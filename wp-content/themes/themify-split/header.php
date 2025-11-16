<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
global $themify;
wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php themify_theme_add_split_loader(); themify_body_start(); // hook ?>

	<div id="pagewrap" class="hfeed site tf_box">

		<?php if ( 'on' !== themify_get('hide_header')) : ?>

			<div id="headerwrap" class="tf_box tf_rel tf_w">

				<?php themify_header_before(); // hook ?>

				<header id="header" class="pagewidth tf_clearfix tf_box tf_rel" itemscope="itemscope" itemtype="https://schema.org/WPHeader">

					<?php themify_header_start(); // hook ?>

					<div class="logo-wrap tf_inline_b tf_vmiddle">
						<?php if ( themify_theme_show_area( 'site_logo' ) ) : ?>
						    <?php 
						    echo themify_logo_image(); 
						    ?>
						<?php endif; ?>

						<?php if ( themify_theme_show_area( 'site_tagline' ) ) : ?>
						    <?php 
							echo themify_site_description(); 
						    ?>
						<?php endif; ?>
					</div>

					<?php if ( themify_theme_do_not_exclude_all( 'mobile-menu' ) ) : ?>
						<a id="menu-icon" class="tf_hide" href="#mobile-menu"><span class="menu-icon-inner tf_box tf_rel tf_vmiddle tf_inline_b tf_overflow"></span><span class="screen-reader-text"><?php _e( 'Menu', 'themify' ); ?></span></a>

						<div id="mobile-menu" class="sidemenu sidemenu-off tf_vmiddle tf_scrollbar">

							<?php themify_mobile_menu_start(); // hook ?>

							<?php if ( themify_theme_show_area( 'search_form' ) ) : ?>
							    <div id="searchform-wrap" class="tf_right tf_rel">
								<?php get_search_form(); ?>
							    </div>
							<?php endif; // exclude search form ?>

							<?php if ( themify_theme_show_area( 'social_widget' ) ) : ?>
								<div class="social-widget">
								    <?php dynamic_sidebar('social-widget');?>
								    <?php if ( themify_theme_show_area( 'rss' ) ) : ?>
									  <?php themify_theme_feed(array('text'=>'','icon'=>'fas rss'));?>
								    <?php endif; // exclude rss ?>
								</div>
								<!-- /.social-widget -->
							<?php endif; // exclude social widget ?>

							<?php if ( themify_theme_show_area( 'menu_navigation' ) ) : ?>
								<nav id="main-nav-wrap" class="tf_inline_b tf_vmiddle" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
									<?php themify_menu_nav(); ?>
									<!-- /#main-nav -->
								</nav>
							<?php endif; // exclude menu navigation ?>

								<a id="menu-icon-close" class="tf_hide" href="#mobile-menu"><span class="screen-reader-text"><?php _e('Close', 'themify'); ?></span></a>

							<?php themify_mobile_menu_end(); // hook ?>

						</div>
						<!-- /#mobile-menu -->
					<?php endif; // do not exclude all this ?>

					<?php themify_header_end(); // hook ?>

				</header>
				<!-- /#header -->

				<?php themify_header_after(); // hook ?>

			</div>
			<!-- /#headerwrap -->

		<?php endif; // exclude header ?>

		<div id="body" class="tf_clearfix tf_box tf_clear tf_mw">

		    <?php themify_layout_before(); 
