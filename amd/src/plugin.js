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
 * TinyMCE plugin for AI image generation.
 *
 * @module     tiny_imageia/plugin
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {getTinyMCE} from 'editor_tiny/loader';
import {getPluginMetadata} from 'editor_tiny/utils';
import {component, pluginName, buttonName, menuItemName} from './common';
import {register as registerOptions, getApiKey} from './options';
import * as Configuration from './configuration';
import {get_strings as getStrings} from 'core/str';

/** @type {string} The Moodle component name used for string lookups. */
const COMPONENT = 'tiny_imageia';

/** @type {Object|null} Cached translated strings, loaded once on first dialog open. */
let S = null;

/**
 * Load all plugin strings from Moodle's language system.
 *
 * @returns {Promise<Object>} Resolved object mapping string keys to translated values.
 */
async function loadStrings() {
    if (S !== null) {
        return S;
    }
    const keys = [
        'dialog_title', 'dialog_subtitle', 'close',
        'tab_generate', 'tab_costs', 'tab_tips',
        'model_label', 'model_gpt2_sub', 'model_dalle3_sub',
        'model_new_badge', 'model_classic_badge',
        'model_gpt2_desc', 'model_dalle3_desc',
        'strength_gpt2_1', 'strength_gpt2_2', 'strength_gpt2_3', 'strength_gpt2_4',
        'strength_dalle3_1', 'strength_dalle3_2', 'strength_dalle3_3',
        'quality_low', 'quality_medium', 'quality_high',
        'quality_standard', 'quality_hd',
        'size_square', 'size_landscape', 'size_portrait',
        'size_landscape_std', 'size_portrait_std',
        'tip_gpt2', 'tip_dalle3',
        'promptlibrary', 'promptlibrary_default',
        'prompt_label', 'prompt_placeholder',
        'size_label', 'quality_label', 'cost_label', 'cost_per_image',
        'generate_btn', 'generating', 'generating_note',
        'insert_btn', 'download_btn', 'regenerate_btn',
        'revised_prompt', 'img_alt',
        'error_noprompt', 'error_noapikey', 'error_prefix', 'error_apihint',
        'costs_why_title', 'costs_why_body',
        'costs_how_title', 'costs_how_body',
        'costs_gpt2_title', 'costs_dalle3_title',
        'costs_col_quality', 'costs_col_use',
        'costs_low_use', 'costs_medium_use', 'costs_high_use',
        'costs_standard_use', 'costs_hd_use',
        'sim_title', 'sim_teachers', 'sim_images', 'sim_model',
        'sim_weeks', 'sim_calculate',
        'sim_perweek', 'sim_permonth', 'sim_peryear',
        'sim_gpt2_medium', 'sim_gpt2_low', 'sim_gpt2_high',
        'sim_dalle3_std', 'sim_dalle3_hd',
        'costs_tips_title', 'costs_tip1', 'costs_tip2', 'costs_tip3', 'costs_tip4',
        'privacy_title', 'privacy_body',
        'tips_goal', 'tips_structure_title', 'tips_structure_body',
        'tips_example_label', 'tips_example',
        'tips_dos_title', 'tips_do_col', 'tips_dont_col',
        'tips_do1', 'tips_dont1', 'tips_do2', 'tips_dont2',
        'tips_do3', 'tips_dont3', 'tips_do4', 'tips_dont4',
        'tips_do5', 'tips_dont5',
        'tips_keywords_title',
        'tips_kw_diagrams', 'tips_kw_diagrams_val',
        'tips_kw_illustrations', 'tips_kw_illustrations_val',
        'tips_kw_realistic', 'tips_kw_realistic_val',
        'tips_kw_constraints', 'tips_kw_constraints_val',
        'tips_iteration_title', 'tips_iteration_body',
        'subject_sciences', 'subject_history', 'subject_languages',
        'subject_maths', 'subject_arts', 'subject_cs',
        'topic_biology', 'topic_chemistry', 'topic_physics',
        'topic_history', 'topic_geography',
        'topic_french', 'topic_english',
        'topic_geometry', 'topic_algebra',
        'topic_art_education', 'topic_digital_ai',
        'prompt_bio_1', 'prompt_bio_2', 'prompt_bio_3', 'prompt_bio_4', 'prompt_bio_5',
        'prompt_chem_1', 'prompt_chem_2', 'prompt_chem_3',
        'prompt_phys_1', 'prompt_phys_2', 'prompt_phys_3',
        'prompt_hist_1', 'prompt_hist_2', 'prompt_hist_3',
        'prompt_geo_1', 'prompt_geo_2', 'prompt_geo_3',
        'prompt_fr_1', 'prompt_fr_2',
        'prompt_en_1', 'prompt_en_2', 'prompt_en_3',
        'prompt_geom_1', 'prompt_geom_2', 'prompt_geom_3',
        'prompt_alg_1', 'prompt_alg_2',
        'prompt_art_1', 'prompt_art_2', 'prompt_art_3',
        'prompt_cs_1', 'prompt_cs_2', 'prompt_cs_3', 'prompt_cs_4',
    ];
    const requests = keys.map((key) => ({key, component: COMPONENT}));
    const values = await getStrings(requests);
    S = {};
    keys.forEach((key, i) => {
        S[key] = values[i];
    });
    return S;
}

/**
 * Get model configuration built from translated strings.
 *
 * @returns {Object} Model info keyed by model name.
 */
