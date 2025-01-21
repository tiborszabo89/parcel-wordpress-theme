<?php

// Render ACF Flexible Content 
function render_acf_flexible_content() {
    if (have_rows('flexible_content')) {
        while (have_rows('flexible_content')) {
            the_row();
            $layout = get_row_layout(); 

            $template_path = get_template_directory() . "/acf-blocks/{$layout}/{$layout}.php";
            if (file_exists($template_path)) {
                include $template_path;
            } 
        }
    } 
}