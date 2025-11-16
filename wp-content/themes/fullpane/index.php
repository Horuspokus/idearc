<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template for common archive pages, author and search results
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
	<?php themify_page_output(); ?>
    </main>
    <?php themify_content_after(); //hook ?>
    <!-- /#content -->
    <?php themify_get_sidebar(); ?>
</div>
<!-- /#layout -->
<?php
get_footer();
