<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template for common archive
 * @package themify
 * @since 1.0.0
 */
get_header();
?>
<!-- layout-container -->
<div id="layout" class="pagewidth tf_clearfix tf_box tf_w">
    <?php themify_content_before(); // hook ?>
    <!-- content -->
    <main id="content" class="tf_clearfix tf_box">
	<?php themify_page_output();?>
    </main>
    <!-- /content -->
    <?php
    themify_content_after(); // hook 
    themify_get_sidebar();
    ?>
</div>
<!-- /layout-container -->
<?php get_footer();