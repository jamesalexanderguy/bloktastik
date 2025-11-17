<?php 
/**
 * Register custom post types.
 */
// FAQ
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
// Testimonials
add_action('init', function() {
    register_post_type('allset_testimonial', [
        'labels' => [
            'name' => __('Testimonials'),
            'singular_name' => __('Testimonial'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => ['title', 'editor', 'sticky'],
        'rewrite' => ['slug' => 'testimonials'],
        'show_in_rest' => true,
        'template'    => [
            [ 'core/pattern', [ 'slug' => 'bloktastik/inner-quote' ] ],
        ],
        'template_lock' => false,
    ]);
});

// Register sticky as a REST field
add_action('rest_api_init', function() {
    register_rest_field('allset_testimonial', 'sticky', array(
        'get_callback' => function($post) {
            return is_sticky($post['id']);
        },
        'update_callback' => function($value, $post) {
            if ($value) {
                stick_post($post->ID);
            } else {
                unstick_post($post->ID);
            }
        },
        'schema' => array(
            'description' => __('Whether or not the post should be treated as sticky.'),
            'type'        => 'boolean',
        ),
    ));
});

// Register sticky as a query parameter for the REST API
add_filter('rest_allset_testimonial_collection_params', function($params) {
    $params['sticky'] = array(
        'description' => __('Limit result set based on sticky status.'),
        'type'        => 'string',
    );
    
    return $params;
});

// Filter the REST API query (for editor preview)
add_filter('rest_allset_testimonial_query', function($args, $request) {
    $sticky = $request->get_param('sticky');
    
    // The editor sends 'true' as a string
    if ($sticky === 'true' || $sticky === true) {
        $all_sticky_posts = get_option('sticky_posts', array());
        
        if (!empty($all_sticky_posts)) {
            $sticky_testimonials = get_posts(array(
                'post_type' => 'allset_testimonial',
                'post__in' => $all_sticky_posts,
                'posts_per_page' => -1,
                'fields' => 'ids',
            ));
            
            $args['post__in'] = !empty($sticky_testimonials) ? $sticky_testimonials : array(0);
        } else {
            $args['post__in'] = array(0);
        }
    }
    
    return $args;
}, 10, 2);

// Filter query loop (for front-end rendering)
add_filter('query_loop_block_query_vars', function($query, $block, $page) {
    if (isset($block->context['query']['postType']) 
        && $block->context['query']['postType'] === 'allset_testimonial'
        && isset($block->context['query']['sticky'])
        && $block->context['query']['sticky'] === 'only') {
        
        $all_sticky_posts = get_option('sticky_posts', array());
        
        if (!empty($all_sticky_posts)) {
            $sticky_testimonials = get_posts(array(
                'post_type' => 'allset_testimonial',
                'post__in' => $all_sticky_posts,
                'posts_per_page' => -1,
                'fields' => 'ids',
            ));
            
            $query['post__in'] = !empty($sticky_testimonials) ? $sticky_testimonials : array(0);
        } else {
            $query['post__in'] = array(0);
        }
    }
    
    return $query;
}, 10, 3);
