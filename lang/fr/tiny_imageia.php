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
 * French language strings for tiny_imageia plugin.
 *
 * @package    tiny_imageia
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apikey']            = 'Clé API OpenAI';
$string['apikey_desc']       = 'Entrez votre clé API OpenAI (sk-...). Obtenez-la sur platform.openai.com.';
$string['buttontext']        = 'Image IA';
$string['buttontitle']       = 'Générer une image IA';
$string['close']             = 'Fermer';
$string['cost_label']        = 'Coût estimé';
$string['cost_per_image']    = 'par image';
$string['costs_col_quality'] = 'Qualité';
$string['costs_col_use']     = 'Usage recommandé';
$string['costs_dalle3_title'] = 'DALL-E 3 — Coûts estimés par image';
$string['costs_gpt2_title']  = 'gpt-image-2 — Coûts estimés par image';
$string['costs_hd_use']      = 'Illustrations haute résolution';
$string['costs_high_use']    = 'Texte dense, détails fins';
$string['costs_how_body']    = 'gpt-image-2 ne coûte pas un prix fixe par image. OpenAI utilise '
    . 'un système de tokens : chaque image consomme un certain nombre de tokens en entrée et en '
    . 'sortie. Le coût varie selon la taille et la qualité. '
    . 'Les chiffres ci-dessous sont des estimations issues du calculateur officiel OpenAI.';
$string['costs_how_title']   = 'Comment OpenAI facture-t-il ?';
$string['costs_low_use']     = 'Brouillons, tests rapides';
$string['costs_medium_use']  = 'Usage pédagogique courant';
$string['costs_standard_use'] = 'Illustrations courantes';
$string['costs_tip1']        = 'Commencez en qualité <strong>faible</strong> pour tester, '
    . 'puis passez en <strong>moyen</strong> ou <strong>élevé</strong> pour la version finale.';
$string['costs_tip2']        = 'Utilisez la <strong>banque de prompts</strong> : des prompts '
    . 'bien construits donnent de meilleurs résultats du premier coup.';
$string['costs_tip3']        = 'Évitez la qualité <strong>élevée</strong> pour les images '
    . 'simples — <strong>moyen</strong> suffit dans 90 % des cas pédagogiques.';
$string['costs_tip4']        = 'Définissez un <strong>plafond mensuel</strong> dans le dashboard '
    . 'OpenAI (platform.openai.com > Settings > Limits) pour éviter les dépassements.';
$string['costs_tips_title']  = 'Bonnes pratiques pour maîtriser les coûts';
$string['costs_why_body']    = 'Chaque image générée a un coût réel facturé par OpenAI sur '
    . 'votre clé API. Ces informations vous permettent d\'utiliser l\'outil de façon éclairée '
    . 'et responsable.';
$string['costs_why_title']   = 'Pourquoi cet onglet ?';
$string['defaultmodel']      = 'Modèle par défaut';
$string['defaultmodel_desc'] = 'Modèle OpenAI utilisé par défaut pour la génération d\'images. '
    . 'gpt-image-2 est recommandé pour les usages pédagogiques.';
$string['dialog_subtitle']   = 'OpenAI · Plugin TinyMCE Moodle';
$string['dialog_title']      = 'Générateur d\'images pédagogiques IA';
$string['download_btn']      = 'Télécharger PNG';
$string['error_apihint']     = 'Vérifiez votre clé API et vos crédits OpenAI.';
$string['error_noapikey']    = 'Clé API OpenAI manquante. '
    . 'Allez dans : Administration > Plugins > Éditeurs de texte > Tiny ImageIA.';
$string['error_noprompt']    = 'Veuillez saisir ou sélectionner un prompt avant de générer.';
$string['error_prefix']      = 'Erreur :';
$string['generate_btn']      = 'Générer avec {$a}';
$string['generating']        = 'Génération en cours...';
$string['generating_note']   = '15 à 40 secondes selon la qualité.';
$string['imagesize']         = 'Taille des images';
$string['imagesize_desc']    = 'Taille par défaut des images générées.';
$string['img_alt']           = 'Image pédagogique générée par IA';
$string['insert_btn']        = 'Insérer dans l\'éditeur';
$string['menutext']          = 'Générer une image IA pédagogique';
$string['model']             = 'Modèle de génération';
$string['model_classic_badge'] = 'CLASSIQUE';
$string['model_dalle3_desc'] = 'Modèle éprouvé et stable. Excellent pour les illustrations '
    . 'artistiques et les scènes narratives. Moins performant pour le texte dans les images.';
