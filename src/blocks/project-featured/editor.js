/**
 * Project Featured block — editor UI
 * blocks/project-featured/editor.js
 *
 * No build step required — uses global wp.* objects
 */

( function () {

    const { registerBlockType } = wp.blocks;
    const { InspectorControls }  = wp.blockEditor;
    const { PanelBody, SelectControl, RangeControl } = wp.components;
    const { useSelect } = wp.data;
    const el = wp.element.createElement;

    registerBlockType( 'theme/project-featured', {

        title:    'Project Featured',
        icon:     'star-filled',
        category: 'theme',

        attributes: {
            category: { type: 'string', default: ''  },
            maxPosts:  { type: 'number', default: 4   },
        },

        edit: function ( { attributes, setAttributes } ) {

            const { category, maxPosts } = attributes;

            // Fetch project_category terms via the WP data store
            const categories = useSelect( function ( select ) {
                return select( 'core' ).getEntityRecords(
                    'taxonomy',
                    'project_category',
                    { per_page: -1, orderby: 'name', order: 'asc' }
                );
            });

            const catOptions = categories
                ? [
                    { label: '— Select a category —', value: '' },
                    ...categories.map( c => ({ label: c.name, value: c.slug }) )
                  ]
                : [ { label: 'Loading categories…', value: '' } ];

            const selectedLabel = categories && category
                ? ( categories.find( c => c.slug === category )?.name || category )
                : null;

            return [

                el( InspectorControls, { key: 'controls' },
                    el( PanelBody, { title: 'Settings', initialOpen: true },

                        el( SelectControl, {
                            label:    'Category',
                            value:    category,
                            options:  catOptions,
                            onChange: ( val ) => setAttributes({ category: val }),
                        }),

                        el( RangeControl, {
                            label:    'Number of posts',
                            value:    maxPosts,
                            min:      1,
                            max:      20,
                            onChange: ( val ) => setAttributes({ maxPosts: val }),
                        })

                    )
                ),

                el( 'div', { key: 'preview', className: 'project-block-placeholder' },
                    el( 'span', { className: 'project-block-placeholder__icon' }, '★' ),
                    el( 'p', null, 'Project Featured' ),
                    el( 'p', { className: 'project-block-placeholder__meta' },
                        selectedLabel
                            ? 'Showing ' + maxPosts + ' from: ' + selectedLabel
                            : 'No category selected — open block settings'
                    )
                )

            ];
        },

        save: () => null, // server-side rendered

    });

} )();