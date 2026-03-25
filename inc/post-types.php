<?php
/**
 * Custom Post Types
 *
 * @package Bloktastik
 */

/**
 * Staff CPT
 * Rename/duplicate this block for each additional post type per project.
 */
function bloktastik_register_staff_cpt() {
	register_post_type( 'staff', array(
		'labels' => array(
			'name'               => __( 'Staff', 'bloktastik' ),
			'singular_name'      => __( 'Staff Member', 'bloktastik' ),
			'add_new'            => __( 'Add New', 'bloktastik' ),
			'add_new_item'       => __( 'Add New Staff Member', 'bloktastik' ),
			'edit_item'          => __( 'Edit Staff Member', 'bloktastik' ),
			'new_item'           => __( 'New Staff Member', 'bloktastik' ),
			'view_item'          => __( 'View Staff Member', 'bloktastik' ),
			'search_items'       => __( 'Search Staff', 'bloktastik' ),
			'not_found'          => __( 'No staff found', 'bloktastik' ),
			'not_found_in_trash' => __( 'No staff found in Trash', 'bloktastik' ),
			'menu_name'          => __( 'Staff', 'bloktastik' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-groups',
		'rewrite'      => array( 'slug' => 'staff' ),
	) );
}
add_action( 'init', 'bloktastik_register_staff_cpt' );
