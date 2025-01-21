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

Installation
------------

1.  bashCopyEditgit clone https://github.com/your-username/parcel-2-theme.git
    
2.  bashCopyEditcd parcel-2-theme
    
3.  bashCopyEditnpm install
    
4.  bashCopyEditnpm run build
    
5.  **Activate the theme**Log in to the WordPress admin panel and activate the Parcel-2-Theme.
    
6.  **Set up ACF flexible content**
    
    *   Create a flexible content field in ACF named flexible\_content.
        
    *   Add layouts corresponding to your blocks (e.g., hero\_section, about\_section).
        

Development
-----------

Use the following command to enable hot-reloading during development:

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   bashCopyEditnpm run watch   `

This watches for changes in the acf-blocks and src directories and automatically recompiles assets.

Scripts
-------

*   npm run build: Builds all assets for production.
    
*   npm run watch: Watches files for changes and rebuilds assets with hot-reloading.
    

ACF Flexible Content Integration
--------------------------------

Each ACF block is organized as a subdirectory under acf-blocks. For example, the hero\_section block includes:

*   hero\_section.php: PHP template for the block.
    
*   hero\_section.scss: Styles specific to the block.
    
*   hero\_section.js: Scripts specific to the block.
    

### Example Usage

1.  Create a flexible content field in ACF named flexible\_content.
    
2.  Add layouts corresponding to your blocks (e.g., hero\_section, about\_section).
    
3.  The theme automatically loads the CSS and JS for each block used on a page.
    

Global Assets
-------------

Place shared styles and scripts in the src/ directory:

*   src/global.scss: Shared styles (e.g., typography, colors).
    
*   src/global.js: Shared scripts (e.g., navigation, modals).
    

These assets are always included on every page.

Troubleshooting
---------------

1.  **Missing Assets**: Ensure npm run build or npm run watch has run successfully.
    
2.  **File Permissions**: Verify that the dist/ directory is writable.
    
3.  bashCopyEditnpx parcel clean
    

License
-------

This theme is open-source and licensed under the MIT License.
