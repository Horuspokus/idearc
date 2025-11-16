<?php
/**
 * Template for generic post display.
 * @package themify
 * @since 1.0.0
 */
global $themify;
themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class( 'post tf_clearfix' ); ?>>
	<?php themify_post_start(); // hook ?>


	<div class="post-content">

		<?php if ( ! is_single() || !empty( Themify_Builder::$is_loop ) ) : ?>

			<?php if ( 'below' !== $themify->media_position ) : ?>
				<?php themify_post_media(); ?>
			<?php endif; ?>

			<p class="post-meta entry-meta">
			    <?php themify_meta_taxonomies(); ?>
			</p>

			<?php themify_post_title(); ?>

			<?php if ( 'below' === $themify->media_position ) : ?>
				<?php themify_post_media(); ?>
			<?php endif; ?>

			<?php if ( $themify->hide_meta !== 'yes' || $themify->hide_date !== 'yes' ) : ?>
				<p class="post-meta entry-meta">

					<?php if ( $themify->hide_meta !== 'yes' && $themify->hide_meta_author !== 'yes' ) : ?>
						<span class="author-avatar"><?php echo get_avatar( get_the_author_meta('user_email'), $themify->avatar_size ); ?></span>
						<span class="post-author"><?php echo themify_get_author_link(); ?></span>
					<?php endif; // post author ?>

					<span class="post-meta-inline">
						<?php if ( $themify->hide_date !== 'yes' ) : ?>
							<time datetime="<?php the_time('o-m-d') ?>" class="post-date entry-date updated"><?php the_time( apply_filters( 'themify_loop_date', get_option( 'date_format' ) ) ) ?></time>
						<?php endif; // post date ?>
						<?php if($themify->hide_meta !== 'yes'):?>	
						    <?php if ( $themify->hide_meta_tag !== 'yes' ) : ?>
							    <?php the_terms( get_the_id(), 'post_tag', ' <span class="post-tag">', ', ', '</span>' ); ?>
						    <?php endif; ?>

						    <?php themify_comments_popup_link();?>
						<?php endif;?>
					</span>

				</p>
				<!-- /post-meta -->
			<?php endif; // end meta or date  ?>

		<?php endif; // elements not in single view ?>

		<?php themify_post_content();?>

	</div>
	<!-- /.post-content -->
	<?php themify_post_end(); // hook ?>

</article>
<!-- /.post -->
<?php themify_post_after(); // hook 
