<?php
/**
 * Title: Footer
 * Slug: bloktastik/footer
 * Categories: allset, footer
 * Block Types: core/template-part/footer
 * Description: Site footer with logo and navigation.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>

<!-- wp:group {"align":"full","layout":{"type":"default"},"className":"mt-[100px]"} -->
<div class="wp-block-group alignfull">
  <!-- wp:cover {"useFeaturedImage":true,"dimRatio":0,"customOverlayColor":"#FFF","isUserOverlayColor":true,"layout":{"type":"constrained"},"className":"footer-cover"} -->
  <div class="wp-block-cover footer-cover"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#FFF"></span>
    <div class="wp-block-cover__inner-container">
    </div>
  </div><!-- /wp:cover -->
    
  <!-- wp:group {"align":"full","className":"arrow-up","style":{"elements":{"link":{"color":{"text":"var:preset|color|logo-blue"}}}},"textColor":"logo-blue","layout":{"type":"default"}} -->
  <div class="wp-block-group alignfull arrow-up has-logo-blue-color has-text-color has-link-color">
  </div><!-- /wp:group -->
</div><!-- /wp:group -->
  
<!-- wp:group {"tagName":"footer","align":"full","className":"text-center pt-10 md:pt-30 bg-secondary","layout":{"type":"default"}} -->
<footer class="wp-block-group alignfull text-center pt-10 md:pt-30 bg-secondary"><!-- wp:image {"width":"144px","className":"mb-5 flex justify-center m-auto h-3/5 pb-2 mx-2"} -->
  <figure class="wp-block-image is-resized mb-5 flex justify-center m-auto h-3/5 pb-2 mx-2"><a href="/"><img src="/wp-content/themes/allsetpack/assets/svgs/allset-logo-white.svg" alt="Allset Logo" style="width:144px"/></a></figure>
  <!-- /wp:image -->
  <!-- wp:group {"align":"full","className":"flex justify-center gap-4 no-flow-margin py-6","layout":{"type":"default"}} -->
  <div class="wp-block-group alignfull flex justify-center gap-4 no-flow-margin py-6"><!-- wp:button {"className":"is-style-green-red w-[10rem] mb-5 h-3/5 mx-2"} -->
    <div class="wp-block-button is-style-green-red w-[10rem] mb-5 h-3/5 mx-2">
          <a class="wp-block-button__link wp-element-button">First Nations Readiness</a>
        </div>
    <!-- /wp:button -->
  
    <!-- wp:button {"className":"is-style-green-red w-[10rem] mb-5 h-3/5 mx-2"} -->
    <div class="wp-block-button is-style-green-red w-[10rem] mb-5 h-3/5 mx-2">
          <a class="wp-block-button__link wp-element-button">Municipal Readiness</a>
        </div>
    <!-- /wp:button --></div>
  <!-- /wp:group -->
  
  <!-- wp:separator {"className":"mx-auto w-[45%] is-style-default","backgroundColor":"lines-grey"} -->
  <hr class="wp-block-separator has-text-color has-lines-grey-color has-alpha-channel-opacity has-lines-grey-background-color has-background mx-auto w-[45%] is-style-default"/>
  <!-- /wp:separator -->
  
  <!-- wp:paragraph {"className":"text-lg text-white text-center"} -->
  <p class="text-lg text-white text-center">We are grateful to live, work, and build community within the forests, waters, and mountains of this region. This is the unceded traditional territory of the Sinixt, Ktunaxa, and Syilx peoples, and it is also home to the Métis and many other Indigenous peoples. We commit ourselves to learning, listening, and taking meaningful action toward reconciliation in partnership with Indigenous communities.</p>
  <!-- /wp:paragraph -->
  
  <!-- wp:separator {"className":"mx-auto w-[45%] is-style-default","backgroundColor":"lines-grey"} -->
  <hr class="wp-block-separator has-text-color has-lines-grey-color has-alpha-channel-opacity has-lines-grey-background-color has-background mx-auto w-[45%] is-style-default"/>
  <!-- /wp:separator -->
  
  <!-- wp:navigation {"ref":4,"overlayMenu":"never","className":"mt-12 mb-10 flex justify-center space-x-4"} /-->
  
  <!-- wp:group {"align":"full","layout":{"type":"default"},"className":"mx-auto p-6 md:px-12 xl:px-6 mt-6 bg-footer-base"} -->
  <div class="wp-block-group alignfull mx-auto p-10 md:px-12 xl:px-6 mt-6 bg-footer-base">
          <!-- wp:group {"align":"full","layout":{"type":"default"},"className":"text-white text-center text-xs"} -->
           <div class="wp-block-group alignfull text-white text-center text-xs">
            <!-- wp:paragraph --><p><img class="inline m-auto w-[1.5rem] py-2 mx-2" src="/wp-content/themes/allsetpack/assets/svgs/allset-maple-leaf.svg" alt="Allset Evacuation Backpacks, Canada Maple Leaf">
              <img class="text-white inline w-[0.75rem] svg-inline--fa fa-copyright fa-w-16" src="/wp-content/themes/allsetpack/assets/svgs/copyright.svg" alt="Copyright Allset Pack">
              <span class="underline">ALLSET Evacuation Backpacks</span>
            <span class="text-dull"><span class="inline md:hidden"><br></span><span class="hidden md:inline">|</span> Site Design
            <a target="_blank" class="underline" href="https://theforest.ca/">TheForest.ca</a> &
            <a class="underline" target="_blank" href="https://spaceracedigital.com/">SpaceRacedigital.com</a></span>
          </p><!-- /wp:paragraph -->
        </div><!-- /wp:group -->
  </div><!-- /wp:group -->
</footer><!-- /wp:group -->
