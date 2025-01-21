# Parcel-2-Theme

A custom WordPress theme using Parcel 2 for modern asset bundling. This setup dynamically loads CSS and JavaScript for Advanced Custom Fields (ACF) flexible content blocks, ensuring optimal performance by loading only the assets used on the current page.

---

## Features

- **Dynamic Asset Loading**: Load CSS and JS for ACF flexible content blocks used on a page.
- **Modern Build System**: Parcel 2 for bundling JavaScript and SCSS.
- **Global Assets Support**: Includes a global CSS and JS file for shared styles and scripts.
- **Clean Theme Structure**: Modular ACF block organization for easy development.

---

## Requirements

- WordPress 6.x or higher
- ACF PRO plugin
- Node.js 14.x or higher
- Parcel 2 (installed via `npm`)

---

## Theme Structure

```plaintext
parcel-theme/
│
├── acf-blocks/                # ACF flexible content blocks
│   ├── hero_section/
│   │   ├── hero_section.php   # PHP template
│   │   ├── hero_section.scss  # SCSS file
│   │   └── hero_section.js    # JS file
│   └── about_section/
│       ├── about_section.php
│       ├── about_section.scss
│       └── about_section.js
│
├── src/                       # Global styles and scripts
│   ├── global.scss            # Global styles
│   └── global.js              # Global scripts
│
├── dist/                      # Output directory for bundled files
│
├── functions.php              # WordPress theme functions
├── page.php                   # Renders ACF flexible content
├── header.php, footer.php, etc.
│
├── package.json               # Parcel scripts and dependencies
└── README.md