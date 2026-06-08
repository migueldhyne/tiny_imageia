<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * External service: generate an AI image via the OpenAI API.
 *
 * @package    tiny_imageia
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tiny_imageia\external;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');
require_once($CFG->libdir . '/filelib.php');

use external_api;
use external_function_parameters;
use external_single_structure;
use external_value;
use context_system;
use moodle_exception;

/**
 * External function: tiny_imageia_generate_image
 *
 * Proxies the image generation request to the OpenAI API.
 * The API key is stored server-side and never exposed to the browser.
 */
class generate_image extends external_api {

    /**
     * Describes the parameters for generate_image.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'prompt'  => new external_value(PARAM_TEXT,       'Image generation prompt'),
            'model'   => new external_value(PARAM_ALPHANUMEXT, 'Model name',   VALUE_DEFAULT, 'gpt-image-2'),
            'quality' => new external_value(PARAM_ALPHA,       'Image quality', VALUE_DEFAULT, 'medium'),
            'size'    => new external_value(PARAM_ALPHANUMEXT, 'Image size',    VALUE_DEFAULT, '1536x1024'),
        ]);
    }

    /**
     * Generate an image via the OpenAI API.
     *
     * @param  string $prompt  The image description prompt.
     * @param  string $model   The OpenAI model to use.
     * @param  string $quality The image quality level.
     * @param  string $size    The image dimensions.
     * @return array           Array containing the base64-encoded image data.
     * @throws moodle_exception
     */
    public static function execute(string $prompt, string $model, string $quality, string $size): array {
        global $CFG;

        // Validate and clean parameters.
        $params = self::validate_parameters(self::execute_parameters(), [
            'prompt'  => $prompt,
            'model'   => $model,
            'quality' => $quality,
            'size'    => $size,
        ]);

        // Capability check.
        $context = context_system::instance();
        self::validate_context($context);
        require_capability('tiny/imageia:use', $context);

        // Whitelist validation.
        $allowedmodels    = ['gpt-image-2'];
        $allowedsizes     = ['1024x1024', '1536x1024', '1024x1536', 'auto'];
        $allowedqualities = ['low', 'medium', 'high'];

        if (!in_array($params['model'], $allowedmodels, true)) {
            throw new moodle_exception('invalidparameter', 'error', '', 'model');
        }
        if (!in_array($params['size'], $allowedsizes, true)) {
            throw new moodle_exception('invalidparameter', 'error', '', 'size');
        }
        if (!in_array($params['quality'], $allowedqualities, true)) {
            throw new moodle_exception('invalidparameter', 'error', '', 'quality');
        }
        if (empty(trim($params['prompt']))) {
            throw new moodle_exception('invalidparameter', 'error', '', 'prompt');
        }

        // Retrieve the API key from Moodle config (never exposed to the client).
        $apikey = trim((string) get_config('tiny_imageia', 'apikey'));
        if ($apikey === '') {
            throw new moodle_exception('missingapikey', 'tiny_imageia');
        }

        // Build the request payload.
        $payload = json_encode([
            'model'   => $params['model'],
            'prompt'  => $params['prompt'],
            'n'       => 1,
            'size'    => $params['size'],
            'quality' => $params['quality'],
        ]);

        // Call the OpenAI API using Moodle's curl wrapper.
        if (class_exists('\\core\\curl')) {
            $curl = new \core\curl();
        } else {
            $curl = new \curl();
        }

        $curl->setHeader([
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apikey,
        ]);
        $curl->setopt([
            'CURLOPT_TIMEOUT'        => 180,
            'CURLOPT_CONNECTTIMEOUT' => 15,
            'CURLOPT_RETURNTRANSFER' => true,
        ]);

        $response = $curl->post('https://api.openai.com/v1/images/generations', $payload);

        if ($response === false || $response === null || $response === '') {
            throw new moodle_exception('networkerror', 'tiny_imageia');
        }

        $info     = $curl->get_info();
        $httpcode = is_array($info) ? ($info['http_code'] ?? 0) : 0;
        $decoded  = json_decode($response, true);

        if ($httpcode !== 200) {
            $message = $decoded['error']['message'] ?? ('OpenAI HTTP ' . $httpcode);
            throw new moodle_exception('apierror', 'tiny_imageia', '', $message);
        }

        if (empty($decoded['data']) || !is_array($decoded['data'])) {
            throw new moodle_exception('unexpectedresponse', 'tiny_imageia');
        }

        return ['data' => json_encode($decoded['data'])];
    }

    /**
     * Describes the return value of generate_image.
     *
     * @return external_single_structure
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'data' => new external_value(PARAM_RAW, 'JSON-encoded array of image data objects from OpenAI'),
        ]);
    }
}
