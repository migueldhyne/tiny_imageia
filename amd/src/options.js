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
 * Options for the tiny_imageia plugin.
 *
 * @module     tiny_imageia/options
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import {getPluginOptionName} from 'editor_tiny/options';
import {pluginName} from './common';

const configuredOptionName = getPluginOptionName(pluginName, 'configured');
const contextIdOptionName = getPluginOptionName(pluginName, 'contextid');

export const register = (editor) => {
    editor.options.register(configuredOptionName, {processor: 'string'});
    editor.options.register(contextIdOptionName, {processor: 'string'});
};

export const isConfigured = (editor) => editor.options.get(configuredOptionName) === '1';

export const getContextId = (editor) => editor.options.get(contextIdOptionName) || '0';