function getModelInfo() {
    return {
        'gpt-image-2': {
            badge: S.model_new_badge,
            badgeColor: '#7c3aed',
            description: S.model_gpt2_desc,
            strengths: [
                S.strength_gpt2_1,
                S.strength_gpt2_2,
                S.strength_gpt2_3,
                S.strength_gpt2_4,
            ],
            qualities: [
                ['low', S.quality_low],
                ['medium', S.quality_medium],
                ['high', S.quality_high],
            ],
            defaultQuality: 'medium',
            sizes: [
                ['1024x1024', `1024x1024 — ${S.size_square}`],
                ['1536x1024', `1536x1024 — ${S.size_landscape}`],
                ['1024x1536', `1024x1536 — ${S.size_portrait}`],
            ],
            defaultSize: '1536x1024',
            tip: S.tip_gpt2,
            gradient: 'linear-gradient(135deg,#7c3aed,#4f46e5)',
            tipBg: '#f5f3ff',
            tipBorder: '#7c3aed',
            costs: {low: 0.006, medium: 0.053, high: 0.211},
        },
        'dall-e-3': {
            badge: S.model_classic_badge,
            badgeColor: '#2563eb',
            description: S.model_dalle3_desc,
            strengths: [
                S.strength_dalle3_1,
                S.strength_dalle3_2,
                S.strength_dalle3_3,
            ],
            qualities: [
                ['standard', S.quality_standard],
                ['hd', S.quality_hd],
            ],
            defaultQuality: 'standard',
            sizes: [
                ['1024x1024', `1024x1024 — ${S.size_square}`],
                ['1792x1024', `1792x1024 — ${S.size_landscape_std}`],
                ['1024x1792', `1024x1792 — ${S.size_portrait_std}`],
            ],
            defaultSize: '1792x1024',
            tip: S.tip_dalle3,
            gradient: 'linear-gradient(135deg,#2563eb,#1d4ed8)',
            tipBg: '#eff6ff',
            tipBorder: '#2563eb',
            costs: {standard: 0.04, hd: 0.08},
        },
    };
}

/** @type {Object} Cost lookup per model and quality. */
const COST_MAP = {
    'gpt-image-2': {low: 0.006, medium: 0.053, high: 0.211},
    'dall-e-3': {standard: 0.04, hd: 0.08},
};

/**
 * Get the prompt library built from translated strings.
 *
 * @returns {Object} Prompt bank keyed by subject and topic.
 */
function getPromptBank() {
    return {
        [S.subject_sciences]: {
            [S.topic_biology]: [
                S.prompt_bio_1,
                S.prompt_bio_2,
                S.prompt_bio_3,
                S.prompt_bio_4,
                S.prompt_bio_5,
            ],
            [S.topic_chemistry]: [
                S.prompt_chem_1,
                S.prompt_chem_2,
                S.prompt_chem_3,
            ],
            [S.topic_physics]: [
                S.prompt_phys_1,
                S.prompt_phys_2,
                S.prompt_phys_3,
            ],
        },
        [S.subject_history]: {
            [S.topic_history]: [
                S.prompt_hist_1,
                S.prompt_hist_2,
                S.prompt_hist_3,
            ],
            [S.topic_geography]: [
                S.prompt_geo_1,
                S.prompt_geo_2,
                S.prompt_geo_3,
            ],
        },
        [S.subject_languages]: {
            [S.topic_french]: [
                S.prompt_fr_1,
                S.prompt_fr_2,
            ],
            [S.topic_english]: [
                S.prompt_en_1,
                S.prompt_en_2,
                S.prompt_en_3,
            ],
        },
        [S.subject_maths]: {
            [S.topic_geometry]: [
                S.prompt_geom_1,
                S.prompt_geom_2,
                S.prompt_geom_3,
            ],
            [S.topic_algebra]: [
                S.prompt_alg_1,
                S.prompt_alg_2,
            ],
        },
        [S.subject_arts]: {
            [S.topic_art_education]: [
                S.prompt_art_1,
                S.prompt_art_2,
                S.prompt_art_3,
            ],
        },
        [S.subject_cs]: {
            [S.topic_digital_ai]: [
                S.prompt_cs_1,
                S.prompt_cs_2,
                S.prompt_cs_3,
                S.prompt_cs_4,
            ],
        },
    };
}

/**
 * Build the model info card HTML for a given model key.
 *
 * @param {string} modelKey The model identifier.
 * @param {Object} modelInfo The model configuration object.
 * @returns {string} HTML string.
 */
function buildModelCard(modelKey, modelInfo) {
    const info = modelInfo[modelKey];
    const items = info.strengths.map((s) => `<li>${s}</li>`).join('');
    return '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;'
        + 'padding:12px 14px;font-size:.82rem;color:#374151;">'
        + `<span style="background:${info.badgeColor};color:#fff;font-size:.7rem;`
        + `font-weight:700;padding:2px 8px;border-radius:99px;">${info.badge}</span> `
        + `<strong>${modelKey}</strong>`
        + `<p style="margin:6px 0;">${info.description}</p>`
        + `<ul style="margin:0;padding-left:16px;">${items}</ul></div>`;
}

/**
 * Build size select options for a given model.
 *
 * @param {string} modelKey The model identifier.
 * @param {Object} modelInfo The model configuration object.
 * @returns {string} HTML option elements.
 */
function buildSizeOptions(modelKey, modelInfo) {
    return modelInfo[modelKey].sizes.map(([val, label]) => {
        const selected = val === modelInfo[modelKey].defaultSize ? ' selected' : '';
        return `<option value="${val}"${selected}>${label}</option>`;
    }).join('');
}

/**
 * Build quality select options for a given model.
 *
 * @param {string} modelKey The model identifier.
 * @param {Object} modelInfo The model configuration object.
 * @returns {string} HTML option elements.
 */
function buildQualityOptions(modelKey, modelInfo) {
    return modelInfo[modelKey].qualities.map(([val, label]) => {
        const selected = val === modelInfo[modelKey].defaultQuality ? ' selected' : '';
        return `<option value="${val}"${selected}>${label}</option>`;
    }).join('');
}

/**
 * Build the prompt bank select options.
 *
 * @param {Object} promptBank The prompt bank object.
 * @returns {string} HTML option and optgroup elements.
 */
