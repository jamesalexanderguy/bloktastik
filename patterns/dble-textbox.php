<?php
/**
 * Title: Double column text box
 * Slug: bloktastik/dble-textbox
 * Categories: theforest
 * Description: Two-column text box with headings and bordered container.
 * Keywords: text, textbox, double, columns
 */
?>

<!-- wp:columns {"style":{"border":{"radius":"12px","width":"1px"},"spacing":{"blockGap":{"top":"0"},"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"backgroundColor":"base","borderColor":"contrast"} -->
<div class="wp-block-columns has-border-color has-contrast-border-color has-base-background-color has-background" style="border-width:1px;border-radius:12px;margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60);padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0"}}},"fontSize":"3xl"} -->
<h3 class="wp-block-heading has-3-xl-font-size" style="margin-bottom:0"><strong>Column Heading One</strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0"}}}} -->
<p style="margin-top:0">Add your first column content here. This works well for mission, values, or any two complementary pieces of information.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"fontSize":"3xl"} -->
<h3 class="wp-block-heading has-3-xl-font-size"><strong>Column Heading Two</strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Add your second column content here. Keep both columns roughly balanced in length for the best visual result.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
