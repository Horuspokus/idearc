<?php


if ( ! function_exists( 'themify_theme_get_gallery_category_terms' ) ) {
	/**
	 * Displays a list of current gallery categories
	 * @return array of name/value arrays
	 * @since 1.0.0
	 */
	function themify_theme_get_gallery_category_terms() {
		$backgrounds = array();
		$backgrounds[] = array( 'name' => __( 'All Categories', 'themify' ), 'value' => 0 );
		$bgs = get_terms( 'gallery-category' );
		if ( ! empty( $bgs ) ) {
			foreach ( $bgs as $gallery ) {
				$backgrounds[] = array(
					'name' => $gallery->name,
					'value' => $gallery->slug
				);
			}
		}
		return $backgrounds;
	}
}
/**
 * Section Meta Box Options
 * @return array
 * @since 1.0.7
 */
if (!function_exists('themify_theme_section_meta_box')) {

    function themify_theme_section_meta_box() {
	return array(
	    // Section Width
	    array(
		'name' => 'section_width',
		'title' => __('Section Width', 'themify'),
		'description' => '',
		'type' => 'layout',
		'show_title' => true,
		'meta' => array(
		    array('value' => 'default', 'img' => 'themify/img/default.svg', 'selected' => true, 'title' => __('Default', 'themify')),
		    array('value' => 'fullwidth', 'img' => 'images/layout-icons/slider-image-only.png', 'title' => __('Fullwidth', 'themify'))
		),
		'default' => 'default'
	    ),
	    // Section Type
	    array(
		'name' => 'section_type',
		'title' => __('Section Type', 'themify'),
		'description' => '',
		'type' => 'layout',
		'show_title' => true,
		'meta' => array(
		    array('value' => 'default', 'img' => 'themify/img/default.svg', 'selected' => true, 'title' => __('Default', 'themify')),
		    array('value' => 'message', 'img' => 'images/layout-icons/type-text.png', 'selected' => true, 'title' => __('Message', 'themify')),
		    array('value' => 'video', 'img' => 'images/layout-icons/type-video.png', 'title' => __('Video', 'themify')),
		    array('value' => 'gallery', 'img' => 'images/layout-icons/grid4.png', 'title' => __('Gallery', 'themify')),
		    array('value' => 'gallery_posts', 'img' => 'images/layout-icons/grid3.png', 'title' => __('Gallery Posts', 'themify')),
		),
		'enable_toggle' => true,
		'default' => 'default'
	    ),
	    // Gallery Shortcode
	    array(
		'name' => 'gallery_shortcode',
		'title' => __('Gallery', 'themify'),
		'description' => '',
		'type' => 'gallery_shortcode',
		'toggle' => 'gallery-toggle'
	    ),
	    // Gallery Posts
	    array(
		'name' => 'gallery_posts',
		'title' => __('Gallery Posts', 'themify'),
		'description' => '<br />' . sprintf(__('Add more <a href="%s">Gallery Posts</a>', 'themify'), admin_url('post-new.php?post_type=gallery')),
		'type' => 'dropdown',
		'toggle' => 'gallery_posts-toggle',
		'meta' => 'themify_theme_get_gallery_category_terms'
	    ),
	    // Gallery background mode
	    array(
		'name' => 'gallery_stretch',
		'title' => __('Gallery Mode', 'themify'),
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'cover', 'name' => __('Full Cover', 'themify'), 'selected' => true),
		    array('value' => 'best-fit', 'name' => __('Best Fit', 'themify'))
		),
		'before' => '',
		'after' => '',
		'toggle' => array('gallery-toggle', 'gallery_posts-toggle'),
		'default' => 'cover'
	    ),
	    // Gallery Slider Controls
	    array(
		'type' => 'multi',
		'name' => '_gallery_slider_controls',
		'title' => __('Slider Controls', 'themify'),
		'meta' => array(
		    'fields' => array(
			// Slider Speed
			array(
			    'name' => 'gallery_autoplay',
			    'label' => '',
			    'description' => '',
			    'type' => 'dropdown',
			    'meta' => array(
				array('value' => 'off', 'name' => __('Off', 'themify')),
				array('value' => 1000, 'name' => __('1 Sec', 'themify')),
				array('value' => 2000, 'name' => __('2 Sec', 'themify')),
				array('value' => 3000, 'name' => __('3 Sec', 'themify')),
				array('value' => 4000, 'name' => __('4 Secs', 'themify'), 'selected' => true),
				array('value' => 5000, 'name' => __('5 Sec', 'themify')),
				array('value' => 6000, 'name' => __('6 Sec', 'themify')),
				array('value' => 7000, 'name' => __('7 Sec', 'themify')),
				array('value' => 8000, 'name' => __('8 Sec', 'themify')),
				array('value' => 9000, 'name' => __('9 Sec', 'themify')),
				array('value' => 10000, 'name' => __('10 Sec', 'themify')),
			    ),
			    'before' => __('Auto Play', 'themify') . '<br/> ',
			    'after' => '',
			    'default' => 'off'
			),
			// Slider Transition Speed
			array(
			    'name' => 'gallery_transition',
			    'label' => '',
			    'description' => '',
			    'type' => 'dropdown',
			    'meta' => array(
				array('value' => 500, 'name' => __('Fast', 'themify')),
				array('value' => 1000, 'name' => __('Normal', 'themify'), 'selected' => true),
				array('value' => 1500, 'name' => __('Slow', 'themify')),
			    ),
			    'before' => '<p>' . __('Transition Speed', 'themify') . '<br/> ',
			    'after' => '</p>',
			    'default' => '1000'
			),
		    ),
		    'description' => '',
		    'before' => '',
		    'after' => '',
		    'separator' => ''
		),
		'toggle' => array('gallery-toggle', 'gallery_posts-toggle')
	    ),
	    // Hide Timer
	    array(
		'name' => 'hide_timer',
		'title' => __('Hide Gallery Timer', 'themify'),
		'description' => __('Timer bar is only visible if auto play is on.', 'themify'),
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'default', 'name' => '', 'selected' => true),
		    array('value' => 'yes', 'name' => __('Yes', 'themify')),
		    array('value' => 'no', 'name' => __('No', 'themify'))
		),
		'toggle' => array('gallery-toggle', 'gallery_posts-toggle'),
		'default' => 'default'
	    ),
	    // Video URL
	    array(
		'name' => 'video_url',
		'title' => __('Video URL', 'themify'),
		'description' => __('Video embed URL such as YouTube or Vimeo video url (<a href="https://themify.me/docs/video-embeds">details</a>).', 'themify'),
		'type' => 'textbox',
		'meta' => array(),
		'toggle' => 'video-toggle',
	    ),
	    // Hide Section Title
	    array(
		'name' => 'hide_section_title',
		'title' => __('Section Title', 'themify'),
		'description' => '',
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'default', 'name' => '', 'selected' => true),
		    array('value' => 'yes', 'name' => __('Hide', 'themify')),
		    array('value' => 'no', 'name' => __('Show', 'themify'))
		),
		'default' => 'default'
	    ),
	    // Separator
	    array(
		'name' => 'separator_section_title_font',
		'title' => '',
		'description' => '',
		'type' => 'separator',
		'meta' => array('html' => '<h4>' . __('Section Title Font', 'themify') . '</h4><hr class="meta_fields_separator"/>'),
	    ),
	    // Multi field: Font
	    array(
		'type' => 'multi',
		'name' => '_font_title',
		'title' => __('Font', 'themify'),
		'meta' => array(
		    'fields' => array(
			// Font size
			array(
			    'name' => 'title_font_size',
			    'label' => '',
			    'description' => '',
			    'type' => 'textbox',
			    'meta' => array('size' => 'small'),
			    'before' => '',
			    'after' => ''
			),
			// Font size unit
			array(
			    'name' => 'title_font_size_unit',
			    'label' => '',
			    'type' => 'dropdown',
			    'meta' => array(
				array('value' => 'px', 'name' => __('px', 'themify'), 'selected' => true),
				array('value' => 'em', 'name' => __('em', 'themify'))
			    ),
			    'before' => '',
			    'after' => '',
			    'default' => 'px'
			),
			// Font family
			array(
			    'name' => 'title_font_family',
			    'label' => '',
			    'type' => 'dropdown',
			    'meta' => array_merge(themify_get_web_safe_font_list(), themify_get_google_web_fonts_list()),
			    'before' => '',
			    'after' => '',
			),
		    ),
		    'description' => '',
		    'before' => '',
		    'after' => '',
		    'separator' => ''
		)
	    ),
	    // Font Color
	    array(
		'name' => 'title_font_color',
		'title' => __('Font Color', 'themify'),
		'description' => '',
		'type' => 'color',
		'meta' => array('default' => null),
	    ),
	    // Separator
	    array(
		'name' => 'separator_font',
		'title' => '',
		'description' => '',
		'type' => 'separator',
		'meta' => array('html' => '<h4>' . __('Section Font', 'themify') . '</h4><hr class="meta_fields_separator"/>'),
	    ),
	    // Multi field: Font
	    array(
		'type' => 'multi',
		'name' => '_font',
		'title' => __('Font', 'themify'),
		'meta' => array(
		    'fields' => array(
			// Font size
			array(
			    'name' => 'font_size',
			    'label' => '',
			    'description' => '',
			    'type' => 'textbox',
			    'meta' => array('size' => 'small'),
			    'before' => '',
			    'after' => ''
			),
			// Font size unit
			array(
			    'name' => 'font_size_unit',
			    'label' => '',
			    'type' => 'dropdown',
			    'meta' => array(
				array('value' => 'px', 'name' => __('px', 'themify'), 'selected' => true),
				array('value' => 'em', 'name' => __('em', 'themify'))
			    ),
			    'before' => '',
			    'after' => '',
			    'default' => 'px'
			),
			// Font family
			array(
			    'name' => 'font_family',
			    'label' => '',
			    'type' => 'dropdown',
			    'meta' => array_merge(themify_get_web_safe_font_list(), themify_get_google_web_fonts_list()),
			    'before' => '',
			    'after' => '',
			),
		    ),
		    'description' => '',
		    'before' => '',
		    'after' => '',
		    'separator' => ''
		)
	    ),
	    // Font Color
	    array(
		'name' => 'font_color',
		'title' => __('Font Color', 'themify'),
		'description' => '',
		'type' => 'color',
		'meta' => array('default' => null),
	    ),
	    // Link Color
	    array(
		'name' => 'link_color',
		'title' => __('Link Color', 'themify'),
		'description' => '',
		'type' => 'color',
		'meta' => array('default' => null),
	    ),
	    // Separator
	    array(
		'name' => 'separator',
		'title' => '',
		'description' => '',
		'type' => 'separator',
		'meta' => array('html' => '<h4>' . __('Section Background', 'themify') . '</h4><hr class="meta_fields_separator"/>'),
	    ),
	    // Background Color
	    array(
		'name' => 'background_color',
		'title' => __('Background Color', 'themify'),
		'description' => '',
		'type' => 'color',
		'meta' => array('default' => null),
	    ),
	    // Backgroud image
	    array(
		'name' => 'background_image',
		'title' => '',
		'type' => 'image',
		'description' => '',
		'meta' => array(),
		'before' => '',
		'after' => ''
	    ),
	    // Background repeat
	    array(
		'name' => 'background_repeat',
		'title' => __('Background Repeat', 'themify'),
		'description' => '',
		'type' => 'dropdown',
		'meta' => array(
		    array('value' => 'fullcover', 'name' => __('Fullcover', 'themify')),
		    array('value' => 'repeat', 'name' => __('Repeat', 'themify')),
		    array('value' => 'repeat-x', 'name' => __('Repeat horizontally', 'themify')),
		    array('value' => 'repeat-y', 'name' => __('Repeat vertically', 'themify')),
		    array('value' => 'no-repeat', 'name' => __('Do not repeat', 'themify'))
		),
		'default' => 'fullcover'
	    )
	);
    }

}
if (!function_exists('themify_theme_get_section_metaboxes')) {

    function themify_theme_get_section_metaboxes(array $args, &$meta_boxes) {
	return array(
	    array(
		'name' => __('Section Options', 'themify'),
		'id' => 'section-options',
		'options' => themify_theme_section_meta_box(),
		'pages' => 'section'
	    )
	);
    }

}
