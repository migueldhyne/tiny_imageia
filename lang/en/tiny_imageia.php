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
 * English language strings for tiny_imageia plugin.
 *
 * @package    tiny_imageia
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apikey']            = 'OpenAI API key';
$string['apikey_desc']       = 'Enter your OpenAI API key (sk-...). Get it at platform.openai.com.';
$string['buttontext']        = 'AI Image';
$string['buttontitle']       = 'Generate an AI image';
$string['close']             = 'Close';
$string['cost_label']        = 'Estimated cost';
$string['cost_per_image']    = 'per image';
$string['costs_col_quality'] = 'Quality';
$string['costs_col_use']     = 'Recommended use';
$string['costs_dalle3_title'] = 'DALL-E 3 — Estimated costs per image';
$string['costs_gpt2_title']  = 'gpt-image-2 — Estimated costs per image';
$string['costs_hd_use']      = 'High-resolution illustrations';
$string['costs_high_use']    = 'Dense text, fine detail';
$string['costs_how_body']    = 'gpt-image-2 does not have a fixed price per image. OpenAI uses '
    . 'a token system: each image consumes a number of input and output tokens. '
    . 'The cost varies by image size and quality. '
    . 'The figures below are estimates from the official OpenAI calculator.';
$string['costs_how_title']   = 'How does OpenAI charge?';
$string['costs_low_use']     = 'Drafts, quick tests';
$string['costs_medium_use']  = 'Standard pedagogical use';
$string['costs_standard_use'] = 'Standard illustrations';
$string['costs_tip1']        = 'Start with <strong>low</strong> quality to test your prompt, '
    . 'then switch to <strong>medium</strong> or <strong>high</strong> for the final version.';
$string['costs_tip2']        = 'Use the <strong>prompt library</strong>: well-crafted prompts '
    . 'give better results on the first attempt, avoiding costly regenerations.';
$string['costs_tip3']        = 'Avoid <strong>high</strong> quality for simple images without '
    . 'dense text — <strong>medium</strong> is sufficient in 90% of pedagogical cases.';
$string['costs_tip4']        = 'Set a <strong>monthly budget cap</strong> in the OpenAI '
    . 'dashboard (platform.openai.com > Settings > Limits) to avoid overspending.';
$string['costs_tips_title']  = 'Best practices to control costs';
$string['costs_why_body']    = 'Each generated image has a real cost charged by OpenAI on your '
    . 'API key. This information helps you use the tool in a responsible and informed way.';
$string['costs_why_title']   = 'Why this tab?';
$string['defaultmodel']      = 'Default model';
$string['defaultmodel_desc'] = 'Default OpenAI model for image generation. '
    . 'gpt-image-2 is recommended for pedagogical use.';
$string['dialog_subtitle']   = 'OpenAI · TinyMCE Moodle Plugin';
$string['dialog_title']      = 'AI Pedagogical Image Generator';
$string['download_btn']      = 'Download PNG';
$string['error_apihint']     = 'Check your API key and OpenAI credit balance.';
$string['error_noapikey']    = 'OpenAI API key missing. '
    . 'Go to: Site administration > Plugins > Text editors > Tiny ImageIA.';
$string['error_noprompt']    = 'Please enter or select a prompt before generating.';
$string['error_prefix']      = 'Error:';
$string['generate_btn']      = 'Generate with {$a}';
$string['generating']        = 'Generating...';
$string['generating_note']   = '15 to 40 seconds depending on quality.';
$string['imagesize']         = 'Image size';
$string['imagesize_desc']    = 'Default size of generated images.';
$string['img_alt']           = 'AI generated pedagogical image';
$string['insert_btn']        = 'Insert into editor';
$string['menutext']          = 'Generate a pedagogical AI image';
$string['model']             = 'Generation model';
$string['model_classic_badge'] = 'CLASSIC';
$string['model_dalle3_desc'] = 'Proven and stable model. Excellent for artistic illustrations '
    . 'and narrative scenes. Less effective for text in images.';
