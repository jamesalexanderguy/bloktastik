<?php
/**
 * Theme setup and configuration.
 *
 * @package Bloktastik
 */

/**
 * Add theme support for post formats.
 */
if ( ! function_exists( 'bloktastik_post_format_setup' ) ) :
	function bloktastik_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'bloktastik_post_format_setup' );

/**
 * Register pattern categories.
 * Keep the namespace bloktastik — update the label to the client site name per project.
 */
if ( ! function_exists( 'bloktastik_pattern_categories' ) ) :
	function bloktastik_pattern_categories() {
		register_block_pattern_category(
			'bloktastik',
			array(
				'label'       => __( 'Bloktastik', 'bloktastik' ),
				'description' => __( 'Theme patterns.', 'bloktastik' ),
			)
		);
	}
endif;
add_action( 'init', 'bloktastik_pattern_categories' );

/**
 * Register the post format block binding source.
 */
if ( ! function_exists( 'bloktastik_register_block_bindings' ) ) :
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

/**
 * Callback for the post format name block binding source.
 */
if ( ! function_exists( 'bloktastik_format_binding' ) ) :
	function bloktastik_format_binding() {
		$post_format_slug = get_post_format();
		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

/**
 * Register custom blocks from build/blocks/ directory.
 */
if ( ! function_exists( 'bloktastik_register_blocks' ) ) :
	function bloktastik_register_blocks() {
		$blocks_dir = get_template_directory() . '/build/blocks';

		if ( ! is_dir( $blocks_dir ) ) {
			return;
		}

		foreach ( glob( $blocks_dir . '/*', GLOB_ONLYDIR ) as $block_folder ) {
			if ( file_exists( $block_folder . '/block.json' ) ) {
				register_block_type( $block_folder );
			}
		}
	}
endif;
add_action( 'init', 'bloktastik_register_blocks' );

/**
 * Apply the staff-member pattern as the default template for Staff posts.
 */
function bloktastik_staff_post_template() {
	$post_type_object = get_post_type_object( 'staff' );

	if ( ! $post_type_object ) {
		return;
	}

	$post_type_object->template = array(
		array( 'core/pattern', array(
			'slug' => 'bloktastik/staff-member',
		) ),
	);
}
add_action( 'init', 'bloktastik_staff_post_template', 20 );

/**
 * Add square image size.
 */
add_action( 'after_setup_theme', function() {
	add_image_size( 'square_image', 500, 500, true );
} );

add_filter( 'image_size_names_choose', function( $sizes ) {
	return array_merge( $sizes, array(
		'square_image' => __( 'Square Image' ),
	) );
} );

/**
 * Add body class when a singular post/page has a featured image.
 */
add_filter( 'body_class', function( $classes ) {
	if ( is_singular() && has_post_thumbnail() ) {
		$classes[] = 'has-featured-image';
	}
	return $classes;
} );

/**
 * Disable remote patterns from WordPress.org.
 */
add_filter( 'should_load_remote_block_patterns', '__return_false' );

/**
 * Remove all core block patterns.
 */
add_action( 'init', function() {
	remove_theme_support( 'core-block-patterns' );
}, 10 );

/**
 * Inject site logo inside the navigation modal overlay.
 */
add_filter( 'render_block', function( $block_content, $block ) {
	if ( $block['blockName'] !== 'core/navigation' ) {
		return $block_content;
	}

	$logo = render_block( array(
		'blockName' => 'core/site-logo',
		'attrs'     => array(
			'width'     => 210,
			'className' => 'menu-modal-logo',
		),
	) );

	$block_content = preg_replace(
		'/(<div[^>]*wp-block-navigation__responsive-container-content[^>]*>)/',
		'$1' . $logo,
		$block_content
	);

	return $block_content;
}, 10, 2 );

// page color meta field for editor and frontend
add_action( 'init', function() {
    foreach ( array( 'page', 'project' ) as $post_type ) {
        register_post_meta( $post_type, '_page_color', [
            'show_in_rest'  => true,
            'single'        => true,
            'type'          => 'string',
            'default'       => '#ffffff',
            'auth_callback' => function() {
                return current_user_can( 'edit_posts' );
            },
        ] );
        add_post_type_support( $post_type, 'custom-fields' );
    }
}, 20 );

add_action( 'wp_head', function() {
    if ( ! is_singular( array( 'page', 'project' ) ) ) return;
    $color = get_post_meta( get_the_ID(), '_page_color', true ) ?: '#ffffff';
    printf( '<style>body{--page-color:%s}</style>', esc_attr( $color ) );
} );
