<?php 
global $themify;
$is_single_portfolio=themify_loop_is_singular( 'portfolio' );
$class = '';
if($is_single_portfolio===false){
	$categories = wp_get_object_terms( get_the_id(), 'portfolio-category' );
	if ( ! is_wp_error( $categories ) ) {
		foreach ( $categories as $cat ) {
			if ( is_object( $cat ) ) {
				$class .= ' cat-' . $cat->term_id;
			}
		}
	}
}
?>

<?php themify_post_before(); //hook ?>
<article id="portfolio-<?php the_id(); ?>" <?php  post_class('post tf_clearfix portfolio-post' . $class); ?>>
	<?php themify_post_start(); //hook ?>

	<a <?php themify_permalink_attr(); ?> data-post-permalink="yes" style="display: none;"></a>

	<?php if ( $is_single_portfolio===true) : ?>

		<?php
		$client = get_post_meta( get_the_id(), 'project_client', true );
		$services = get_post_meta( get_the_id(), 'project_services', true );
		$date = get_post_meta( get_the_id(), 'project_date', true );
		$launch = get_post_meta( get_the_id(), 'project_launch', true );
		if ( $client || $services || $date || $launch ) : ?>
			<div class="project-meta">
				<?php if ( $date ): ?>
					<div class="project-date">
						<strong><?php _e( 'Date', 'themify' ); ?></strong>
						<?php echo  $date ; ?>
					</div>
				<?php endif; ?>

				<?php if ( $client ) : ?>
					<div class="project-client">
						<strong><?php _e( 'Client', 'themify' ); ?></strong>
						<?php echo  $client ; ?>
					</div>
				<?php endif; ?>

				<?php if ( $services ) : ?>
					<div class="project-services">
						<strong><?php _e( 'Services', 'themify' ); ?></strong>
						<?php echo  $services ; ?>
					</div>
				<?php endif; ?>

				<?php if ( $launch ) : ?>
					<div class="project-view">
						<strong><?php _e( 'View', 'themify' ); ?></strong>
						<a href="<?php echo esc_url( $launch ); ?>"><?php _e( 'Launch Project', 'themify' ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; // $client || $services || $date || $launch ?>
	
	<?php elseif($themify->hide_image !== 'yes' ) : ?>
	    <?php themify_post_media(); ?>
	<?php endif; // is singular portfolio ?>


	<div class="post-content">

		<?php if ($is_single_portfolio===false ) : ?>
			<div class="disp-table">
				<div class="disp-row">
					<div class="disp-cell valignmid">

						<?php if ( $themify->hide_meta !== 'yes' ): ?>
							<p class="post-meta entry-meta">
							    <?php themify_meta_taxonomies('',' <span class="separator">/</span> '); ?>
							</p>
						<?php endif; //post meta ?>

						
							<?php themify_post_title( array( 'tag' => 'h2' ) ); ?>

		<?php endif; // is singular portfolio ?>

						<?php themify_post_content();?>


		<?php if ($is_single_portfolio===false ) : ?>

					</div>
					<!-- /.disp-cell -->
				</div>
				<!-- /.disp-row -->
			</div>
			<!-- /.disp-table -->
		<?php endif; // is singular portfolio ?>

	</div>
	<!-- /.post-content -->

	<?php themify_post_end(); //hook ?>
</article>
<!-- /.post -->
<?php themify_post_after(); //hook
