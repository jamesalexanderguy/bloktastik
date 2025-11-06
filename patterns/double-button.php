<?php
/**
 * Title: Double button
 * Slug: bloktastic/double-button
 * Categories: call-to-action, button
 * Description: Two buttons side-by-side like in the footer
 * Keywords: call-to-action, button
 */
?>

<!-- wp:group {"className":"flex justify-center gap-4 no-flow-margin py-6"} -->
<div class="wp-block-group flex justify-center gap-4 no-flow-margin py-6">
    <!-- wp:buttons {"className":"flex gap-4"} -->
    <div class="wp-block-buttons flex gap-4">
        <!-- wp:button {"className":"is-style-blue-border w-[10rem] h-auto mb-5 mx-2"} -->
        <div class="wp-block-button is-style-blue-border w-[10rem] mb-5 mx-2">
            <a href="/add-your-own-link" class="wp-block-button__link">First Nations Readiness</a>
        </div>
        <!-- /wp:button -->

        <!-- wp:button {"className":"is-style-blue-border w-[10rem] h-auto mb-5 mx-2"} -->
        <div class="wp-block-button is-style-blue-border w-[10rem] mb-5 mx-2">
            <a href="/add-your-own-link" class="wp-block-button__link">Municipal Readiness</a>
        </div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->
