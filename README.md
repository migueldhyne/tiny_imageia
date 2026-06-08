# moodle-tiny_imageia — TinyMCE plugin for Moodle 4.3+

## Pedagogical AI image generator using OpenAI `gpt-image-2`

---

## Description

This plugin adds an AI Image button to the Moodle TinyMCE toolbar.
It allows teachers and course creators to generate educational images directly inside Moodle
using OpenAI's `gpt-image-2` image generation model.

The plugin lets users:

- Choose a prompt from a bank of 30+ ready-to-use educational prompts
  (Sciences, History and Geography, Languages, Mathematics, Arts, Computing)
- Edit the selected prompt before sending it
- Write a custom prompt
- Generate an image via the Moodle External Services API (no direct browser-to-OpenAI calls)
- Insert the generated image directly into the Moodle editor
- Download the generated image as a PNG file

---

## Requirements

- Moodle **4.3 minimum** (`$plugin->requires = 2023100900`)
- The **TinyMCE** editor enabled (this plugin is not for Atto)
- A paid **OpenAI API key** with access to image generation
  (obtain one at https://platform.openai.com)
- PHP cURL enabled on the Moodle server

> **Subscription required:** This plugin integrates with the OpenAI API, a paid third-party service.
> You must obtain an API key from https://platform.openai.com and accept OpenAI's terms of service.
> The API key is stored server-side in Moodle's plugin configuration and is never exposed to browsers.

---

## Installation

### Method 1 — Moodle web interface (recommended)

1. Download the plugin ZIP file.
2. Log in as a Moodle administrator.
3. Go to **Site administration → Plugins → Install plugins**.
4. Upload the ZIP file and click **Install plugin**.
5. Follow the on-screen installation steps.
6. After installation, go to **Site administration → Notifications** to run the database upgrade.

### Method 2 — FTP or SSH

1. Unzip the archive.
2. Copy the `imageia` folder to:
   ```
   /path/to/moodle/lib/editor/tiny/plugins/
   ```
   The folder **must** be named `imageia` (not `tiny_imageia`), so that Moodle resolves it
   as the component `tiny_imageia`.
3. Go to **Site administration → Notifications** to complete the installation.

---

## Configuration

After installation:

1. Go to **Site administration → Plugins → Text editors → Pedagogical ImageIA**.
2. Enter your **OpenAI API key** (`sk-...`).
3. Save the settings.
4. Go to **Site administration → Plugins → Text editors → TinyMCE → General settings**
   and add `tiny_imageia` to a toolbar row.

---

## Usage

1. Open any Moodle page or activity that uses the TinyMCE editor.
2. Click the AI Image button in the toolbar.
3. In the dialog:
   - Select a prompt from the library, or write your own.
   - Choose image size and quality.
4. Click **Generate**.
5. Insert the image into the editor, or download it as PNG.

---

## Security

- The OpenAI API key is stored in `config_plugins` and read server-side only.
- All image generation requests go through the `tiny_imageia_generate_image` External Service,
  protected by `require_login()`, `require_capability('tiny/imageia:use')`, and Moodle's
  standard AJAX security.
- The browser never communicates directly with the OpenAI API.

---

## Privacy

This plugin transmits user-supplied text prompts to the OpenAI API (https://api.openai.com)
for image generation. No personal data is stored locally by this plugin.
Please review OpenAI's privacy policy before enabling access for students.
See the plugin's Privacy API implementation (`classes/privacy/provider.php`).

---

## Bug tracker / Issue tracker

Please report bugs, suggest features, or ask questions at:
**https://github.com/migueldhyne/moodle-tiny_imageia/issues**

---

## Documentation

Full documentation is available at:
**https://github.com/migueldhyne/moodle-tiny_imageia/wiki**

---

## OpenAI API costs for `gpt-image-2`

Pricing is token-based. Estimated cost per image:

| Quality | ~1024×1024 | ~1536×1024 |
|---------|-----------|-----------|
| low     | $0.006    | $0.008    |
| medium  | $0.053    | $0.070    |
| high    | $0.211    | $0.280    |

Monitor your usage at https://platform.openai.com and set a monthly budget limit.

---

## License

GNU General Public License v3 or later — see [LICENSE](LICENSE).

---

## Changelog

### 1.3.2
- Replaced deprecated `require_once($CFG->libdir . '/externallib.php')` with namespaced
  `core_external` classes (`core_external\external_api`, etc.), required for Moodle 4.3+.
- Changed `PARAM_ALPHANUMEXT` to `PARAM_TEXT` + explicit whitelist for `model` and `size`
  parameters, to reliably support all valid values including `auto` and hyphenated model names.
- Replaced JavaScript `alert()` calls with `core/notification` (`Notification.alert()`),
  conforming to Moodle JS standards.
- Added `pix/icon.svg` so the plugin displays its icon correctly in Site Administration.
- `is_enabled()` now checks the `tiny/imageia:use` capability, hiding the button for
  users who do not have permission to generate images.
- Added `$plugin->supported = [403, 404, 405]` to declare tested Moodle versions.
- Added explicit PHPDoc comment on `PARAM_RAW` usage in `execute_returns()`.

### 1.3.1
- All user-facing strings moved to lang files; no hard-coded text in JS.
- Image generation migrated to Moodle External Services (`tiny_imageia_generate_image`).
- Modal UI rendered via Mustache template (`templates/modal.mustache`).
- Added `db/access.php` with `tiny/imageia:use` capability.
- Privacy provider updated with `add_external_location_link()`.
- Repository renamed to `moodle-tiny_imageia`.
- LICENSE file added to plugin root.
