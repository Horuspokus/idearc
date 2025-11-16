<?php
/**
 * Template for site footer
 * @package themify
 * @since 1.0.0
 */

	global $themify;
	themify_layout_after(); // hook ?>
			</div>
			<!-- /body -->

			<?php if ( 'on' !== themify_get('hide_footer') ) : ?>

			    <div id="footerwrap" class="tf_box tf_clear">

					<?php themify_footer_before(); // hook ?>

					<footer id="footer" class="pagewidth tf_clearfix tf_box tf_rel" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
						
						<div class="back-top tf_textc tf_abs"><a href="#header"><span class="screen-reader-text"><?php _e('Back to top', 'themify'); ?></span></a></div>
						<div class="footer_inner<?php if(themify_theme_is_fullpage_scroll()):?> tf_hide<?php endif;?>">
							<?php themify_footer_start(); // hook ?>

							<?php if ( themify_theme_show_area( 'footer_widgets' ) ) : ?>
								<div class="footer-widgets-wrap">
									<?php get_template_part( 'includes/footer-widgets'); ?>
								</div>
							<?php endif; // exclude footer widgets ?>


							<?php	themify_menu_nav( array(
									'theme_location' => 'footer-nav',
									'fallback_cb' => '',
									'container'  => '',
									'menu_id' => 'footer-nav',
									'menu_class' => 'footer-nav',
								) );
							?>

							<div class="footer-text tf_clearfix">
								<?php
								themify_the_footer_text();
								themify_the_footer_text('right');
								?>
							</div>
							<!-- /footer-text -->

							<?php themify_footer_end(); // hook ?>
						</div>
					</footer>
					<!-- /#footer -->

					<?php themify_footer_after(); // hook ?>

				</div>
				<!-- /#footerwrap -->

			<?php endif; // exclude footer ?>

		</div>
		<!-- /#pagewrap -->
        <?php themify_body_end(); // hook ?>		
        <!-- wp_footer -->
		<?php wp_footer(); ?>
	</body>
</html>