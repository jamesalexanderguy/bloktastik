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

    // Add sticky toggle for testimonials

    const { registerPlugin } = wp.plugins;
    const { PluginDocumentSettingPanel } = wp.editPost;
    const { ToggleControl } = wp.components;
    const { useSelect, useDispatch } = wp.data;
    const { createElement: el } = wp.element;

    const TestimonialStickyToggle = () => {
        const postType = useSelect((select) => 
            select('core/editor').getCurrentPostType()
        );
        
        const sticky = useSelect((select) => 
            select('core/editor').getEditedPostAttribute('sticky')
        );
        
        const { editPost } = useDispatch('core/editor');
        
        if (postType !== 'allset_testimonial') {
            return null;
        }
        
        return el(PluginDocumentSettingPanel, {
            name: 'testimonial-sticky',
            title: 'Feature',
            className: 'testimonial-sticky-panel'
        },
            el(ToggleControl, {
                label: 'Feature in the default slider',
                checked: !!sticky,
                onChange: (value) => {
                    editPost({ sticky: value });
                }
            })
        );
    };

    registerPlugin('testimonial-sticky-toggle', {
        render: TestimonialStickyToggle,
        icon: null
    });
});

