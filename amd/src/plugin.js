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
 * TinyMCE plugin for pedagogical AI image generation via the OpenAI API.
 *
 * All user-facing strings are loaded from the lang files via core/str.
 * The modal UI is rendered using a Mustache template (tiny_imageia/modal).
 * The image generation request is sent via the tiny_imageia_generate_image
 * External Service (core/ajax), never directly to the OpenAI API from the browser.
 *
 * @module     tiny_imageia/plugin
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {getTinyMCE} from 'editor_tiny/loader';
import {getPluginMetadata} from 'editor_tiny/utils';
import {component, pluginName, buttonName, menuItemName} from './common';
import {register as registerOptions, isConfigured, getContextId} from './options';
import * as Configuration from './configuration';
import {get_strings as getStrings} from 'core/str';
import Ajax from 'core/ajax';
import Notification from 'core/notification';
import Templates from 'core/templates';

// ---------------------------------------------------------------------------
// String keys to preload from the lang file via core/str.
// All user-facing text must come from here — no hard-coded strings in this file.
// ---------------------------------------------------------------------------
const STRING_KEYS = [
    'buttontitle',
    'cost_col_quality', 'cost_col_use', 'cost_high_use', 'cost_how_body', 'cost_how_title',
    'cost_label', 'cost_low_use', 'cost_medium_use', 'cost_per_image', 'cost_table_title',
    'cost_why_body', 'cost_why_title',
    'best_1', 'best_2', 'best_3', 'best_4', 'best_5', 'best_title',
    'dialog_subtitle', 'dialog_title',
    'download_btn',
    'error_hint', 'error_no_key', 'error_no_prompt', 'error_prefix',
    'generate_btn', 'generating', 'generating_hint',
    'img_alt', 'insert_btn',
    'model_badge', 'model_desc', 'model_label', 'model_sub', 'model_tip',
    'prompt_bank_label', 'prompt_hint', 'prompt_label', 'prompt_placeholder', 'prompt_used_prefix',
    'quality_high', 'quality_label', 'quality_low', 'quality_medium',
    'regen_btn',
    'select_prompt',
    'sim_btn', 'sim_images', 'sim_model', 'sim_opt_high', 'sim_opt_low', 'sim_opt_medium',
    'sim_per_month', 'sim_per_week', 'sim_per_year', 'sim_teachers', 'sim_title', 'sim_weeks',
    'size_auto', 'size_label', 'size_landscape', 'size_portrait', 'size_square',
    'strength_1', 'strength_2', 'strength_3', 'strength_4', 'strength_5',
    'subj_arts', 'subj_hg', 'subj_info', 'subj_lang', 'subj_maths', 'subj_sciences',
    'tab_cost', 'tab_generate', 'tab_tips',
    'tips_do_1', 'tips_do_2', 'tips_do_3', 'tips_do_4', 'tips_do_5', 'tips_do_6',
    'tips_do_col', 'tips_do_title',
    'tips_dont_1', 'tips_dont_2', 'tips_dont_3', 'tips_dont_4', 'tips_dont_5', 'tips_dont_6',
    'tips_dont_col', 'tips_example', 'tips_example_label', 'tips_goal',
    'tips_iter_body', 'tips_iter_title',
    'tips_kw_const', 'tips_kw_const_val', 'tips_kw_diag', 'tips_kw_diag_val',
    'tips_kw_illus', 'tips_kw_illus_val', 'tips_kw_photo', 'tips_kw_photo_val',
    'tips_kw_title', 'tips_struct_body', 'tips_struct_title',
    'topic_alg', 'topic_art', 'topic_bio', 'topic_chem', 'topic_cs',
    'topic_en', 'topic_fr', 'topic_geo', 'topic_geom', 'topic_hist', 'topic_phys',
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
    'prompt_cs_1', 'prompt_cs_2', 'prompt_cs_3', 'prompt_cs_4', 'prompt_cs_5',
];

// Loaded strings cache — null until loadStrings() is called.
let T = null;

/**
 * Load all plugin strings from the lang file via core/str.
 * Results are cached so the network call only happens once per page.
 *
 * @returns {Promise<Object>} Resolved string map keyed by string id.
 */
