<?php

include THEME_DIR.'/admin/panel/settings.php';

/**
 * Appearance Tab for Themify Custom Panel
 * @since 1.0.0
 * @return array
 */
function themify_theme_appearance_meta_box() {
    $states = themify_ternary_states(array(
	'icon_no' => THEMIFY_URI . '/img/ddbtn-check.svg',
	'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.svg',
    ));
    return array(
	// Hide header and footer
	array(
	    'name' => '_multi_layout',
	    'type' => 'multi',
	    'title' => __('Layout', 'themify'),
	    'meta' => array(
		'fields' => array(
		    // Image Width
		    array(
			'name' => 'hide_header',
			'label' => __('Exclude Header', 'themify'),
			'description' => '',
			'type' => 'checkbox',
			'meta' => array('size' => 'small'),
			'before' => '<div>',
			'after' => '</div>',
		    ),
		    // Image Height
		    array(
			'name' => 'hide_footer',
			'label' => __('Exclude Footer', 'themify'),
			'description' => '',
			'type' => 'checkbox',
			'meta' => array('size' => 'small'),
			'before' => '<div>',
			'after' => '</div>',
		    ),
		),
		'description' => '',
		'before' => '',
		'after' => '',
		'separator' => ''
	    )
	),
	// Header Elements
	array(
	    'name' => '_multi_header_elements',
	    'title' => __('Header Elements', 'themify'),
	    'description' => '',
	    'type' => 'multi',
	    'class' => 'hide-if none',
	    'meta' => array(
		'fields' => array(
		    // Show Site Logo
		    array(
			'name' => 'exclude_site_logo',
			'description' => '',
			'title' => __('Site Logo', 'themify'),
			'type' => 'dropdownbutton',
			'states' => $states,
			'class' => 'hide-if none',
			'after' => '<div class="clear"></div>',
		    ),
		    // Show Site Tagline
		    array(
			'name' => 'exclude_site_tagline',
			'description' => '',
			'title' => __('Site Tagline', 'themify'),
			'type' => 'dropdownbutton',
			'states' => $states,
			'class' => 'hide-if none',
			'after' => '<div class="clear"></div>',
		    ),
		    // Show Search Form
		    array(
			'name' => 'exclude_search_form',
			'description' => '',
			'title' => __('Search Form', 'themify'),
			'type' => 'dropdownbutton',
			'states' => $states,
			'class' => 'hide-if none',
			'after' => '<div class="clear"></div>',
		    ),
		    // Show RSS Link
		    array(
			'name' => 'exclude_rss',
			'description' => '',
			'title' => __('RSS Link', 'themify'),
			'type' => 'dropdownbutton',
			'states' => $states,
			'class' => 'hide-if none',
			'after' => '<div class="clear"></div>',
		    ),
		    // Show Social Widget
		    array(
			'name' => 'exclude_social_widget',
			'description' => '',
			'title' => __('Social Widget', 'themify'),
			'type' => 'dropdownbutton',
			'states' => $states,
			'class' => 'hide-if none',
			'after' => '<div class="clear"></div>',
		    ),
		    // Show Menu Navigation
		    array(
			'name' => 'exclude_menu_navigation',
			'description' => '',
			'title' => __('Menu Navigation', 'themify'),
			'type' => 'dropdownbutton',
			'states' => $states,
			'class' => 'hide-if none',
			'after' => '<div class="clear"></div>',
		    ),
		),
		'description' => '',
		'before' => '',
		'after' => '<div class="clear"></div>',
		'separator' => ''
	    )
	),
	// Header Wrap
	array(
	    'name' => 'header_wrap',
	    'title' => __('Header Background', 'themify'),
	    'description' => '',
	    'type' => 'radio',
	    'show_title' => true,
	    'meta' => array(
		array(
		    'value' => 'solid',
		    'name' => __('Solid Background', 'themify'),
		    'selected' => true
		),
		array(
		    'value' => 'transparent',
		    'name' => __('Transparent Background', 'themify')
		),
	    ),
	    'enable_toggle' => true,
	    'class' => 'hide-if none',
	),
	// Background Color
	array(
	    'name' => 'background_color',
	    'title' => '',
	    'description' => '',
	    'type' => 'color',
	    'meta' => array('default' => null),
	    'toggle' => 'solid-toggle',
	    'class' => 'hide-if none',
	),
	// Background image
	array(
	    'name' => 'background_image',
	    'title' => '',
	    'type' => 'image',
	    'description' => '',
	    'meta' => array(),
	    'before' => '',
	    'after' => '',
	    'toggle' => 'solid-toggle',
	    'class' => 'hide-if none',
	),
	// Background repeat
	array(
	    'name' => 'background_repeat',
	    'title' => '',
	    'description' => __('Background Repeat', 'themify'),
	    'type' => 'dropdown',
	    'meta' => array(
		array(
		    'value' => 'fullcover',
		    'name' => __('Fullcover', 'themify')
		),
		array(
		    'value' => 'repeat',
		    'name' => __('Repeat', 'themify')
		),
		array(
		    'value' => 'repeat-x',
		    'name' => __('Repeat horizontally', 'themify')
		),
		array(
		    'value' => 'repeat-y',
		    'name' => __('Repeat vertically', 'themify')
		),
	    ),
	    'toggle' => 'solid-toggle',
	    'class' => 'hide-if none',
	),
	// Header wrap text color
	array(
	    'name' => 'headerwrap_text_color',
	    'title' => __('Header Text Color', 'themify'),
	    'description' => '',
	    'type' => 'color',
	    'meta' => array('default' => null),
	    'class' => 'hide-if none',
	),
	// Header wrap link color
	array(
	    'name' => 'headerwrap_link_color',
	    'title' => __('Header Link Color', 'themify'),
	    'description' => '',
	    'type' => 'color',
	    'meta' => array('default' => null),
	    'class' => 'hide-if none',
	),
    );
}

