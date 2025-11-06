<?php
/**
 * Block style customizations
 */


// Register custom block styles
function bloktastik_block_styles() {
	// Register custom button styles
	register_block_style(
		'core/button',
		array(
			'name'  => 'blue-border',
			'label' => __('Blue Border', 'bloktastik'),
		)
	);
	
	register_block_style(
		'core/button',
		array(
			'name'  => 'green-red',
			'label' => __('Green to Red', 'bloktastik'),
		)
	);
	
	// Register custom list style
	register_block_style(
		'core/list',
		array(
			'name'         => 'checkmark-list',
			'label'        => __('Checkmark', 'bloktastik'),
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
add_action('init', 'bloktastik_block_styles');

// add pulse styles to default button
function add_pulse_classes_to_default_button($block_content, $block) {
    if ($block['blockName'] === 'core/button' && !strpos($block_content, 'is-style-')) {
        // Add the Tailwind classes
        $block_content = str_replace(
            'wp-block-button__link', 
            'wp-block-button__link relative flex h-9 w-full items-center justify-center px-4 before:absolute before:inset-0 before:rounded-md before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max', 
            $block_content
        );
        
        // Wrap the button text in a span
        $block_content = preg_replace(
            '/(<a [^>]*class="[^"]*wp-block-button__link[^"]*"[^>]*>)(.*?)(<\/a>)/',
            '$1<span class="relative">$2</span>$3',
            $block_content
        );
    }
    return $block_content;
}
add_filter('render_block', 'add_pulse_classes_to_default_button', 10, 2);
