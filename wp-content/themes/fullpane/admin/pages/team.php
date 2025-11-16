<?php

/**
 * Team Meta Box Options
 * @return array
 * @since 1.0.7
 */
if (!function_exists('themify_theme_team_meta_box')) {

    function themify_theme_team_meta_box() {
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
	    // Team Title
	    array(
		'name' => 'team_title',
		'title' => __('Team Member Position', 'themify'),
		'description' => '',
		'type' => 'textbox',
		'meta' => array()
	    ),
	    // Skills
	    array(
		'name' => 'skills',
		'title' => __('Skill Set', 'themify'),
		'description' => '',
		'type' => 'textarea'
	    ),
	    // Social links
	    array(
		'name' => 'social',
		'title' => __('Social Links', 'themify'),
		'description' => '',
		'type' => 'textarea'
	    )
	);
    }

}
/* * ************************************************************************************************
 * Themify Theme Settings Module
 * ************************************************************************************************ */

if (!function_exists('themify_default_team_single_layout')) {

    /**
     * Default Single Team Layout
     * @param array $data
     * @return string
     */
    function themify_default_team_single_layout($data = array()) {
	/**
	 * Associative array containing theme settings
	 * @var array
	 */
	$data = themify_get_data();

	/**
	 * Sidebar Layout Options
	 * @var array
	 */
	$sidebar_options = array(
	    array(
		'value' => 'sidebar1',
		'img' => 'images/layout-icons/sidebar1.png',
		'title' => __('Sidebar Right', 'themify')
	    ),
	    array(
		'value' => 'sidebar1 sidebar-left',
		'img' => 'images/layout-icons/sidebar1-left.png',
		'title' => __('Sidebar Left', 'themify')
	    ),
	    array(
		'value' => 'sidebar-none',
		'img' => 'images/layout-icons/sidebar-none.png',
		'title' => __('No Sidebar', 'themify'),
		'selected' => true
	    )
	);

	/**
	 * Variable prefix key
	 * @var string
	 */
	$prefix = 'setting-default_team_single_';

	/**
	 * Sidebar Layout
	 * @var string
	 */
	$layout = isset($data[$prefix . 'layout']) ? $data[$prefix . 'layout'] : '';

	/**
	 * Basic default options '', 'yes', 'no'
	 * @var array
	 */
	$default_options = array(
	    array('name' => '', 'value' => ''),
	    array('name' => __('Yes', 'themify'), 'value' => 'yes'),
	    array('name' => __('No', 'themify'), 'value' => 'no')
	);

 	$show_hide_options = array(
		array('name'=>__('Show', 'themify'),'value'=>'no'),
		array('name'=>__('Hide', 'themify'),'value'=>'yes'),
	);

	$unlink_options = [
		[ 'name' => __('Linked', 'themify'), 'value' => 'no' ],
		[ 'name' => __('Unlinked', 'themify'), 'value' => 'yes' ],
	];

	/**
	 * HTML for settings panel
	 * @var string
	 */
	$output = '';

	/**
	 * Sidebar Layout
	 */
	$output .= '<p>
						<span class="label">' . __('Team Sidebar Option', 'themify') . '</span>';
	foreach ($sidebar_options as $option) {
	    if (( '' == $layout || !$layout || !isset($layout) ) && ( isset($option['selected']) && $option['selected'] )) {
		$layout = $option['value'];
	    }
	    if ($layout == $option['value']) {
		$class = 'selected';
	    } else {
		$class = '';
	    }
	    $output .= '<a href="#" class="preview-icon ' . $class . '" title="' . $option['title'] . '"><img src="' . THEME_URI . '/' . $option['img'] . '" alt="' . $option['value'] . '"  /></a>';
	}
	$output .= '<input type="hidden" name="' . $prefix . 'layout" class="val" value="' . $layout . '" />';
	$output .= '</p>';

	/**
	 * Hide Team Title
	 */
	$output .= '<p>
						<span class="label">' . __('Team Title', 'themify') . '</span>
						<select name="' . $prefix . 'hide_title">' .
		themify_options_module($show_hide_options, $prefix . 'hide_title') . '
						</select>
					</p>';

	/**
	 * Unlink Team Title
	 */
	$output .= '<p>
						<span class="label">' . __('Team Title Link', 'themify') . '</span>
						<select name="' . $prefix . 'unlink_title">' .
		themify_options_module($unlink_options, $prefix . 'unlink_title') . '
						</select>
					</p>';
	/**
	 * Hide Featured Image
	 */
	$output .= '<p>
						<span class="label">' . __('Featured Image', 'themify') . '</span>
						<select name="' . $prefix . 'hide_image">' .
		themify_options_module($show_hide_options, $prefix . 'hide_image') . '
						</select>
					</p>';

	/**
	 * Unlink Featured Image
	 */
	$output .= '<p>
						<span class="label">' . __('Featured Image Link', 'themify') . '</span>
						<select name="' . $prefix . 'unlink_image">' .
		themify_options_module($unlink_options, $prefix . 'unlink_image') . '
						</select>
					</p>';

	/**
	 * Image Dimensions
	 */
	$output .= '
			<p>
				<span class="label">' . __('Image Size', 'themify') . '</span>
				<input type="text" class="width2" name="' . $prefix . 'image_post_width" value="' . themify_get($prefix . 'image_post_width', '', true) . '" /> ' . __('width', 'themify') . ' <small>(px)</small>
				<input type="text" class="width2 show_if_enabled_img_php" name="' . $prefix . 'image_post_height" value="' . themify_get($prefix . 'image_post_height', '', true) . '" /> <span class="show_if_enabled_img_php">' . __('height', 'themify') . ' <small>(px)</small></span>
			</p>';

	return $output;
    }

}

if (!function_exists('themify_team_slug')) {

    /**
     * Team Slug
     * @param array $data
     * @return string
     */
    function themify_team_slug($data = array()) {
	$data = themify_get_data();
	$team_slug = isset($data['themify_team_slug']) ? $data['themify_team_slug'] : apply_filters('themify_team_rewrite', 'team');
	return '
			<p>
				<span class="label">' . __('Team Base Slug', 'themify') . '</span>
				<input type="text" name="themify_team_slug" value="' . $team_slug . '" class="slug-rewrite">
				<br />
				<span class="pushlabel"><small>' . __('Use only lowercase letters, numbers, underscores and dashes.', 'themify') . '</small></span>
				<br />
				<span class="pushlabel"><small>' . sprintf(__('After changing this, go to <a href="%s">permalinks</a> and click "Save changes" to refresh them.', 'themify'), admin_url('options-permalink.php')) . '</small></span><br />
			</p>';
    }

}

if (!function_exists('themify_theme_get_team_metaboxes')) {

    function themify_theme_get_team_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Team Options', 'themify'),
		'id' => 'team-options',
		'options' => themify_theme_team_meta_box(),
		'pages' => 'team'
	    )
	);
    }

}
