<?php

/**
 * Gallery Meta Box Options
 * @return array
 * @since 1.0.7
 */
if (!function_exists('themify_theme_gallery_meta_box')) {

    function themify_theme_gallery_meta_box() {
	return array(
	    // Content Width
	    array(
		'name' => 'content_width',
		'title' => __('Content Width', 'themify'),
		'description' => '',
		'type' => 'layout',
		'show_title' => true,
		'meta' => array(
		    array(
			'value' => 'default_width',
			'img' => 'themify/img/default.svg',
			'selected' => true,
			'title' => __('Default', 'themify')
		    ),
		    array(
			'value' => 'full_width',
			'img' => 'themify/img/fullwidth.svg',
			'title' => __('Fullwidth (Builder Page)', 'themify')
		    )
		),
		'default' => 'default_width'
	    ),
	    // Menu Bar Position
	    array(
		'name' => 'menu_bar_position',
		'title' => __('Menu Bar Position', 'themify'),
		'description' => '',
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => '', 'name' => '', 'selected' => true),
		    array(
			'value' => 'menubar-bottom',
			'name' => __('Menu bar at bottom', 'themify')
		    ),
		    array(
			'value' => 'menubar-top',
			'name' => __('Menu bar at the top', 'themify')
		    )
		),
		'default' => ''
	    ),
	    // Featured Image Size
	    array(
		'name' => 'feature_size',
		'title' => __('Image Size', 'themify'),
		'description' => sprintf(__('Image sizes can be set at <a href="%s">Media Settings</a> and <a href="%s" target="_blank">Regenerated</a>', 'themify'), 'options-media.php', 'https://wordpress.org/plugins/regenerate-thumbnails/'),
		'type' => 'featimgdropdown',
		'display_callback' => 'themify_is_image_script_disabled'
	    ),
	    // Multi field: Image Dimension
	    themify_image_dimensions_field(),
	    // Gallery Shortcode
	    array(
		'name' => 'gallery_shortcode',
		'title' => __('Gallery', 'themify'),
		'description' => '',
		'type' => 'gallery_shortcode',
	    )
	);
    }

}
if (!function_exists('themify_theme_get_gallery_metaboxes')) {

    function themify_theme_get_gallery_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Gallery Options', 'themify'),
		'id' => 'gallery-options',
		'options' => themify_theme_gallery_meta_box(),
		'pages' => 'gallery'
	    )
	);
    }

}
