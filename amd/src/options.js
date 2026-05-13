// tiny_imageia/amd/src/options.js
import {getPluginOptionName} from 'editor_tiny/options';
import {pluginName} from './common';

const proxyUrlOptionName = getPluginOptionName(pluginName, 'proxyurl');
const configuredOptionName = getPluginOptionName(pluginName, 'configured');

export const register = (editor) => {
    editor.options.register(proxyUrlOptionName, {processor: 'string'});
    editor.options.register(configuredOptionName, {processor: 'string'});
};

export const getProxyUrl = (editor) => editor.options.get(proxyUrlOptionName) || '';
export const isConfigured = (editor) => editor.options.get(configuredOptionName) === '1';
