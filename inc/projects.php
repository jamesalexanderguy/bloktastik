<?php
/**
 * Projects — CPT, Taxonomy, Blocks, Query, AJAX
 * require_once get_template_directory() . '/inc/projects.php';
 */


// ─────────────────────────────────────────────
// 1. REGISTER CPT: project
// ─────────────────────────────────────────────

add_action( 'init', function () {

    register_post_type( 'project', [
        'labels' => [
            'name'          => 'Projects',
            'singular_name' => 'Project',
            'add_new_item'  => 'Add New Project',
            'edit_item'     => 'Edit Project',
            'view_item'     => 'View Project',
            'search_items'  => 'Search Projects',
            'not_found'     => 'No projects found.',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'menu_icon'    => 'dashicons-portfolio',
        'rewrite'      => [ 'slug' => 'project' ],
    ]);

});


// ─────────────────────────────────────────────
// 2. REGISTER TAXONOMY: project_category
// ─────────────────────────────────────────────

add_action( 'init', function () {

    register_taxonomy( 'project_category', 'project', [
        'labels' => [
            'name'          => 'Project Categories',
            'singular_name' => 'Project Category',
            'add_new_item'  => 'Add New Category',
            'edit_item'     => 'Edit Category',
            'search_items'  => 'Search Categories',
            'not_found'     => 'No categories found.',
            'menu_name'     => 'Categories',
        ],
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => [ 'slug' => 'project-category' ],
    ]);

});


// ─────────────────────────────────────────────
// 3. REGISTER BLOCKS
// ─────────────────────────────────────────────

add_action( 'init', function () {

    // — project-grid: filterable grid with category menu —
    register_block_type( 'theme/project-grid', [
        'render_callback' => 'project_grid_render',
        'attributes'      => [
            'maxPosts' => [ 'type' => 'number', 'default' => -1 ],
        ],
    ]);

    // — project-featured: static single-category grid, no menu —
    register_block_type( 'theme/project-featured', [
        'render_callback' => 'project_featured_render',
        'attributes'      => [
            'category' => [ 'type' => 'string', 'default' => ''  ],
            'maxPosts'  => [ 'type' => 'number', 'default' => 4   ],
        ],
    ]);

    // — project-navigation: previous/next project cards —
    register_block_type( 'theme/project-navigation', [
        'render_callback' => 'project_navigation_render',
    ]);

});


// ─────────────────────────────────────────────
// 4. FRONT-END SCRIPT + LOCALIZATION
//    Registered here, enqueued only when project-grid block is on the page
// ─────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', function () {

    $js_version = defined( 'WP_DEBUG' ) && WP_DEBUG
        ? filemtime( get_template_directory() . '/build/scripts/projects.js' )
        : wp_get_theme()->get( 'Version' );

    wp_register_script(
        'projects',
        get_template_directory_uri() . '/build/scripts/projects.js',
        [],
        $js_version,
        true
    );

    wp_localize_script( 'projects', 'projectData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'project_nonce' ),
    ]);

});


// ─────────────────────────────────────────────
// 5. BLOCK RENDER CALLBACKS
// ─────────────────────────────────────────────

function project_grid_render( array $attributes ): string {

    $max        = (int) ( $attributes['maxPosts'] ?? -1 );
    $cat_slug   = 'all';
    $post_ids   = project_get_posts( $cat_slug, $max );
    $categories = get_terms([
        'taxonomy'   => 'project_category',
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
        'exclude' => [ 10 ],
    ]);

    // Enqueue front-end JS only on pages that contain this block
    wp_enqueue_script( 'projects' );

    ob_start();
    ?>

    <nav class="project-filter nav-secondary" aria-label="Filter projects">
        <span class="nav-secondary__label">Filter by:</span>
        <button class="project-filter-btn is-active" data-category="all">All</button>
        <?php foreach ( $categories as $cat ) : ?>
            <button class="project-filter-btn" data-category="<?= esc_attr( $cat->slug ) ?>">
                <?= esc_html( $cat->name ) ?>
            </button>
        <?php endforeach; ?>
    </nav>

    <div class="project-grid" data-max="<?= esc_attr( $max ) ?>">
        <?php project_render_grid( $post_ids, $cat_slug ); ?>
    </div>

    <?php
    return ob_get_clean();
}

