<?php 
/**
 * Register custom post types.
 */

 add_action('init', function() {
    // Register the custom post type
    register_post_type('faq', [
        'labels' => [
            'name' => __('FAQs'),
            'singular_name' => __('FAQ'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-editor-help',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'rewrite' => ['slug' => 'faqs'],
        'show_in_rest' => true,
    ]);

    // Register the taxonomy
    register_taxonomy('faq_type', 'faq', [
        'labels' => [
            'name' => __('Types'),
            'singular_name' => __('Type'),
        ],
        'public' => true,
        'hierarchical' => true, 
        'rewrite' => ['slug' => 'faq-type'],
        'show_in_rest' => true, 
    ]);
});