async function loadStrings() {
    if (T !== null) {
        return T;
    }
    const requests = STRING_KEYS.map(key => ({key, component: 'tiny_imageia'}));
    const values = await getStrings(requests);
    T = {};
    STRING_KEYS.forEach((key, i) => {
        T[key] = values[i];
    });
    return T;
}

// ---------------------------------------------------------------------------
// Model information — labels come from T (lang strings), costs are numeric.
// ---------------------------------------------------------------------------

/**
 * Return the model info object using localised strings.
 * Must be called after loadStrings().
 *
 * @returns {Object} Model metadata map.
 */
function getModelInfo() {
    return {
        'gpt-image-2': {
            badge: T.model_badge,
            badgeColor: '#7c3aed',
            description: T.model_desc,
            strengths: [T.strength_1, T.strength_2, T.strength_3, T.strength_4, T.strength_5],
            qualities: [
                ['low', T.quality_low],
                ['medium', T.quality_medium],
                ['high', T.quality_high],
            ],
            defaultQuality: 'medium',
            sizes: [
                ['1024x1024', '1024\u00d71024 \u2014 ' + T.size_square],
                ['1536x1024', '1536\u00d71024 \u2014 ' + T.size_landscape],
                ['1024x1536', '1024\u00d71536 \u2014 ' + T.size_portrait],
                ['auto', T.size_auto],
            ],
            defaultSize: '1536x1024',
            tip: T.model_tip,
            gradient: 'linear-gradient(135deg,#7c3aed,#4f46e5)',
            tipBg: '#f5f3ff',
            tipBorder: '#7c3aed',
            // Estimated cost per image (source: OpenAI calculator)
            costs: {low: 0.006, medium: 0.053, high: 0.211},
        },
    };
}

// ---------------------------------------------------------------------------
// Prompt bank — subject and topic labels come from T (lang strings).
// The prompts themselves are in English in the lang file.
// ---------------------------------------------------------------------------

/**
 * Return the prompt bank using localised subject/topic labels and prompts.
 * Must be called after loadStrings().
 *
 * @returns {Object} Nested prompt bank structure.
 */
function getPromptBank() {
    return {
        [T.subj_sciences]: {
            [T.topic_bio]:  [T.prompt_bio_1, T.prompt_bio_2, T.prompt_bio_3, T.prompt_bio_4, T.prompt_bio_5],
            [T.topic_chem]: [T.prompt_chem_1, T.prompt_chem_2, T.prompt_chem_3],
            [T.topic_phys]: [T.prompt_phys_1, T.prompt_phys_2, T.prompt_phys_3],
        },
        [T.subj_hg]: {
            [T.topic_hist]: [T.prompt_hist_1, T.prompt_hist_2, T.prompt_hist_3],
            [T.topic_geo]:  [T.prompt_geo_1, T.prompt_geo_2, T.prompt_geo_3],
        },
        [T.subj_lang]: {
            [T.topic_fr]: [T.prompt_fr_1, T.prompt_fr_2],
            [T.topic_en]: [T.prompt_en_1, T.prompt_en_2, T.prompt_en_3],
        },
        [T.subj_maths]: {
            [T.topic_geom]: [T.prompt_geom_1, T.prompt_geom_2, T.prompt_geom_3],
            [T.topic_alg]:  [T.prompt_alg_1, T.prompt_alg_2],
        },
        [T.subj_arts]: {
            [T.topic_art]: [T.prompt_art_1, T.prompt_art_2, T.prompt_art_3],
        },
        [T.subj_info]: {
            [T.topic_cs]: [T.prompt_cs_1, T.prompt_cs_2, T.prompt_cs_3, T.prompt_cs_4, T.prompt_cs_5],
        },
    };
}

// ---------------------------------------------------------------------------
// HTML fragment builders — use T for all text, return HTML strings.
// These populate the dynamic sections injected into the Mustache template.
// ---------------------------------------------------------------------------

/**
 * Build the model info card HTML for a given model key.
 *
 * @param {string} m Model key (e.g. 'gpt-image-2').
 * @returns {string} HTML string.
 */
