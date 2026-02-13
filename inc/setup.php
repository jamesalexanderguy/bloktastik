<?php
/**
 * Bloktastik functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'bloktastik_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function bloktastik_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'bloktastik_post_format_setup' );

// Registers pattern categories.
if ( ! function_exists( 'bloktastik_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function bloktastik_pattern_categories() {

		register_block_pattern_category(
			'bloktastik_page',
			array(
				'label'       => __( 'Pages', 'bloktastik' ),
				'description' => __( 'A collection of full page layouts.', 'bloktastik' ),
			)
		);

		register_block_pattern_category(
			'bloktastik_post-format',
			array(
				'label'       => __( 'Post formats', 'bloktastik' ),
				'description' => __( 'A collection of post format patterns.', 'bloktastik' ),
			)
		);
	}
endif;
add_action( 'init', 'bloktastik_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'bloktastik_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function bloktastik_register_block_bindings() {
		register_block_bindings_source(
			'bloktastik/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'bloktastik' ),
				'get_value_callback' => 'bloktastik_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'bloktastik_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'bloktastik_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function bloktastik_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

/**
 * Register custom blocks dynamically
 */
if ( ! function_exists( 'bloktastik_register_blocks' ) ) :
	/**
	 * Automatically registers all blocks in build/blocks/ folder.
	 *
	 * @since Bloktastik 1.0
	 *
	 * @return void
	 */
	function bloktastik_register_blocks() {
		$blocks_dir = __DIR__ . '/build/blocks';
		
		// Check if blocks directory exists
		if ( ! is_dir( $blocks_dir ) ) {
			return;
		}
		
		// Loop through each block folder and register it
		$block_folders = glob( $blocks_dir . '/*', GLOB_ONLYDIR );
		foreach ( $block_folders as $block_folder ) {
			$block_json = $block_folder . '/block.json';
			if ( file_exists( $block_json ) ) {
				register_block_type( $block_folder );
			}
		}
	}
endif;
add_action( 'init', 'bloktastik_register_blocks' );

// Register custom block category for Lower Columbia blocks
add_filter('block_categories_all', function($categories, $post) {
    $custom_category = [
        'slug'  => 'lowercolumbia',
        'title' => __('Lower Columbia Blocks', 'lowercolumbia'),
    ];

    foreach ($categories as $category) {
        if ($category['slug'] === $custom_category['slug']) {
            return $categories; // avoid duplicates
        }
    }

    return array_merge($categories, [$custom_category]);
}, 10, 2);


// Allow 'rand' and 'menu_order' in REST API for testimonials
add_filter('rest_allset_testimonial_collection_params', function($params) {
    if (isset($params['orderby']['enum'])) {
        $params['orderby']['enum'][] = 'rand';
    }
    return $params;
});

// add square image size
add_action('after_setup_theme', function() {
    add_image_size('square_image', 500, 500, true);
});

add_filter('image_size_names_choose', function($sizes) {
    return array_merge($sizes, [
        'square_image' => __('Square Image')
    ]);
});

// remove featured image block abover footer when no fi exists
add_filter( 'render_block', function( $block_content, $block ) {

    if (
        isset( $block['blockName'], $block['attrs']['useFeaturedImage'] )
        && $block['blockName'] === 'core/cover'
        && $block['attrs']['useFeaturedImage'] === true
        && isset( $block['attrs']['className'] )
        && strpos( $block['attrs']['className'], 'footer-cover' ) !== false
        && ! has_post_thumbnail()
    ) {
        return '';
    }

    return $block_content;
}, 10, 2 );

// register block pattern categories

add_action( 'init', function() {
    register_block_pattern_category(
        'lowercolumbia',
        array(
            'label' => __( 'Lower Columbia', 'bloktastik' ),
        )
    );
} );

add_filter( 'body_class', function( $classes ) {
    // Add class if current post/page has a featured image
    if ( is_singular() && has_post_thumbnail() ) {
        $classes[] = 'has-featured-image';
    }
    
    return $classes;
} );

/**
 * Add lightbox modal globally via wp_footer
 */
function bloktastik_render_lightbox_modal() {
    // Load the template part
    block_template_part( 'lightbox-modal' );
}
add_action( 'wp_footer', 'bloktastik_render_lightbox_modal' );

// Disable remote patterns from WordPress.org
add_filter('should_load_remote_block_patterns', '__return_false');

// Remove all core patterns
add_action('init', function() {
    remove_theme_support('core-block-patterns');
}, 10);

// fix changes to query in wp6.9 for FAQ taxonomy queries
// Filter query loop to support taxonomy queries for FAQs (front-end rendering)
add_filter('query_loop_block_query_vars', function($query, $block, $page) {
    // Check if this is an FAQ query with taxonomy parameters
    if (isset($block->context['query']['postType']) 
        && $block->context['query']['postType'] === 'faq'
        && isset($block->context['query']['taxQuery'])) {
        
        $tax_query = array();
        
        foreach ($block->context['query']['taxQuery'] as $taxonomy => $terms) {
            // Handle both old format (array of term IDs) and new format (object with terms)
            if (is_array($terms)) {
                $term_ids = isset($terms['terms']) ? $terms['terms'] : $terms;
                $operator = isset($terms['operator']) ? $terms['operator'] : 'IN';
            } else {
                $term_ids = array($terms);
                $operator = 'IN';
            }
            
            $tax_query[] = array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $term_ids,
                'operator' => $operator,
            );
        }
        
        if (!empty($tax_query)) {
            $query['tax_query'] = $tax_query;
        }
    }
    
    return $query;
}, 10, 3);

// Filter the REST API query (for editor preview)
add_filter('rest_faq_query', function($args, $request) {
    $tax_query = $request->get_param('taxQuery');
    
    if ($tax_query) {
        $args['tax_query'] = array();
        
        foreach ($tax_query as $taxonomy => $terms) {
            if (is_array($terms)) {
                $term_ids = isset($terms['terms']) ? $terms['terms'] : $terms;
                $operator = isset($terms['operator']) ? $terms['operator'] : 'IN';
            } else {
                $term_ids = array($terms);
                $operator = 'IN';
            }
            
            $args['tax_query'][] = array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $term_ids,
                'operator' => $operator,
            );
        }
    }
    
    return $args;
}, 10, 2);