function buildBankOptions(promptBank) {
    let html = `<option value="">${S.promptlibrary_default}</option>`;
    Object.keys(promptBank).forEach((subject) => {
        html += `<optgroup label="${subject}">`;
        Object.keys(promptBank[subject]).forEach((topic) => {
            promptBank[subject][topic].forEach((p) => {
                const safe = p.replace(/"/g, '&quot;');
                const label = p.substring(0, 65) + '...';
                html += `<option value="${safe}">${topic} -- ${label}</option>`;
            });
        });
        html += '</optgroup>';
    });
    return html;
}

/**
 * Build the cost transparency tab HTML.
 *
 * @returns {string} HTML string.
 */
function buildCostTab() {
    return '<div id="tab-cost" style="display:none;">'
        + '<div style="background:#fffbeb;border:1px solid #fde68a;border-radius:8px;'
        + 'padding:14px;margin-bottom:16px;font-size:.85rem;color:#92400e;">'
        + `<strong>${S.costs_why_title}</strong> ${S.costs_why_body}</div>`
        + `<h3 style="font-size:.9rem;color:#7c3aed;">${S.costs_gpt2_title}</h3>`
        + '<table style="width:100%;border-collapse:collapse;font-size:.82rem;margin-bottom:14px;">'
        + '<tr style="background:#f5f3ff;">'
        + `<th style="padding:7px;border:1px solid #e5e7eb;text-align:left;">${S.costs_col_quality}</th>`
        + '<th style="padding:7px;border:1px solid #e5e7eb;text-align:center;">1024x1024</th>'
        + `<th style="padding:7px;border:1px solid #e5e7eb;text-align:left;">${S.costs_col_use}</th></tr>`
        + '<tr><td style="padding:7px;border:1px solid #e5e7eb;"><strong>low</strong></td>'
        + '<td style="padding:7px;border:1px solid #e5e7eb;text-align:center;color:#059669;">'
        + 'approx. $0.006</td>'
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.costs_low_use}</td></tr>`
        + '<tr style="background:#fafafa;">'
        + '<td style="padding:7px;border:1px solid #e5e7eb;"><strong>medium</strong></td>'
        + '<td style="padding:7px;border:1px solid #e5e7eb;text-align:center;color:#2563eb;">'
        + 'approx. $0.053</td>'
        + `<td style="padding:7px;border:1px solid #e5e7eb;"><strong>${S.costs_medium_use}</strong>`
        + '</td></tr>'
        + '<tr><td style="padding:7px;border:1px solid #e5e7eb;"><strong>high</strong></td>'
        + '<td style="padding:7px;border:1px solid #e5e7eb;text-align:center;color:#dc2626;">'
        + 'approx. $0.211</td>'
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.costs_high_use}</td></tr>`
        + '</table>'
        + `<h3 style="font-size:.9rem;color:#2563eb;">${S.costs_dalle3_title}</h3>`
        + '<table style="width:100%;border-collapse:collapse;font-size:.82rem;margin-bottom:16px;">'
        + '<tr style="background:#eff6ff;">'
        + `<th style="padding:7px;border:1px solid #e5e7eb;text-align:left;">${S.costs_col_quality}</th>`
        + '<th style="padding:7px;border:1px solid #e5e7eb;text-align:center;">1024x1024</th>'
        + `<th style="padding:7px;border:1px solid #e5e7eb;text-align:left;">${S.costs_col_use}</th></tr>`
        + '<tr><td style="padding:7px;border:1px solid #e5e7eb;"><strong>standard</strong></td>'
        + '<td style="padding:7px;border:1px solid #e5e7eb;text-align:center;color:#059669;">'
        + 'approx. $0.04</td>'
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.costs_standard_use}</td></tr>`
        + '<tr style="background:#fafafa;">'
        + '<td style="padding:7px;border:1px solid #e5e7eb;"><strong>hd</strong></td>'
        + '<td style="padding:7px;border:1px solid #e5e7eb;text-align:center;color:#2563eb;">'
        + 'approx. $0.08</td>'
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.costs_hd_use}</td></tr>`
        + '</table>'
        + `<h3 style="font-size:.9rem;color:#111;">${S.sim_title}</h3>`
        + '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:14px;">'
        + '<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">'
        + `<div><label style="font-size:.82rem;font-weight:600;display:block;margin-bottom:3px;">${S.sim_teachers}</label>`
        + '<input type="number" id="sim-teachers" value="5" min="1" '
        + 'style="width:100%;padding:6px;border:1px solid #d1d5db;border-radius:6px;'
        + 'font-size:.84rem;box-sizing:border-box;"></div>'
        + `<div><label style="font-size:.82rem;font-weight:600;display:block;margin-bottom:3px;">${S.sim_images}</label>`
        + '<input type="number" id="sim-images" value="10" min="1" '
        + 'style="width:100%;padding:6px;border:1px solid #d1d5db;border-radius:6px;'
        + 'font-size:.84rem;box-sizing:border-box;"></div>'
        + `<div><label style="font-size:.82rem;font-weight:600;display:block;margin-bottom:3px;">${S.sim_model}</label>`
        + '<select id="sim-model" style="width:100%;padding:6px;border:1px solid #d1d5db;'
        + 'border-radius:6px;font-size:.82rem;">'
        + `<option value="0.053">${S.sim_gpt2_medium}</option>`
        + `<option value="0.006">${S.sim_gpt2_low}</option>`
        + `<option value="0.211">${S.sim_gpt2_high}</option>`
        + `<option value="0.04">${S.sim_dalle3_std}</option>`
        + `<option value="0.08">${S.sim_dalle3_hd}</option>`
        + '</select></div>'
        + `<div><label style="font-size:.82rem;font-weight:600;display:block;margin-bottom:3px;">${S.sim_weeks}</label>`
        + '<input type="number" id="sim-weeks" value="36" min="1" max="52" '
        + 'style="width:100%;padding:6px;border:1px solid #d1d5db;border-radius:6px;'
        + 'font-size:.84rem;box-sizing:border-box;"></div>'
        + '</div>'
        + `<button id="sim-calc" style="width:100%;padding:9px;background:#374151;color:#fff;`
        + `border:none;border-radius:7px;font-weight:600;cursor:pointer;">${S.sim_calculate}</button>`
        + '<div id="sim-result" style="display:none;margin-top:10px;"></div>'
        + '</div>'
        + `<h3 style="font-size:.9rem;color:#111;margin-top:16px;">${S.costs_tips_title}</h3>`
        + '<ul style="font-size:.82rem;line-height:1.8;padding-left:18px;margin:0 0 14px;">'
        + `<li>${S.costs_tip1}</li>`
        + `<li>${S.costs_tip2}</li>`
        + `<li>${S.costs_tip3}</li>`
        + `<li>${S.costs_tip4}</li>`
        + '</ul>'
        + '<div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;'
        + 'padding:12px;font-size:.81rem;color:#7f1d1d;">'
        + `<strong>${S.privacy_title}</strong> ${S.privacy_body}</div>`
        + '</div>';
}

