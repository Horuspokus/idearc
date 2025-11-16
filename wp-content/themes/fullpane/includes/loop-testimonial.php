<?php
/**
 * Template for testimonial post type display.
 * @package themify
 * @since 1.0.0
 */
global $themify;
?>

<?php themify_post_before(); // hook ?>
<article id="testimonial-<?php the_id(); ?>" <?php post_class('post tf_clearfix testimonial-post'); ?><?php if ('slider' === $themify->post_layout):?> data-swiper-thumb="<?php echo themify_get_image('urlonly=true&w='.$themify->width.'&h='.$themify->height ); ?>"<?php endif;?>>
	<?php themify_post_start(); // hook ?>

	<div class="testimonial-content">
		<?php
			themify_post_title(array('tag'=>'h2','unlink'=>true));
			themify_post_content();
		?>
	</div>

	<?php if ('slider' !== $themify->post_layout): ?>
		<?php themify_post_media();?>
	<?php endif;?>

	<?php
	$testimonial_author = themify_get('testimonial_name','');
	if($testimonial_author==='' ) {
		$testimonial_author = themify_get('_testimonial_name','');
	}
	$testimonial_title = themify_get('testimonial_title','');
	if($testimonial_title==='' ) {
		$testimonial_title = themify_get('_testimonial_position','');
	}
	if($testimonial_title!==''){
		$testimonial_title='<span class="testimonial-title">'.$testimonial_title.'</span>';
	}
	if( $testimonial_author!=='' || $testimonial_title!=='' ) : ?>
		<?php themify_post_title(array('tag'=>'div','title'=>$testimonial_author,'show_title'=>true,'after_title'=>$testimonial_title,'class'=>'testimonial-author'));?>
	<?php endif; ?>

	<?php themify_post_end(); // hook ?>
</article>
<!-- / .post -->
<?php themify_post_after(); // hook ?>
