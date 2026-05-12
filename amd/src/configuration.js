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
 * TinyMCE toolbar and menu configuration for tiny_imageia plugin.
 *
 * @module     tiny_imageia/configuration
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {buttonName, menuItemName} from './common';
import {addMenubarItem, addToolbarButtons} from 'editor_tiny/utils';

/**
 * Get the updated toolbar configuration with the plugin button added.
 *
 * @param {Object} instanceConfig The current TinyMCE instance configuration.
 * @returns {Array} Updated toolbar configuration.
 */
const getToolbarConfiguration = (instanceConfig) => {
    let toolbar = instanceConfig.toolbar;
    toolbar = addToolbarButtons(toolbar, 'content', [buttonName]);
    return toolbar;
};

/**
 * Get the updated menu configuration with the plugin menu item added.
 *
 * @param {Object} instanceConfig The current TinyMCE instance configuration.
 * @returns {Object} Updated menu configuration.
 */
const getMenuConfiguration = (instanceConfig) => {
    let menu = instanceConfig.menu;
    menu = addMenubarItem(menu, 'insert', [menuItemName].join(' '));
    return menu;
};

/**
 * Configure toolbar and menu for this plugin.
 *
 * @param {Object} instanceConfig The current TinyMCE instance configuration.
 * @returns {Object} Updated configuration with toolbar and menu.
 */
export const configure = (instanceConfig) => {
    return {
        toolbar: getToolbarConfiguration(instanceConfig),
        menu: getMenuConfiguration(instanceConfig),
    };
};