/**
 * Build the prompt tips tab HTML.
 *
 * @returns {string} HTML string.
 */
function buildTipsTab() {
    return '<div id="tab-tips" style="display:none;">'
        + '<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;'
        + `padding:12px;margin-bottom:14px;font-size:.83rem;color:#14532d;">${S.tips_goal}</div>`
        + `<h3 style="font-size:.9rem;">${S.tips_structure_title}</h3>`
        + '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;'
        + 'padding:12px;font-size:.82rem;margin-bottom:14px;">'
        + `${S.tips_structure_body}<br><br>`
        + `<em>${S.tips_example_label}</em> ${S.tips_example}</div>`
        + `<h3 style="font-size:.9rem;">${S.tips_dos_title}</h3>`
        + '<table style="width:100%;border-collapse:collapse;font-size:.81rem;margin-bottom:14px;">'
        + '<tr>'
        + `<th style="padding:7px;background:#f0fdf4;border:1px solid #e5e7eb;text-align:left;`
        + `color:#14532d;">${S.tips_do_col}</th>`
        + `<th style="padding:7px;background:#fef2f2;border:1px solid #e5e7eb;text-align:left;`
        + `color:#7f1d1d;">${S.tips_dont_col}</th></tr>`
        + `<tr><td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_do1}</td>`
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_dont1}</td></tr>`
        + `<tr style="background:#fafafa;">`
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_do2}</td>`
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_dont2}</td></tr>`
        + `<tr><td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_do3}</td>`
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_dont3}</td></tr>`
        + `<tr style="background:#fafafa;">`
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_do4}</td>`
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_dont4}</td></tr>`
        + `<tr><td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_do5}</td>`
        + `<td style="padding:7px;border:1px solid #e5e7eb;">${S.tips_dont5}</td></tr>`
        + '</table>'
        + `<h3 style="font-size:.9rem;">${S.tips_keywords_title}</h3>`
        + '<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:.82rem;">'
        + '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:7px;padding:10px;">'
        + `<strong>${S.tips_kw_diagrams}</strong><br>`
        + `<span style="color:#6b7280;">${S.tips_kw_diagrams_val}</span></div>`
        + '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:7px;padding:10px;">'
        + `<strong>${S.tips_kw_illustrations}</strong><br>`
        + `<span style="color:#6b7280;">${S.tips_kw_illustrations_val}</span></div>`
        + '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:7px;padding:10px;">'
        + `<strong>${S.tips_kw_realistic}</strong><br>`
        + `<span style="color:#6b7280;">${S.tips_kw_realistic_val}</span></div>`
        + '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:7px;padding:10px;">'
        + `<strong>${S.tips_kw_constraints}</strong><br>`
        + `<span style="color:#6b7280;">${S.tips_kw_constraints_val}</span></div></div>`
        + '<div style="background:#eff6ff;border-left:4px solid #2563eb;border-radius:5px;'
        + 'padding:10px;margin-top:14px;font-size:.82rem;color:#1e3a5f;">'
        + `<strong>${S.tips_iteration_title}:</strong> ${S.tips_iteration_body}</div>`
        + '</div>';
}

/**
 * Build the complete modal HTML.
 *
 * @param {Object} modelInfo The model configuration object.
 * @param {Object} promptBank The prompt bank object.
 * @returns {string} HTML string.
 */
