<?php
/**
 * Title: Numbered FAQ List
 * Slug: bloktastik/faq-list
 * Categories: allset, posts
 * Description: A numbered list of FAQ posts with customizable post type and category
 * Keywords: faq, query, numbered, list
 */
?>
<!-- wp:query {"queryId":47,"query":{"perPage":10,"pages":0,"offset":0,"postType":"faq","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[]},"namespace":"core/posts-list","layout":{"type":"default"},"className":"numbered-faq-pattern"} -->
<div class="wp-block-query numbered-faq-pattern">
    <!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"},"tagName":"ol"} -->
        <!-- wp:post-title {"level":3} /-->
        <!-- wp:post-content /-->
    <!-- /wp:post-template -->
</div>
<!-- /wp:query -->