<?php
/**
 * Template for site footer
 * @package themify
 * @since 1.0.0
 */
?>
	<?php themify_layout_after(); //hook ?>
    </div>
    <!-- /body -->

	<?php if( 'on' !== themify_get( 'setting-exclude_footer_panel','',true ) ) :
		Themify_Enqueue_Assets::loadThemeStyleModule('footer'); ?>
		<div id="footerwrap" class="tf_box tf_w tf_clearfix">
			<div id="footerwrap-inner" class="tf_hide">
		
				<?php themify_footer_before(); // hook ?>
				<footer id="footer" class="pagewidth tf_clearfix tf_box tf_clear" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
					<?php themify_footer_start(); // hook ?>	
		
					<?php get_template_part( 'includes/footer-widgets'); ?>
			
					<div class="footer-text tf_clearfix">
						<?php themify_the_footer_text(); ?>
						<?php themify_the_footer_text('right'); ?>
					</div>
					<!-- /footer-text --> 
					<?php themify_footer_end(); // hook ?>
				</footer>
				<!-- /#footer --> 
				<?php themify_footer_after(); // hook ?>

			</div>
			<!-- /footerwrap-inner -->

			<div id="footer-tab">
				<a href="#"><span class="screen-reader-text"><?php _e( 'Toggle Footer', 'themify' ); ?></span></a>
			</div>
			<!-- /footer-tab -->

		</div>
		<!-- /#footerwrap -->
	<?php endif; // exclude_footer_panel check ?>

</div>
<!-- /#pagewrap -->

<?php themify_body_end(); // hook ?>
<!-- wp_footer -->
<?php wp_footer(); ?>

</body>
</html>
