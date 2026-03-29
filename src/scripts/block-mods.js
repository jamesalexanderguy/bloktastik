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

// =========================================================
// Page background colour panel
// =========================================================

const { registerPlugin } = wp.plugins;
const { PluginDocumentSettingPanel } = wp.editor;
const { PanelColorSettings } = wp.blockEditor;
const { useSelect, useDispatch } = wp.data;
const { useEffect } = wp.element;

const PageColorPanel = () => {
    const { postType, pageColor } = useSelect( select => ( {
        postType: select( 'core/editor' ).getCurrentPostType(),
        pageColor: select( 'core/editor' ).getEditedPostAttribute( 'meta' )?._page_color,
    } ) );

    const { editPost } = useDispatch( 'core/editor' );

    useEffect( () => {
        document.documentElement.style.setProperty(
            '--page-color', pageColor || '#ffffff'
        );
    }, [ pageColor ] );

	if ( postType !== 'page' && postType !== 'project' ) return null;

    return wp.element.createElement(
        PluginDocumentSettingPanel,
        { name: 'page-color', title: 'Page colour' },
        wp.element.createElement( PanelColorSettings, {
            title: 'Page colour',
            colorSettings: [ {
                label: 'Background',
                value: pageColor,
                onChange: val => editPost( { meta: { _page_color: val } } ),
            } ],
        } )
    );
};

registerPlugin( 'page-color', { render: PageColorPanel } );