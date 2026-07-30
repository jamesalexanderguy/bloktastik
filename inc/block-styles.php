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

// replace the current nav item with a "current" class for styling
add_action('wp_footer', function() {
    if (!is_page()) return;
    $slug = get_post_field('post_name', get_queried_object_id());
    ?>
    <script>
    (function() {
        var slug = '<?php echo esc_js($slug); ?>';
        var map = {
            'documentation': 'nav-getting-started',
            'installation-and-setup': 'nav-installation',
            'laikachat-settings': 'nav-settings',
            'your-support-team': 'nav-support-team',
            'agent-prompts': 'nav-agent-prompts',
            'leads-and-conversations': 'nav-leads',
            'providers-and-billing': 'nav-providers',
            'security': 'nav-security',
            'faq-and-troubleshooting': 'nav-faq'
        };
        var id = map[slug];
        if (id) {
            var el = document.getElementById(id);
            if (el) el.classList.add('current');
        }
    })();
    </script>
    <?php
});

