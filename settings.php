<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Settings for tiny_imageia plugin.
 *
 * @package    tiny_imageia
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings->add(new admin_setting_configtext(
        'tiny_imageia/apikey',
        get_string('apikey', 'tiny_imageia'),
        get_string('apikey_desc', 'tiny_imageia'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configselect(
        'tiny_imageia/defaultmodel',
        get_string('defaultmodel', 'tiny_imageia'),
        get_string('defaultmodel_desc', 'tiny_imageia'),
        'gpt-image-2',
        [
            'gpt-image-2' => 'gpt-image-2 (recommande - meilleure qualite 2025)',
            'dall-e-3'    => 'DALL-E 3 (classique - illustrations artistiques)',
        ]
    ));
}
