<?php
global $themify;
if ($themify->hide_image !== 'yes') {
    
    $gallery_images = themify_get_gallery_shortcode(themify_get('gallery_shortcode'));
    if (!empty($gallery_images) && 'slider' === themify_get('media_type', 'slider')) {
	// Get images from [gallery]
	$option = 'setting-portfolio_slider';
	themify_before_post_image();
	?>
	<div class="post-image slideshow-wrap">
	    <div data-lazy="1" class="slideshow tf_carousel tf_swiper-container tf_overflow tf_rel" data-auto="<?php echo themify_get($option . '_autoplay', '4000', true); ?>" data-effect="<?php echo themify_get($option . '_effect', 'slide', true); ?>" data-speed="<?php echo themify_get($option . '_transition_speed', '500', true); ?>">
		<div class="tf_swiper-wrapper tf_lazy tf_rel tf_w tf_h">
		    <?php foreach ($gallery_images as $gallery_image): ?>
			<div class="tf_swiper-slide tf_lazy">
				<?php echo themify_get_image(array('src'=>$gallery_image->ID,'is_slider'=>true));?>
				<?php if ('' != $gallery_image->post_excerpt):?>
				    <div class="slider-image-caption"><?php echo $gallery_image->post_excerpt; ?></div>
				<?php endif;?>
			</div>
		    <?php endforeach; ?>
		</div>
	    </div>
	</div>

	<?php themify_after_post_image(); // hook 
    } 
    else {
	themify_post_media();
    }
}
