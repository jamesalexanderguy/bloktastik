wp.domReady(() => {
    // Remove specific button styles
    wp.blocks.unregisterBlockStyle('core/button', 'fill');
    wp.blocks.unregisterBlockStyle('core/button', 'outline');

    // change details placeholder text

    const { select, dispatch } = wp.data;
    wp.data.subscribe(() => {
        const blocks = select('core/block-editor').getBlocks();
        blocks.forEach(block => {
        if (block.name === 'core/details' && !block.innerBlocks.length) {
            const summaryBlock = {
            name: 'core/paragraph',
            attributes: { content: 'Click to expand' },
            };
            dispatch('core/block-editor').replaceInnerBlocks(block.clientId, [summaryBlock]);
        }
        });
    });
      
    
    // Or remove all default styles
    // wp.blocks.unregisterBlockStyle('core/button', '*');
});

wp.domReady(() => {
    
  });
  
