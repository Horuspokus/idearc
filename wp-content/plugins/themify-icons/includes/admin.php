<?php

function themify_icons_add_plugin_page() {
	add_menu_page(
		__( 'Themify Icons', 'themify-icons' ),
		__( 'Themify Icons', 'themify-icons' ),
		'manage_options',
		'themify-icons',
		'themify_icons_create_admin_page'
	);
}
add_action( 'admin_menu', 'themify_icons_add_plugin_page' );

function themify_icons_create_admin_page() {
	include( THEMIFY_ICONS_DIR . 'docs/index.html' );
}

function themify_icons_wp_ajax_ti_get_icons() {
	if ( current_user_can( 'edit_theme_options' ) || current_user_can( 'publish_posts' ) ) {
		$icons = Themify_Icons_Icon_Picker::get_icons();
		include THEMIFY_ICONS_DIR . 'templates/icon-picker.php';
		die;
	}
}
add_action( 'wp_ajax_ti_get_icons', 'themify_icons_wp_ajax_ti_get_icons' );

function themify_icons_plugin_meta( $links, $file ) {
	if ( 'themify-icons/init.php' === $file ) {
		$row_meta = array(
		  'changelogs'    => '<a href="https://themify.org/changelogs/themify-icons.txt" target="_blank" aria-label="' . esc_attr__( 'Plugin Changelogs', 'themify-icons' ) . '">' . esc_html__( 'View Changelogs', 'themify-icons' ) . '</a>'
		);
 
		return array_merge( $links, $row_meta );
	}
	return (array) $links;
}
add_filter( 'plugin_row_meta', 'themify_icons_plugin_meta', 10, 2 );