function buildModalHTML(modelInfo, promptBank) {
    const activeTab = 'padding:9px 16px;border:none;border-bottom:3px solid #7c3aed;'
        + 'background:none;cursor:pointer;font-size:.86rem;font-weight:700;color:#7c3aed;';
    const inactiveTab = 'padding:9px 16px;border:none;border-bottom:3px solid transparent;'
        + 'background:none;cursor:pointer;font-size:.86rem;font-weight:500;color:#6b7280;';

    return '<div id="imageia-overlay" style="position:fixed;inset:0;background:rgba(0,0,0,.6);'
        + 'z-index:99999;display:flex;align-items:center;justify-content:center;">'
        + '<div style="background:#fff;border-radius:14px;width:700px;max-width:96vw;'
        + 'max-height:92vh;overflow:hidden;display:flex;flex-direction:column;'
        + 'box-shadow:0 16px 56px rgba(0,0,0,.35);">'
        + '<div style="padding:20px 26px 0;flex-shrink:0;">'
        + '<div style="display:flex;justify-content:space-between;margin-bottom:14px;">'
        + '<div>'
        + `<h2 style="margin:0;font-size:1.1rem;color:#111;">${S.dialog_title}</h2>`
        + `<p style="margin:3px 0 0;font-size:.76rem;color:#9ca3af;">${S.dialog_subtitle}</p>`
        + '</div>'
        + `<button id="imageia-close" style="background:none;border:none;font-size:1.5rem;`
        + `cursor:pointer;color:#9ca3af;">${S.close}</button></div>`
        + '<div style="display:flex;border-bottom:1px solid #e5e7eb;'
        + 'margin:0 -26px;padding:0 26px;overflow-x:auto;">'
        + `<button id="tab-btn-generate" style="${activeTab}">${S.tab_generate}</button>`
        + `<button id="tab-btn-cost" style="${inactiveTab}">${S.tab_costs}</button>`
        + `<button id="tab-btn-tips" style="${inactiveTab}">${S.tab_tips}</button>`
        + '</div></div>'
        + '<div style="padding:18px 26px 22px;overflow-y:auto;flex:1;">'
        + '<div id="tab-generate">'
        + `<label style="font-weight:700;font-size:.87rem;display:block;margin-bottom:8px;">`
        + `${S.model_label}</label>`
        + '<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:12px;">'
        + '<label id="lbl-gpt2" style="display:flex;align-items:center;gap:8px;padding:10px 12px;'
        + 'border:2px solid #7c3aed;border-radius:8px;cursor:pointer;background:#faf5ff;">'
        + '<input type="radio" name="imageia-model" value="gpt-image-2" checked>'
        + '<div>'
        + '<div style="font-weight:700;color:#7c3aed;font-size:.87rem;">gpt-image-2</div>'
        + `<div style="font-size:.73rem;color:#6b7280;">${S.model_gpt2_sub}</div>`
        + '</div></label>'
        + '<label id="lbl-dalle3" style="display:flex;align-items:center;gap:8px;padding:10px 12px;'
        + 'border:2px solid #e5e7eb;border-radius:8px;cursor:pointer;background:#f9fafb;">'
        + '<input type="radio" name="imageia-model" value="dall-e-3">'
        + '<div>'
        + '<div style="font-weight:700;color:#2563eb;font-size:.87rem;">DALL-E 3</div>'
        + `<div style="font-size:.73rem;color:#6b7280;">${S.model_dalle3_sub}</div>`
        + '</div></label></div>'
        + '<div id="imageia-model-card" style="margin-bottom:12px;">'
        + buildModelCard('gpt-image-2', modelInfo) + '</div>'
        + '<hr style="border:none;border-top:1px solid #f3f4f6;margin:0 0 12px;">'
        + `<label style="font-weight:700;font-size:.87rem;display:block;margin-bottom:6px;">`
        + `${S.promptlibrary}</label>`
        + '<select id="imageia-bank" style="width:100%;padding:8px;border:1px solid #d1d5db;'
        + 'border-radius:7px;font-size:.85rem;margin-bottom:12px;">'
        + buildBankOptions(promptBank) + '</select>'
        + `<label style="font-weight:700;font-size:.87rem;display:block;margin-bottom:6px;">`
        + `${S.prompt_label}</label>`
        + `<textarea id="imageia-prompt" rows="4" placeholder="${S.prompt_placeholder}" `
        + 'style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:7px;'
        + 'font-size:.85rem;resize:vertical;box-sizing:border-box;line-height:1.6;"></textarea>'
        + '<div style="display:flex;gap:10px;margin-top:10px;flex-wrap:wrap;align-items:flex-end;">'
        + '<div style="flex:1;min-width:140px;">'
        + `<label style="font-size:.82rem;font-weight:700;display:block;margin-bottom:4px;">`
        + `${S.size_label}</label>`
        + '<select id="imageia-size" style="width:100%;padding:7px;border:1px solid #d1d5db;'
        + 'border-radius:7px;font-size:.82rem;">'
        + buildSizeOptions('gpt-image-2', modelInfo) + '</select></div>'
        + '<div style="flex:1;min-width:140px;">'
        + `<label style="font-size:.82rem;font-weight:700;display:block;margin-bottom:4px;">`
        + `${S.quality_label}</label>`
        + '<select id="imageia-quality" style="width:100%;padding:7px;border:1px solid #d1d5db;'
        + 'border-radius:7px;font-size:.82rem;">'
        + buildQualityOptions('gpt-image-2', modelInfo) + '</select></div>'
        + '<div id="cost-estimate-box" style="background:#f5f3ff;border:1px solid #ddd6fe;'
        + 'border-radius:7px;padding:7px 12px;text-align:center;">'
        + `<div style="font-size:.68rem;color:#7c3aed;font-weight:600;">${S.cost_label}</div>`
        + '<div id="cost-estimate-value" style="font-size:.95rem;font-weight:700;color:#7c3aed;">'
        + 'approx. $0.053</div>'
        + `<div style="font-size:.64rem;color:#9ca3af;">${S.cost_per_image}</div></div></div>`
        + '<div id="imageia-tip" style="background:#f5f3ff;border-left:4px solid #7c3aed;'
        + 'border-radius:5px;padding:10px 14px;margin-top:12px;font-size:.8rem;line-height:1.55;">'
        + modelInfo['gpt-image-2'].tip + '</div>'
        + '<button id="imageia-generate" style="margin-top:14px;width:100%;padding:13px;'
        + 'background:linear-gradient(135deg,#7c3aed,#4f46e5);color:#fff;border:none;'
        + 'border-radius:9px;font-size:.96rem;font-weight:700;cursor:pointer;">'
        + `${S.generate_btn.replace('{$a}', 'gpt-image-2')}</button>`
        + '<div id="imageia-result" style="margin-top:16px;display:none;text-align:center;">'
        + '<div id="imageia-loading" style="display:none;padding:22px;">'
        + '<div style="font-size:1.6rem;margin-bottom:6px;">...</div>'
        + `<div id="loading-label" style="color:#7c3aed;font-weight:700;">${S.generating}</div>`
        + `<div style="color:#9ca3af;font-size:.79rem;margin-top:4px;">${S.generating_note}</div>`
        + '</div>'
        + '<div id="imageia-error" style="display:none;color:#dc2626;background:#fef2f2;'
        + 'border:1px solid #fecaca;padding:12px;border-radius:7px;margin-bottom:10px;'
        + 'text-align:left;font-size:.85rem;"></div>'
        + `<img id="imageia-img" style="max-width:100%;border-radius:10px;`
        + `box-shadow:0 4px 20px rgba(0,0,0,.18);display:none;" alt="${S.img_alt}"/>`
        + '<div id="imageia-revised" style="display:none;margin-top:6px;font-size:.75rem;'
        + 'color:#9ca3af;font-style:italic;text-align:left;"></div>'
        + '<div id="imageia-actions" style="display:none;margin-top:12px;gap:10px;'
        + 'justify-content:center;flex-wrap:wrap;">'
        + `<button id="imageia-insert" style="padding:10px 20px;background:#10b981;color:#fff;`
        + `border:none;border-radius:7px;cursor:pointer;font-weight:700;">`
        + `${S.insert_btn}</button>`
        + `<a id="imageia-download" download="ai-image.png" `
        + `style="padding:10px 20px;background:#6366f1;color:#fff;border-radius:7px;`
        + `text-decoration:none;font-weight:700;display:inline-block;">${S.download_btn}</a>`
        + `<button id="imageia-regenerate" style="padding:10px 20px;background:#f9fafb;`
        + `color:#374151;border:1px solid #d1d5db;border-radius:7px;cursor:pointer;">`
        + `${S.regenerate_btn}</button>`
        + '</div></div></div>'
        + buildCostTab()
        + buildTipsTab()
        + '</div></div></div>';
}

