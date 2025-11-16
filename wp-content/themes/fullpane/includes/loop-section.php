<?php
/**
 * Template for section post type display.
 * @package themify
 * @since 1.0.0
 */
global $themify, $post;

$section_type = themify_check( 'section_type' ) ? themify_get( 'section_type' ) : 'standard';
$section_width = themify_check( 'section_width' ) ? themify_get( 'section_width' ) : '';
$section_type_class = 'gallery_posts' == $section_type ? 'gallery' : $section_type;
?>

<?php themify_post_before(); // hook ?>

<section id="<?php echo apply_filters('editable_slug', $post->post_name); ?>" <?php Themify_Section::section_background('tf_clearfix section-post ' . Themify_Section::category_classes($post->ID) . ' ' . $section_type_class . ' ' . $section_width); ?>>
	
	<div class="section-inner">
		<?php themify_post_start(); // hook ?>
	
		<?php if ( ( themify_is_query_page() && $themify->hide_title != 'yes' ) && ( 'yes' != themify_get( 'hide_section_title' ) ) ): ?>
			<?php themify_post_title( array( 'tag' => 'h2', 'class' => 'section-title', 'unlink' => true ) ); ?>
		<?php endif; //section title ?>
	
		<div class="section-content">

			<?php
			/**
			 * SECTION TYPE: VIDEO
			 */
			if ( 'video' == $section_type && themify_has_post_video() ) : ?>

				<?php  themify_post_video(); ?>

			<?php endif; // video section type ?>

			<?php
			/**
			 * SECTION TYPE: GALLERY SHORTCODE
			 */
			if ( 'gallery' == $section_type && themify_get( 'gallery_shortcode' ) != '' ) : ?>

				<?php get_template_part( 'includes/gallery', 'shortcode' ); ?>

			<?php endif; // gallery section type ?>

			<?php
			/**
			 * SECTION TYPE: GALLERY POST TYPE
			 */
			if ( 'gallery_posts' == $section_type && themify_get( 'gallery_posts' ) != '' ) : ?>

				<?php get_template_part( 'includes/gallery', 'post_type' ); ?>

			<?php endif; // gallery post section type ?>

			<?php themify_post_content();?>

		</div>
		<!-- /.section-content -->

		<?php themify_post_end(); // hook ?>
	</div> <!-- /.section-inner -->
	
</section>
<?php themify_post_after(); // hook ?>
<!-- /.section-post -->