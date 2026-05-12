# tiny_imageia — AI Image Generator for Moodle TinyMCE

**Version:** 1.1.0 | **Updated:** May 12, 2026 | **Author:** Miguël Dhyne <miguel.dhyne@gmail.com>
**License:** GNU GPL v3 or later | **Requires:** Moodle 4.3+, TinyMCE editor

---

## Overview

`tiny_imageia` adds an AI-powered image generation button directly into the TinyMCE toolbar in Moodle. Teachers can generate pedagogical images (diagrams, infographics, illustrations) using OpenAI's image generation API and insert them instantly into any course content — without leaving the editor.

---

## ⚠️ A Note on AI Models (as of May 12, 2026)

This plugin currently supports **two OpenAI image generation models**. OpenAI regularly releases new and improved models, so the recommendations below reflect the best available options **at the time of this release**. If you are reading this at a later date, we recommend checking [platform.openai.com](https://platform.openai.com) for newer models that may have superseded those listed here.

### gpt-image-2 ✨ *(Recommended as of May 2026)*

OpenAI's most capable image generation model at the time of this release. It represents a significant step forward from DALL-E 3 and is the **recommended choice for educational use**.

**Strengths:**
- Accurate text rendering inside images (labels, arrows, captions)
- Complex infographics and scientific diagrams
- High-fidelity photorealism
- Flexible output sizes up to 2K resolution

**Quality levels:** `low` (drafts) · `medium` (recommended) · `high` (dense text, fine detail)

**Estimated cost per image (1024×1024):**
| Quality | Cost |
|---------|------|
| low | ≈ $0.006 |
| medium | ≈ $0.053 |
| high | ≈ $0.211 |

---

### DALL-E 3 *(Classic — stable and well-documented)*

The previous generation model from OpenAI. Still reliable and widely used, with a strong community of prompt examples. Best suited for artistic illustrations and narrative scenes rather than technical diagrams.

**Strengths:**
- Artistic and creative illustrations
- Narrative scenes and atmospheric images
- Varied styles: watercolor, sketch, cartoon
- Large community, extensive documentation

**Limitations compared to gpt-image-2:**
- Less accurate text rendering inside images
- Lower performance on dense infographics
- Fewer size options (1024×1024, 1792×1024, 1024×1792 only)

**Quality levels:** `standard` · `hd`

**Estimated cost per image:**
| Quality | 1024×1024 | 1792×1024 |
|---------|-----------|-----------|
| standard | ≈ $0.04 | ≈ $0.08 |
| hd | ≈ $0.08 | ≈ $0.12 |

---

## Features

- 🖼️ **Custom SVG icon** in the TinyMCE toolbar
- 📚 **Prompt library** with 30+ ready-to-use pedagogical prompts across 6 subjects (Sciences, History & Geography, Languages, Mathematics, Arts, Computer Science)
- ✏️ **Editable prompt** — select from the library or write your own, always modifiable before sending
- 🤖 **Model selector** — switch between gpt-image-2 and DALL-E 3 with live info cards
- 💰 **Cost transparency tab** — live cost estimate per image, budget simulator for schools
- 💡 **Prompt tips tab** — structure guide, do/don't table, style keyword glossary
- ✅ **Insert into editor** — one click to embed the generated image
- ⬇️ **Download PNG** — save the image locally
- 🔄 **Regenerate** — rerun with the same or modified prompt

---

## Installation

### Method 1 — Via Moodle interface (recommended)
1. Download `tiny_imageia.zip`
2. Go to **Site administration → Plugins → Install plugins**
3. Upload the ZIP file and follow the on-screen instructions

### Method 2 — Via FTP/SSH
1. Extract the ZIP
2. Copy the `tiny_imageia` folder to:
   ```
   /path/to/moodle/lib/editor/tiny/plugins/
   ```
3. Go to **Site administration → Notifications** to complete installation

---

## Configuration

After installation:

1. Go to **Site administration → Plugins → Text editors → Tiny ImageIA**
2. Enter your **OpenAI API key** (`sk-...`) — obtain one at [platform.openai.com](https://platform.openai.com)
3. Select the **default model** (gpt-image-2 recommended)
4. Save settings

### Add the button to the TinyMCE toolbar

1. Go to **Site administration → Plugins → Text editors → TinyMCE editor → General settings**
2. Add `tiny_imageia` to the desired toolbar row, e.g.:
   ```
   bold italic | tiny_imageia | image media
   ```

---

## Usage

1. Open any TinyMCE editor in Moodle (page, activity, resource…)
2. Click the **🖼️ star icon** in the toolbar
3. In the dialog:
   - Select a prompt from the dropdown library, or write your own
   - Modify the prompt if needed
   - Choose image size and quality
   - Click **🚀 Generate**
4. Once the image appears:
   - **✅ Insert into editor** — embeds the image directly
   - **⬇️ Download PNG** — saves the file locally
   - **🔄 Regenerate** — generates a new variation

---

## Cost Management

Costs are billed by OpenAI directly on your API key. Recommended practices:

- Start with **low** quality to test prompts, then switch to **medium** for the final version
- Use the **built-in budget simulator** (💰 tab in the dialog) to estimate monthly costs for your institution
- Set a **monthly spending cap** in your OpenAI dashboard at [platform.openai.com → Settings → Limits](https://platform.openai.com)
- **medium** quality is sufficient for 90% of pedagogical use cases

---

## Privacy & Data

Prompts entered by users are sent to OpenAI's servers (USA) for processing. No personal data is stored locally by this plugin. **Do not include students' personal data in prompts.** Review OpenAI's privacy policy and your institution's data governance rules before enabling access for students.

---

## Security Note

The OpenAI API key is stored in Moodle's plugin configuration and transmitted to the teacher's browser at runtime. For large-scale production deployments, consider implementing a server-side PHP proxy to avoid exposing the API key client-side.

---

## Changelog

| Version | Date | Notes |
|---------|------|-------|
| 1.1.0 | 2026-05-12 | Custom SVG icon, full Moodle coding standards compliance |
| 1.0.3 | 2024-12-01 | Tabs UI: Generate / Costs / Prompt tips, gpt-image-2 support |
| 1.0.0 | 2024-12-01 | Initial release with DALL-E 3 |
