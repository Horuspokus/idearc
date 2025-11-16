<?php

global $themify;
$post_type=get_post_type();
$category='category';
$cl='';
if($post_type==='portfolio'){
	$category=$post_type.'-'.$category;
	$cl=' '.$category;
}
if ( have_posts() ){
    the_post();
?>
<div class="featured-area tf_w tf_rel tf_overflow tf_h">
	<?php if ( $themify->hide_image !== 'yes' ) : ?>
		<?php themify_post_video();?>
		<?php if ($post_image = themify_get_image($themify->auto_featured_image . "w=".$themify->width."&h=".$themify->height) ) : ?>
			<figure class="post-image tf_rel tf__width"><?php echo $post_image ?></figure>
		<?php endif; ?>
	<?php endif; ?>
	<div class="top-post-meta-wrap tf_box tf_rel tf_textc tf_w">

		<p class="top-post-meta">
			<?php if ( $themify->hide_meta !== 'yes' && $themify->hide_meta_category !== 'yes' ) : ?>
				<?php the_terms( get_the_ID(), $category, ' <span class="post-category'.$cl.'">', ', ', '</span>' ); ?>
			<?php endif; ?>
		</p>
		<!-- /post-meta -->
		<?php if ( 'yes' !== $themify->hide_title ) :  ?>
			<?php themify_post_title( array( 'unlink' => $themify->unlink_title === 'yes', 'tag' => themify_theme_entry_title_tag( false ) ) ); ?>
		<?php endif;?>
		<?php if ($post_type!=='portfolio' && ($themify->hide_meta !== 'yes' || $themify->hide_date !== 'yes' )) : ?>
			<p class="post-meta entry-meta">

				<?php if ( $themify->hide_meta_author !== 'yes' ) : ?>
					<span class="author-avatar"><?php echo get_avatar( get_the_author_meta('user_email'), $themify->avatar_size ); ?></span>
					<span class="post-author"><?php echo themify_get_author_link(); ?></span>
				<?php endif; // post author ?>

				<span class="post-meta-inline">
					<?php if ( $themify->hide_date !== 'yes' ) : ?>
						<time datetime="<?php the_time('o-m-d') ?>" class="post-date entry-date updated"><?php the_time( apply_filters( 'themify_loop_date', get_option( 'date_format' ) ) ) ?></time>
						
					<?php endif; // post date ?>

					<?php if ( $themify->hide_meta_tag !== 'yes' ) : ?>
						<?php the_terms( get_the_ID(), 'post_tag', ' <span class="post-tag">', ', ', '</span>' ); ?>
					<?php endif; ?>

					<?php themify_comments_popup_link();?>
				</span>

			</p>
			<!-- /post-meta -->
		<?php endif; // end meta or date  ?>

		<div class="top-excerpt-wrap">
			<?php the_excerpt(); ?>
		</div>

	</div>

</div>

<?php } ?>
<?php rewind_posts(); 