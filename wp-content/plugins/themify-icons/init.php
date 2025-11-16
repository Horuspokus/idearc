<?php
/*
Plugin Name:  Themify Icons Plugin
Plugin URI:   https://themify.me/themify-icons
Version:      2.0.4 
Author:       Themify
Description:  Insert the Themify Icons easily in your post-content, WordPress menus, and widget titles.
Text Domain:  themify-icons
Domain Path:  /languages
Requires PHP: 7.2
Compatibility: 5.0.0
*/

if ( !defined( 'ABSPATH' ) ) exit;

class Themify_Icons {

    const THEMIFY_ICONS_VERSION='2.0.4';

	public static function init() {
		load_plugin_textdomain( 'themify-icons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		if ( ! defined( 'THEMIFY_ICONS_DIR' ) ){
			define( 'THEMIFY_ICONS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		}
		if ( ! defined( 'THEMIFYICONS_URI' ) ){
			define( 'THEMIFY_ICONS_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
		}

		if ( is_admin() ) {
			include( THEMIFY_ICONS_DIR . 'includes/admin.php' );
			include( THEMIFY_ICONS_DIR . 'includes/icon-picker.php' );
		}
		include( THEMIFY_ICONS_DIR . 'includes/tinymce.php' );
		Themify_Icons_TinyMCE::init();
		if ( ! self::is_themify_theme() ) {
			include( THEMIFY_ICONS_DIR . 'includes/menu-icons.php' );
		}
		include( THEMIFY_ICONS_DIR . 'includes/widget-icons.php' );
		include( THEMIFY_ICONS_DIR . 'includes/functions.php' );
		include( THEMIFY_ICONS_DIR . 'includes/shortcode.php' );

		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue' ] );
	}

	public static function enqueue() {
		wp_register_style( 'themify-icons', THEMIFY_ICONS_URI . 'assets/themify-icons/themify-icons.css', null, self::THEMIFY_ICONS_VERSION );
		wp_register_style( 'themify-icons-frontend', THEMIFY_ICONS_URI . 'assets/styles.css', array( 'themify-icons' ), self::THEMIFY_ICONS_VERSION );
	}

	public static function admin_enqueue( $hook_suffix='' ) {
		self::enqueue();
		wp_enqueue_style( 'themify-icons' );
		wp_enqueue_style( 'themify-icons-frontend' );
		wp_enqueue_script( 'themify-icons-picker', THEMIFY_ICONS_URI . 'assets/icon-picker.js', [ 'jquery' ], self::THEMIFY_ICONS_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );

		wp_localize_script( 'themify-icons-picker', 'themifyIconsPlugin', array(
			'css' => THEMIFY_ICONS_URI . "assets/icon-picker.css",
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		));
	}

	public static function is_themify_theme() {
		return is_file( get_template_directory() . '/themify/themify-utils.php' );
	}
}
add_action( 'init', [ 'Themify_Icons', 'init' ] );
