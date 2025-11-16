<?php

/**
 * Portfolio Meta Box Options
 * @return array
 * @since 1.0.7
 */
if (!function_exists('themify_theme_portfolio_meta_box')) {

    function themify_theme_portfolio_meta_box() {
	return array(
	    // Layout
	    array(
		'name' => 'layout',
		'title' => __('Sidebar Option', 'themify'),
		'description' => '',
		'type' => 'layout',
		'show_title' => true,
		'meta' => array(
		    array('value' => 'default', 'img' => 'themify/img/default.svg', 'selected' => true, 'title' => __('Default', 'themify')),
		    array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify')),
		    array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
		    array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar ', 'themify'))
		),
		'default' => 'default'
	    ),
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
	    // Gallery Shortcode
	    array(
		'name' => 'gallery_shortcode',
		'title' => __('Slider Gallery', 'themify'),
		'description' => '',
		'type' => 'gallery_shortcode'
	    ),
	    // Media Type
	    array(
		'name' => 'media_type',
		'title' => __('Show Media', 'themify'),
		'description' => __('Show whether the featured image or gallery slider on the index view.', 'themify'),
		'type' => 'dropdown',
		'meta' => array(
		    array(
			'value' => 'slider',
			'name' => __('Slider', 'themify'),
			'selected' => true
		    ),
		    array(
			'value' => 'image',
			'name' => __('Image', 'themify')
		    )
		),
		'default' => 'slider'
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
	    // Hide Title
	    array(
		'name' => 'hide_post_title',
		'title' => __('Post Title', 'themify'),
		'description' => '',
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'default', 'name' => '', 'selected' => true),
		    array('value' => 'yes', 'name' => __('Hide', 'themify')),
		    array('value' => 'no', 'name' => __('Show', 'themify'))
		),
		'default' => 'default'
	    ),
	    // Unlink Post Title
	    array(
		'name' => 'unlink_post_title',
		'title' => __('Post Title Link', 'themify'),
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'default', 'name' => '', 'selected' => true),
		    array('value' => 'yes', 'name' => __('Unlinked', 'themify')),
		    array('value' => 'no', 'name' => __('Linked', 'themify'))
		),
		'default' => 'default'
	    ),
	    // Hide Post Date
	    array(
		'name' => 'hide_post_date',
		'title' => __('Post Date', 'themify'),
		'description' => '',
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'default', 'name' => '', 'selected' => true),
		    array('value' => 'yes', 'name' => __('Hide', 'themify')),
		    array('value' => 'no', 'name' => __('Show', 'themify'))
		),
		'default' => 'default'
	    ),
	    // Hide Post Meta
	    array(
		'name' => 'hide_post_meta',
		'title' => __('Post Meta', 'themify'),
		'description' => '',
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'default', 'name' => '', 'selected' => true),
		    array('value' => 'yes', 'name' => __('Hide', 'themify')),
		    array('value' => 'no', 'name' => __('Show', 'themify'))
		),
		'default' => 'default'
	    ),
	    // Hide Post Image
	    array(
		'name' => 'hide_post_image',
		'title' => __('Featured Image', 'themify'),
		'description' => '',
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'default', 'name' => '', 'selected' => true),
		    array('value' => 'yes', 'name' => __('Hide', 'themify')),
		    array('value' => 'no', 'name' => __('Show', 'themify'))
		),
		'default' => 'default'
	    ),
	    // Unlink Post Image
	    array(
		'name' => 'unlink_post_image',
		'title' => __('Featured Image Link', 'themify'),
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'default', 'name' => '', 'selected' => true),
		    array('value' => 'yes', 'name' => __('Unlinked', 'themify')),
		    array('value' => 'no', 'name' => __('Linked', 'themify'))
		),
		'default' => 'default'
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
/* * ************************************************************************************************
 * Themify Theme Settings Module
 * ************************************************************************************************ */

