<?php
/**
 * Theme Functions
 * 
 */
// Force cache bust during dev
add_filter('style_loader_src', function($src) {
    return add_query_arg('ver', time(), $src);
}, 9999);

add_action('init', function() {
    delete_option('_transient_wp_core_block_patterns');
    delete_option('_transient_timeout_wp_core_block_patterns');
});

// Enqueue scripts and styles
require_once get_template_directory() . '/inc/enqueues.php';

// Block customizations (variations, removals)
require_once get_template_directory() . '/inc/block-styles.php';

// Formats, block binding etc
require_once get_template_directory() . '/inc/setup.php';

// Custom post types
// require get_template_directory() . '/inc/post-types.php';

