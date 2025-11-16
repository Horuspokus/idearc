<?php
/**
 * Template for team post type display.
 * @package themify
 * @since 1.0.0
 */

$skills = themify_get('skills','');
$social = themify_get('social', '' );
$team_title=themify_get('team_title','');
if($team_title!==''){
	$team_title='<span class="team-title">'.$team_title.'</span>';
}
?>

<?php themify_post_before(); // hook ?>
<article id="team-<?php the_id(); ?>" <?php post_class('post tf_clearfix team-post'); ?>>
	<?php themify_post_start(); // hook ?>

		<div class="team-content-wrap tf_clearfix">
			<?php themify_post_media();?>
			<div class="team-title-wrapper tf_clearfix">
				<?php themify_post_title(array('tag'=>'h2','after_title'=>$team_title)); ?>

				<?php if( $social!=='' ): ?>
					<div class="team-social">
						<?php echo do_shortcode( $social ); ?>
					</div>
					<!-- /.team-social -->
				<?php endif; ?>
			</div>

		</div>

		<div class="post-content tf_clearfix">
			<?php themify_post_content();?>
		</div>
		<!-- /.post-content -->

	<?php if( $skills!=='' ): ?>
		<div class="skillset-wrap tf_clearfix">
			<h4><?php _e( 'Skills', 'themify' ); ?></h4>
			<div class="progress-bar-wrap">
				<?php echo do_shortcode( $skills ); ?>
			</div>
		</div>
		<!-- /.skillset -->
	<?php endif; ?>
	<?php themify_post_end(); // hook ?>
</article>
<!-- / .post -->
<?php themify_post_after(); // hook ?>