function themify_theme_setup_metaboxes($meta_boxes=array(), $post_type='all') {
    $supportedTypes=array('post', 'page','portfolio', 'product');
    $dir=THEME_DIR . '/admin/pages/';
    if($post_type==='all'){
	foreach($supportedTypes as $s){
	    require_once( $dir . "$s.php" );
	}
	return $meta_boxes;
    }
    if (!in_array($post_type, $supportedTypes, true)) {
	return $meta_boxes;
    }
    if($post_type==='page'){
	wp_enqueue_script( 'themify-theme-custom-panel', THEME_URI . '/admin/js/themify-custom-panel.js', array( 'jquery' ),Themify_Enqueue_Assets::$themeVersion,true );
    }
    require_once( $dir . "$post_type.php" );
    if($post_type==='product'){
	return $meta_boxes;
    }
    $theme_metaboxes = call_user_func_array( "themify_theme_get_{$post_type}_metaboxes", array( array(), &$meta_boxes ) );

    return array_merge($theme_metaboxes, $meta_boxes);
}

/**
 * Register plugins required for the theme
 *
 * @since 1.0.0
 */
function themify_theme_register_required_plugins( $plugins ) {
	$plugins[] = array(
		'name'               => __( ' Themify Portfolio Posts', 'themify' ),
		'slug'               => 'themify-portfolio-post',
		'source'             => 'https://themify.me/files/themify-portfolio-post/themify-portfolio-post.zip',
		'required'           => true,
		'version'            => '1.0.0',
		'force_activation'   => false,
		'force_deactivation' => false,
	);
	return $plugins;
}

add_filter( 'themify_theme_required_plugins', 'themify_theme_register_required_plugins' );
if(isset( $_GET['page'] ) && $_GET['page']==='themify'){
    themify_theme_setup_metaboxes();
}
else{
    add_filter('themify_metabox/fields/themify-meta-boxes', 'themify_theme_setup_metaboxes', 10, 2);
}
