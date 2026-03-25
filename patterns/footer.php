<?php
/**
 * Title: Footer
 * Slug: bloktastik/footer
 * Categories: bloktastik
 * Block Types: core/template-part/footer
 * Description: Site footer with logo, navigation, and copyright line.
 *
 * @package Bloktastik
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-contrast-background-color has-base-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:site-logo {"width":160,"shouldSyncIcon":false} /-->

<!-- wp:site-tagline {"textColor":"base","fontSize":"sm"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:navigation {"textColor":"base","overlayBackgroundColor":"contrast","overlayTextColor":"base","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"right"}} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"opacity":"css","style":{"color":{"background":"rgba(255,255,255,0.15)"},"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"}}}} -->
<hr class="wp-block-separator has-css-opacity" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--40);background-color:rgba(255,255,255,0.15);color:rgba(255,255,255,0.15)"/>
<!-- /wp:separator -->

<!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"xs"} -->
<p class="has-text-align-center has-base-color has-text-color has-xs-font-size">© Site Name &nbsp;|&nbsp; <a href="/privacy-policy/">Privacy Policy</a> &nbsp;|&nbsp; <em>Site by <a href="https://spaceracedigital.com/" target="_blank" rel="noreferrer noopener">SpaceRace Digital</a></em></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
