<?php
/**
 * Block style customizations
 */


// Register custom block styles
function bloktastik_block_styles() {
	// Register custom separator style variation
	register_block_style( 'core/separator', array(
        'name'  => 'shorty',
        'label' => 'Shorty'
    ) );
	// Register custom button styles
	// Register a "default" style for buttons
    register_block_style( 'core/button', array(
        'name'  => 'default',
        'label' => 'Default',
        'is_default' => true
    ) );
	
}
add_action('init', 'bloktastik_block_styles');