$string['model_dalle3_sub']  = 'Artistic illustrations, narrative scenes';
$string['model_desc']        = 'Choose the OpenAI model for image generation.';
$string['model_gpt2_desc']   = 'Most powerful OpenAI model (2025). Best for infographics, '
    . 'text in images, scientific diagrams and photorealism. Best quality on first attempt.';
$string['model_gpt2_sub']    = 'Recommended for diagrams and text';
$string['model_label']       = 'AI Model';
$string['model_new_badge']   = 'NEW';
$string['pluginname']        = 'Pedagogical AI Image';
$string['privacy:metadata']  = 'The tiny_imageia plugin sends prompts to the OpenAI API '
    . 'to generate images. No personal data is stored locally.';
$string['privacy_body']      = 'Prompts are sent to OpenAI servers (USA) for processing. '
    . '<strong>Never include personal student data</strong> in prompts. '
    . 'Review OpenAI\'s privacy policy and your institution\'s data governance rules '
    . 'before enabling student access.';
$string['privacy_title']     = 'Data & privacy';
$string['prompt_alg_1'] = "Create an infographic titled 'Order of Operations BODMAS'. "
    . "Show Brackets, Exponents, Multiplication, Division, Addition, Subtraction "
    . "with a worked example. Orange and blue palette, white background.";
$string['prompt_alg_2'] = "Create an infographic titled 'Pythagoras Theorem'. "
    . "Right triangle with sides a, b, c, formula a squared plus b squared equals c squared, "
    . "two numerical examples. Clean educational style, white background.";
$string['prompt_art_1'] = "Create a color wheel poster titled 'The Color Wheel'. "
    . "Show primary, secondary and tertiary colors with complementary relationships. "
    . "White background.";
$string['prompt_art_2'] = "Create an art history infographic titled 'Major Art Movements'. "
    . "Show Impressionism, Cubism, Surrealism, Abstract Expressionism, Pop Art with dates. "
    . "White background.";
$string['prompt_art_3'] = "Create a diagram titled 'Elements of Art'. "
    . "Show the 7 elements: line, shape, form, space, texture, value, color with examples. "
    . "White background.";
$string['prompt_bio_1'] = "Create a biology diagram titled 'Cell Structure' for high school. "
    . "Show organelles: nucleus, mitochondria, ribosomes, Golgi apparatus, cell membrane. "
    . "Labeled arrows, pastel colors, flat design, white background.";
$string['prompt_bio_2'] = "Create an infographic titled 'Photosynthesis' for middle school. "
    . "Show: sunlight + CO2 + water to glucose + oxygen with a simple plant diagram. "
    . "Flat design, green and yellow palette, white background.";
$string['prompt_bio_3'] = "Create a diagram titled 'DNA Double Helix' for high school biology. "
    . "Show base pairs A-T and G-C, sugar-phosphate backbone, labeled. "
    . "Scientific style, blue and white palette, white background.";
$string['prompt_bio_4'] = "Create a poster titled 'The Human Digestive System' for ages 12-15. "
    . "Path from mouth to intestines with labeled organs. "
    . "Simple anatomical style, warm colors, white background.";
$string['prompt_bio_5'] = "Create an infographic titled 'Cellular Respiration' for high school. "
    . "Show glycolysis, Krebs cycle, electron transport chain. "
    . "Label: glucose, pyruvate, ATP, NADH, CO2. Clean diagram, white background.";
$string['prompt_chem_1'] = "Create a chemistry diagram titled 'States of Matter' for middle school. "
    . "Show solid, liquid, gas with molecule arrangement and phase transition arrows. "
    . "Flat design, blue palette, white background.";
$string['prompt_chem_2'] = "Create an infographic titled 'The pH Scale' for high school. "
    . "Horizontal scale 0 to 14, common substances at each level. "
    . "Color gradient red to purple. White background.";
