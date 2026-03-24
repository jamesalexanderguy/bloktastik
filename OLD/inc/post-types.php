<?php 
/**
 * Register custom post types.
 */
// Jobs
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
        'rewrite' => [
            'slug' => 'jobs',
            'with_front' => false,
        ],
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

add_action('init', function() {
    // Register practitioner cpt
    register_post_type('practitioners', [
        'labels' => [
            'name' => __('Practitioners'),
            'singular_name' => __('Practitioner'),
        ],
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'rewrite' => [
            'slug' => 'practitioners',
            'with_front' => false,
        ],
        'show_in_rest' => true,
    ]);
});
