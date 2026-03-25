wp.domReady(() => {

	// =========================================================
	// Unregister default block styles
	// =========================================================

	wp.blocks.unregisterBlockStyle('core/button', 'fill');
	wp.blocks.unregisterBlockStyle('core/button', 'outline');

	// =========================================================
	// Block modifications
	// Add per-project block editor customisations below
	// =========================================================

});