$string['prompt_chem_3'] = "Create an infographic titled 'Types of Chemical Bonds' for high school. "
    . "Show ionic, covalent and metallic bonds with simple molecular diagrams. "
    . "Color-coded, white background, labeled.";
$string['prompt_cs_1'] = "Create an infographic titled 'How the Internet Works'. "
    . "Data journey: user, router, ISP, server with simple icons. "
    . "Flat design, blue and grey palette, white background.";
$string['prompt_cs_2'] = "Create a poster titled 'Types of Cybersecurity Threats'. "
    . "Show phishing, malware, ransomware, DDoS with icons and descriptions. "
    . "Warning-style design, red and dark palette, white background.";
$string['prompt_cs_3'] = "Create an infographic titled 'How Machine Learning Works'. "
    . "Pipeline: data collection, training, model, prediction, feedback loop. "
    . "Purple and blue palette, labeled arrows, white background.";
$string['prompt_cs_4'] = "Create a diagram titled 'The Software Development Cycle SDLC'. "
    . "6 phases: planning, design, coding, testing, deployment, maintenance in a circle. "
    . "Flat design, teal palette, white background.";
$string['prompt_en_1'] = "Create a poster titled 'English Irregular Verbs'. "
    . "Table with 15 common irregular verbs: base form, past simple, past participle. "
    . "Colorful table, white background.";
$string['prompt_en_2'] = "Create an infographic titled 'English Prepositions of Place'. "
    . "Show in, on, at, under, next to, between with simple illustrations. "
    . "Clean flat design, colorful.";
$string['prompt_en_3'] = "Create a poster titled 'English Connectors and Transition Words'. "
    . "Group by function: addition, contrast, cause. "
    . "Clean typographic layout, white background.";
$string['prompt_fr_1'] = "Create a grammar poster titled 'French Verb Tenses'. "
    . "Timeline with present, past and future tenses with example sentences. "
    . "Clean typographic design, blue and white.";
$string['prompt_fr_2'] = "Create a vocabulary infographic titled 'Emotions in French' for beginners. "
    . "8 to 10 emotion words with simple expressive face illustrations. "
    . "Colorful, friendly style, white background.";
$string['prompt_geo_1'] = "Create a diagram titled 'Types of Ecosystems' for middle school. "
    . "Show 6 biomes: tropical forest, desert, tundra, ocean, temperate forest, savanna. "
    . "Flat design, colorful, white background.";
$string['prompt_geo_2'] = "Create an infographic titled 'Causes and Effects of Climate Change'. "
    . "Human causes leading to effects with arrow diagram. "
    . "Blue and orange palette, white background.";
$string['prompt_geo_3'] = "Create a poster titled 'The Rock Cycle' for middle school. "
    . "Show igneous, sedimentary and metamorphic rocks with transformation arrows. "
    . "Earthy colors, white background.";
$string['prompt_geom_1'] = "Create a poster titled 'Types of Triangles' for middle school. "
    . "Show equilateral, isoceles, scalene, right-angled, obtuse, acute with angle properties. "
    . "Clean geometric style, blue palette, white background.";
$string['prompt_geom_2'] = "Create a diagram titled 'Area and Perimeter Formulas'. "
    . "Formulas for rectangle, triangle, circle and trapezoid with illustrated shapes. "
    . "Clean educational style, white background.";
$string['prompt_geom_3'] = "Create a poster titled '3D Shapes and Their Properties'. "
    . "Show cube, sphere, cylinder, cone, pyramid with faces, edges and vertices labeled. "
    . "Isometric illustration, colorful, white background.";
$string['prompt_hist_1'] = "Create a timeline titled 'Key Events of World War II 1939 to 1945'. "
    . "6 to 8 major events in chronological order with small icons. "
    . "Clean infographic, dark red and grey palette, white background.";