if (!function_exists('themify_default_portfolio_single_layout')) {

    /**
     * Default Single Portfolio Layout
     * @param array $data
     * @return string
     */
    function themify_default_portfolio_single_layout($data = array()) {
	/**
	 * Associative array containing theme settings
	 * @var array
	 */
	$data = themify_get_data();
	/**
	 * Variable prefix key
	 * @var string
	 */
	$prefix = 'setting-default_portfolio_single_';
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

	$layout = isset($data[$prefix . 'layout']) ? $data[$prefix . 'layout'] : '';

	/**
	 * Sidebar Layout Options
	 * @var array
	 */
	$sidebar_options = array(
	    array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify')),
	    array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
	    array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'selected' => true, 'title' => __('No Sidebar', 'themify')),
	);

	/**
	 * HTML for settings panel
	 * @var string
	 */
	$output = '<p>
						<span class="label">' . __('Portfolio Sidebar Option', 'themify') . '</span>';
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
	$output .= '<p>
						<span class="label">' . __('Portfolio Title', 'themify') . '</span>
						<select name="' . $prefix . 'title">' .
		themify_options_module($show_hide_options, $prefix . 'title') . '
						</select>
					</p>';

	$output .= '<p>
						<span class="label">' . __('Portfolio Title Link', 'themify') . '</span>
						<select name="' . $prefix . 'unlink_post_title">' .
		themify_options_module($unlink_options, $prefix . 'unlink_post_title') . '
						</select>
					</p>';

	// Hide Post Meta /////////////////////////////////////////
	$output .= '<p>
						<span class="label">' . __('Portfolio Meta', 'themify') . '</span>
						<select name="' . $prefix . 'post_meta_category">' .
		themify_options_module($show_hide_options, $prefix . 'post_meta_category', true, '') . '
						</select>
					</p>';

	$output .= '<p>
						<span class="label">' . __('Portfolio Date', 'themify') . '</span>
						<select name="' . $prefix . 'post_date">' .
		themify_options_module($show_hide_options, $prefix . 'post_date') . '
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

	// Portfolio Navigation
	$prefix = 'setting-portfolio_nav_';
	$output .= '
			<p>
				<span class="label">' . __('Portfolio Navigation', 'themify') . '</span>
				<label for="' . $prefix . 'disable">
					<input type="checkbox" id="' . $prefix . 'disable" name="' . $prefix . 'disable" ' . checked(themify_get($prefix . 'disable', '', true), 'on', false) . '/> ' . __('Remove Portfolio Navigation', 'themify') . '
				</label>
				<span class="pushlabel vertical-grouped">
				<label for="' . $prefix . 'same_cat">
					<input type="checkbox" id="' . $prefix . 'same_cat" name="' . $prefix . 'same_cat" ' . checked(themify_get($prefix . 'same_cat', '', true), 'on', false) . '/> ' . __('Show only portfolios in the same category', 'themify') . '
				</label>
				</span>
			</p>';

	$output .= '
			<p>
				<span class="label">' . __('Portfolio Comments', 'themify') . '</span>
				<label for="setting-portfolio_comments">
					<input type="checkbox" id="setting-portfolio_comments" name="setting-portfolio_comments" ' . checked(themify_get('setting-portfolio_comments', '', true), 'on', false) . '/> ' . __('Enable portfolio comments', 'themify') . '
				</label>
			</p>';

	return $output;
    }

}

