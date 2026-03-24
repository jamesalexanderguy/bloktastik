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
		// Frontend styles
		wp_enqueue_style(
			'bloktastik-styles',
			get_template_directory_uri() . '/build/styles/main.css',
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
			),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
endif;
add_action( 'enqueue_block_editor_assets', 'bloktastik_block_mods' );