function project_featured_render( array $attributes ): string {

    $cat_slug = sanitize_key( $attributes['category'] ?? '' );
    $max      = (int) ( $attributes['maxPosts'] ?? 4 );

    if ( ! $cat_slug ) {
        return '<p class="project-featured__empty">No category selected — edit this block to choose one.</p>';
    }

    $post_ids = project_get_posts( $cat_slug, $max );

    ob_start();
    echo '<div class="project-grid project-grid--featured">';
    project_render_grid( $post_ids, $cat_slug );
    echo '</div>';
    return ob_get_clean();
}

function project_navigation_render( array $attributes ): string {

    $prev = get_adjacent_post( false, '', true );
    $next = get_adjacent_post( false, '', false );

    if ( ! $prev && ! $next ) return '';

    ob_start();
    ?>
    <nav class="project-navigation" aria-label="Project navigation">
        <?php if ( $prev ) : ?>
            <?php project_navigation_card( $prev ); ?>
        <?php else : ?>
            <div class="project-navigation__spacer"></div>
        <?php endif; ?>
        <?php if ( $next ) : ?>
            <?php project_navigation_card( $next ); ?>
        <?php else : ?>
            <div class="project-navigation__spacer"></div>
        <?php endif; ?>
    </nav>
    <?php
    return ob_get_clean();
}

function project_navigation_card( WP_Post $post ): void {

    $url     = get_permalink( $post );
    $title   = get_the_title( $post );
    $img_id  = get_post_thumbnail_id( $post->ID );
    $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';

    ?>
    <article class="project-nav-card">
        <a class="project-nav-card__link" href="<?= esc_url( $url ) ?>">
            <?php if ( $img_url ) : ?>
                <div class="project-nav-card__image">
                    <img src="<?= esc_url( $img_url ) ?>" alt="<?= esc_attr( $title ) ?>" loading="lazy">
                </div>
            <?php endif; ?>
            <div class="project-nav-card__meta">
                <h3 class="project-nav-card__title"><?= esc_html( $title ) ?></h3>
                <div class="project-nav-card__sep" aria-hidden="true"></div>
            </div>
        </a>
    </article>
    <?php
}


// ─────────────────────────────────────────────
// 6. HELPER: position → size key
//    Cycle of 5: large, medium, large, medium, full
// ─────────────────────────────────────────────

function project_size_key( int $position ): string {
    return match ( $position % 5 ) {
        1       => 'large',
        2       => 'medium',
        3       => 'large',
        4       => 'medium',
        default => 'full',
    };
}


// ─────────────────────────────────────────────
// 7. HELPER: resolve correct image ID
//    Fallback: category+size → category default → size default → featured image
// ─────────────────────────────────────────────

function project_get_image( int $post_id, string $cat_slug, string $size_key ): int|false {

    $field         = 'image_' . $size_key;
    $cat_overrides = get_field( 'category_images', $post_id ) ?: [];
    $defaults      = get_field( 'default_images',  $post_id ) ?: [];

    // 1. Category + size
    foreach ( $cat_overrides as $row ) {
        if ( $row['category']->slug === $cat_slug && ! empty( $row[ $field ] ) ) {
            return (int) $row[ $field ];
        }
    }

    // 2. Category default — first non-empty image in that category's row
    foreach ( $cat_overrides as $row ) {
        if ( $row['category']->slug === $cat_slug ) {
            $img = $row['image_large'] ?? $row['image_medium'] ?? $row['image_full'] ?? null;
            if ( $img ) return (int) $img;
        }
    }

    // 3. Default images — requested size
    if ( ! empty( $defaults[ $field ] ) ) {
        return (int) $defaults[ $field ];
    }

    // 4. Featured image
    return get_post_thumbnail_id( $post_id ) ?: false;
}


// ─────────────────────────────────────────────
// 8. QUERY: fetch and sort post IDs for a category
// ─────────────────────────────────────────────

function project_get_posts( string $cat_slug, int $max = -1 ): array {

    $args = [
        'post_type'      => 'project',
        'posts_per_page' => -1, // fetch all, then sort, then slice
        'fields'         => 'ids',
    ];

    if ( $cat_slug !== 'all' ) {
        $args['tax_query'] = [[
            'taxonomy' => 'project_category',
            'field'    => 'slug',
            'terms'    => $cat_slug,
        ]];
    }

    $ids = get_posts( $args );

    usort( $ids, function ( $a, $b ) use ( $cat_slug ) {
        return project_get_order( $a, $cat_slug ) <=> project_get_order( $b, $cat_slug );
    });

    return $max > 0 ? array_slice( $ids, 0, $max ) : $ids;
}

