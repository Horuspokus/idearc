<?php

/**
 * Testimonial Meta Box Options
 * @return array
 * @since 1.0.7
 */
if (!function_exists('themify_theme_testimonial_meta_box')) {

    function themify_theme_testimonial_meta_box() {
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
	    // Testimonial Author Name
	    array(
		'name' => 'testimonial_name',
		'title' => __('Author Name', 'themify'),
		'description' => '',
		'type' => 'textbox',
		'meta' => array()
	    ),
	    // Testimonial Title
	    array(
		'name' => 'testimonial_title',
		'title' => __('Title', 'themify'),
		'description' => '',
		'type' => 'textbox',
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
if (!function_exists('themify_theme_get_testimonial_metaboxes')) {

    function themify_theme_get_testimonial_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Testimonial Options', 'themify'),
		'id' => 'testimonial-options',
		'options' => themify_theme_testimonial_meta_box(),
		'pages' => 'testimonial'
	    )
	);
    }

}