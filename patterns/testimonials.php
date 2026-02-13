<?php
/**
 * Title: Testimonials
 * Slug: bloktastik/testimonials
 * Categories: allset
 * Description: A two-column card layout.
 * Keywords: testimonials, two-column
 */
?>

<!-- wp:group {"metadata":{"categories":["Allset"],"className":"testimonials-grid","patternName":"bloktastik/testimonials","name":"Testimonials"},"align":"full","className":"allset-testimonials","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"backgroundColor":"bright-green","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull allset-testimonials has-bright-green-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"right":"0","left":"0"}}}} -->
<p style="margin-right:0;margin-left:0"><img src="/wp-content/themes/allsetpack/assets/svgs/quotes.svg" alt="Quotation mark"></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"0","right":"0"}}},"textColor":"base"} -->
<h3 class="wp-block-heading has-base-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--30);margin-right:0;margin-bottom:var(--wp--preset--spacing--30);margin-left:0">Clients say the nicest things</h3>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:query {"queryId":21,"query":{"perPage":7,"pages":0,"offset":0,"postType":"allset_testimonial","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"only","inherit":false,"parents":[],"format":[]}} -->
<div class="wp-block-query"><!-- wp:post-template {"className":"testimonials-grid","layout":{"type":"default","columnCount":3}} -->
<!-- wp:post-content /-->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:group {"className":"slider-controls","layout":{"type":"constrained"}} -->
<div class="wp-block-group slider-controls"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-default slide-left"} -->
<div class="wp-block-button is-style-default slide-left"><a class="wp-block-button__link wp-element-button"><img src="/wp-content/themes/allsetpack/assets/svgs/arrow-left.svg" alt="Slide Left"></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-default slide-right"} -->
<div class="wp-block-button is-style-default slide-right"><a class="wp-block-button__link wp-element-button"><img src="/wp-content/themes/allsetpack/assets/svgs/arrow-right.svg" alt="Slide Right"></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
