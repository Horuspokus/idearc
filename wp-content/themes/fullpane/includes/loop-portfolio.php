<?php
/**
 * Template for portfolio post type display.
 * @package themify
 * @since 1.0.0
 */
global $themify;
$categories = wp_get_object_terms(get_the_ID(), 'portfolio-category');
$class = '';
foreach($categories as $cat){
    if ( is_object( $cat ) ) {
        $class .= ' cat-'.$cat->term_id;
    }
}
?>

<?php themify_post_before(); // hook ?>
<article id="portfolio-<?php the_id(); ?>" class="<?php echo implode(' ', get_post_class('post tf_clearfix portfolio-post' . $class)); ?>">
	<?php themify_post_start(); // hook ?>
    <?php 
	if(!is_singular( 'portfolio' )){
	    themify_post_media( array( 'is_lightbox' => $themify->lightbox_portfolio ) );
	}
	else{
	    get_template_part( 'includes/single-portfolio');
	}
    ?>
	

	<div class="post-content">

		<?php if( 'yes' !== $themify->unlink_image && !is_singular( 'portfolio' )): ?>
			<a <?php themify_permalink_attr( array( 'link_class'=>'tf_abs tf_w tf_h', 'is_lightbox' => $themify->lightbox_portfolio )); ?>></a>
		<?php endif; ?>
		<div class="post-content-inner tf_rel tf_w">
			<?php if($themify->hide_meta !== 'yes'): ?>
				<p class="post-meta entry-meta">
					<?php themify_meta_taxonomies('',' <span class="separator">/</span> ');?>
				</p>
			<?php endif; //post meta ?>

			<?php themify_post_title( array( 'tag' => 'h2' ) ); ?>

			<?php if($themify->hide_date !== 'yes'): ?>
				<time datetime="<?php the_time('o-m-d') ?>" class="post-date entry-date updated"><?php echo get_the_date( apply_filters( 'themify_loop_date', '' ) ) ?></time>
			<?php endif; //post date ?>

			<?php themify_post_content();?>
		</div>

	</div>
	<!-- /.post-content -->

	<?php themify_post_end(); // hook ?>
</article>
<!-- /.post -->
<?php themify_post_after(); //hook ?>