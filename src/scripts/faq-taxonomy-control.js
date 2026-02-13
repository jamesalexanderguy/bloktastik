(function() {
    const { addFilter } = wp.hooks;
    const { createElement: el, Fragment } = wp.element;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, SelectControl } = wp.components;
    const { createHigherOrderComponent } = wp.compose;

    // Add FAQ Type control to Query block
    const withFAQTaxonomyControl = createHigherOrderComponent((BlockEdit) => {
        return (props) => {
            if (props.name !== 'core/query') {
                return el(BlockEdit, props);
            }

            const { attributes, setAttributes } = props;
            const { query } = attributes;

            // Only show for FAQ post type
            if (query?.postType !== 'faq') {
                return el(BlockEdit, props);
            }

            const currentTaxQuery = query?.taxQuery || {};
            const currentTermId = currentTaxQuery?.faq_type?.[0] || '';

            const onTermChange = (termId) => {
                const newTaxQuery = termId ? { faq_type: [parseInt(termId)] } : {};
                
                setAttributes({
                    query: {
                        ...query,
                        taxQuery: newTaxQuery,
                    },
                });
            };

            return el(
                Fragment,
                {},
                el(BlockEdit, props),
                el(
                    InspectorControls,
                    {},
                    el(
                        PanelBody,
                        { title: 'FAQ Type Filter', initialOpen: true },
                        el(SelectControl, {
                            label: 'Filter by Type',
                            value: currentTermId,
                            options: [
                                { label: 'All Types', value: '' },
                                ...faqTaxonomyData.terms.map(term => ({
                                    label: term.name,
                                    value: term.id.toString(),
                                })),
                            ],
                            onChange: onTermChange,
                        })
                    )
                )
            );
        };
    }, 'withFAQTaxonomyControl');

    addFilter(
        'editor.BlockEdit',
        'my-theme/faq-taxonomy-control',
        withFAQTaxonomyControl
    );
})();
