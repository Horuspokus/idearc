<?php
/**
 * Template for highlight post type display.
 * @package themify
 * @since 1.0.0
 */
?>
<?php themify_post_before(); // hook ?>
<article id="highlight-<?php the_id(); ?>" <?php post_class('post tf_clearfix highlight-post'); ?>>
	<?php themify_post_start(); // hook ?>

	<?php
	$imageArgs=array();
	$fa_icon = themify_get('icon','');
	$bar_percentage = themify_get('bar_percentage', false);
	if ( $bar_percentage !==false || $fa_icon!=='') {
		
		$bar_color = themify_get_color_both('bar_color', 'styling-backgrounds-chart_bar_color-background_color-value-value', '#22d9e5');
		if($fa_icon!==''){
			$imageArgs['image']='<i style="color:'.$bar_color.'">'.themify_get_icon($fa_icon).'</i>';
		}
		if($bar_percentage!==false){
			$imageArgs['before_image']='<svg viewBox="0 0 33.83098862 33.83098862" class="tf_higlight_chart tf_abs tf_w tf_h">
				<circle class="tf_higlight_feature_fill"/>
				<circle class="tf_higlight_feature_stroke" stroke="'.$bar_color.'" fill="none" data-progress="'.$bar_percentage.'" stroke-dasharray="0,100"/>
				</svg>';
		}
	}
	?>
    	<?php themify_post_media($imageArgs);?>

	<div class="post-content">
	    <?php themify_post_title(array('tag'=>'h2'));?>

	    <?php themify_post_content();?>
	</div>

<?php themify_post_end(); // hook ?>
</article>
<!-- / .post -->
<?php themify_post_after(); // hook ?>