if (!function_exists('themify_default_portfolio_index_layout')) {

    /**
     * Default Archive Portfolio Layout
     * @param array $data
     * @return string
     */
    function themify_default_portfolio_index_layout($data = array()) {
	/**
	 * Associative array containing theme settings
	 * @var array
	 */
	$data = themify_get_data();
	/**
	 * Variable prefix key
	 * @var string
	 */
	$prefix = 'setting-default_portfolio_index_';
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
	 * Sidebar Layout
	 * @var string
	 */
	$layout = isset($data[$prefix . 'layout']) ? $data[$prefix . 'layout'] : '';
	/**
	 * Sidebar Layout Options
	 * @var array
	 */
	$sidebar_options = array(
	    array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify')),
	    array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
	    array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'selected' => true, 'title' => __('No Sidebar', 'themify')),
	);
	/**
	 * Post Layout Options
	 * @var array
	 */
	$post_layout_options = array(
		array('value' => 'grid6','img' => 'images/layout-icons/grid6.png','title' => __('Grid 6', 'themify')),
		array('value' => 'grid5', 'img' => 'images/layout-icons/grid5.png','title' => __('Grid 5', 'themify')),
	    array('value' => 'grid4', 'img' => 'images/layout-icons/grid4.png', 'title' => __('Grid 4', 'themify'), 'selected' => true),
	    array('value' => 'grid3', 'img' => 'images/layout-icons/grid3.png', 'title' => __('Grid 3', 'themify')),
	    array('value' => 'grid2', 'img' => 'images/layout-icons/grid2.png', 'title' => __('Grid 2', 'themify'))
	);
	/**
	 * HTML for settings panel
	 * @var string
	 */
	$output = '<p>
						<span class="label">' . __('Portfolio Sidebar Option', 'themify') . '</span>';
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
	 * Post Layout
	 */
	$output .= '<p>
						<span class="label">' . __('Portfolio Layout', 'themify') . '</span>';

	$val = isset($data[$prefix . 'post_layout']) ? $data[$prefix . 'post_layout'] : '';

	foreach ($post_layout_options as $option) {
	    if (( '' == $val || !$val || !isset($val) ) && ( isset($option['selected']) && $option['selected'] )) {
		$val = $option['value'];
	    }
	    if ($val == $option['value']) {
		$class = "selected";
	    } else {
		$class = "";
	    }
	    $output .= '<a href="#" class="preview-icon ' . $class . '" title="' . $option['title'] . '"><img src="' . THEME_URI . '/' . $option['img'] . '" alt="' . $option['value'] . '"  /></a>';
	}

	$output .= '	<input type="hidden" name="' . $prefix . 'post_layout" class="val" value="' . $val . '" />
					</p>';
	/**
	 * Display Content
	 */
	$output .= '<p>
						<span class="label">' . __('Display Content', 'themify') . '</span>
						<select name="' . $prefix . 'display">' .
		themify_options_module(array(
		    array('name' => __('None', 'themify'), 'value' => 'none'),
		    array('name' => __('Full Content', 'themify'), 'value' => 'content'),
		    array('name' => __('Excerpt', 'themify'), 'value' => 'excerpt')
			), $prefix . 'display') . '
						</select>
					</p>';

	$output .= '<p>
						<span class="label">' . __('Portfolio Title', 'themify') . '</span>
						<select name="' . $prefix . 'title">' .
		themify_options_module($show_hide_options, $prefix . 'title') . '
						</select>
					</p>';

	$output .= '<p>
						<span class="label">' . __('Portfolio Title Link', 'themify') . '</span>
						<select name="' . $prefix . 'unlink_post_title">' .
		themify_options_module($unlink_options, $prefix . 'unlink_post_title') . '
						</select>
					</p>';

	$output .= '<p>
						<span class="label">' . __('Portfolio Lightbox', 'themify') . '</span>
						<label for="' . $prefix . 'disable_lightbox_portfolio">
							<input type="checkbox" id="' . $prefix . 'disable_lightbox_portfolio" name="' . $prefix . 'disable_lightbox_portfolio" ' . checked(themify_get($prefix . 'disable_lightbox_portfolio', '', true), 'on', false) . '/> ' . __('Disable portfolio lightbox (portfolio will open in browser)', 'themify') . '
						</label>
					</p>';

	// Hide Post Meta /////////////////////////////////////////
	$output .= '<p>
						<span class="label">' . __('Portfolio Meta', 'themify') . '</span>
						<select name="' . $prefix . 'post_meta_category">' .
		themify_options_module($show_hide_options, $prefix . 'post_meta_category', true, '') . '
						</select>
					</p>';

	$output .= '<p>
						<span class="label">' . __('Portfolio Date', 'themify') . '</span>
						<select name="' . $prefix . 'post_date">' .
		themify_options_module($show_hide_options, $prefix . 'post_date', true, '') . '
						</select>
					</p>';
	/**
	 * Image Dimensions
	 */
	$output .= '<p>
						<span class="label">' . __('Image Size', 'themify') . '</span>
						<input type="text" class="width2" name="' . $prefix . 'image_post_width" value="' . themify_get($prefix . 'image_post_width', '', true) . '" /> ' . __('width', 'themify') . ' <small>(px)</small>
						<input type="text" class="width2 show_if_enabled_img_php" name="' . $prefix . 'image_post_height" value="' . themify_get($prefix . 'image_post_height', '', true) . '" /> <span class="show_if_enabled_img_php">' . __('height', 'themify') . ' <small>(px)</small></span>
					</p>';
	return $output;
    }

}

if (!function_exists('themify_portfolio_slug')) {

    /**
     * Portfolio Slug
     * @param array $data
     * @return string
     */
    function themify_portfolio_slug($data = array()) {
	$data = themify_get_data();
	$portfolio_slug = isset($data['themify_portfolio_slug']) ? $data['themify_portfolio_slug'] : apply_filters('themify_portfolio_rewrite', 'project');
	$output = '
			<p>
				<span class="label">' . __('Portfolio Base Slug', 'themify') . '</span>
				<input type="text" name="themify_portfolio_slug" value="' . $portfolio_slug . '" class="slug-rewrite">
			</p>';
	$portfolio_category_slug = isset($data['themify_portfolio_category_slug']) ? $data['themify_portfolio_category_slug'] : apply_filters('themify_portfolio_category_rewrite', 'portfolio-category');
	$output .= '
			<p>
				<span class="label">' . __('Portfolio Category Slug', 'themify') . '</span>
				<input type="text" name="themify_portfolio_category_slug" value="' . $portfolio_category_slug . '" class="slug-rewrite">
				<br />
				<span class="pushlabel"><small>' . __('Use only lowercase letters, numbers, underscores and dashes.', 'themify') . '</small></span>
				<br />
				<span class="pushlabel"><small>' . sprintf(__('After changing this, go to <a href="%s">permalinks</a> and click "Save changes" to refresh them.', 'themify'), admin_url('options-permalink.php')) . '</small></span><br />
			</p>';
	return $output;
    }

}

