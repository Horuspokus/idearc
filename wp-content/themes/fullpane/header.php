<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php themify_body_start(); // hook ?>
<div id="pagewrap" class="hfeed site tf_box">
	<div id="headerwrap" class="tf_box">

		<?php themify_header_before(); // hook ?>

		<header id="header" class="tf_rel tf_box" itemscope="itemscope" itemtype="https://schema.org/WPHeader">

        	<?php themify_header_start(); // hook ?>

			<?php echo themify_logo_image(), themify_site_description();?>

			<div id="menu-icon" class="mobile-button tf_hide"><?php _e( 'Menu', 'themify' ); ?></div>

			<!-- <div class="navwrap tf_clearfix"> -->
			<div id="mobile-menu" class="tf_scrollbar tf_clearfix sidemenu sidemenu-off">

				<?php themify_mobile_menu_start(); // hook ?>

				<a id="menu-icon-close" class="tf_hide" href="#slide-nav"><span class="screen-reader-text"><?php _e( 'Close Menu', 'themify' ); ?></span></a>

				<div class="secondarymenu-wrap tf_clearfix tf_left">

					<div id="searchform-wrap" class="tf_rel tf_right">
						<?php 
						if(!themify_check('setting-exclude_search_form',true)){ 
						    get_search_form(); 
						}
						?>
					</div>

					<div class="social-widget">
						<?php 
						dynamic_sidebar('social-widget');
						themify_theme_feed(array('text'=>'','icon'=>'fas rss'));
						?>
					</div>
					<!-- /.social-widget -->

				</div>
				<!-- /.secondarymenu-wrap -->

				<div id="main-nav-wrap" class="tf_right">
					<nav itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
						<?php themify_menu_nav(); ?>
						<!-- /#main-nav -->
					</nav>
				</div>
				<!-- /#main-nav-wrap -->

				<?php themify_mobile_menu_end(); // hook ?>

			</div><!-- #mobile-menu -->

			<?php themify_header_end(); // hook ?>

		</header>
		<!-- /#header -->

        <?php themify_header_after(); // hook ?>

	</div>
	<!-- /#headerwrap -->

	<div id="body" class="tf_clearfix tf_box tf_overflow">

	    <?php themify_layout_before(); //hook