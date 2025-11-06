wp.domReady(() => {
    // Remove specific button styles
    wp.blocks.unregisterBlockStyle('core/button', 'fill');
    wp.blocks.unregisterBlockStyle('core/button', 'outline');
    
    // Or remove all default styles
    // wp.blocks.unregisterBlockStyle('core/button', '*');
});


