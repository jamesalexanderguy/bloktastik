<?php
/**
 * Title: Manual Testimonials
 * Slug: bloktastik/manual-testimonials
 * Categories: lowercolumbia
 * Description: Add testimonial area.
 * Keywords: testimonials, two-column
 *
 * NOTE:
 * This pattern was supposed to use a custom query variation defined in manual-testimonials.js
 * whereby you can drop the post id or and array of ids into a panel in the query block to determine
 * the post output while still using the testimonials cpt. Until we return to that project, this pattern 
 * is supposed to provide the same design as the testimonial slider but with the 'inner-quote' block
 * from the testimonial pasted inside. Should work for a slider too if two inner quotes are added
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
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"right":"0","left":"0"}}}} -->
<p style="margin-right:0;margin-left:0">Paste the entire testimonial block content (or several) in place of this paragraph.</p>
<!-- /wp:paragraph -->

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
