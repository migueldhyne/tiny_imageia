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
 * French language strings for tiny_imageia plugin.
 *
 * @package    tiny_imageia
 * @copyright  2026 Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apikey'] = 'Clé API OpenAI';
$string['apikey_desc'] = 'Entrez votre clé API OpenAI (sk-...). Obtenez-la sur platform.openai.com.';
$string['best_1'] = 'Commencez en qualité <strong>faible</strong> pour tester votre prompt, puis passez en <strong>moyen</strong> ou <strong>élevé</strong> pour la version finale.';
$string['best_2'] = 'Utilisez la banque de prompts : des prompts bien construits donnent de meilleurs résultats du premier coup, évitant les régénérations coûteuses.';
$string['best_3'] = 'Évitez la qualité <strong>élevée</strong> pour les images simples sans texte dense — <strong>moyen</strong> suffit dans 90 % des cas pédagogiques.';
$string['best_4'] = 'Ne retouchez pas une image générée via ce plugin (envoi + édition) : cela coûte 2 à 3 fois plus cher qu\'une génération simple.';
$string['best_5'] = 'Définissez un budget mensuel dans le tableau de bord OpenAI (platform.openai.com → Paramètres → Limites) pour éviter les dépassements.';
$string['best_title'] = 'Bonnes pratiques pour maîtriser les coûts';
$string['buttontitle'] = 'Générer une image pédagogique par IA';
$string['cost_col_quality'] = 'Qualité';
$string['cost_col_use'] = 'Usage recommandé';
$string['cost_high_use'] = 'Schémas très denses, texte fin';
$string['cost_how_body'] = '<code>gpt-image-2</code> ne coûte <strong>pas un prix fixe par image</strong>. OpenAI utilise un système de <strong>jetons</strong> (unités de traitement) : chaque image consomme un certain nombre de jetons en entrée et en sortie. Le coût varie donc selon la taille et la qualité choisies. Les chiffres ci-dessous sont des <em>estimations</em> issues du calculateur officiel OpenAI.';
$string['cost_how_title'] = 'Comment OpenAI facture-t-il ?';
$string['cost_label'] = 'Coût estimé';
$string['cost_low_use'] = 'Brouillons, tests rapides';
$string['cost_medium_use'] = 'Usage pédagogique courant';
$string['cost_per_image'] = 'par image';
$string['cost_table_title'] = 'gpt-image-2 — Coûts estimés par image';
$string['cost_why_body'] = 'Chaque image générée a un coût réel facturé par OpenAI sur votre clé API. Ces informations vous permettent d\'utiliser l\'outil de façon <strong>éclairée et responsable</strong>, et d\'estimer l\'impact budgétaire pour votre établissement.';
$string['cost_why_title'] = 'Pourquoi cet onglet ?';
$string['defaultmodel'] = 'Modèle par défaut';
$string['defaultmodel_desc'] = 'Modèle OpenAI utilisé par défaut pour la génération d\'images.';
$string['dialog_subtitle'] = 'OpenAI · Plugin TinyMCE pour Moodle';
$string['dialog_title'] = 'Générateur d\'images pédagogiques IA';
$string['download_btn'] = 'Télécharger en PNG';
$string['error_hint'] = 'Vérifiez votre clé API et vos crédits OpenAI.';
$string['error_no_key'] = 'Clé API OpenAI manquante. Allez dans : Administration > Plugins > Éditeurs de texte > ImageIA pédagogique.';
$string['error_no_prompt'] = 'Veuillez saisir ou sélectionner un prompt.';
$string['error_prefix'] = 'Erreur :';
$string['generate_btn'] = 'Générer';
$string['generating'] = 'Génération en cours…';
$string['img_alt'] = 'Image pédagogique générée par IA';
$string['insert_btn'] = 'Insérer dans l\'éditeur';
$string['model_badge'] = 'NOUVEAU';
$string['model_desc'] = 'Modèle le plus puissant d\'OpenAI (2025). Idéal pour les infographies, le texte dans les images, les schémas scientifiques et le photoréalisme. Meilleure qualité dès le premier essai.';
$string['model_label'] = 'Modèle IA';
$string['model_sub'] = 'Recommandé — schémas, texte, infographies';
$string['model_tip'] = '<strong>Conseil gpt-image-2 :</strong> Pour les schémas avec du texte, choisissez <em>moyen</em> ou <em>élevé</em>. Précisez le public cible, le style visuel et ajoutez <em>« fond blanc, sans filigrane »</em>.';
$string['pluginname'] = 'Image IA pédagogique';
$string['privacy:metadata'] = 'Le plugin tiny_imageia envoie les prompts à l\'API OpenAI pour générer des images. Aucune donnée personnelle n\'est stockée localement.';
$string['privacy_body'] = 'Les prompts saisis sont envoyés aux serveurs d\'OpenAI (États-Unis) pour traitement. Ne saisissez jamais de données personnelles d\'élèves dans les prompts. Consultez la politique de confidentialité d\'OpenAI et le règlement de votre établissement avant d\'autoriser l\'accès aux étudiants.';
$string['privacy_title'] = 'Données et vie privée';
$string['prompt_alg_1'] = 'Créez une infographie intitulée \'Priorité des opérations\' pour le collège. Montrez Parenthèses → Exposants → Multiplication/Division → Addition/Soustraction avec un exemple résolu. Palette orange et bleue, fond blanc.';
$string['prompt_alg_2'] = 'Créez une infographie de maths intitulée \'Le théorème de Pythagore\' pour le collège. Triangle rectangle avec côtés a, b, c, la formule a²+b²=c², deux exemples numériques. Style pédagogique épuré, fond blanc.';
$string['prompt_art_1'] = 'Créez une affiche de roue chromatique intitulée \'La roue des couleurs\' pour les élèves en art. Montrez les couleurs primaires, secondaires et tertiaires, avec les relations complémentaires et analogues. Fond blanc.';
$string['prompt_art_2'] = 'Créez une infographie d\'histoire de l\'art intitulée \'Les grands mouvements artistiques\'. Montrez Impressionnisme, Cubisme, Surréalisme, Expressionnisme abstrait, Pop Art avec dates et artistes clés.';
$string['prompt_art_3'] = 'Créez un diagramme intitulé \'Les éléments du langage plastique\'. Montrez les 7 éléments : ligne, forme, volume, espace, texture, valeur, couleur. Chacun avec un exemple visuel. Fond blanc.';
$string['prompt_bank_label'] = 'Banque de prompts pédagogiques';
$string['prompt_bio_1'] = 'Créez un diagramme de biologie intitulé \'La structure cellulaire\' pour le lycée. Montrez les principaux organites d\'une cellule animale (noyau, mitochondrie, ribosomes, réticulum endoplasmique, appareil de Golgi, membrane). Flèches légendées, couleurs pastel, style épuré, fond blanc.';
$string['prompt_bio_2'] = 'Créez une infographie éducative intitulée \'La photosynthèse\' pour le collège. Montrez : lumière + CO2 + eau → glucose + oxygène, avec un diagramme de plante simple. Style épuré, palette verte et jaune, fond blanc.';
$string['prompt_bio_3'] = 'Créez un diagramme intitulé \'La structure de l\'ADN en double hélice\' pour le lycée. Montrez les paires de bases (A-T, G-C), le squelette sucre-phosphate, légendés. Palette bleue et blanche, fond blanc.';
$string['prompt_bio_4'] = 'Créez une affiche éducative intitulée \'Le système digestif humain\' pour les 12-15 ans. Trajet de la bouche aux intestins avec organes légendés. Style anatomique simple, couleurs chaudes, fond blanc.';
$string['prompt_bio_5'] = 'Créez une infographie intitulée \'La respiration cellulaire\' pour le lycée. Montrez glycolyse, cycle de Krebs, chaîne respiratoire. Légendez : glucose, pyruvate, ATP, NADH, CO2. Schéma épuré, fond blanc.';
$string['prompt_chem_1'] = 'Créez un schéma de chimie intitulé \'Les états de la matière\' pour le collège. Montrez solide, liquide, gaz avec arrangement des molécules et flèches de changement d\'état. Style épuré, palette bleue, fond blanc.';
$string['prompt_chem_2'] = 'Créez une infographie intitulée \'L\'échelle de pH\' pour le lycée. Échelle horizontale 0-14, substances courantes à chaque niveau. Dégradé de couleur rouge à violet, fond blanc.';
$string['prompt_chem_3'] = 'Créez une infographie intitulée \'Les types de liaisons chimiques\' pour le lycée. Montrez liaisons ionique, covalente et métallique avec diagrammes moléculaires simples. Code couleur, fond blanc, légendé.';
$string['prompt_cs_1'] = 'Créez une infographie intitulée \'Comment fonctionne internet\' pour le collège. Parcours des données : utilisateur → routeur → FAI → serveur → retour, avec icônes simples. Style épuré, palette bleue et grise, fond blanc.';
$string['prompt_cs_2'] = 'Créez un diagramme intitulé \'Le système binaire\' pour l\'informatique. Montrez le binaire (base 2) et le décimal de 0 à 15, avec un tableau de conversion clair. Style terminal vert sur fond sombre.';
$string['prompt_cs_3'] = 'Créez une affiche intitulée \'Les cybermenaces\'. Montrez hameçonnage, logiciel malveillant, rançongiciel, attaque par déni de service avec icônes et descriptions. Style alerte, palette rouge et sombre, fond blanc.';
$string['prompt_cs_4'] = 'Créez une infographie intitulée \'Comment fonctionne l\'apprentissage automatique\' pour le lycée. Enchaînement : collecte des données → entraînement → modèle → prédiction → boucle de rétroaction. Palette violette et bleue, flèches légendées, fond blanc.';
$string['prompt_cs_5'] = 'Créez un diagramme intitulé \'Le cycle de développement logiciel (SDLC)\'. 6 phases : planification, conception, codage, test, déploiement, maintenance en schéma circulaire. Style épuré, palette bleue, fond blanc.';
$string['prompt_en_1'] = 'Créez une affiche intitulée \'Les verbes irréguliers anglais\'. Tableau avec 15 verbes courants (forme de base, prétérit, participe passé). Tableau coloré, fond blanc.';
$string['prompt_en_2'] = 'Créez une infographie intitulée \'Les prépositions de lieu en anglais\'. Montrez in, on, at, under, next to, between avec illustrations simples. Style épuré et coloré.';
$string['prompt_en_3'] = 'Créez une affiche intitulée \'Les connecteurs et mots de liaison en anglais\'. Groupés par fonction : ajout (also, moreover), contraste (however, although), cause (because, since). Mise en page typographique épurée.';
$string['prompt_fr_1'] = 'Créez une affiche de grammaire intitulée \'Les temps verbaux en français\'. Frise chronologique avec présent, passé (passé composé, imparfait) et futur avec des exemples de phrases. Mise en page typographique épurée, bleu et blanc.';
$string['prompt_fr_2'] = 'Créez une infographie de vocabulaire intitulée \'Les émotions en français\' pour débutants. 8 à 10 mots d\'émotions avec illustrations de visages expressifs. Style coloré et convivial, fond blanc.';
$string['prompt_geo_1'] = 'Créez un diagramme intitulé \'Les types d\'écosystèmes\' pour le collège. Montrez 6 biomes (forêt tropicale, désert, toundra, océan, forêt tempérée, savane) avec petites illustrations. Style épuré, coloré, fond blanc.';
$string['prompt_geo_2'] = 'Créez une infographie intitulée \'Causes et effets du changement climatique\' pour le lycée. Causes humaines → effets (hausse des températures, montée des eaux). Schéma à flèches, palette bleue et orange, fond blanc.';
$string['prompt_geo_3'] = 'Créez une affiche intitulée \'Le cycle des roches\' pour le collège. Montrez roches ignées, sédimentaires et métamorphiques avec processus de transformation en flèches légendées. Couleurs naturelles, schéma épuré.';
$string['prompt_geom_1'] = 'Créez une affiche intitulée \'Les types de triangles\' pour le collège. Montrez et légendez : équilatéral, isocèle, scalène, rectangle, obtusangle, acutangle avec propriétés des angles. Style géométrique épuré, palette bleue, fond blanc.';
$string['prompt_geom_2'] = 'Créez un diagramme intitulé \'Formules d\'aire et de périmètre\' pour le collège. Formules pour rectangle, triangle, cercle et trapèze avec formes illustrées. Style pédagogique épuré, fond blanc.';
$string['prompt_geom_3'] = 'Créez une affiche intitulée \'Les solides et leurs propriétés\'. Montrez cube, sphère, cylindre, cône, pyramide avec faces, arêtes et sommets légendés. Illustration isométrique, colorée, fond blanc.';
$string['prompt_hist_1'] = 'Créez une frise chronologique intitulée \'Événements clés de la Seconde Guerre mondiale (1939-1945)\'. 6 à 8 événements majeurs en ordre chronologique avec petites icônes. Infographie épurée, palette rouge sombre et grise, fond blanc.';
$string['prompt_hist_2'] = 'Créez une infographie intitulée \'La Révolution française (1789-1799)\'. Phases clés avec dates et descriptions brèves. Palette bleu, blanc, rouge, fond blanc.';
$string['prompt_hist_3'] = 'Créez un diagramme intitulé \'Les causes de la Première Guerre mondiale (MAIN)\'. Montrez Militarisme, Alliances, Impérialisme, Nationalisme avec icônes et flèches. Infographie épurée, fond blanc.';
$string['prompt_label'] = 'Prompt (modifiable avant envoi)';
$string['prompt_phys_1'] = 'Créez un schéma de physique intitulé \'Le spectre électromagnétique\' pour le lycée. Spectre complet des ondes radio aux rayons gamma, indicateurs de longueur d\'onde et fréquence. Inclure la section arc-en-ciel de la lumière visible, fond blanc.';
$string['prompt_phys_2'] = 'Créez un diagramme éducatif intitulé \'Les trois lois du mouvement de Newton\'. Illustrez : inertie (balle au repos), F=ma (flèche de force), action-réaction (fusée). Style épuré, palette bleu foncé et orange, fond blanc.';
$string['prompt_phys_3'] = 'Créez une infographie intitulée \'Le cycle de l\'eau\' pour le collège. Montrez évaporation, condensation, précipitation et ruissellement avec flèches légendées dans un paysage. Style aquarelle douce, palette bleue et verte, fond blanc.';
$string['prompt_placeholder'] = 'Décrivez l\'image souhaitée : sujet, public cible, style visuel, couleurs…';
$string['prompt_used_prefix'] = 'Prompt interprété :';
$string['quality_high'] = 'Élevé — qualité maximale, texte dense';
$string['quality_label'] = 'Qualité';
$string['quality_low'] = 'Faible — rapide, bon pour les brouillons';
$string['quality_medium'] = 'Moyen — équilibre qualité et vitesse';
$string['regen_btn'] = 'Régénérer';
$string['select_prompt'] = '-- Sélectionner un prompt ou écrire le vôtre --';
$string['sim_btn'] = 'Calculer';
$string['sim_images'] = 'Images par enseignant et par semaine';
$string['sim_model'] = 'Modèle et qualité';
$string['sim_opt_high'] = 'gpt-image-2 · élevé (texte dense)';
$string['sim_opt_low'] = 'gpt-image-2 · faible (brouillons)';
$string['sim_opt_medium'] = 'gpt-image-2 · moyen (recommandé)';
$string['sim_per_month'] = 'Par mois';
$string['sim_per_week'] = 'Par semaine';
$string['sim_per_year'] = 'Par année scolaire';
$string['sim_teachers'] = 'Nombre d\'enseignants';
$string['sim_title'] = 'Simulateur budgétaire';
$string['sim_weeks'] = 'Nombre de semaines par an';
$string['size_auto'] = 'Automatique — choix optimal par l\'API';
$string['size_label'] = 'Taille';
$string['size_landscape'] = 'Paysage HD';
$string['size_portrait'] = 'Portrait HD';
$string['size_square'] = 'Carré';
$string['strength_1'] = 'Texte dans les images très précis';
$string['strength_2'] = 'Infographies et diagrammes complexes';
$string['strength_3'] = 'Photoréalisme haute fidélité';
$string['strength_4'] = 'Labels, flèches et légendes nets';
$string['strength_5'] = 'Tailles flexibles jusqu\'à 2 Ko';
$string['subj_arts'] = 'Arts';
$string['subj_hg'] = 'Histoire et Géographie';
$string['subj_info'] = 'Informatique';
$string['subj_lang'] = 'Langues';
$string['subj_maths'] = 'Mathématiques';
$string['subj_sciences'] = 'Sciences';
$string['tab_cost'] = 'Coûts et transparence';
$string['tab_generate'] = 'Générer';
$string['tab_tips'] = 'Conseils de prompts';
$string['tips_do_1'] = 'Préciser le public cible ("for high school students")';
$string['tips_do_2'] = 'Ajouter "white background, no watermark"';
$string['tips_do_3'] = 'Mettre le texte attendu entre guillemets';
$string['tips_do_4'] = 'Préciser le style (schéma épuré, aquarelle, réaliste, diagramme)';
$string['tips_do_5'] = 'Lister les éléments spécifiques à inclure';
$string['tips_do_6'] = 'Commencer en qualité faible pour tester';
$string['tips_do_col'] = 'À faire';
$string['tips_do_title'] = 'À faire / À éviter';
$string['tips_dont_1'] = 'Prompts trop vagues ("make an image about science")';
$string['tips_dont_2'] = 'Oublier le fond ou le style visuel';
$string['tips_dont_3'] = 'Demander trop de concepts en une seule image';
$string['tips_dont_4'] = 'Mentionner des personnes réelles ou des marques';
$string['tips_dont_5'] = 'Utiliser des termes ambigus ou poétiques';
$string['tips_dont_6'] = 'Régénérer 5 fois sans modifier le prompt';
$string['tips_dont_col'] = 'À éviter';
$string['tips_example'] = '"Create an educational infographic titled The Water Cycle for middle school students. Show evaporation, condensation, precipitation with labeled arrows. Soft watercolor style, blue and green palette. White background, no watermark."';
$string['tips_example_label'] = 'Exemple :';
$string['tips_goal'] = 'Objectif : un bon prompt = une image utile dès le premier essai = moins de coût et de temps perdu.';
$string['tips_iter_body'] = 'Si le résultat n\'est pas satisfaisant, modifiez <strong>un seul élément à la fois</strong> dans le prompt (« même image mais avec des couleurs plus chaudes » · « même image mais avec des étiquettes » · « même image mais plus simple »). C\'est plus efficace — et moins coûteux — que de tout réécrire.';
$string['tips_iter_title'] = 'Astuce itération';
$string['tips_kw_const'] = 'Contraintes utiles';
$string['tips_kw_const_val'] = 'sans filigrane · sans texte superflu · sans logos · sans marques · fond uni · sans personnes';
$string['tips_kw_diag'] = 'Schémas et diagrammes';
$string['tips_kw_diag_val'] = 'schéma épuré · flèches légendées · affiche pédagogique · style infographie · fond blanc';
$string['tips_kw_illus'] = 'Illustrations';
$string['tips_kw_illus_val'] = 'aquarelle · illustration douce · dessin animé · dessiné à la main · couleurs pastel';
$string['tips_kw_photo'] = 'Photos réalistes';
$string['tips_kw_photo_val'] = 'photoréaliste · photographie candide · pellicule 35 mm · éclairage naturel · faible profondeur de champ';
$string['tips_kw_title'] = 'Mots-clés de style utiles';
$string['tips_struct_body'] = 'Format + Sujet + Public cible + Style visuel + Contraintes';
$string['tips_struct_title'] = 'Structure d\'un prompt efficace';
$string['topic_alg'] = 'Algèbre';
$string['topic_art'] = 'Éducation artistique';
$string['topic_bio'] = 'Biologie';
$string['topic_chem'] = 'Chimie';
$string['topic_cs'] = 'Numérique et IA';
$string['topic_en'] = 'Anglais';
$string['topic_fr'] = 'Français';
$string['topic_geo'] = 'Géographie';
$string['topic_geom'] = 'Géométrie';
$string['topic_hist'] = 'Histoire';
$string['topic_phys'] = 'Physique';
