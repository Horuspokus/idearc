<?php

function themify_icons_shortcode( $atts, $content = '' ) {
	wp_enqueue_style( 'themify-icons-frontend' );

	extract( shortcode_atts( array(
		'icon' => '',
		'text' => '',
		'link' => '',
		'target' => '',
		'size' => 'default',
		'style' => 'icon-left',
		'background_color' => '',
		'icon_color' => '',
		'text_color' => '',
		'corners' => 'square',
	), $atts, 'themify_icons' ) );

	$classes = array( 'ti_icon', 'size-' . $size, 'corner-' . $corners, $style );
	$presetColors=array( 'white', 'purple', 'pink', 'yellow', 'blue', 'darkblue', 'cyan', 'black' );

	if( $background_color != '' ) {
		if( in_array( $background_color, $presetColors,true ) ) {
			$classes[] = 'bg-color-' . $background_color;
			$background_color = '';
		} else {
			$classes[] = 'bg-color-custom';
			$background_color = 'background-color: '. esc_attr( $background_color) .';';
		}
	}

	if( $text_color != '' ) {
		if( in_array( $text_color, $presetColors,true ) ) {
			$classes[] = 'text-color-' . $text_color;
			$text_color = '';
		} else {
			$classes[] = 'text-color-custom';
			$text_color = ' style="color: '. esc_attr( $text_color ) .'"';
		}
	}

	if( $icon_color != '' ) {
		if( in_array( $icon_color, $presetColors,true ) ) {
			$classes[] = 'icon-color-' . $icon_color;
			$icon_color = '';
		} else {
			$classes[] = 'icon-color-custom';
			$icon_color = 'color: '. $icon_color .';';
		}
	}

	$output = '<span class="'. esc_attr( implode( ' ', $classes ) ) .'"';
	if( $style == 'icon-wrapped' || $style == 'icon-wrapped-top' ) {
		$output .= ' style="' . $background_color . '"';
	}
	$output .= '>';
	if( $link ) {
		$output .= '<a href="'. esc_url( $link ) .'"';
		if( $target ) {
			$output .= ' target="' . esc_attr( $target ) . '"';
		}
		$output .= '>';
	}

	if( $style == 'icon-boxed' || $style == 'icon-boxed-top' ) {
		$icon_color .= $background_color;
	}
	$output .= '<i class="' . esc_attr( themify_icons_get_icon( $icon ) ) . '" style="'. esc_attr( $icon_color ) .'"></i> ';
	if( $text ) {
		$output .= '<span class="icon-text"'. $text_color .'>' . esc_html( $text ) . '</span>';
	}
	if( $link ) {
		$output .= '</a>';
	}
	$output .= '</span>';

	return apply_filters( 'themify_icons_output', $output, $atts );
}
add_shortcode( 'ti_icon', 'themify_icons_shortcode' );