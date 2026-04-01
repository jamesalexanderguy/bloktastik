/**
 * Project Grid filter — assets/js/projects.js
 * Handles category button clicks → AJAX → replaces grid HTML
 */

document.addEventListener( 'DOMContentLoaded', () => {

    const grid    = document.querySelector( '.project-grid' );
    const buttons = document.querySelectorAll( '.project-filter-btn' );

    if ( ! grid || ! buttons.length ) return;

    const maxPosts = grid.dataset.max || -1;

    async function fetchCategory( slug ) {

        const nav       = document.querySelector( '.project-filter' );
        const navBottom = nav.getBoundingClientRect().bottom;
        const gridTop   = grid.getBoundingClientRect().top;
        const target    = window.scrollY + gridTop - navBottom - 19;

        grid.classList.add( 'is-loading' );

        const body = new FormData();
        body.append( 'action',   'project_filter' );
        body.append( 'nonce',    projectData.nonce );
        body.append( 'category', slug );
        body.append( 'maxPosts', maxPosts );

        try {
            const res  = await fetch( projectData.ajaxUrl, { method: 'POST', body } );
            const data = await res.json();
            if ( data.success ) {
                grid.innerHTML = data.data.html;

                if ( gridTop < navBottom + 19 ) {
                    window.removeEventListener( 'scroll', window._dockingUpdate );
                    window.scrollTo({ top: target, behavior: 'instant' });
                    requestAnimationFrame( () => {
                        window.addEventListener( 'scroll', window._dockingUpdate, { passive: true } );
                    });
                }
            }
        } catch ( err ) {
            console.error( 'Project filter error:', err );
        } finally {
            grid.classList.remove( 'is-loading' );
        }
    }

    buttons.forEach( btn => {
        btn.addEventListener( 'click', () => {
            buttons.forEach( b => b.classList.remove( 'is-active' ) );
            btn.classList.add( 'is-active' );
            fetchCategory( btn.dataset.category );
        } );
    } );

} );
