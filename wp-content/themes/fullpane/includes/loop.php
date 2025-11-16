<?php
/**
 * Template for generic post display.
 * @package themify
 * @since 1.0.0
 */
global $themify;
?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class( 'post tf_clearfix' ); ?>>
	<?php themify_post_start(); // hook ?>

	<?php themify_post_media() ?>

	<div class="post-content">

			<?php themify_post_title(); ?>

		<?php if($themify->hide_meta !== 'yes'): ?>
			<div class="post-meta entry-meta">

				<?php if($themify->hide_meta_author !== 'yes'): ?>
					<p class="post-author">
						<?php echo get_avatar( get_the_author_meta('user_email'), $themify->avatar_size, '' ); ?>
					</p>
				<?php endif; ?>

				<?php if($themify->hide_meta_author !== 'yes'): ?>
					<span class="post-author-name"><?php printf( __('<a href="%s">%s</a>', 'themify'),  get_author_posts_url( get_the_author_meta( 'ID' ) ), get_the_author_meta('display_name') ); ?></span>
				<?php endif; ?>

				<?php if($themify->hide_date !== 'yes'): ?>
					<time datetime="<?php the_time('o-m-d') ?>" class="post-date entry-date updated"><?php echo get_the_date( apply_filters( 'themify_loop_date', '' ) ) ?></time>
				<?php endif; //post date ?>

				<?php themify_comments_popup_link(array('zero'=>__( '0 Comments', 'themify' ),'one'=>__( '1 Comment', 'themify' ),'more'=>__( '% Comments', 'themify' ))); ?>
				<?php themify_meta_taxonomies();?>

				<?php if($themify->hide_meta_tag !== 'yes'): ?>
					<?php the_tags('<span class="post-tag">', ', ', '</span>'); ?>
				<?php endif; ?>

			</div>
		<?php endif; //post meta ?>

		<?php themify_post_content();?>

	</div>
	<!-- /.post-content -->
	<?php themify_post_end(); // hook ?>

</article>
<!-- /.post -->
<?php themify_post_after(); // hook ?>
