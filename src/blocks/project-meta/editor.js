( function () {
    const { registerBlockType } = wp.blocks;
    const el = wp.element.createElement;

    registerBlockType( 'theme/project-meta', {
        apiVersion: 3,
        title:    'Project Meta',
        icon:     'tag',
        category: 'theme',
        attributes: {},
        edit: function () {
            return el( 'div', { className: 'project-block-placeholder' },
                el( 'p', null, 'Project Meta' ),
                el( 'p', { className: 'project-block-placeholder__meta' }, 'Scope categories + project tags — renders on the front end' )
            );
        },
        save: () => null,
    });
} )();