function buildModelCard(m) {
    const modelInfo = getModelInfo();
    const info = modelInfo[m];
    const strengths = info.strengths.map(s => `<li style="margin:2px 0;">\u2713 ${s}</li>`).join('');
    return `
    <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:12px 14px;font-size:.82rem;color:#374151;line-height:1.5;">
      <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;flex-wrap:wrap;">
        <span style="background:${info.badgeColor};color:#fff;font-size:.7rem;font-weight:700;padding:2px 8px;border-radius:99px;">${info.badge}</span>
        <strong style="font-size:.88rem;">${m}</strong>
      </div>
      <p style="margin:0 0 6px;">${info.description}</p>
      <ul style="margin:0;padding-left:16px;color:#4b5563;">${strengths}</ul>
    </div>`;
}

/**
 * Build the size <option> elements for a given model.
 *
 * @param {string} m Model key.
 * @returns {string} HTML string.
 */
function buildSizeOptions(m) {
    const modelInfo = getModelInfo();
    return modelInfo[m].sizes
        .map(([val, label]) =>
            `<option value="${val}"${val === modelInfo[m].defaultSize ? ' selected' : ''}>${label}</option>`
        ).join('');
}

/**
 * Build the quality <option> elements for a given model.
 *
 * @param {string} m Model key.
 * @returns {string} HTML string.
 */
function buildQualityOptions(m) {
    const modelInfo = getModelInfo();
    return modelInfo[m].qualities
        .map(([val, label]) =>
            `<option value="${val}"${val === modelInfo[m].defaultQuality ? ' selected' : ''}>${label}</option>`
        ).join('');
}

/**
 * Build the prompt bank <option> and <optgroup> elements.
 *
 * @returns {string} HTML string.
 */