$string['prompt_hist_2'] = "Create an infographic titled 'The French Revolution 1789 to 1799'. "
    . "Key phases with dates and brief descriptions. "
    . "Blue, white, red palette, white background.";
$string['prompt_hist_3'] = "Create a diagram titled 'Causes of World War I MAIN'. "
    . "Show Militarism, Alliance system, Imperialism, Nationalism with icons and arrows. "
    . "Clean infographic, white background.";
$string['prompt_label']      = 'Prompt (editable before sending)';
$string['prompt_phys_1'] = "Create a physics diagram titled 'The Electromagnetic Spectrum'. "
    . "Full spectrum from radio waves to gamma rays with wavelength and frequency. "
    . "Include rainbow visible light section. White background.";
$string['prompt_phys_2'] = "Create a diagram titled 'Newton Three Laws of Motion'. "
    . "Illustrate: inertia, F equals ma, action-reaction. "
    . "Flat design, dark blue and orange palette, white background.";
$string['prompt_phys_3'] = "Create an infographic titled 'The Water Cycle' for middle school. "
    . "Show evaporation, condensation, precipitation with labeled arrows in a landscape. "
    . "Soft watercolor style, blue and green palette.";
$string['prompt_placeholder'] = 'Describe the image: subject, target audience, visual style, '
    . 'colours, constraints...';
$string['promptlibrary']     = 'Prompt library';
$string['promptlibrary_default'] = '-- Select a prompt or write your own --';
$string['quality_hd']        = 'HD — high definition';
$string['quality_high']      = 'High — maximum quality';
$string['quality_label']     = 'Quality';
$string['quality_low']       = 'Low — fast, good for drafts';
$string['quality_medium']    = 'Medium — balanced quality/speed (recommended)';
$string['quality_standard']  = 'Standard — normal quality';
$string['regenerate_btn']    = 'Regenerate';
$string['revised_prompt']    = 'Interpreted prompt:';
$string['sim_calculate']     = 'Calculate';
$string['sim_dalle3_hd']     = 'DALL-E 3 hd';
$string['sim_dalle3_std']    = 'DALL-E 3 standard';
$string['sim_gpt2_high']     = 'gpt-image-2 high';
$string['sim_gpt2_low']      = 'gpt-image-2 low';
$string['sim_gpt2_medium']   = 'gpt-image-2 medium (recommended)';
$string['sim_images']        = 'Images / teacher / week';
$string['sim_model']         = 'Model and quality';
$string['sim_permonth']      = 'Per month';
$string['sim_perweek']       = 'Per week';
$string['sim_peryear']       = 'Per school year';
$string['sim_teachers']      = 'Number of teachers';
$string['sim_tip']           = 'Tip: set a monthly spending cap of {$a} in your '
    . 'OpenAI dashboard (platform.openai.com > Settings > Limits).';
$string['sim_title']         = 'Budget Simulator';
$string['sim_weeks']         = 'Weeks per school year';
$string['size_label']        = 'Size';
$string['size_landscape']    = 'Landscape HD';
$string['size_landscape_std'] = 'Landscape';
$string['size_portrait']     = 'Portrait HD';
$string['size_portrait_std'] = 'Portrait';
$string['size_square']       = 'Square';
$string['strength_dalle3_1'] = 'Artistic and creative illustrations';
$string['strength_dalle3_2'] = 'Narrative scenes and atmospheres';
$string['strength_dalle3_3'] = 'Varied styles: watercolor, sketch, cartoon';
$string['strength_gpt2_1']   = 'Accurate text rendering in images';
$string['strength_gpt2_2']   = 'Complex infographics and diagrams';
$string['strength_gpt2_3']   = 'High-fidelity photorealism';
$string['strength_gpt2_4']   = 'Flexible sizes up to 2K';
$string['subject_arts']         = 'Arts';
$string['subject_cs']           = 'Computer Science';
$string['subject_history']      = 'History and Geography';
$string['subject_languages']    = 'Languages';
$string['subject_maths']        = 'Mathematics';
$string['subject_sciences']     = 'Sciences';
$string['tab_costs']         = 'Costs';
$string['tab_generate']      = 'Generate';
$string['tab_tips']          = 'Tips';
$string['tip_dalle3']        = '<strong>Tip DALL-E 3:</strong> Best for artistic illustrations. '
    . 'Use <em>hd</em> for fine detail. Avoid if the image needs readable text.';
