<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php wp_head(); ?>
    <base target="_top">
</head>

<body <?php body_class(); ?>>

	<?php themify_body_start(); // hook ?>

	<div id="pagewrap" class="hfeed site tf_box">
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
		</div><!-- /#layout -->
	</div><!-- /#pagewrap -->

	<?php themify_body_end(); // hook ?>

	<?php wp_footer(); ?>

</body>
</html>