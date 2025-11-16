<?php

/**
 * Default Index Product Layout
 *
 * @param array $data
 *
 * @return string
 */
function themify_default_product_index_layout($data = array()) {

    /**
     * Default options 'yes', 'no'
     *
     * @var array
     */
    $binary_options = array(
	array('name' => __('Yes', 'themify'), 'value' => 'yes'),
	array('name' => __('No', 'themify'), 'value' => 'no')
    );

    /**
     * HTML for settings panel
     *
     * @var string
     */
    $output = '';

    $options = array(
	array(
	    'name' => 'product_disable_masonry',
	    'label' => __('Enable Masonry Layout', 'themify'),
	    'desc' => __('Masonry produces the post stacking layout (products are placed above each other)', 'themify'),
	),
	array(
	    'name' => 'product_archive_hide_image',
	    'label' => __('Show Image', 'themify'),
	    'desc' => '',
	),
	array(
	    'name' => 'product_archive_hide_title',
	    'label' => __('Show Title', 'themify'),
	    'desc' => '',
	),
	array(
	    'name' => 'product_archive_hide_price',
	    'label' => __('Show Price', 'themify'),
	    'desc' => '',
	),
	array(
	    'name' => 'product_archive_hide_rating',
	    'label' => __('Show Rating', 'themify'),
	    'desc' => '',
	),
	array(
	    'name' => 'product_archive_hide_add_to_cart',
	    'label' => __('Show Add To Cart', 'themify'),
	    'desc' => '',
	),
    );

    foreach ($options as $option) {
	$output .= '<p>
							<span class="label">' . esc_attr($option['label']) . '</span>
							<select name="setting-' . esc_attr($option['name']) . '">' . themify_options_module($binary_options, 'setting-' . $option['name']) . '
							</select>';
	if (!empty($option['desc'])) {
	    $output .= '<br/><small>' . wp_kses_post($option['desc']) . '</small>';
	}
	$output .= '</p>';
    }

    return $output;
}
