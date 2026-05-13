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
 * English language strings for tiny_imageia plugin.
 *
 * @package    tiny_imageia
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apikey'] = 'OpenAI API key';
$string['apikey_desc'] = 'Enter your OpenAI API key (sk-...). Obtain it at platform.openai.com.';
$string['best_1'] = 'Start with <strong>low</strong> quality to test your prompt, then switch to <strong>medium</strong> or <strong>high</strong> for the final version.';
$string['best_2'] = 'Use the prompt library: well-crafted prompts give better results on the first attempt, avoiding costly regenerations.';
$string['best_3'] = 'Avoid <strong>high</strong> quality for simple images without dense text — <strong>medium</strong> is sufficient in 90% of pedagogical cases.';
$string['best_4'] = 'Do not edit a generated image via this plugin (upload + edit): it costs 2–3× more than a simple generation.';
$string['best_5'] = 'Set a monthly budget cap in the OpenAI dashboard (platform.openai.com → Settings → Limits) to avoid overspending.';
$string['best_title'] = 'Best practices to control costs';
$string['buttontitle'] = 'Generate a pedagogical AI image';
$string['cost_col_quality'] = 'Quality';
$string['cost_col_use'] = 'Recommended use';
$string['cost_high_use'] = 'Dense diagrams, fine text';
$string['cost_how_body'] = '<code>gpt-image-2</code> does not have a <strong>fixed price per image</strong>. OpenAI uses a <strong>token</strong> system: each image consumes a number of input and output tokens. The cost therefore varies according to image size and quality. The figures below are <em>estimates</em> from the official OpenAI calculator.';
$string['cost_how_title'] = 'How does OpenAI charge?';
$string['cost_label'] = 'Estimated cost';
$string['cost_low_use'] = 'Drafts, quick tests';
$string['cost_medium_use'] = 'Standard pedagogical use';
$string['cost_per_image'] = 'per image';
$string['cost_table_title'] = 'gpt-image-2 — Estimated costs per image';
$string['cost_why_body'] = 'Each generated image has a real cost charged by OpenAI to your API key. This information helps you use the tool in an <strong>informed and responsible</strong> way, and estimate the budget impact for your institution.';
$string['cost_why_title'] = 'Why this tab?';
$string['defaultmodel'] = 'Default model';
$string['defaultmodel_desc'] = 'Default OpenAI model used for image generation.';
$string['dialog_subtitle'] = 'OpenAI · TinyMCE Plugin for Moodle';
$string['dialog_title'] = 'AI Pedagogical Image Generator';
$string['download_btn'] = 'Download PNG';
$string['error_hint'] = 'Check your API key and OpenAI credit balance.';
$string['error_no_key'] = 'OpenAI API key missing. Go to: Administration > Plugins > Text editors > Pedagogical ImageIA.';
$string['error_no_prompt'] = 'Please enter or select a prompt.';
$string['error_prefix'] = 'Error:';
$string['generate_btn'] = 'Generate';
$string['generating'] = 'Generating…';
$string['img_alt'] = 'AI-generated pedagogical image';
$string['insert_btn'] = 'Insert into editor';
$string['model_badge'] = 'NEW';
$string['model_desc'] = 'OpenAI\'s most powerful model (2025). Best for infographics, text in images, scientific diagrams and photorealism. Best quality on first attempt.';
$string['model_label'] = 'AI Model';
$string['model_sub'] = 'Recommended — diagrams, text, infographics';
$string['model_tip'] = '<strong>Tip gpt-image-2:</strong> Use <em>medium</em> or <em>high</em> quality for diagrams with text. Specify the target audience, visual style and add <em>"white background, no watermark"</em>.';
$string['pluginname'] = 'Pedagogical AI Image';
$string['privacy:metadata'] = 'The tiny_imageia plugin sends prompts to the OpenAI API to generate images. No personal data is stored locally.';
$string['privacy_body'] = 'Prompts are sent to OpenAI servers (USA) for processing. Never include students\'s personal data in prompts. Review OpenAI\'s privacy policy and your institution\'s data governance rules before enabling student access.';
$string['privacy_title'] = 'Data & Privacy';
$string['prompt_alg_1'] = 'Create an infographic titled \'Order of Operations (BODMAS/PEMDAS)\' for middle school. Show Brackets → Exponents → Multiplication/Division → Addition/Subtraction with a worked example. Orange and blue palette, white background.';
$string['prompt_alg_2'] = 'Create a math infographic titled \'Pythagoras Theorem\' for middle school. Right triangle with sides a, b, c, the formula a²+b²=c², two numerical examples. Clean educational style, white background.';
$string['prompt_art_1'] = 'Create a color wheel poster titled \'The Color Wheel\' for art students. Show primary, secondary and tertiary colors, with complementary, analogous, triadic relationships. White background.';
$string['prompt_art_2'] = 'Create an art history infographic titled \'Major Art Movements Timeline\'. Show Impressionism, Cubism, Surrealism, Abstract Expressionism, Pop Art with dates, key artists and style swatches.';
$string['prompt_art_3'] = 'Create a diagram titled \'Elements of Art\'. Show and illustrate the 7 elements: line, shape, form, space, texture, value, color. Each with a small visual example. White background.';
$string['prompt_bank_label'] = 'Pedagogical Prompt Library';
$string['prompt_bio_1'] = 'Create a biology diagram titled \'Cell Structure\' for high school. Show the main organelles (nucleus, mitochondria, ribosomes, endoplasmic reticulum, Golgi apparatus, cell membrane). Labeled arrows, pastel colors, flat design, white background.';
$string['prompt_bio_2'] = 'Create an educational infographic titled \'Photosynthesis\' for middle school. Show: sunlight + CO2 + water → glucose + oxygen, with a simple plant diagram. Flat design, green and yellow palette, white background.';
$string['prompt_bio_3'] = 'Create a diagram titled \'DNA Double Helix Structure\' for high school biology. Show base pairs (A-T, G-C), sugar-phosphate backbone, labeled. Blue and white palette, white background.';
$string['prompt_bio_4'] = 'Create an educational poster titled \'The Human Digestive System\' for students aged 12-15. Path from mouth to intestines with labeled organs. Simple anatomical style, warm colors, white background.';
$string['prompt_bio_5'] = 'Create a biology infographic titled \'Cellular Respiration\' for high school. Show glycolysis, Krebs cycle, electron transport chain. Label: glucose, pyruvate, ATP, NADH, CO2. Clean classroom diagram, white background.';
$string['prompt_chem_1'] = 'Create a chemistry diagram titled \'States of Matter\' for middle school. Show solid, liquid, gas with molecule arrangement and phase transition arrows. Flat design, blue palette, white background.';
$string['prompt_chem_2'] = 'Create an infographic titled \'The pH Scale\' for high school chemistry. Horizontal scale 0-14, common substances at each level. Color gradient red to purple, white background.';
$string['prompt_chem_3'] = 'Create a chemistry infographic titled \'Types of Chemical Bonds\' for high school. Show ionic, covalent and metallic bonds with simple molecular diagrams. Color-coded, white background, labeled.';
$string['prompt_cs_1'] = 'Create an infographic titled \'How the Internet Works\' for middle school. Data journey: user → router → ISP → server → back, with simple icons. Flat design, blue and grey palette, white background.';
$string['prompt_cs_2'] = 'Create a diagram titled \'Binary Number System\' for computer science. Show binary (base 2) vs decimal 0-15, with a clear conversion table. Clean green-on-dark terminal style.';
$string['prompt_cs_3'] = 'Create a poster titled \'Types of Cybersecurity Threats\'. Show phishing, malware, ransomware, DDoS with icons and descriptions. Warning-style design, red and dark palette, white background.';
$string['prompt_cs_4'] = 'Create an infographic titled \'How Machine Learning Works\' for high school. Pipeline: data collection → training → model → prediction → feedback loop. Purple and blue palette, labeled arrows, white background.';
$string['prompt_cs_5'] = 'Create a diagram titled \'The Software Development Cycle (SDLC)\'. 6 phases: planning, design, coding, testing, deployment, maintenance in a circular diagram. Flat design, teal palette, white background.';
$string['prompt_en_1'] = 'Create a poster titled \'English Irregular Verbs\' for language learners. Table with 15 common irregular verbs (base form, past simple, past participle). Colorful table, white background.';
$string['prompt_en_2'] = 'Create an infographic titled \'English Prepositions of Place\' for ESL students. Show in, on, at, under, next to, between with simple box/object illustrations. Clean flat design, colorful.';
$string['prompt_en_3'] = 'Create a poster titled \'English Connectors and Transition Words\'. Group by function: addition (also, moreover), contrast (however, although), cause (because, since). Clean typographic layout.';
$string['prompt_fr_1'] = 'Create a grammar poster titled \'French Verb Tenses\' for language learners. Timeline with present, past (passé composé, imparfait) and future tenses with example sentences. Clean typographic design, blue and white.';
$string['prompt_fr_2'] = 'Create a vocabulary infographic titled \'Emotions in French\' for beginners. 8-10 emotion words with simple expressive face illustrations. Colorful, friendly style, white background.';
$string['prompt_geo_1'] = 'Create a diagram titled \'Types of Ecosystems\' for middle school. Show 6 biomes (tropical forest, desert, tundra, ocean, temperate forest, savanna) with small illustrations. Flat design, colorful, white background.';
$string['prompt_geo_2'] = 'Create an infographic titled \'Causes and Effects of Climate Change\' for high school. Human causes → effects (rising temperatures, sea level rise). Arrow diagram, blue and orange palette, white background.';
$string['prompt_geo_3'] = 'Create a poster titled \'The Rock Cycle\' for middle school earth science. Show igneous, sedimentary and metamorphic rocks with transformation processes as labeled arrows. Earthy colors, clean diagram.';
$string['prompt_geom_1'] = 'Create a poster titled \'Types of Triangles\' for middle school math. Show and label: equilateral, isoceles, scalene, right-angled, obtuse, acute with angle properties. Clean geometric style, blue palette, white background.';
$string['prompt_geom_2'] = 'Create a diagram titled \'Area and Perimeter Formulas\' for middle school. Formulas for rectangle, triangle, circle and trapezoid with illustrated shapes. Clean educational style, white background.';
$string['prompt_geom_3'] = 'Create a poster titled \'3D Shapes and Their Properties\'. Show cube, sphere, cylinder, cone, pyramid with faces, edges and vertices labeled. Isometric illustration, colorful, white background.';
$string['prompt_hist_1'] = 'Create a timeline titled \'Key Events of World War II (1939-1945)\'. 6-8 major events in chronological order with small icons. Clean infographic, dark red and grey palette, white background.';
$string['prompt_hist_2'] = 'Create a historical infographic titled \'The French Revolution (1789-1799)\'. Key phases with dates and brief descriptions. Blue, white, red palette, white background.';
$string['prompt_hist_3'] = 'Create a diagram titled \'Causes of World War I (MAIN)\'. Show Militarism, Alliance system, Imperialism, Nationalism with icons and connecting arrows. Clean infographic, white background.';
$string['prompt_label'] = 'Prompt (editable before sending)';
$string['prompt_phys_1'] = 'Create a physics diagram titled \'The Electromagnetic Spectrum\' for high school. Full spectrum from radio waves to gamma rays, wavelength and frequency indicators. Include rainbow visible light section, white background.';
$string['prompt_phys_2'] = 'Create an educational diagram titled \'Newton\'s Three Laws of Motion\'. Illustrate: inertia (ball at rest), F=ma (force arrow), action-reaction (rocket). Flat design, dark blue and orange palette, white background.';
$string['prompt_phys_3'] = 'Create an infographic titled \'The Water Cycle\' for middle school. Show evaporation, condensation, precipitation and collection with labeled arrows in a landscape. Soft watercolor style, blue and green palette.';
$string['prompt_placeholder'] = 'Describe the image: subject, target audience, visual style, colours…';
$string['prompt_used_prefix'] = 'Interpreted prompt:';
$string['quality_high'] = 'High — maximum quality, dense text';
$string['quality_label'] = 'Quality';
$string['quality_low'] = 'Low — fast, good for drafts';
$string['quality_medium'] = 'Medium — balanced quality/speed';
$string['regen_btn'] = 'Regenerate';
$string['select_prompt'] = '-- Select a prompt or write your own --';
$string['sim_btn'] = 'Calculate';
$string['sim_images'] = 'Images / teacher / week';
$string['sim_model'] = 'Model and quality';
$string['sim_opt_high'] = 'gpt-image-2 · high (dense text)';
$string['sim_opt_low'] = 'gpt-image-2 · low (drafts)';
$string['sim_opt_medium'] = 'gpt-image-2 · medium (recommended)';
$string['sim_per_month'] = 'Per month';
$string['sim_per_week'] = 'Per week';
$string['sim_per_year'] = 'Per school year';
$string['sim_teachers'] = 'No. of teachers';
$string['sim_title'] = 'Budget Simulator';
$string['sim_weeks'] = 'No. of weeks / year';
$string['size_auto'] = 'Auto — optimal choice by the API';
$string['size_label'] = 'Size';
$string['size_landscape'] = 'Landscape HD';
$string['size_portrait'] = 'Portrait HD';
$string['size_square'] = 'Square';
$string['strength_1'] = 'Accurate text rendering in images';
$string['strength_2'] = 'Complex infographics and diagrams';
$string['strength_3'] = 'High-fidelity photorealism';
$string['strength_4'] = 'Clear labels, arrows and captions';
$string['strength_5'] = 'Flexible sizes up to 2K';
$string['subj_arts'] = 'Arts';
$string['subj_hg'] = 'History & Geography';
$string['subj_info'] = 'Computer Science';
$string['subj_lang'] = 'Languages';
$string['subj_maths'] = 'Mathematics';
$string['subj_sciences'] = 'Sciences';
$string['tab_cost'] = 'Costs & Transparency';
$string['tab_generate'] = 'Generate';
$string['tab_tips'] = 'Prompt Tips';
$string['tips_do_1'] = 'Specify the target audience ("for high school students")';
$string['tips_do_2'] = 'Add "white background, no watermark"';
$string['tips_do_3'] = 'Put expected text in quotes';
$string['tips_do_4'] = 'Specify the style (flat design, watercolor, realistic, diagram)';
$string['tips_do_5'] = 'List the specific elements to include';
$string['tips_do_6'] = 'Start with low quality to test';
$string['tips_do_col'] = 'Do';
$string['tips_do_title'] = 'Do / Don\'t';
$string['tips_dont_1'] = 'Vague prompts ("make an image about science")';
$string['tips_dont_2'] = 'Forget the background or visual style';
$string['tips_dont_3'] = 'Ask for too many concepts in one image';
$string['tips_dont_4'] = 'Mention real people or brand names';
$string['tips_dont_5'] = 'Use ambiguous or poetic terms';
$string['tips_dont_6'] = 'Regenerate 5× without changing the prompt';
$string['tips_dont_col'] = 'Don\'t';
$string['tips_example'] = '"Create an educational infographic titled The Water Cycle for middle school students. Show evaporation, condensation, precipitation with labeled arrows. Soft watercolor style, blue and green palette. White background, no watermark."';
$string['tips_example_label'] = 'Example:';
$string['tips_goal'] = 'Goal: A good prompt = a useful image on the first attempt = less cost and time wasted.';
$string['tips_iter_body'] = 'If the result is not satisfactory, change <strong>one element at a time</strong> in the prompt ("same image but with warmer colors" · "same image but add labels" · "same image but simpler"). This is more effective — and less costly — than rewriting everything.';
$string['tips_iter_title'] = 'Iteration tip';
$string['tips_kw_const'] = 'Useful constraints';
$string['tips_kw_const_val'] = 'no watermark · no extra text · no logos · no trademarks · plain background · no people';
$string['tips_kw_diag'] = 'Diagrams & charts';
$string['tips_kw_diag_val'] = 'flat design · clean diagram · labeled arrows · educational poster · infographic style · white background';
$string['tips_kw_illus'] = 'Illustrations';
$string['tips_kw_illus_val'] = 'watercolor · soft illustration · cartoon · hand-drawn · pastel colors · storybook style';
$string['tips_kw_photo'] = 'Realistic photos';
$string['tips_kw_photo_val'] = 'photorealistic · candid photograph · 35mm film · natural lighting · shallow depth of field';
$string['tips_kw_title'] = 'Useful style keywords';
$string['tips_struct_body'] = 'Format + Subject + Target audience + Visual style + Constraints';
$string['tips_struct_title'] = 'Effective prompt structure';
$string['topic_alg'] = 'Algebra';
$string['topic_art'] = 'Art Education';
$string['topic_bio'] = 'Biology';
$string['topic_chem'] = 'Chemistry';
$string['topic_cs'] = 'Digital & AI';
$string['topic_en'] = 'English';
$string['topic_fr'] = 'French';
$string['topic_geo'] = 'Geography';
$string['topic_geom'] = 'Geometry';
$string['topic_hist'] = 'History';
$string['topic_phys'] = 'Physics';
