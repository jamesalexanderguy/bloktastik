<?php 
/**
 * Register custom post types.
 */
// FAQ
add_action('init', function() {
    // Register the custom post type
    register_post_type('jobs', [
        'labels' => [
            'name' => __('Jobs'),
            'singular_name' => __('Job'),
        ],
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'menu_icon' => 'dashicons-businessman',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'rewrite' => false,
        'show_in_rest' => true,
    ]);

    // Register the taxonomy
    register_taxonomy('job_type', 'jobs', [
        'labels' => [
            'name' => __('Types'),
            'singular_name' => __('Type'),
        ],
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'hierarchical' => true, 
        'rewrite' => false,
        'show_in_rest' => true, 
    ]);
});
