<?php
/**
 * Template for single post view
 * @package themify
 * @since 1.0.0
 */
get_header();
?>
<!-- layout -->
<div id="layout" class="pagewidth tf_clearfix tf_box">
    <!-- content -->
    <?php themify_content_before(); //hook ?>
    <main id="content" class="tf_clearfix tf_box tf_left">
	<?php get_template_part('content-single'); ?>
    </main>
    <?php themify_content_after(); //hook ?>
    <!-- /#content -->
    <?php themify_get_sidebar(); ?>
</div>
<!-- /#layout -->
<?php get_footer(); 
