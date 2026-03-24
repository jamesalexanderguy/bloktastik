<?php
/**
 * Title: Practitioner Query
 * Slug: bloktastik/practitioner-query
 * Categories: lowercolumbia
 * Description: Show all the practitioners in an alphabeticized grid
 * Keywords: team, staff, practitioners
 */
?>

<!-- wp:query {"queryId":26,"query":{"perPage":50,"pages":0,"offset":0,"postType":"practitioners","order":"asc","orderBy":"title","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[]},"metadata":{"categories":["posts"],"patternName":"core/query-grid-posts","name":"Grid"}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"16rem"}} -->
<!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}},"layout":{"inherit":false}} -->
<div class="wp-block-group" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:post-content /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->