/**
 * Update the cost estimate display based on current model and quality.
 *
 * @param {HTMLElement} wrapper The dialog wrapper element.
 */
function updateCostEstimate(wrapper) {
    const modelInput = wrapper.querySelector('input[name="imageia-model"]:checked');
    const qualSelect = document.getElementById('imageia-quality');
    const costBox = document.getElementById('cost-estimate-value');
    const costContainer = document.getElementById('cost-estimate-box');
    if (!modelInput || !qualSelect || !costBox) {
        return;
    }
    const modelKey = modelInput.value;
    const quality = qualSelect.value;
    const cost = COST_MAP[modelKey] ? COST_MAP[modelKey][quality] : undefined;
    if (cost !== undefined) {
        costBox.textContent = `approx. $${cost.toFixed(3)}`;
        if (cost < 0.01) {
            costContainer.style.background = '#f0fdf4';
            costContainer.style.borderColor = '#bbf7d0';
            costBox.style.color = '#059669';
        } else if (cost < 0.1) {
            costContainer.style.background = '#f5f3ff';
            costContainer.style.borderColor = '#ddd6fe';
            costBox.style.color = '#7c3aed';
        } else {
            costContainer.style.background = '#fef2f2';
            costContainer.style.borderColor = '#fecaca';
            costBox.style.color = '#dc2626';
        }
    }
}

/**
 * Switch to the specified dialog tab.
 *
 * @param {string} name The tab name: generate, cost, or tips.
 */
function switchTab(name) {
    ['generate', 'cost', 'tips'].forEach((t) => {
        const content = document.getElementById(`tab-${t}`);
        const btn = document.getElementById(`tab-btn-${t}`);
        const isActive = t === name;
        if (content) {
            content.style.display = isActive ? 'block' : 'none';
        }
        if (btn) {
            btn.style.borderBottom = isActive
                ? '3px solid #7c3aed' : '3px solid transparent';
            btn.style.fontWeight = isActive ? '700' : '500';
            btn.style.color = isActive ? '#7c3aed' : '#6b7280';
        }
    });
}

/**
 * Run the budget simulator and display results.
 */
function runSimulator() {
    const teachersEl = document.getElementById('sim-teachers');
    const imagesEl = document.getElementById('sim-images');
    const weeksEl = document.getElementById('sim-weeks');
    const modelEl = document.getElementById('sim-model');
    const resultEl = document.getElementById('sim-result');
    if (!teachersEl || !imagesEl || !weeksEl || !modelEl || !resultEl) {
        return;
    }
    const teachers = parseInt(teachersEl.value) || 5;
    const images = parseInt(imagesEl.value) || 10;
    const weeks = parseInt(weeksEl.value) || 36;
    const costPerImage = parseFloat(modelEl.value) || 0.053;
    const perWeek = teachers * images * costPerImage;
    const perMonth = perWeek * (weeks / 12);
    const perYear = perWeek * weeks;
    let color;
    if (perYear < 50) {
        color = '#059669';
    } else if (perYear < 200) {
        color = '#d97706';
    } else {
        color = '#dc2626';
    }
    const cap = (perMonth * 1.3).toFixed(2);
    const tip = S.sim_tip.replace('{$a}', `$${cap}`);
    resultEl.style.display = 'block';
    resultEl.innerHTML = '<div style="background:#fff;border:1px solid #e5e7eb;border-radius:8px;">'
        + '<div style="display:grid;grid-template-columns:1fr 1fr 1fr;text-align:center;">'
        + '<div style="padding:12px;border-right:1px solid #e5e7eb;">'
        + `<div style="font-size:.73rem;color:#6b7280;">${S.sim_perweek}</div>`
        + `<div style="font-size:1rem;font-weight:700;">$${perWeek.toFixed(2)}</div></div>`
        + '<div style="padding:12px;border-right:1px solid #e5e7eb;">'
        + `<div style="font-size:.73rem;color:#6b7280;">${S.sim_permonth}</div>`
        + `<div style="font-size:1rem;font-weight:700;">$${perMonth.toFixed(2)}</div></div>`
        + '<div style="padding:12px;">'
        + `<div style="font-size:.73rem;color:#6b7280;">${S.sim_peryear}</div>`
        + `<div style="font-size:1.1rem;font-weight:700;color:${color};">`
        + `$${perYear.toFixed(2)}</div></div></div>`
        + '<div style="padding:9px 12px;background:#fffbeb;border-top:1px solid #fde68a;'
        + `font-size:.77rem;color:#92400e;">${tip}</div></div>`;
}

