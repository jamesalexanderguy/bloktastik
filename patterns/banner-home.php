<?php
/**
 * Title: Home Hero Banner
 * Slug: bloktastik/banner-home
 * Categories: bloktastik
 * Description: Full-width hero banner with featured image overlay and a CTA booking box below.
 * Keywords: banner, hero, home
 */
?>

<!-- wp:group {"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull" id="hero-banner"><!-- wp:cover {"useFeaturedImage":true,"dimRatio":60,"style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-cover" style="margin-top:0"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"textColor":"base","fontSize":"5xl"} -->
<p class="has-base-color has-text-color has-link-color has-5-xl-font-size" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><strong>Your compelling hero headline goes here</strong></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div id="booking-box" class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"border":{"radius":"12px","width":"0px","style":"none"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group has-base-color has-contrast-background-color has-text-color has-background has-link-color" style="border-style:none;border-width:0px;border-radius:12px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":3,"textColor":"base","fontSize":"xl"} -->
<h3 class="wp-block-heading has-text-align-center has-base-color has-text-color has-xl-font-size"><strong>Book an appointment</strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"lg"} -->
<p class="has-text-align-center has-base-color has-text-color has-link-color has-lg-font-size">Add your booking instructions or contact details here.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0"><!-- wp:button {"className":"is-style-default"} -->
<div class="wp-block-button is-style-default"><a class="wp-block-button__link wp-element-button" href="/"><strong>BOOK ONLINE NOW</strong></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":5,"fontSize":"xl"} -->
<h5 class="wp-block-heading has-text-align-center has-xl-font-size">Supporting subheading or tagline goes here.</h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Add a short supporting sentence with a <a href="/">relevant link</a>.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
