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
const { useSelect, useDispatch, subscribe } = wp.data;
const { useEffect, useRef } = wp.element;

const PageColorPanel = () => {
    const { postType, pageColor } = useSelect( select => ( {
        postType: select( 'core/editor' ).getCurrentPostType(),
        pageColor: select( 'core/editor' ).getEditedPostAttribute( 'meta' )?._page_color,
    } ) );

    const { editPost } = useDispatch( 'core/editor' );

    const isFirstRender = useRef( true );

    useEffect( () => {
        const color = pageColor || '#ffffff';
        document.documentElement.style.setProperty( '--page-color', color );
        isFirstRender.current = false;
    }, [ pageColor ] );

    if ( ! [ 'page', 'project' ].includes( postType ) ) return null;

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

// =========================================================
// Reload editor after save to reflect new page colour
// =========================================================

let wasSaving = false;
let savedColor;
let initialized = false;

subscribe( () => {
    const state = wp.data.select( 'core/editor' );
    const currentColor = state.getEditedPostAttribute( 'meta' )?._page_color;

    if ( ! initialized && currentColor !== undefined ) {
        savedColor = currentColor;
        initialized = true;
        return;
    }

    const isSaving = state.isSavingPost();
    const isDirty = state.isEditedPostDirty();

    if ( wasSaving && ! isSaving && ! isDirty ) {
        if ( currentColor !== savedColor ) {
            savedColor = currentColor;
            window.location.reload();
        }
    }

    wasSaving = isSaving;
} );