/**
 * Open the image generation dialog.
 *
 * @param {Object} editor The TinyMCE editor instance.
 * @param {string} apiKey The OpenAI API key.
 */
function openImageIADialog(editor, apiKey) {
    const modelInfo = getModelInfo();
    const promptBank = getPromptBank();
    const wrapper = document.createElement('div');
    wrapper.innerHTML = buildModalHTML(modelInfo, promptBank);
    document.body.appendChild(wrapper);

    // Tab navigation.
    ['generate', 'cost', 'tips'].forEach((t) => {
        const btn = document.getElementById(`tab-btn-${t}`);
        if (btn) {
            btn.addEventListener('click', () => switchTab(t));
        }
    });

    // Quality change.
    const qualSelect = document.getElementById('imageia-quality');
    if (qualSelect) {
        qualSelect.addEventListener('change', () => updateCostEstimate(wrapper));
    }

    // Model change.
    wrapper.querySelectorAll('input[name="imageia-model"]').forEach((radio) => {
        radio.addEventListener('change', () => {
            const m = radio.value;
            const info = modelInfo[m];
            const lblGpt2 = document.getElementById('lbl-gpt2');
            const lblDalle3 = document.getElementById('lbl-dalle3');
            const modelCard = document.getElementById('imageia-model-card');
            const sizeEl = document.getElementById('imageia-size');
            const qualEl = document.getElementById('imageia-quality');
            const tipEl = document.getElementById('imageia-tip');
            const genBtn = document.getElementById('imageia-generate');
            if (lblGpt2) {
                lblGpt2.style.border = m === 'gpt-image-2'
                    ? '2px solid #7c3aed' : '2px solid #e5e7eb';
                lblGpt2.style.background = m === 'gpt-image-2' ? '#faf5ff' : '#f9fafb';
            }
            if (lblDalle3) {
                lblDalle3.style.border = m === 'dall-e-3'
                    ? '2px solid #2563eb' : '2px solid #e5e7eb';
                lblDalle3.style.background = m === 'dall-e-3' ? '#eff6ff' : '#f9fafb';
            }
            if (modelCard) {
                modelCard.innerHTML = buildModelCard(m, modelInfo);
            }
            if (sizeEl) {
                sizeEl.innerHTML = buildSizeOptions(m, modelInfo);
            }
            if (qualEl) {
                qualEl.innerHTML = buildQualityOptions(m, modelInfo);
            }
            if (tipEl) {
                tipEl.style.background = info.tipBg;
                tipEl.style.borderColor = info.tipBorder;
                tipEl.innerHTML = info.tip;
            }
            if (genBtn) {
                genBtn.style.background = info.gradient;
                genBtn.textContent = S.generate_btn.replace('{$a}', m);
            }
            updateCostEstimate(wrapper);
        });
    });

    // Prompt bank selection.
    const bankSelect = document.getElementById('imageia-bank');
    const promptTA = document.getElementById('imageia-prompt');
    if (bankSelect && promptTA) {
        bankSelect.addEventListener('change', () => {
            if (bankSelect.value) {
                promptTA.value = bankSelect.value;
            }
        });
    }

    // Simulator.
    const simCalc = document.getElementById('sim-calc');
    if (simCalc) {
        simCalc.addEventListener('click', runSimulator);
    }

    // Close.
    const closeBtn = document.getElementById('imageia-close');
    const overlay = document.getElementById('imageia-overlay');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => document.body.removeChild(wrapper));
    }
    if (overlay) {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                document.body.removeChild(wrapper);
            }
        });
    }

    /**
     * Call the OpenAI API and handle the response.
     *
     * @returns {Promise<void>}
     */
    /**
     * Set UI into loading state.
     *
     * @param {string} modelKey Selected model key.
     * @param {Object} modelData Model info object.
     */
    function setLoadingState(modelKey, modelData) {
        const ids = {
            result: 'imageia-result', loading: 'imageia-loading',
            loadingLbl: 'loading-label', error: 'imageia-error',
            img: 'imageia-img', actions: 'imageia-actions',
            revised: 'imageia-revised', btn: 'imageia-generate',
        };
        const el = {};
        Object.keys(ids).forEach((k) => {
            el[k] = document.getElementById(ids[k]);
        });
        if (el.result) {
            el.result.style.display = 'block';
        }
        if (el.loading) {
            el.loading.style.display = 'block';
        }
        if (el.loadingLbl) {
            el.loadingLbl.style.color = modelData[modelKey].badgeColor;
        }
        if (el.error) {
            el.error.style.display = 'none';
        }
        if (el.img) {
            el.img.style.display = 'none';
        }
        if (el.actions) {
            el.actions.style.display = 'none';
        }
        if (el.revised) {
            el.revised.style.display = 'none';
        }
        if (el.btn) {
            el.btn.disabled = true;
            el.btn.style.opacity = '0.65';
            el.btn.textContent = S.generating;
        }
    }

    /**
     * Reset UI after API call.
     *
     * @param {string} fallbackModel Fallback model key.
     */
    function resetLoadingState(fallbackModel) {
        const loadingDiv = document.getElementById('imageia-loading');
        const genBtn = document.getElementById('imageia-generate');
        if (loadingDiv) {
            loadingDiv.style.display = 'none';
        }
        if (genBtn) {
            const cm = wrapper.querySelector('input[name="imageia-model"]:checked');
            genBtn.disabled = false;
            genBtn.style.opacity = '1';
            genBtn.textContent = S.generate_btn.replace('{$a}', cm ? cm.value : fallbackModel);
        }
    }

    /**
     * Update UI with successful image generation result.
     *
     * @param {string} src Base64 image data URL.
     * @param {string|undefined} revisedPrompt Revised prompt from OpenAI.
     */
    function handleSuccess(src, revisedPrompt) {
        const imgEl = document.getElementById('imageia-img');
        const downloadA = document.getElementById('imageia-download');
        const actionsDiv = document.getElementById('imageia-actions');
        const revisedEl = document.getElementById('imageia-revised');
        if (imgEl) {
            imgEl.src = src;
            imgEl.style.display = 'block';
        }
        if (downloadA) {
            downloadA.href = src;
        }
        if (actionsDiv) {
            actionsDiv.style.display = 'flex';
        }
        if (revisedPrompt && revisedEl) {
            revisedEl.style.display = 'block';
            revisedEl.textContent = `${S.revised_prompt} "${revisedPrompt.substring(0, 140)}..."`;
        }
    }

    /**
     * Call the OpenAI API and update the UI.
     *
     * @returns {Promise<void>}
     */
    async function generate() {
        const prompt = promptTA ? promptTA.value.trim() : '';
        if (!prompt) {
            window.console.warn(S.error_noprompt);
            return;
        }
        if (!apiKey) {
            window.console.warn(S.error_noapikey);
            return;
        }

        const modelInput = wrapper.querySelector('input[name="imageia-model"]:checked');
        const sizeEl = document.getElementById('imageia-size');
        const qualEl = document.getElementById('imageia-quality');
        const m = modelInput ? modelInput.value : 'gpt-image-2';
        const size = sizeEl ? sizeEl.value : '1024x1024';
        const quality = qualEl ? qualEl.value : 'medium';

        setLoadingState(m, modelInfo);

        const responseFormat = 'b64_json';
        const requestBody = {
            model: m,
            prompt: prompt,
            n: 1,
            size: size,
            quality: quality,
        };
        requestBody['response_format'] = responseFormat;

        try {
            const resp = await fetch('https://api.openai.com/v1/images/generations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${apiKey}`,
                },
                body: JSON.stringify(requestBody),
            });
            const data = await resp.json();
            if (!resp.ok) {
                throw new Error(data.error ? data.error.message : `API error ${resp.status}`);
            }
            handleSuccess(
                `data:image/png;base64,${data.data[0].b64_json}`,
                data.data[0].revised_prompt
            );
        } catch (err) {
            const errorDiv = document.getElementById('imageia-error');
            if (errorDiv) {
                errorDiv.textContent = `${S.error_prefix} ${err.message}`;
                errorDiv.style.display = 'block';
            }
        } finally {
            resetLoadingState(m);
        }
    }

    const genBtn = document.getElementById('imageia-generate');
    const regenBtn = document.getElementById('imageia-regenerate');
    if (genBtn) {
        genBtn.addEventListener('click', generate);
    }
    if (regenBtn) {
        regenBtn.addEventListener('click', generate);
    }

    // Insert into editor.
    const insertBtn = document.getElementById('imageia-insert');
    if (insertBtn) {
        insertBtn.addEventListener('click', () => {
            const imgEl = document.getElementById('imageia-img');
            if (imgEl && imgEl.src) {
                const currentModel = wrapper.querySelector(
                    'input[name="imageia-model"]:checked'
                );
                const usedModel = currentModel ? currentModel.value : 'gpt-image-2';
                editor.insertContent(
                    `<img src="${imgEl.src}" alt="${S.img_alt} (${usedModel})" `
                    + 'style="max-width:100%;height:auto;border-radius:4px;" />'
                );
                document.body.removeChild(wrapper);
            }
        });
    }

    updateCostEstimate(wrapper);
}

