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


// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'bloktastik_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function bloktastik_editor_style() {
		// Add the compiled Tailwind editor styles to the editor canvas
		add_editor_style( array(
			'build/styles/editor.css',    // Tailwind + global editor styles
			'build/style-blocks.css'             // Block-specific styles
		) );
	}
endif;
add_action( 'after_setup_theme', 'bloktastik_editor_style' );

// Registers custom block styles.
if ( ! function_exists( 'bloktastik_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function bloktastik_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'bloktastik' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'bloktastik_block_styles' );

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
 * Enqueue frontend assets
 */
if ( ! function_exists( 'bloktastik_frontend_assets' ) ) :
	/**
	 * Enqueues frontend Tailwind styles and main JavaScript.
	 *
	 * @since Bloktastik 1.0
	 *
	 * @return void
	 */
	function bloktastik_frontend_assets() {
		// Frontend Tailwind styles
		wp_enqueue_style(
			'bloktastik-tailwind',
			get_template_directory_uri() . '/build/styles/tailwind.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);
		
		// Block styles (auto-compiled from each block's style.scss)
		wp_enqueue_style(
			'bloktastik-blocks',
			get_template_directory_uri() . '/build/style-blocks.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);
		
		// Main JavaScript
		wp_enqueue_script(
			'bloktastik-scripts',
			get_template_directory_uri() . '/build/scripts/main.js',
			array(),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'bloktastik_frontend_assets' );

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

/**
 * Enqueue the single blocks bundle
 */
if ( ! function_exists( 'bloktastik_enqueue_blocks_bundle' ) ) :
	/**
	 * Enqueues the compiled blocks bundle for the editor.
	 *
	 * @since Bloktastik 1.0
	 *
	 * @return void
	 */
	function bloktastik_enqueue_blocks_bundle() {
		$asset_file = include get_template_directory() . '/build/blocks.asset.php';
		
		wp_enqueue_script(
			'bloktastik-blocks',
			get_template_directory_uri() . '/build/blocks.js',
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);
	}
endif;
add_action( 'enqueue_block_editor_assets', 'bloktastik_enqueue_blocks_bundle' );
