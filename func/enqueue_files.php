<?php 

function enqueue_global_assets() {

    wp_enqueue_style('global-styles', get_template_directory_uri() . '/dist/assets/global.css', [], null);
    wp_enqueue_script('global-scripts', get_template_directory_uri() . '/dist/assets/global.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_global_assets');
function enqueue_acf_block_files() {
    if (!is_singular()) {
        return;
    }

    $rows = get_field('flexible_content');
    if ($rows) {
        foreach ($rows as $row) {
            $layout = $row['acf_fc_layout']; // Layout name
            $css_file = get_template_directory_uri() . "/dist/{$layout}/{$layout}.css";
            $js_file = get_template_directory_uri() . "/dist/{$layout}/{$layout}.js";
            if (file_exists(get_template_directory() . "/dist/{$layout}/{$layout}.css")) {
                wp_enqueue_style("block-{$layout}-css", $css_file, [], null);
            } 
            if (file_exists(get_template_directory() . "/dist/{$layout}/{$layout}.js")) {
                wp_enqueue_script("block-{$layout}-js", $js_file, [], null, true);
            } 
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_acf_block_files');