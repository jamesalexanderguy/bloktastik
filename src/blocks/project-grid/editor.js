/**
 * Project Grid block — editor UI
 * blocks/project-grid/editor.js
 *
 * No build step required — uses global wp.* objects
 */

( function () {

    const { registerBlockType } = wp.blocks;
    const { InspectorControls }  = wp.blockEditor;
    const { PanelBody, RangeControl, ToggleControl } = wp.components;
    const el = wp.element.createElement;

    registerBlockType( 'theme/project-grid', {
        apiVersion: 3,

        title:    'Project Grid',
        icon:     'grid-view',
        category: 'theme',

        attributes: {
            maxPosts: { type: 'number', default: -1 },
        },

        edit: function ( { attributes, setAttributes } ) {

            const { maxPosts } = attributes;
            const limited = maxPosts > 0;

            return [

                el( InspectorControls, { key: 'controls' },
                    el( PanelBody, { title: 'Settings', initialOpen: true },

                        el( ToggleControl, {
                            label:    'Limit number of posts',
                            checked:  limited,
                            onChange: ( val ) => setAttributes({ maxPosts: val ? 6 : -1 }),
                        }),

                        limited && el( RangeControl, {
                            label:    'Max posts',
                            value:    maxPosts,
                            min:      1,
                            max:      50,
                            onChange: ( val ) => setAttributes({ maxPosts: val }),
                        })

                    )
                ),

                el( 'div', { key: 'preview', className: 'project-block-placeholder' },
                    el( 'span', { className: 'project-block-placeholder__icon' }, '▦' ),
                    el( 'p', null, 'Project Grid' ),
                    el( 'p', { className: 'project-block-placeholder__meta' },
                        limited ? 'Showing up to ' + maxPosts + ' projects' : 'Showing all projects'
                    )
                )

            ];
        },

        save: () => null, // server-side rendered

    });

} )();