// tiny_imageia/amd/src/configuration.js
import {buttonName, menuItemName} from './common';
import {addMenubarItem, addToolbarButtons} from 'editor_tiny/utils';

const getToolbarConfiguration = (instanceConfig) => {
    let toolbar = instanceConfig.toolbar;
    toolbar = addToolbarButtons(toolbar, 'content', [buttonName]);
    return toolbar;
};

const getMenuConfiguration = (instanceConfig) => {
    let menu = instanceConfig.menu;
    menu = addMenubarItem(menu, 'insert', [menuItemName].join(' '));
    return menu;
};

export const configure = (instanceConfig) => {
    return {
        toolbar: getToolbarConfiguration(instanceConfig),
        menu: getMenuConfiguration(instanceConfig),
    };
};
