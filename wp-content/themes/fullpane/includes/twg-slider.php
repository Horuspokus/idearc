<?php
/**
 * Partial template to render the gallery post_type section type
 * Created by themify
 * @since 1.0.0
 */

$uniqid=uniqid('tf_gallery_');
$thumbs=array();
$speed=$atts['transition'];
if($speed==='fast'){
	$speed=1000;
}
elseif($speed==='normal'){
	$speed=2000;
}
elseif($speed==='slow'){
	$speed=4000;
}
$limit=(int)$atts['limit'];
global $post;
?>

<!-- start gallery post type entry -->

<div class="twg-wrap tf_rel tf_overflow">
	<div data-lazy="1" class="gallery-slider tf_carousel tf_swiper-container tf_overflow tf_rel tf_h" data-slider_nav="0" data-height="100vh" data-effect="fade" data-thumbs="<?php echo $uniqid?>" data-speed="<?php echo $speed; ?>" data-visible="1" data-wrapvar="1" data-pager="0">
		<div class="tf_swiper-wrapper tf_lazy tf_rel tf_w tf_h">
			<?php foreach ( $galleries as $post ) :?>
				<?php 
						
					setup_postdata( $post );
					$id = get_post_thumbnail_id($post->ID);
					$full=wp_get_attachment_url($id);
				?>
				<?php if($id):?>
					<div class="tf_swiper-slide twg-holder tf_lazy">
						<?php 
							echo themify_get_image(array('src'=>$full,'w'=>$atts['image_w'],'h'=>$atts['image_h'],'is_slider'=>true));
							$permalink=get_permalink();
							$thumbs[]= $id;
						?>
						<div class="gallery-info twg-info">
							
							<?php themify_meta_taxonomies()?>

							<h2 class="gallery-title">
								<a href="<?php echo $permalink ?>" class="twg-title"><?php the_title()?></a>
							</h2>

							<div class="separator tf_clearfix"></div>

							<time class="gallery-date twg-date"><?php the_date('M j, Y')?></time>


							<div class="twg-actions">
								<a href="<?php echo $permalink ?>" class="shortcode button outline twg-primary-action"><?php _e( 'Launch Gallery', 'themify' ); ?></a>
							</div>
						</div>
					</div>
				<?php endif;?>
			<?php endforeach; // galleries as gallery ?>
		</div>
	</div>
	<!-- / .gallery-image-holder -->
	<?php wp_reset_postdata(); ?>
	<div class="twg-controls tf_w">
		<?php if ( 'off' !== $atts['auto'] ) : ?>
			<div class="timer-bar tf_w tf_abs_t"></div>
		<?php endif; ?>

		<div data-lazy="1" class="gallery-slider-thumbs tf_carousel tf_swiper-container tf_overflow tf_rel" data-thumbs-id="<?php echo $uniqid?>" data-css_url="<?php echo Themify_Enqueue_Assets::$THEME_CSS_MODULES_URI?>twg-slider.css?v=<?php echo Themify_Enqueue_Assets::$themeVersion?>" data-height="100" data-free-mode="1" data-visible="<?php echo count($thumbs)>$limit?$limit:($limit-1)?>" data-nav_out="1" data-auto="<?php echo $atts['auto']; ?>" data-speed="<?php echo $speed; ?>" data-wrapvar="1" data-pager="0">
			<div class="tf_swiper-wrapper tf_lazy tf_rel tf_w tf_h">
			<?php
			foreach ( $thumbs as $thumb ) : ?>
				<div class="twg-item tf_swiper-slide tf_lazy">
					<?php echo themify_get_image(array('src'=>$thumb,'w'=>100,'h'=>100,'is_slider'=>true))?>
				</div>
			<?php endforeach; // galleries as gallery ?>
			</div>
		</div>

	</div>
	<!-- /gallery-slider-wrap -->
</div>
<!-- /.twg-wrap -->
