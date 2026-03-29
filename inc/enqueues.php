<?php
/**
 * Enqueues
 *
 * @package Bloktastik
 */

/**
 * Enqueue editor styles.
 */
if ( ! function_exists( 'bloktastik_editor_style' ) ) :
	function bloktastik_editor_style() {
		add_editor_style( array(
			'build/styles/editor.css',
		) );
	}
endif;
add_action( 'after_setup_theme', 'bloktastik_editor_style' );

/**
 * Enqueue frontend assets.
 */
if ( ! function_exists( 'bloktastik_frontend_assets' ) ) :
	function bloktastik_frontend_assets() {

		$theme_version = wp_get_theme()->get( 'Version' );

		$css_version = defined( 'WP_DEBUG' ) && WP_DEBUG
			? filemtime( get_template_directory() . '/build/styles/main.css' )
			: $theme_version;

		$js_version = defined( 'WP_DEBUG' ) && WP_DEBUG
			? filemtime( get_template_directory() . '/build/scripts/main.js' )
			: $theme_version;

		// Frontend styles
		wp_enqueue_style(
			'bloktastik-styles',
			get_template_directory_uri() . '/build/styles/main.css',
			array(),
			$css_version
		);

		// Main JavaScript
		wp_enqueue_script(
			'bloktastik-scripts',
			get_template_directory_uri() . '/build/scripts/main.js',
			array(),
			$js_version,
			true
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'bloktastik_frontend_assets' );

/**
 * Enqueue the compiled blocks bundle for the editor.
 */
if ( ! function_exists( 'bloktastik_enqueue_blocks_bundle' ) ) :
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
 * Enqueue block editor modification scripts.
 */
if ( ! function_exists( 'bloktastik_block_mods' ) ) :
	function bloktastik_block_mods() {

		$version = defined( 'WP_DEBUG' ) && WP_DEBUG
			? filemtime( get_template_directory() . '/build/scripts/block-mods.js' )
			: wp_get_theme()->get( 'Version' );

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
				'wp-block-editor',
				'wp-compose',
				'wp-core-data',
			),
			$version,
			true
		);
	}
endif;
add_action( 'enqueue_block_editor_assets', 'bloktastik_block_mods' );