if (!function_exists('themify_portfolio_slider')) {

    /**
     * Creates portfolio slider module
     * @return string
     */
    function themify_portfolio_slider() {

	$prefix = 'setting-portfolio_slider_';

	$auto_options = apply_filters('themify_generic_slider_auto',
		array(
		    __('4 Secs (default)', 'themify') => 4000,
		    __('Off', 'themify') => 'off',
		    __('1 Sec', 'themify') => 1000,
		    __('2 Secs', 'themify') => 2000,
		    __('3 Secs', 'themify') => 3000,
		    __('4 Secs', 'themify') => 4000,
		    __('5 Secs', 'themify') => 5000,
		    __('6 Secs', 'themify') => 6000,
		    __('7 Secs', 'themify') => 7000,
		    __('8 Secs', 'themify') => 8000,
		    __('9 Secs', 'themify') => 9000,
		    __('10 Secs', 'themify') => 10000
		)
	);
	$speed_options = apply_filters('themify_generic_slider_speed',
		array(
		    __('Fast', 'themify') => 500,
		    __('Normal', 'themify') => 1000,
		    __('Slow', 'themify') => 1500
		)
	);
	$effect_options = array(
	    array('name' => __('Scroll', 'themify'), 'value' => 'scroll'),
	    array('name' => __('Fade', 'themify'), 'value' => 'fade')
	);

	/**
	 * Auto Play
	 */
	$output = '<p>
						<span class="label">' . __('Auto Play', 'themify') . '</span>
						<select name="' . $prefix . 'autoplay">';
	foreach ($auto_options as $name => $val) {
	    $output .= '<option value="' . $val . '" ' . selected(themify_get($prefix . 'autoplay', '', true), themify_check($prefix . 'autoplay', true) ? $val : 4000, false) . '>' . $name . '</option>';
	}
	$output .= '	</select>
					</p>';

	/**
	 * Effect
	 */
	$output .= '<p>
						<span class="label">' . __('Effect', 'themify') . '</span>
						<select name="' . $prefix . 'effect">' .
		themify_options_module($effect_options, $prefix . 'effect') . '
						</select>
					</p>';

	/**
	 * Transition Speed
	 */
	$output .= '<p>
						<span class="label">' . __('Transition Speed', 'themify') . '</span>
						<select name="' . $prefix . 'transition_speed">';
	foreach ($speed_options as $name => $val) {
	    $output .= '<option value="' . $val . '" ' . selected(themify_get($prefix . 'transition_speed', '', true), themify_check($prefix . 'transition_speed', true) ? $val : 500, false) . '>' . $name . '</option>';
	}
	$output .= '	</select>
					</p>';

	/**
	 * Visible Items
	 */
	$visible_items = themify_get($prefix . 'visible', '1', true);
	$output .= '<p>
						<span class="label">' . __('Visible Items', 'themify') . '</span>
						<input type="text" name="' . $prefix . 'visible" value="' . $visible_items . '">
						<span class="pushlabel"><small>' . __('Enter the number of visible items at the same time in the slider.', 'themify') . '</small></span>
					</p>';

	/**
	 * Scroll Items
	 */
	$scroll_items = themify_get($prefix . 'scroll', '1', true);
	$output .= '<p>
						<span class="label">' . __('Items to Scroll', 'themify') . '</span>
						<input type="text" name="' . $prefix . 'scroll" value="' . $scroll_items . '">
						<span class="pushlabel"><small>' . __('Enter the number of items to scroll at the same time in the slider.', 'themify') . '</small></span>
					</p>';

	return apply_filters('themify_portfolio_slider', $output);
    }

}

if (!function_exists('themify_theme_get_portfolio_metaboxes')) {

    function themify_theme_get_portfolio_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Portfolio Options', 'themify'),
		'id' => 'portfolio-options',
		'options' => themify_theme_portfolio_meta_box(),
		'pages' => 'portfolio'
	    )
	);
    }

}
