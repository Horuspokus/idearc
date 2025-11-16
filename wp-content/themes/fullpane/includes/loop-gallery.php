<?php
/**
 * Template for gallery post type display.
 * @package themify
 * @since 1.0.0
 */

global $themify;

?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class( 'gallery-post' ); ?>>
	<?php themify_post_start(); // hook ?>

	<?php themify_post_title( array( 'tag' => 'h1' ) ); ?>

	<?php themify_meta_taxonomies();?>

	<?php if ( post_password_required() ) : ?>
		<div class="gallery-content pagewidth">
			<?php echo get_the_password_form(); ?>
		</div>
	<?php else: ?>
		<div data-lazy="1" class="gallery-wrapper gallery-type-gallery masonry tf_clearfix" data-fit="1" data-gutter="0" data-column="0">
			<?php
			/**
			 * GALLERY TYPE: GALLERY
			 */
			$shortcode=themify_get( 'gallery_shortcode' );
			$images = themify_get_gallery_shortcode($shortcode);
			if(!empty($images)){
			    $img_size = themify_get_gallery_shortcode_params($shortcode,'size','full');
			    $imageParams=array('width' => 250,'height' => 268);
			    if($img_size!=='full'){
					$imageParams=themify_get_additional_image_sizes($img_size,$imageParams);
			    }
			    $imageParams['image_size']=$img_size;

			    themify_before_post_image();
			    ?>

			    <?php foreach ( $images as $image ) :
				    $caption = $image->post_excerpt;
				    $description = $image->post_content;
				    if($caption===''){
					$caption=$description;
				    }
				    $alt = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
				    if(!$alt){
					$alt = $caption?$caption:($description?$description:the_title_attribute('echo=0'));
				    }
				    $img = wp_get_attachment_image_src( $image->ID, 'full' );
				    $imageParams['src']=$img[0];
				    $imageParams['alt']=$alt;
				    ?>
				    <div class="item gallery-icon">
					<a href="<?php echo $img[0]; ?>" title="<?php esc_attr_e($image->post_title)?>" data-caption="<?php esc_attr_e($caption); ?>" data-description="<?php esc_attr_e($description); ?>" class="themify_lightbox">
						<?php echo themify_get_image( $imageParams ); ?>
						<?php if($caption):?>
							<span><?php echo $caption; ?></span>
						<?php endif;?>
					    </a>
				    </div>
			    <?php endforeach; // images as image ?>

			<?php themify_after_post_image(); // hook ?>
			<?php } ?>

		</div>

		<div class="gallery-content pagewidth">
			<div class="post tf_clearfix">
				<div class="post-meta entry-meta">
					<p class="post-author">

						<?php echo get_avatar( get_the_author_meta('user_email'), $themify->avatar_size, '' ); ?>
						<br/>
						<small><?php printf( __('<a href="%s">%s</a>', 'themify'),  get_author_posts_url( get_the_author_meta( 'ID' ) ), get_the_author_meta('display_name') ); ?></small>
					</p>

					<time class="post-date entry-date updated" datetime="<?php the_time('o-m-d') ?>"><?php echo get_the_date( apply_filters( 'themify_loop_date', '' ) ) ?></time><br>
					<?php themify_comments_popup_link(array('zero'=>__( '0 comments', 'themify' ),'one'=>__( '1 comment', 'themify' ),'more'=>__( '% comments', 'themify' ))); ?><br/>

				</div>
				<div class="post-content">

				    <?php themify_post_content();?>

				</div>
				<!-- /.post-content -->

			</div>
			<!-- / .post -->

			<?php wp_link_pages(array('before' => '<p class="post-pagination"><strong>' . __('Pages:', 'themify') . ' </strong>', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			<?php get_template_part( 'includes/author-box', 'single'); ?>

			<?php if ( is_singular() ) : ?>
				<?php get_template_part( 'includes/post-nav'); ?>
			<?php endif; ?>

			<?php themify_comments_template(); ?>

		</div>

	<?php endif; ?>
	<?php themify_post_end(); // hook ?>

</article>
<!-- /.post -->
<?php themify_post_after(); // hook ?>
