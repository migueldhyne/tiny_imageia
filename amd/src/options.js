// tiny_imageia/amd/src/options.js
import {getPluginOptionName} from 'editor_tiny/options';
import {pluginName} from './common';

const apiKeyOptionName = getPluginOptionName(pluginName, 'apikey');

export const register = (editor) => {
    editor.options.register(apiKeyOptionName, {
        processor: 'string',
    });
};

export const getApiKey = (editor) => editor.options.get(apiKeyOptionName) || '';
