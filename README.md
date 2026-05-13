# tiny_imageia — Plugin TinyMCE pour Moodle 4.5+
## Générateur d'images pédagogiques IA (OpenAI DALL-E)

---

## 📋 Description

Ce plugin ajoute un bouton **🖼️ Image IA** dans la barre d'outils TinyMCE de Moodle.
Il permet aux enseignants de :

- **Choisir** un prompt dans une banque de +30 prompts pédagogiques prêts à l'emploi
  (Sciences, Histoire-Géo, Langues, Maths, Arts, Informatique)
- **Modifier** le prompt avant envoi
- **Écrire** leur propre prompt libre
- **Générer** l'image via l'API OpenAI (DALL-E 3)
- **Insérer** l'image directement dans l'éditeur Moodle
- **Télécharger** l'image générée

---

## ⚙️ Prérequis

- Moodle **4.3 minimum** (recommandé : 4.5+)
- Éditeur **TinyMCE** activé (pas Atto)
- Clé API **OpenAI** avec accès payant (DALL-E 3 ≈ 0,04 $/image standard)

---

## 🚀 Installation

### Méthode 1 — Via l'interface Moodle (recommandée)

1. Téléchargez le fichier ZIP du plugin
2. Connectez-vous en tant qu'administrateur
3. Allez dans : **Administration du site → Plugins → Installer des plugins**
4. Déposez le fichier ZIP et cliquez **Installer le plugin**
5. Suivez les instructions à l'écran

### Méthode 2 — Via FTP/SSH

1. Décompressez le zip
2. Copiez le dossier `imageia` dans :
   ```
   /var/www/moodle/lib/editor/tiny/plugins/
   ```
3. Allez dans **Administration du site → Notifications** pour finaliser l'installation

---

## 🔧 Configuration

Après installation :

1. **Administration du site → Plugins → Éditeurs de texte → ImageIA pédagogique**
2. Renseignez votre **Clé API OpenAI** (`sk-...`)
3. Choisissez le modèle (DALL-E 3 recommandé) et la taille par défaut
4. Sauvegardez

### Ajouter le bouton à la barre d'outils TinyMCE

1. **Administration du site → Plugins → Éditeurs de texte → TinyMCE → Paramètres généraux**
2. Dans la configuration de la barre d'outils, ajoutez `tiny_imageia` à la ligne souhaitée
   Exemple : `bold italic | tiny_imageia | image media`

---

## 🎓 Utilisation

1. Ouvrez n'importe quel éditeur TinyMCE dans Moodle (page, activité, ressource…)
2. Cliquez sur le bouton **🖼️** dans la barre d'outils
3. Dans la fenêtre :
   - Sélectionnez un prompt dans la liste déroulante, OU
   - Écrivez votre propre prompt
   - Modifiez le prompt si nécessaire
   - Choisissez la taille et la qualité
4. Cliquez **🚀 Générer l'image**
5. Une fois l'image apparue :
   - **✅ Insérer dans l'éditeur** — place l'image dans votre contenu
   - **⬇️ Télécharger** — sauvegarde le fichier PNG sur votre ordinateur

---

## 📚 Matières couvertes dans la banque de prompts

| Matière | Sujets |
|---------|--------|
| 🔬 Sciences | Biologie, Chimie, Physique |
| 🗺️ Histoire-Géo | Histoire, Géographie |
| 🗣️ Langues | Français, Anglais |
| 📐 Mathématiques | Géométrie, Algèbre |
| 🎨 Arts | Éducation artistique |
| 💻 Informatique | Numérique, Cybersécurité, IA |

---

## 💰 Coûts API OpenAI (indicatifs, mai 2024)

| Modèle | Qualité | Prix/image |
|--------|---------|-----------|
| DALL-E 3 | Standard | ~0,04 $ |
| DALL-E 3 | HD | ~0,08 $ |
| DALL-E 2 | Standard | ~0,02 $ |

---

## 🔐 Sécurité

⚠️ **Important** : La clé API est stockée dans la configuration Moodle et transmise
au navigateur de l'enseignant. Pour une sécurité maximale en production,
il est recommandé de créer un proxy PHP côté serveur plutôt que d'appeler
l'API OpenAI directement depuis le navigateur.

---

## 📄 Licence

GPL v3 — Libre d'utilisation, modification et distribution.

## Structure Moodle correcte

Le dossier sur le disque doit s’appeler `imageia` et être placé dans `lib/editor/tiny/plugins/imageia`.
Le composant déclaré dans `version.php` reste `tiny_imageia`.
Ne pas installer ce plugin dans un dossier nommé `tiny_imageia`, sinon Moodle le détecte comme `tiny_tiny_imageia`.


## Version 1.0.2

- Button registered as `tiny_imageia_imageia` following Moodle TinyMCE skeleton naming.
- Toolbar insertion moved back to the standard `content` toolbar region.
- Menu item registered separately from the toolbar button.
