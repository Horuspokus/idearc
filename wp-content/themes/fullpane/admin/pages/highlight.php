<?php

/**
 * Highlight Meta Box Options
 * @return array
 * @since 1.0.7
 */
if (!function_exists('themify_theme_highlight_meta_box')) {

    function themify_theme_highlight_meta_box() {
	return array(
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
	    // Bar Percentage
	    array(
		'name' => 'bar_percentage',
		'title' => __('Bar Percentage', 'themify'),
		'description' => __('Enter a value from 0 to 100', 'themify'),
		'type' => 'textbox',
		'meta' => array()
	    ),
	    // Bar Color
	    array(
		'name' => 'bar_color',
		'title' => __('Bar Color', 'themify'),
		'description' => sprintf(__('You can set up the default color at <a href="%s">Styling &gt; Backgrounds</a>.', 'themify'), admin_url('admin.php?page=themify#styling')),
		'type' => 'color',
		'meta' => array('default' => null),
	    ),
	    // External Link
	    array(
		'name' => 'icon',
		'title' => __('Icon', 'themify'),
		'type' => 'fontawesome',
		'meta' => array()
	    ),
	    // External Link
	    array(
		'name' => 'external_link',
		'title' => __('External Link', 'themify'),
		'description' => __('Link Featured Image and Post Title to external URL', 'themify'),
		'type' => 'textbox',
		'meta' => array()
	    ),
	    // Lightbox Link
	    themify_lightbox_link_field()
	);
    }

}
if (!function_exists('themify_theme_get_highlight_metaboxes')) {

    function themify_theme_get_highlight_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Highlight Options', 'themify'),
		'id' => 'highlight-options',
		'options' => themify_theme_highlight_meta_box(),
		'pages' => 'highlight'
	    )
	);
    }

}