$string['model_dalle3_sub']  = 'Illustrations artistiques, scènes narratives';
$string['model_desc']        = 'Choisissez le modèle OpenAI pour la génération d\'images.';
$string['model_gpt2_desc']   = 'Modèle le plus puissant d\'OpenAI (2025). Idéal pour les '
    . 'infographies, le texte dans les images, les schémas et le photoréalisme. '
    . 'Meilleure qualité dès le premier essai.';
$string['model_gpt2_sub']    = 'Recommandé pour les schémas et le texte';
$string['model_label']       = 'Modèle IA';
$string['model_new_badge']   = 'NOUVEAU';
$string['pluginname']        = 'Image IA pédagogique';
$string['privacy:metadata']  = 'Le plugin tiny_imageia envoie les prompts à l\'API OpenAI '
    . 'pour générer des images. Aucune donnée personnelle n\'est stockée localement.';
$string['privacy_body']      = 'Les prompts saisis sont envoyés aux serveurs d\'OpenAI (USA). '
    . '<strong>Ne saisissez jamais de données personnelles d\'élèves</strong> dans les prompts. '
    . 'Consultez la politique de confidentialité d\'OpenAI et le règlement de votre établissement '
    . 'avant d\'autoriser l\'accès aux étudiants.';
$string['privacy_title']     = 'Données et vie privée';
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
$string['prompt_label']      = 'Prompt (modifiable avant envoi)';
$string['prompt_phys_1'] = "Create a physics diagram titled 'The Electromagnetic Spectrum'. "
    . "Full spectrum from radio waves to gamma rays with wavelength and frequency. "
    . "Include rainbow visible light section. White background.";
$string['prompt_phys_2'] = "Create a diagram titled 'Newton Three Laws of Motion'. "
    . "Illustrate: inertia, F equals ma, action-reaction. "
    . "Flat design, dark blue and orange palette, white background.";
$string['prompt_phys_3'] = "Create an infographic titled 'The Water Cycle' for middle school. "
    . "Show evaporation, condensation, precipitation with labeled arrows in a landscape. "
    . "Soft watercolor style, blue and green palette.";
$string['prompt_placeholder'] = 'Décrivez l\'image : sujet, public cible, style visuel, '
    . 'couleurs, contraintes...';
$string['promptlibrary']     = 'Banque de prompts pédagogiques';
$string['promptlibrary_default'] = '-- Sélectionner un prompt ou écrire le vôtre --';
$string['quality_hd']        = 'HD — haute définition';
$string['quality_high']      = 'Élevé — qualité maximale';
$string['quality_label']     = 'Qualité';
$string['quality_low']       = 'Faible — rapide, bon pour les brouillons';
$string['quality_medium']    = 'Moyen — équilibre qualité/vitesse (recommandé)';
$string['quality_standard']  = 'Standard — qualité normale';
$string['regenerate_btn']    = 'Régénérer';
$string['revised_prompt']    = 'Prompt interprété :';
$string['sim_calculate']     = 'Calculer';
$string['sim_dalle3_hd']     = 'DALL-E 3 hd';
$string['sim_dalle3_std']    = 'DALL-E 3 standard';
$string['sim_gpt2_high']     = 'gpt-image-2 élevé';
$string['sim_gpt2_low']      = 'gpt-image-2 faible';
$string['sim_gpt2_medium']   = 'gpt-image-2 moyen (recommandé)';
$string['sim_images']        = 'Images / enseignant / semaine';
$string['sim_model']         = 'Modèle et qualité';
$string['sim_permonth']      = 'Par mois';
$string['sim_perweek']       = 'Par semaine';
$string['sim_peryear']       = 'Par année scolaire';
$string['sim_teachers']      = 'Nombre d\'enseignants';
$string['sim_tip']           = 'Conseil : fixez un plafond mensuel de {$a} dans votre '
    . 'dashboard OpenAI (platform.openai.com > Settings > Limits).';