$string['tip_gpt2']          = '<strong>Tip gpt-image-2:</strong> Use <em>medium</em> or '
    . '<em>high</em> for diagrams with text. Always add '
    . '<em>"white background, no watermark"</em>.';
$string['tips_do1']          = 'Specify the <strong>target audience</strong> '
    . '(e.g. "for high school students")';
$string['tips_do2']          = 'Add <strong>"white background, no watermark"</strong>';
$string['tips_do3']          = 'Specify the <strong>style</strong> '
    . '(flat, watercolor, realistic, diagram)';
$string['tips_do4']          = 'List the <strong>specific elements</strong> to include';
$string['tips_do5']          = 'Start with <strong>low</strong> quality to test';
$string['tips_do_col']       = 'Do';
$string['tips_dont1']        = 'Use vague prompts ("make an image about science")';
$string['tips_dont2']        = 'Forget the background or visual style';
$string['tips_dont3']        = 'Mention real people or brand names';
$string['tips_dont4']        = 'Pack too many concepts into one image';
$string['tips_dont5']        = 'Regenerate 5 times without changing the prompt';
$string['tips_dont_col']     = 'Do not';
$string['tips_dos_title']    = 'Do / Do not';
$string['tips_example']      = '"Create an educational infographic titled The Water Cycle for '
    . 'middle school students. Show evaporation, condensation, precipitation with labeled '
    . 'arrows. Soft watercolor style, blue and green palette. White background, no watermark."';
$string['tips_example_label']   = 'Example:';
$string['tips_goal']         = '<strong>Goal:</strong> A good prompt = a useful image on the '
    . 'first attempt = less cost and time wasted.';
$string['tips_iteration_body']    = 'Change only one element at a time: '
    . '"same image but with warmer colors" or "same image but add labels" or '
    . '"same image but simpler". More effective and less costly than rewriting everything.';
$string['tips_iteration_title']   = 'Iteration tip';
$string['tips_keywords_title']  = 'Useful style keywords';
$string['tips_kw_constraints']    = 'Constraints';
$string['tips_kw_constraints_val'] = 'no watermark, no logos, no text, plain background';
$string['tips_kw_diagrams']     = 'Diagrams';
$string['tips_kw_diagrams_val'] = 'flat design, clean diagram, labeled arrows, '
    . 'educational poster, white background';
$string['tips_kw_illustrations']    = 'Illustrations';
$string['tips_kw_illustrations_val'] = 'watercolor, soft illustration, cartoon, hand-drawn, '
    . 'pastel colors';
$string['tips_kw_realistic']    = 'Realistic photos';
$string['tips_kw_realistic_val'] = 'photorealistic, 35mm film, natural lighting, '
    . 'shallow depth of field';
$string['tips_structure_body']  = 'Format + Subject + Target audience + Visual style + '
    . 'Constraints';
$string['tips_structure_title'] = 'Effective prompt structure';
$string['topic_algebra']        = 'Algebra';
$string['topic_art_education']  = 'Art Education';
$string['topic_biology']        = 'Biology';
$string['topic_chemistry']      = 'Chemistry';
$string['topic_digital_ai']     = 'Digital and AI';
$string['topic_english']        = 'English';
$string['topic_french']         = 'French';
$string['topic_geography']      = 'Geography';
$string['topic_geometry']       = 'Geometry';
$string['topic_history']        = 'History';
$string['topic_physics']        = 'Physics';
