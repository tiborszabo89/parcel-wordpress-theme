<?php
// Optimize WordPress Default Assets
// Disable Gutenberg on the back end.
add_filter( 'use_block_editor_for_post', '__return_false' );

// Disable Gutenberg for widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

add_action( 'wp_enqueue_scripts', function() {
    // Remove CSS on the front end.
    wp_dequeue_style( 'wp-block-library' );

    // Remove Gutenberg theme.
    wp_dequeue_style( 'wp-block-library-theme' );

    // Remove inline global CSS on the front end.
    wp_dequeue_style( 'global-styles' );

    // Remove classic-themes CSS for backwards compatibility for button blocks.
    wp_dequeue_style( 'classic-theme-styles' );
}, 20 );

function optimize_wp_assets() {
    // Remove wp-embed.js
    wp_deregister_script('wp-embed');

    // Remove Dashicons for non-logged-in users
    if (!is_admin()) {
        wp_deregister_style('dashicons');
    }
}
add_action('wp_enqueue_scripts', 'optimize_wp_assets', 100);
// Theme setup


add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});


//Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');
 
// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );
 
//Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
 
//Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');
 
//Remove oEmbed JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');


// Disable Emojis
function disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'disable_emojis');

// Clean Up wp_head
function clean_wp_head() {
    remove_action('wp_head', 'rsd_link'); // Remove RSD link
    remove_action('wp_head', 'wlwmanifest_link'); // Remove Windows Live Writer link
    remove_action('wp_head', 'wp_generator'); // Remove WordPress version
    remove_action('wp_head', 'wp_shortlink_wp_head'); // Remove shortlink
    remove_action('wp_head', 'rest_output_link_wp_head'); // Remove REST API link
    remove_action('wp_head', 'oembed_link'); // Remove oEmbed discovery links
}
add_action('after_setup_theme', 'clean_wp_head');

// Disable Heartbeat API
function disable_heartbeat() {
    wp_deregister_script('heartbeat');
    wp_deregister_script( 'comment-reply' );

}
add_action('init', 'disable_heartbeat');

// Lazy Load Scripts
function add_defer_attribute($tag, $handle) {
    if (!is_admin() && strpos($handle, 'main-js') !== false) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

// Remove Query Strings from Static Resources
function remove_query_strings($src) {
    return remove_query_arg('ver', $src);
}
add_filter('script_loader_src', 'remove_query_strings', 10, 1);
add_filter('style_loader_src', 'remove_query_strings', 10, 1);

// Optional: Disable REST API for Non-Authenticated Users
function disable_rest_api($access) {
    if (!is_user_logged_in()) {
        return new WP_Error('rest_disabled', 'The REST API is disabled.', ['status' => 403]);
    }
    return $access;
}
add_filter('rest_authentication_errors', 'disable_rest_api');

// Hide admin bar
show_admin_bar(false);

// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');
