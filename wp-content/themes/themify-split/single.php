<?php
/**
 * Template for single post view
 * @package themify
 * @since 1.0.0
 */
get_header();
if(is_singular('post') || is_singular('portfolio')){
    get_template_part('includes/featured-area');
}
?>
<!-- layout-container -->
<div id="layout" class="pagewidth tf_clearfix tf_box tf_w">
    <?php
    if (have_posts()) {
	the_post();
	?>
	<?php themify_content_before(); // hook  ?>
        <!-- content -->
        <main id="content" class="tf_clearfix tf_box">
	    <?php
	    themify_content_start(); // hook 

	    get_template_part('includes/loop', get_post_type());

	    wp_link_pages(array('before' => '<p class="post-pagination"><strong>' . __('Pages:', 'themify') . ' </strong>', 'after' => '</p>', 'next_or_number' => 'number'));

	    get_template_part('includes/author-box', 'single');

	    get_template_part('includes/post-nav', get_post_type());

	    themify_comments_template();

	    themify_content_end();
	    ?>
        </main>
        <!-- /content -->
	<?php
	themify_content_after(); // hook 
    }
    themify_get_sidebar();
    ?>
</div>
<!-- /layout-container -->
<?php
get_footer();