$string['sim_title']         = 'Simulateur budgétaire';
$string['sim_weeks']         = 'Semaines par année scolaire';
$string['size_label']        = 'Taille';
$string['size_landscape']    = 'Paysage HD';
$string['size_landscape_std'] = 'Paysage';
$string['size_portrait']     = 'Portrait HD';
$string['size_portrait_std'] = 'Portrait';
$string['size_square']       = 'Carré';
$string['strength_dalle3_1'] = 'Illustrations artistiques et créatives';
$string['strength_dalle3_2'] = 'Scènes narratives et ambiances';
$string['strength_dalle3_3'] = 'Styles variés : watercolor, sketch, cartoon';
$string['strength_gpt2_1']   = 'Texte dans les images très précis';
$string['strength_gpt2_2']   = 'Infographies et diagrammes complexes';
$string['strength_gpt2_3']   = 'Photoréalisme haute fidélité';
$string['strength_gpt2_4']   = 'Tailles flexibles jusqu\'à 2K';
$string['subject_arts']         = 'Arts';
$string['subject_cs']           = 'Informatique';
$string['subject_history']      = 'Histoire et Géographie';
$string['subject_languages']    = 'Langues';
$string['subject_maths']        = 'Mathématiques';
$string['subject_sciences']     = 'Sciences';
$string['tab_costs']         = 'Coûts';
$string['tab_generate']      = 'Générer';
$string['tab_tips']          = 'Conseils';
$string['tip_dalle3']        = '<strong>Conseil DALL-E 3 :</strong> Idéal pour les illustrations '
    . 'artistiques. Utilisez <em>hd</em> pour les détails fins. '
    . 'Évitez si l\'image doit contenir du texte lisible.';
$string['tip_gpt2']          = '<strong>Conseil gpt-image-2 :</strong> Utilisez <em>moyen</em> '
    . 'ou <em>élevé</em> pour les schémas avec du texte. Ajoutez toujours '
    . '<em>« white background, no watermark »</em>.';
$string['tips_do1']          = 'Préciser le <strong>public cible</strong> '
    . '(ex. « for high school students »)';
$string['tips_do2']          = 'Ajouter <strong>« white background, no watermark »</strong>';
$string['tips_do3']          = 'Préciser le <strong>style</strong> '
    . '(flat, watercolor, realistic, diagram)';
$string['tips_do4']          = 'Lister les <strong>éléments spécifiques</strong> à inclure';
$string['tips_do5']          = 'Commencer en qualité <strong>faible</strong> pour tester';
$string['tips_do_col']       = 'À faire';
$string['tips_dont1']        = 'Prompts trop vagues (« make an image about science »)';
$string['tips_dont2']        = 'Oublier le fond ou le style visuel';
$string['tips_dont3']        = 'Mentionner des personnes réelles ou des marques';
$string['tips_dont4']        = 'Trop de concepts dans une seule image';
$string['tips_dont5']        = 'Régénérer 5 fois sans modifier le prompt';
$string['tips_dont_col']     = 'À éviter';
$string['tips_dos_title']    = 'À faire / À éviter';
$string['tips_example']      = '« Create an educational infographic titled The Water Cycle for '
    . 'middle school students. Show evaporation, condensation, precipitation. '
    . 'Soft watercolor style, blue and green palette. White background, no watermark. »';
$string['tips_example_label']   = 'Exemple :';
$string['tips_goal']         = '<strong>Objectif :</strong> Un bon prompt = une image utile dès '
    . 'le premier essai = moins de coût et de temps perdu.';
$string['tips_iteration_body']    = 'Modifiez un seul élément à la fois : '
    . '« same image but with warmer colors » ou « same image but add labels ». '
    . 'Plus efficace et moins coûteux que tout réécrire.';
$string['tips_iteration_title']   = 'Astuce itération';
$string['tips_keywords_title']  = 'Mots-clés de style utiles';
$string['tips_kw_constraints']    = 'Contraintes';
$string['tips_kw_constraints_val'] = 'no watermark, no logos, no text, plain background';
$string['tips_kw_diagrams']     = 'Schémas';
$string['tips_kw_diagrams_val'] = 'flat design, clean diagram, labeled arrows, '
    . 'educational poster, white background';
$string['tips_kw_illustrations']    = 'Illustrations';
$string['tips_kw_illustrations_val'] = 'watercolor, soft illustration, cartoon, hand-drawn, '
    . 'pastel colors';
$string['tips_kw_realistic']    = 'Photos réalistes';
$string['tips_kw_realistic_val'] = 'photorealistic, 35mm film, natural lighting, '
    . 'shallow depth of field';
$string['tips_structure_body']  = 'Format + Sujet + Public cible + Style visuel + Contraintes';
$string['tips_structure_title'] = 'Structure d\'un prompt efficace';
$string['topic_algebra']        = 'Algèbre';
$string['topic_art_education']  = 'Éducation artistique';
$string['topic_biology']        = 'Biologie';
$string['topic_chemistry']      = 'Chimie';
$string['topic_digital_ai']     = 'Numérique et IA';
$string['topic_english']        = 'Anglais';
$string['topic_french']         = 'Français';
$string['topic_geography']      = 'Géographie';
$string['topic_geometry']       = 'Géométrie';
$string['topic_history']        = 'Histoire';
$string['topic_physics']        = 'Physique';
