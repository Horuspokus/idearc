<?php

include THEME_DIR.'/admin/panel/settings.php';

function themify_theme_setup_metaboxes($meta_boxes=array(), $post_type='all') {
    $supportedTypes=array('post', 'page', 'highlight', 'team', 'portfolio', 'section', 'testimonial', 'gallery');
    $dir=THEME_DIR . '/admin/pages/';
    if($post_type==='all'){
	foreach($supportedTypes as $s){
	    require_once( $dir . "$s.php" );
	}
	return $meta_boxes;
    }
    if(!in_array($post_type,$supportedTypes,true)){
	return $meta_boxes;
    }
    if($post_type==='page'){
	wp_enqueue_script( 'themify-theme-custom-panel', THEME_URI . '/admin/js/themify-custom-panel.js', null,Themify_Enqueue_Assets::$themeVersion,true );
    }
    require_once( $dir . "$post_type.php" );
    $theme_metaboxes = call_user_func_array( "themify_theme_get_{$post_type}_metaboxes", array( array(), &$meta_boxes ) );

    return array_merge( $theme_metaboxes, $meta_boxes );
}

/**
 * Removes Query Sections panel from list of panels to build.
 *
 * @since 2.0.0
 *
 * @param $themify_write_panels
 * @return mixed
 */
function themify_theme_remove_query_sections($themify_write_panels) {
    $count = 0;
    foreach ($themify_write_panels as $panel) {
	if ('query-section' === $panel['id']) {
	    unset($themify_write_panels[$count]);
	}
	++$count;
    }
    return $themify_write_panels;
}

/**
 * Removes Sections meta box from Menus screen.
 *
 * @since 2.0.0
 */
function themify_theme_unregister_section_menu() {
    remove_meta_box('section-menu', 'nav-menus', 'side');
}

/**
 * Register plugins required for the theme
 *
 * @since 1.0.0
 */
function themify_theme_register_required_plugins($plugins) {
    $plugins[] = array(
	'name' => __(' Themify Portfolio Posts', 'themify'),
	'slug' => 'themify-portfolio-post',
	'source' => 'https://themify.me/files/themify-portfolio-post/themify-portfolio-post.zip',
	'required' => true,
	'version' => '1.0.0',
	'force_activation' => false,
	'force_deactivation' => false
    );
    return $plugins;
}

if ( ! function_exists( 'themify_theme_default_social_links' ) ) {
	/**
	 * Replace default squared social link icons with circular versions
	 * @param $data
	 * @return mixed
	 * @since 1.0.0
	 */
	function themify_theme_default_social_links( $data ) {
		$pre = 'setting-link_img_themify-link-';
		$data[$pre.'0'] = THEME_URI . '/images/twitter.png';
		$data[$pre.'1'] = THEME_URI . '/images/facebook.png';
		$data[$pre.'2'] = THEME_URI . '/images/google-plus.png';
		$data[$pre.'3'] = THEME_URI . '/images/youtube.png';
		$data[$pre.'4'] = THEME_URI . '/images/pinterest.png';
		return $data;
	}
	add_filter( 'themify_default_social_links', 'themify_theme_default_social_links' );
}
if(isset( $_GET['page'] ) && $_GET['page']==='themify'){
    themify_theme_setup_metaboxes();
}
else{
    add_filter('themify_metabox/fields/themify-meta-boxes', 'themify_theme_setup_metaboxes', 10, 2);
}
// Remove meta box in menu screen
add_action('admin_init', 'themify_theme_unregister_section_menu', 12);

// Remove Query Sections panel in page edit screen
add_filter('themify_do_metaboxes', 'themify_theme_remove_query_sections');

add_filter('themify_theme_required_plugins', 'themify_theme_register_required_plugins');