function buildBankOptions() {
    const promptBank = getPromptBank();
    let html = `<option value="">${T.select_prompt}</option>`;
    for (const [subject, topics] of Object.entries(promptBank)) {
        html += `<optgroup label="${subject}">`;
        for (const [topic, prompts] of Object.entries(topics)) {
            prompts.forEach(p => {
                const label = p.substring(0, 65).replace(/"/g, '&quot;') + '\u2026';
                html += `<option value="${p.replace(/"/g, '&quot;')}">${topic} \u2014 ${label}</option>`;
            });
        }
        html += '</optgroup>';
    }
    return html;
}

/**
 * Build the Costs & Transparency tab HTML.
 * All text comes from T (lang strings).
 *
 * @returns {string} HTML string.
 */
function buildCostTab() {
    return `
  <div>
    <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:14px 16px;margin-bottom:18px;font-size:.85rem;color:#92400e;line-height:1.6;">
      <strong>\u2139\ufe0f ${T.cost_why_title}</strong><br>${T.cost_why_body}
    </div>
    <h3 style="font-size:.95rem;color:#111;margin:0 0 8px;">\ud83d\udcca ${T.cost_how_title}</h3>
    <p style="font-size:.83rem;color:#374151;line-height:1.6;margin:0 0 14px;">${T.cost_how_body}</p>
    <h3 style="font-size:.9rem;color:#7c3aed;margin:0 0 8px;">\u2728 ${T.cost_table_title}</h3>
    <table style="width:100%;border-collapse:collapse;font-size:.83rem;margin-bottom:16px;">
      <thead>
        <tr style="background:#f5f3ff;">
          <th style="padding:8px 10px;text-align:left;border:1px solid #e5e7eb;color:#4b5563;">${T.cost_col_quality}</th>
          <th style="padding:8px 10px;text-align:center;border:1px solid #e5e7eb;color:#4b5563;">1024\u00d71024</th>
          <th style="padding:8px 10px;text-align:center;border:1px solid #e5e7eb;color:#4b5563;">1536\u00d71024</th>
          <th style="padding:8px 10px;text-align:center;border:1px solid #e5e7eb;color:#4b5563;">${T.cost_col_use}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;"><strong>low</strong></td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;text-align:center;color:#059669;font-weight:600;">\u2248 0.006 $</td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;text-align:center;color:#059669;">\u2248 0.008 $</td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;color:#6b7280;">${T.cost_low_use}</td>
        </tr>
        <tr style="background:#fafafa;">
          <td style="padding:8px 10px;border:1px solid #e5e7eb;"><strong>medium \u2713</strong></td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;text-align:center;color:#2563eb;font-weight:600;">\u2248 0.053 $</td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;text-align:center;color:#2563eb;">\u2248 0.07 $</td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;"><strong>${T.cost_medium_use}</strong></td>
        </tr>
        <tr>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;"><strong>high</strong></td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;text-align:center;color:#dc2626;font-weight:600;">\u2248 0.21 $</td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;text-align:center;color:#dc2626;">\u2248 0.28 $</td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;color:#6b7280;">${T.cost_high_use}</td>
        </tr>
      </tbody>
    </table>
    <h3 style="font-size:.95rem;color:#111;margin:0 0 10px;">\ud83e\uddee ${T.sim_title}</h3>
    <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:14px 16px;margin-bottom:18px;">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
        <div>
          <label style="font-size:.82rem;font-weight:600;color:#374151;display:block;margin-bottom:4px;" for="sim-teachers">${T.sim_teachers}</label>
          <input type="number" id="sim-teachers" value="5" min="1" max="500"
            style="width:100%;padding:7px;border:1px solid #d1d5db;border-radius:6px;font-size:.85rem;box-sizing:border-box;">
        </div>
        <div>
          <label style="font-size:.82rem;font-weight:600;color:#374151;display:block;margin-bottom:4px;" for="sim-images">${T.sim_images}</label>
          <input type="number" id="sim-images" value="10" min="1" max="1000"
            style="width:100%;padding:7px;border:1px solid #d1d5db;border-radius:6px;font-size:.85rem;box-sizing:border-box;">
        </div>
        <div>
          <label style="font-size:.82rem;font-weight:600;color:#374151;display:block;margin-bottom:4px;" for="sim-model">${T.sim_model}</label>
          <select id="sim-model" style="width:100%;padding:7px;border:1px solid #d1d5db;border-radius:6px;font-size:.85rem;">
            <option value="gpt-image-2-medium">${T.sim_opt_medium}</option>
            <option value="gpt-image-2-low">${T.sim_opt_low}</option>
            <option value="gpt-image-2-high">${T.sim_opt_high}</option>
          </select>
        </div>
        <div>
          <label style="font-size:.82rem;font-weight:600;color:#374151;display:block;margin-bottom:4px;" for="sim-weeks">${T.sim_weeks}</label>
          <input type="number" id="sim-weeks" value="36" min="1" max="52"
            style="width:100%;padding:7px;border:1px solid #d1d5db;border-radius:6px;font-size:.85rem;box-sizing:border-box;">
        </div>
      </div>
      <button id="sim-calc" style="width:100%;padding:9px;background:#374151;color:#fff;border:none;border-radius:7px;font-weight:600;cursor:pointer;font-size:.88rem;">
        ${T.sim_btn}
      </button>
      <div id="sim-result" style="display:none;margin-top:12px;"></div>
    </div>
    <h3 style="font-size:.95rem;color:#111;margin:0 0 8px;">\u2705 ${T.best_title}</h3>
    <ul style="font-size:.83rem;color:#374151;line-height:1.8;padding-left:18px;margin:0 0 16px;">
      <li>${T.best_1}</li>
      <li>${T.best_2}</li>
      <li>${T.best_3}</li>
      <li>${T.best_4}</li>
      <li>${T.best_5}</li>
    </ul>
  </div>`;
}

/**
 * Build the Prompt Tips tab HTML.
 * All text comes from T (lang strings).
 *
 * @returns {string} HTML string.
 */
function buildTipsTab() {
    return `
  <div>
    <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:12px 16px;margin-bottom:16px;font-size:.83rem;color:#14532d;line-height:1.6;">
      <strong>\ud83c\udfaf ${T.tips_goal}</strong>
    </div>
    <h3 style="font-size:.9rem;color:#111;margin:0 0 8px;">\ud83c\udfd7\ufe0f ${T.tips_struct_title}</h3>
    <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:12px 14px;font-size:.82rem;color:#374151;line-height:1.7;margin-bottom:16px;">
      ${T.tips_struct_body}
      <br><br>
      <em>${T.tips_example_label}</em><br>
      <span style="color:#7c3aed;">${T.tips_example}</span>
    </div>
    <h3 style="font-size:.9rem;color:#111;margin:0 0 8px;">${T.tips_do_title}</h3>
    <table style="width:100%;border-collapse:collapse;font-size:.82rem;margin-bottom:16px;">
      <thead>
        <tr>
          <th style="padding:8px 10px;background:#f0fdf4;border:1px solid #e5e7eb;color:#14532d;text-align:left;">\u2705 ${T.tips_do_col}</th>
          <th style="padding:8px 10px;background:#fef2f2;border:1px solid #e5e7eb;color:#7f1d1d;text-align:left;">\u274c ${T.tips_dont_col}</th>
        </tr>
      </thead>
      <tbody>
        ${[1,2,3,4,5,6].map((n, i) => `
        <tr${i % 2 ? ' style="background:#fafafa;"' : ''}>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;">${T['tips_do_' + n]}</td>
          <td style="padding:8px 10px;border:1px solid #e5e7eb;">${T['tips_dont_' + n]}</td>
        </tr>`).join('')}
      </tbody>
    </table>
    <h3 style="font-size:.9rem;color:#111;margin:0 0 8px;">\ud83c\udfa8 ${T.tips_kw_title}</h3>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:.82rem;margin-bottom:16px;">
      <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:7px;padding:10px 12px;">
        <strong style="color:#374151;">${T.tips_kw_diag}</strong><br>
        <span style="color:#6b7280;">${T.tips_kw_diag_val}</span>
      </div>
      <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:7px;padding:10px 12px;">
        <strong style="color:#374151;">${T.tips_kw_illus}</strong><br>
        <span style="color:#6b7280;">${T.tips_kw_illus_val}</span>
      </div>
      <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:7px;padding:10px 12px;">
        <strong style="color:#374151;">${T.tips_kw_photo}</strong><br>
        <span style="color:#6b7280;">${T.tips_kw_photo_val}</span>
      </div>
      <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:7px;padding:10px 12px;">
        <strong style="color:#374151;">${T.tips_kw_const}</strong><br>
        <span style="color:#6b7280;">${T.tips_kw_const_val}</span>
      </div>
    </div>
    <div style="background:#eff6ff;border-left:4px solid #2563eb;border-radius:5px;padding:10px 14px;font-size:.82rem;color:#1e3a5f;line-height:1.6;">
      <strong>\ud83d\udd04 ${T.tips_iter_title}:</strong> ${T.tips_iter_body}
    </div>
  </div>`;
}

// ---------------------------------------------------------------------------
// Cost map (numeric, no localisation needed)
// ---------------------------------------------------------------------------
const COST_MAP = {
    'gpt-image-2': {low: 0.006, medium: 0.053, high: 0.211},
};

// ---------------------------------------------------------------------------
// Image request builder
// ---------------------------------------------------------------------------

/**
 * Build the image generation request payload.
 *
 * @param {string} model   Model key.
 * @param {string} prompt  User prompt.
 * @param {string} size    Image size string.
 * @param {string} quality Image quality string.
 * @returns {Object} Request payload.
 */
function buildImageRequest(model, prompt, size, quality) {
    return {model, prompt, n: 1, size, quality};
}

// ---------------------------------------------------------------------------
// Dialog
// ---------------------------------------------------------------------------

/**
 * Open the image generation dialog.
 * Strings are loaded, then the modal Mustache template is rendered and appended.
 *
 * @param {Object}  editor    TinyMCE editor instance.
 * @param {boolean} configured Whether the plugin API key is configured.
 */
async function openImageIADialog(editor, configured) {
    // Load all strings before rendering anything.
    await loadStrings();
    const modelInfo = getModelInfo();

    // Build the template context — dynamic HTML sections are passed as context variables.
    const templateContext = {
        promptplaceholder: T.prompt_placeholder,
        bankoptions:       buildBankOptions(),
        modelcard:         buildModelCard('gpt-image-2'),
        sizeoptions:       buildSizeOptions('gpt-image-2'),
        qualityoptions:    buildQualityOptions('gpt-image-2'),
        modeltip:          modelInfo['gpt-image-2'].tip,
        costtab:           buildCostTab(),
        tipstab:           buildTipsTab(),
    };

    // Render the Mustache template and inject into the DOM.
    const wrapper = document.createElement('div');
    const {html, js} = await Templates.renderForPromise('tiny_imageia/modal', templateContext);
    Templates.appendNodeContents(wrapper, html, js);
    document.body.appendChild(wrapper);

    const $ = id => document.getElementById(id);

    // Element references.
    const overlay      = $('imageia-overlay');
    const bankSelect   = $('imageia-bank');
    const promptTA     = $('imageia-prompt');
    const genBtn       = $('imageia-generate');
    const resultDiv    = $('imageia-result');
    const loadingDiv   = $('imageia-loading');
    const loadingLabel = $('loading-model-label');
    const errorDiv     = $('imageia-error');
    const imgEl        = $('imageia-img');
    const actionsDiv   = $('imageia-actions');
    const insertBtn    = $('imageia-insert');
    const downloadA    = $('imageia-download');
    const regenBtn     = $('imageia-regenerate');
    const modelCard    = $('imageia-model-card');
    const tipDiv       = $('imageia-tip');
    const promptUsed   = $('imageia-prompt-used');
    const sizeSelect   = $('imageia-size');
    const qualSelect   = $('imageia-quality');
    const costBox      = $('cost-estimate-value');

    function getModel() {
        return wrapper.querySelector('input[name="imageia-model"]:checked').value;
    }

    // Update the estimated cost display when quality changes.
    function updateCostEstimate() {
        const m    = getModel();
        const q    = qualSelect.value;
        const cost = COST_MAP[m]?.[q];
        if (cost !== undefined) {
            costBox.textContent = `\u2248 ${cost.toFixed(3)} $`;
            const box = $('cost-estimate-box');
            box.style.borderColor = cost < 0.01 ? '#bbf7d0' : cost < 0.1 ? '#ddd6fe' : '#fecaca';
            box.style.background  = cost < 0.01 ? '#f0fdf4' : cost < 0.1 ? '#f5f3ff' : '#fef2f2';
            costBox.style.color   = cost < 0.01 ? '#059669' : cost < 0.1 ? '#7c3aed' : '#dc2626';
        }
    }

    qualSelect.addEventListener('change', updateCostEstimate);

    // Update card and options when the user switches models.
    wrapper.querySelectorAll('input[name="imageia-model"]').forEach(radio => {
        radio.addEventListener('change', () => {
            const m    = radio.value;
            const info = modelInfo[m];
            $('lbl-gpt2').style.border     = m === 'gpt-image-2' ? '2px solid #7c3aed' : '2px solid #e5e7eb';
            $('lbl-gpt2').style.background = m === 'gpt-image-2' ? '#faf5ff' : '#f9fafb';
            // These fragments are built entirely from lang strings (T.*) and
            // static option values — no user input is injected.
            modelCard.innerHTML   = buildModelCard(m);
            sizeSelect.innerHTML  = buildSizeOptions(m);
            qualSelect.innerHTML  = buildQualityOptions(m);
            tipDiv.style.background  = info.tipBg;
            tipDiv.style.borderColor = info.tipBorder;
            tipDiv.innerHTML = info.tip; // info.tip comes from T.model_tip (lang string)
            genBtn.style.background  = info.gradient;
            updateCostEstimate();
        });
    });

    // Tab switching.
    function switchTab(name) {
        ['generate', 'cost', 'tips'].forEach(t => {
            const content = $(`tab-${t}`);
            const btn     = $(`tab-btn-${t}`);
            const active  = t === name;
            if (content) {
                content.style.display = active ? 'block' : 'none';
            }
            if (btn) {
                btn.style.borderBottom = active ? '3px solid #7c3aed' : '3px solid transparent';
                btn.style.fontWeight   = active ? '700' : '500';
                btn.style.color        = active ? '#7c3aed' : '#6b7280';
                btn.setAttribute('aria-selected', active ? 'true' : 'false');
            }
        });
    }

    ['generate', 'cost', 'tips'].forEach(t => {
        const btn = $(`tab-btn-${t}`);
        if (btn) {
            btn.addEventListener('click', () => switchTab(t));
        }
    });

    // Budget simulator calculation.
    const simCalc = $('sim-calc');
    if (simCalc) {
        simCalc.addEventListener('click', () => {
            const teachers = parseInt($('sim-teachers').value) || 5;
            const images   = parseInt($('sim-images').value)   || 10;
            const weeks    = parseInt($('sim-weeks').value)    || 36;
            const modelKey = $('sim-model').value;

            const costPerImage = {
                'gpt-image-2-low':    0.006,
                'gpt-image-2-medium': 0.053,
                'gpt-image-2-high':   0.211,
            }[modelKey] || 0.053;

            const perWeek  = teachers * images * costPerImage;
            const perMonth = perWeek * (weeks / 12);
            const perYear  = perWeek * weeks;
            const fmt      = n => n.toFixed(2);
            const color    = perYear < 50 ? '#059669' : perYear < 200 ? '#d97706' : '#dc2626';

            $('sim-result').style.display = 'block';
            // Simulator result: built from numeric calculations and T.* lang strings only.
            $('sim-result').innerHTML = `
              <div style="background:#fff;border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;">
                <div style="background:#f9fafb;padding:10px 14px;font-size:.82rem;color:#374151;border-bottom:1px solid #e5e7eb;">
                  <strong>${teachers} ${T.sim_teachers}</strong> \u00d7
                  <strong>${images} ${T.sim_images}</strong> \u00d7
                  <strong>${weeks} ${T.sim_weeks}</strong> \u2014 ${costPerImage.toFixed(3)} $/image
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;text-align:center;">
                  <div style="padding:14px 10px;border-right:1px solid #e5e7eb;">
                    <div style="font-size:.75rem;color:#6b7280;margin-bottom:4px;">${T.sim_per_week}</div>
                    <div style="font-size:1.1rem;font-weight:700;color:#374151;">${fmt(perWeek)} $</div>
                  </div>
                  <div style="padding:14px 10px;border-right:1px solid #e5e7eb;">
                    <div style="font-size:.75rem;color:#6b7280;margin-bottom:4px;">${T.sim_per_month}</div>
                    <div style="font-size:1.1rem;font-weight:700;color:#374151;">${fmt(perMonth)} $</div>
                  </div>
                  <div style="padding:14px 10px;">
                    <div style="font-size:.75rem;color:#6b7280;margin-bottom:4px;">${T.sim_per_year}</div>
                    <div style="font-size:1.3rem;font-weight:700;color:${color};">${fmt(perYear)} $</div>
                  </div>
                </div>
              </div>`;
        });
    }

    // Fill prompt textarea from the prompt bank.
    bankSelect.addEventListener('change', () => {
        if (bankSelect.value) {
            promptTA.value = bankSelect.value;
        }
    });

    // Close the dialog.
    $('imageia-close').addEventListener('click', () => document.body.removeChild(wrapper));
    overlay.addEventListener('click', e => {
        if (e.target === overlay) {
            document.body.removeChild(wrapper);
        }
    });

    // Image generation via the External Service (tiny_imageia_generate_image).
    async function generate() {
        const prompt = promptTA.value.trim();
        if (!prompt) {
            Notification.alert('', T.error_no_prompt);
            return;
        }
        if (!configured) {
            Notification.alert('', T.error_no_key);
            return;
        }

        const m       = getModel();
        const size    = sizeSelect.value;
        const quality = qualSelect.value;

        resultDiv.style.display  = 'block';
        loadingDiv.style.display = 'block';
        loadingLabel.style.color = getModelInfo()[m].badgeColor;
        errorDiv.style.display   = 'none';
        imgEl.style.display      = 'none';
        actionsDiv.style.display = 'none';
        promptUsed.style.display = 'none';
        genBtn.disabled          = true;
        genBtn.style.opacity     = '0.65';

        try {
            const request = buildImageRequest(m, prompt, size, quality);
            const result  = await Ajax.call([{
                methodname: 'tiny_imageia_generate_image',
                args: {
                    prompt:  request.prompt,
                    model:   request.model,
                    quality: request.quality,
                    size:    request.size,
                    contextid: getContextId(editor),
                },
            }])[0];

            // result.b64_json is the raw base64 string returned directly by the
            // External Service — no JSON.parse needed, avoiding truncation issues
            // with large image payloads.
            const src = `data:image/png;base64,${result.b64_json}`;
            imgEl.src  = src;
            imgEl.style.display      = 'block';
            downloadA.href           = src;
            actionsDiv.style.display = 'flex';

            const rev = result.revised_prompt;
            if (rev) {
                promptUsed.style.display = 'block';
                promptUsed.textContent   = `${T.prompt_used_prefix} "${rev.substring(0, 140)}\u2026"`;
            }

        } catch (err) {
            // Build error display safely: static template strings come from lang files,
            // err.message comes from a server-side moodle_exception (not user input).
            const strong = document.createElement('strong');
            strong.textContent = T.error_prefix;
            const small = document.createElement('small');
            small.style.color = '#9ca3af';
            small.textContent = T.error_hint;
            errorDiv.innerHTML = '';
            errorDiv.appendChild(strong);
            errorDiv.appendChild(document.createTextNode(' ' + err.message));
            errorDiv.appendChild(document.createElement('br'));
            errorDiv.appendChild(small);
            errorDiv.style.display = 'block';
        } finally {
            loadingDiv.style.display = 'none';
            genBtn.disabled          = false;
            genBtn.style.opacity     = '1';
        }
    }

    genBtn.addEventListener('click', generate);
    regenBtn.addEventListener('click', generate);

    // Insert the generated image into the TinyMCE editor.
    insertBtn.addEventListener('click', () => {
        if (imgEl.src) {
            editor.insertContent(
                `<img src="${imgEl.src}" alt="${T.img_alt}" style="max-width:100%;height:auto;border-radius:4px;" />`
            );
            document.body.removeChild(wrapper);
        }
    });

    updateCostEstimate();
}

// ---------------------------------------------------------------------------
// TinyMCE plugin registration
// ---------------------------------------------------------------------------

const setupCommands = (editor, buttonTitle) => {
    editor.ui.registry.addIcon('imageia',
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'
            + '<rect x="1" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.7" fill="none"/>'
            + '<path d="M1 13 L5.5 8 L9 11 L12 9 L19 13" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" fill="none"/>'
            + '<circle cx="5.5" cy="10" r="1.5" fill="currentColor"/>'
            + '<path d="M20 0.5 L21.1 3.4 L24 4.5 L21.1 5.6 L20 8.5 L18.9 5.6 L16 4.5 L18.9 3.4 Z" fill="currentColor"/>'
            + '<circle cx="23" cy="9.5" r="1" fill="currentColor" opacity="0.6"/>'
            + '<circle cx="17.5" cy="10.5" r="0.7" fill="currentColor" opacity="0.4"/></svg>'
        );
    editor.ui.registry.addButton(buttonName, {
        icon: 'imageia',
        tooltip: buttonTitle,
        onAction: () => openImageIADialog(editor, isConfigured(editor)),
    });
    editor.ui.registry.addMenuItem(menuItemName, {
        icon: 'imageia',
        text: buttonTitle,
        onAction: () => openImageIADialog(editor, isConfigured(editor)),
    });
};

export default new Promise(async(resolve) => {
    const [tinyMCE, pluginMetadata] = await Promise.all([
        getTinyMCE(),
        getPluginMetadata(component, pluginName),
    ]);

    // Register the TinyMCE button synchronously and robustly.
    // The full language pack is loaded only when the modal opens, so a missing
    // dialog string cannot prevent the toolbar button from appearing.
    const buttonTitle = 'ImageIA';

    tinyMCE.PluginManager.add(pluginName, (editor) => {
        registerOptions(editor);
        setupCommands(editor, buttonTitle);
        return pluginMetadata;
    });

    resolve([pluginName, Configuration]);
});
