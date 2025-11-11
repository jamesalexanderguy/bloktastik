<?php
/**
 * Theme Functions
 * 
 */

// Enqueue scripts and styles
require_once get_template_directory() . '/inc/enqueues.php';

// Block customizations (variations, removals)
require_once get_template_directory() . '/inc/block-styles.php';

// Formats, block binding etc
require_once get_template_directory() . '/inc/setup.php';

// Custom post types
require get_template_directory() . '/inc/post-types.php';
