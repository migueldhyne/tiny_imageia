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
 * Server-side proxy for OpenAI image generation.
 * The API key never leaves the server.
 *
 * @package    tiny_imageia
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);
require_once(dirname(__DIR__, 5) . '/config.php');
require_once($CFG->libdir . '/filelib.php');

require_login();
header('Content-Type: application/json; charset=utf-8');

$sesskey = optional_param('sesskey', '', PARAM_RAW);
if (!confirm_sesskey($sesskey)) {
    http_response_code(403);
    die(json_encode(['error' => 'Invalid session key.']));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['error' => 'Method not allowed.']));
}

$body = json_decode(file_get_contents('php://input'), true);
if (!is_array($body) || empty($body['prompt'])) {
    http_response_code(400);
    die(json_encode(['error' => 'Missing prompt.']));
}

$prompt = clean_param($body['prompt'], PARAM_TEXT);
$model = clean_param($body['model'] ?? 'gpt-image-2', PARAM_RAW);
$quality = clean_param($body['quality'] ?? 'medium', PARAM_ALPHA);
$size = clean_param($body['size'] ?? '1536x1024', PARAM_RAW);

$allowedmodels = ['gpt-image-2'];
$allowedsizes = ['1024x1024', '1536x1024', '1024x1536', 'auto'];
$allowedqualities = ['low', 'medium', 'high'];

if (!in_array($model, $allowedmodels, true)) {
    http_response_code(400);
    die(json_encode(['error' => 'Invalid model.']));
}
if (!in_array($size, $allowedsizes, true)) {
    http_response_code(400);
    die(json_encode(['error' => 'Invalid size.']));
}
if (!in_array($quality, $allowedqualities, true)) {
    http_response_code(400);
    die(json_encode(['error' => 'Invalid quality.']));
}
if (empty(trim($prompt))) {
    http_response_code(400);
    die(json_encode(['error' => 'Prompt cannot be empty.']));
}

$apikey = trim((string) get_config('tiny_imageia', 'apikey'));
if ($apikey === '') {
    http_response_code(503);
    die(json_encode([
        'error' => 'OpenAI API key is not configured for component tiny_imageia on this Moodle site.',
        'code' => 'missing_moodle_config_apikey',
        'hint' => 'Re-save the OpenAI API key in Site administration > Plugins > Text editors > ImageIA pédagogique, then purge Moodle caches.',
    ]));
}

$payload = json_encode([
    'model' => $model,
    'prompt' => $prompt,
    'n' => 1,
    'size' => $size,
    'quality' => $quality,
]);

$options = [
    'CURLOPT_TIMEOUT' => 180,
    'CURLOPT_CONNECTTIMEOUT' => 15,
    'CURLOPT_RETURNTRANSFER' => true,
];
// Moodle curl class — compatible with all versions.
if (class_exists('\\core\\curl')) {
    $curl = new \core\curl();
} else if (class_exists('curl')) {
    $curl = new curl();
} else {
    http_response_code(500);
    die(json_encode(['error' => 'Moodle curl class not available. Make sure
    filelib.php is loaded and the PHP cURL extension is enabled.']));
}
$curl->setHeader([
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apikey,
]);
$curl->setopt($options);

$response = $curl->post('https://api.openai.com/v1/images/generations', $payload);

if ($response === false || $response === null || $response === '') {
    http_response_code(502);
    die(json_encode(['error' => 'Network error contacting OpenAI.']));
}

$info = $curl->get_info();
$httpcode = is_array($info) ? ($info['http_code'] ?? 0) : 0;
$decoded = json_decode($response, true);

if ($httpcode !== 200) {
    $message = isset($decoded['error']['message'])
        ? $decoded['error']['message']
        : 'OpenAI HTTP ' . $httpcode . ' — raw: ' . substr($response, 0, 500);
    http_response_code(502);
    die(json_encode(['error' => $message, 'http' => $httpcode, 'raw' => substr($response, 0, 500)]));
}

if (!isset($decoded['data']) || !is_array($decoded['data']) || count($decoded['data']) === 0) {
    http_response_code(502);
    die(json_encode(['error' => 'Unexpected response: ' . substr($response, 0, 300)]));
}

echo json_encode(['data' => $decoded['data']]);