/**
 * Register the plugin button, menu item and custom icon with TinyMCE.
 *
 * @param {Object} editor The TinyMCE editor instance.
 */
const setupCommands = (editor) => {
    editor.ui.registry.addIcon(
        'imageia',
        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"'
        + ' fill="none"><rect x="1" y="5" width="18" height="14" rx="2"'
        + ' stroke="currentColor" stroke-width="1.7" fill="none"/>'
        + '<path d="M1 13 L5.5 8 L9 11 L12 9 L19 13" stroke="currentColor"'
        + ' stroke-width="1.5" stroke-linejoin="round" fill="none"/>'
        + '<circle cx="5.5" cy="10" r="1.5" fill="currentColor"/>'
        + '<path d="M20 0.5 L21.1 3.4 L24 4.5 L21.1 5.6 L20 8.5 L18.9 5.6 L16 4.5'
        + ' L18.9 3.4 Z" fill="currentColor"/>'
        + '<circle cx="23" cy="9.5" r="1" fill="currentColor" opacity="0.6"/>'
        + '<circle cx="17.5" cy="10.5" r="0.7" fill="currentColor" opacity="0.4"/></svg>'
    );
    editor.ui.registry.addButton(buttonName, {
        icon: 'imageia',
        tooltip: 'Generate a pedagogical AI image',
        onAction: () => loadStrings().then(() => openImageIADialog(editor, getApiKey(editor))),
    });
    editor.ui.registry.addMenuItem(menuItemName, {
        icon: 'imageia',
        text: 'Generate a pedagogical AI image',
        onAction: () => loadStrings().then(() => openImageIADialog(editor, getApiKey(editor))),
    });
};

const initPromise = Promise.all([
    getTinyMCE(),
    getPluginMetadata(component, pluginName),
]).then(([tinyMCE, pluginMetadata]) => {
    tinyMCE.PluginManager.add(pluginName, (editor) => {
        registerOptions(editor);
        setupCommands(editor);
        return pluginMetadata;
    });
    return [pluginName, Configuration];
});

export default initPromise;
