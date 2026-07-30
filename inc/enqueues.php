<?php 

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
			//'build/style-blocks.css'             // Block-specific styles
		) );
	}
endif;
add_action( 'after_setup_theme', 'bloktastik_editor_style' );

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
			wp_get_theme()->get( 'Version')
		);
		
		// Block styles (auto-compiled from each block's style.scss)
		// wp_enqueue_style(
		// 	'bloktastik-blocks',
		// 	get_template_directory_uri() . '/build/style-blocks.css',
		// 	array(),
		// 	wp_get_theme()->get( 'Version' )
		// );
		
		// Main JavaScript
		wp_enqueue_script(
			'bloktastik-scripts',
			get_template_directory_uri() . '/build/scripts/main.js',
			array('wc-blocks-checkout'),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'bloktastik_frontend_assets' );

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

/**
 * Block editor modifications
 */
if ( ! function_exists( 'bloktastik_block_mods' ) ) :
	/**
	 * Enqueues scripts to modify variations and editor panels.
	 *
	 * @since Bloktastik 1.0
	 *
	 * @return void
	 */
	function bloktastik_block_mods() {
		wp_enqueue_script(
			'bloktastik-block-mods',
			get_template_directory_uri() . '/build/scripts/block-mods.js',
			array(
				'wp-edit-post',
				'wp-plugins',
				'wp-components',
				'wp-data',
				'wp-element',
				'wp-blocks',
				'wp-dom-ready',
				'wp-block-editor',  // Add this dependency
				'wp-compose'         // Add this dependency
			),
			wp_get_theme()->get('Version'),
			true
		);
		
		// Pass taxonomy terms to JavaScript
		$faq_types = get_terms(array(
			'taxonomy' => 'faq_type',
			'hide_empty' => false,
		));
		
		$terms_data = array();
		if (!is_wp_error($faq_types)) {
			foreach ($faq_types as $term) {
				$terms_data[] = array(
					'id' => $term->term_id,
					'name' => $term->name,
				);
			}
		}
		
		wp_localize_script('bloktastik-block-mods', 'faqTaxonomyData', array(
			'terms' => $terms_data,
		));
	}
endif;
add_action( 'enqueue_block_editor_assets', 'bloktastik_block_mods' );
