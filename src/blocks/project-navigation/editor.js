/**
 * Project Navigation block — editor UI
 * blocks/project-navigation/editor.js
 */

( function () {

    const { registerBlockType } = wp.blocks;
    const el = wp.element.createElement;

    registerBlockType( 'theme/project-navigation', {
        apiVersion: 3,

        title:    'Project Navigation',
        icon:     'arrow-left-alt2',
        category: 'theme',

        attributes: {},

        edit: function () {
            return el( 'div', { className: 'project-block-placeholder' },
                el( 'span', { className: 'project-block-placeholder__icon' }, '← →' ),
                el( 'p', null, 'Project Navigation' ),
                el( 'p', { className: 'project-block-placeholder__meta' }, 'Previous / next project cards — renders on the front end' )
            );
        },

        save: () => null,

    });

} )();
