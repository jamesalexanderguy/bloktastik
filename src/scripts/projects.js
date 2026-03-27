/**
 * Project Grid filter — assets/js/projects.js
 * Handles category button clicks → AJAX → replaces grid HTML
 */

document.addEventListener( 'DOMContentLoaded', () => {

    const grid    = document.querySelector( '.project-grid' );
    const buttons = document.querySelectorAll( '.project-filter-btn' );

    if ( ! grid || ! buttons.length ) return;

    // maxPosts is stored as a data attribute on the grid by the PHP render callback
    const maxPosts = grid.dataset.max || -1;

    async function fetchCategory( slug ) {

        grid.classList.add( 'is-loading' );

        const body = new FormData();
        body.append( 'action',   'project_filter' );
        body.append( 'nonce',    projectData.nonce );
        body.append( 'category', slug );
        body.append( 'maxPosts', maxPosts );

        try {
            const res  = await fetch( projectData.ajaxUrl, { method: 'POST', body } );
            const data = await res.json();
            if ( data.success ) grid.innerHTML = data.data.html;
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