function project_get_order( int $post_id, string $cat_slug ): int {
    $rows = get_field( 'category_order', $post_id ) ?: [];
    foreach ( $rows as $row ) {
        if ( $cat_slug === 'all' || $row['category']->slug === $cat_slug ) {
            return (int) $row['order'];
        }
    }
    return 9999;
}


// ─────────────────────────────────────────────
// 9. RENDER: grid and card HTML
// ─────────────────────────────────────────────

function project_render_grid( array $post_ids, string $cat_slug ): void {

    if ( empty( $post_ids ) ) {
        echo '<p class="project-grid__empty">No projects found.</p>';
        return;
    }

    $cards = [];
    foreach ( $post_ids as $i => $post_id ) {
        $position = $i + 1;
        $size_key = project_size_key( $position );
        $image_id = project_get_image( $post_id, $cat_slug, $size_key );
        $cards[]  = compact( 'post_id', 'position', 'size_key', 'image_id' );
    }

    $total = count( $cards );
    $i     = 0;

    while ( $i < $total ) {
        $mod = $i % 5;

        if ( $mod < 4 ) {
            $a = $cards[ $i ]     ?? null;
            $b = $cards[ $i + 1 ] ?? null;

            if ( $mod === 2 ) {
                if ( $a ) $a['size_key'] = 'medium';
                if ( $b ) $b['size_key'] = 'large';
                echo '<div class="project-row project-row--pair project-row--pair-reversed">';
                if ( $a ) project_render_card( $a );
                if ( $b ) project_render_card( $b );
            } else {
                echo '<div class="project-row project-row--pair">';
                if ( $a ) project_render_card( $a );
                if ( $b ) project_render_card( $b );
            }

            echo '</div>';
            $i += 2;
        } else {
            echo '<div class="project-row project-row--full">';
            project_render_card( $cards[ $i ] );
            echo '</div>';
            $i += 1;
        }
    }
}

function project_render_card( array $card ): void {

    $post    = get_post( $card['post_id'] );
    $url     = get_permalink( $post );
    $title   = get_the_title( $post );
    $img_url = $card['image_id']
        ? wp_get_attachment_image_url( $card['image_id'], 'large' )
        : '';

    // Get category names (not linked)
    $terms     = get_the_terms( $post->ID, 'project_category' );
    $cat_names = ( $terms && ! is_wp_error( $terms ) )
        ? implode( ' &bull; ', array_map( fn( $t ) => esc_html( $t->name ), array_filter( $terms, fn( $t ) => $t->slug !== 'featured' ) ) )
        : '';

    $image_html = $img_url ? sprintf(
        '<div class="project-card__image">
            <img src="%s" alt="%s" loading="lazy">
        </div>',
        esc_url( $img_url ),
        esc_attr( $title )
    ) : '';

    $meta_html = sprintf(
        '<div class="project-card__meta">
            <h3 class="project-card__title">%s</h3>
            <div class="project-card__sep" aria-hidden="true"></div>
            %s
        </div>',
        esc_html( $title ),
        $cat_names ? '<p class="project-card__cats">' . $cat_names . '</p>' : ''
    );

    printf(
        '<article class="project-card project-card--%s">
            <a class="project-card__link" href="%s">
                %s
                %s
            </a>
        </article>',
        esc_attr( $card['size_key'] ),
        esc_url( $url ),
        $image_html,
        $meta_html
    );
}


// ─────────────────────────────────────────────
// 10. AJAX HANDLER
// ─────────────────────────────────────────────

add_action( 'wp_ajax_project_filter',        'project_ajax_handler' );
add_action( 'wp_ajax_nopriv_project_filter', 'project_ajax_handler' );

function project_ajax_handler(): void {

    check_ajax_referer( 'project_nonce', 'nonce' );

    $cat_slug = sanitize_key( $_POST['category'] ?? 'all' );
    $max      = (int) ( $_POST['maxPosts']  ?? -1  );
    $post_ids = project_get_posts( $cat_slug, $max );

    ob_start();
    project_render_grid( $post_ids, $cat_slug );

    wp_send_json_success([ 'html' => ob_get_clean() ]);
}
