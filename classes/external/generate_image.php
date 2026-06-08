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

// Note: require_once($CFG->libdir . '/externallib.php') is intentionally omitted.
// This plugin targets Moodle 4.3+ (requires = 2023100900), where the External API
// classes are fully namespaced under core_external and do not require manual inclusion.
use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;
use context;
use context_system;
use moodle_exception;

/**
 * External function: tiny_imageia_generate_image
 *
 * Proxies the image generation request to the OpenAI API.
 * The API key is stored server-side in Moodle config and is never exposed to the browser.
 */
class generate_image extends external_api {
    /**
     * Describes the parameters for generate_image.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'prompt' => new external_value(PARAM_TEXT, 'Image generation prompt'),
            'model' => new external_value(PARAM_TEXT, 'Model name', VALUE_DEFAULT, 'gpt-image-2'),
            'quality' => new external_value(PARAM_ALPHA, 'Image quality', VALUE_DEFAULT, 'medium'),
            'size' => new external_value(PARAM_TEXT, 'Image size', VALUE_DEFAULT, '1536x1024'),
            'contextid' => new external_value(PARAM_INT, 'Editor context id', VALUE_DEFAULT, 0),
        ]);
    }

    /**
     * Generate an image via the OpenAI API.
     *
     * The model and size parameters are declared as PARAM_TEXT and validated against
     * explicit whitelists below, because PARAM_ALPHANUMEXT does not reliably accept
     * all valid values (e.g. 'auto' for size, or model names containing hyphens and digits
     * across different Moodle versions).
     *
     * @param  string $prompt    The image description prompt.
     * @param  string $model     The OpenAI model to use.
     * @param  string $quality   The image quality level.
     * @param  string $size      The image dimensions.
     * @param  int    $contextid The editor context id.
     * @return array             Array containing the base64-encoded image data.
     * @throws moodle_exception
     */
    public static function execute(
        string $prompt,
        string $model,
        string $quality,
        string $size,
        int $contextid = 0
    ): array {
        // Validate and clean parameters.
        $params = self::validate_parameters(self::execute_parameters(), [
            'prompt'    => $prompt,
            'model'     => $model,
            'quality'   => $quality,
            'size'      => $size,
            'contextid' => $contextid,
        ]);

        // Capability check in the actual editor context when available.
        $context = empty($params['contextid'])
            ? context_system::instance()
            : context::instance_by_id($params['contextid']);
        self::validate_context($context);
        require_capability('tiny/imageia:use', $context);

        // Whitelist validation — PARAM_TEXT above allows any string,
        // so we enforce strict allowed values here.
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
        // \curl is defined in lib/filelib.php — require it explicitly to guarantee availability.
        global $CFG;
        require_once($CFG->libdir . '/filelib.php');
        $curl = new \curl();
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

        // Extract only the necessary fields to avoid double JSON-encoding the full
        // OpenAI response (which would cause unterminated JSON errors in the browser
        // due to the large base64 image payload being re-serialised by Moodle's AJAX layer).
        $imagedata = $decoded['data'][0];
        return [
            'b64_json'       => $imagedata['b64_json'] ?? '',
            'revised_prompt' => $imagedata['revised_prompt'] ?? '',
        ];
    }

    /**
     * Describes the return value of generate_image.
     *
     * The data field uses PARAM_RAW because it contains a JSON-encoded string
     * produced server-side from the OpenAI API response. Cleaning it with any
     * other PARAM type would corrupt the JSON structure. The value is never
     * rendered as HTML without being parsed first in JavaScript.
     *
     * @return external_single_structure
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'b64_json' => new external_value(
                PARAM_RAW,
                'Base64-encoded PNG image data returned by the OpenAI API. ' .
                'PARAM_RAW is required because base64 strings contain characters ' .
                'that would be corrupted by any cleaning filter.'
            ),
            'revised_prompt' => new external_value(
                PARAM_TEXT,
                'The revised prompt used by the model, if available.',
                VALUE_OPTIONAL
            ),
        ]);
    }
}
