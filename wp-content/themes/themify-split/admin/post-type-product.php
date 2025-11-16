<?php
/**
 * Functions and modules related to products.
 *
 * @since 1.0.0
 */

if ( themify_is_woocommerce_active() ) {
	// Specific for infinite scroll in WooCommerce archive pages.
	if ( 'infinite' === themify_get( 'setting-more_posts','infinite',true )) {
		// Remove WC standard pagination.
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
		// Add Themify's pagination and infinite scroll.
		add_action( 'woocommerce_after_shop_loop', 'themify_shop_infinite_scroll' );
	}

	add_filter( 'the_title', 'themify_no_product_title' );
	add_filter( 'woocommerce_loop_add_to_cart_link', 'themify_no_product_add_to_cart' );

	if ( themify_get( 'setting-product_archive_hide_image','',true ) == 'no' ) {
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
	}
	if ( themify_get( 'setting-product_archive_hide_rating','',true ) == 'no' ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	}
	if ( themify_get( 'setting-product_archive_hide_price','',true ) == 'no' ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
	}
}

/**
 * Calculates the max number of pages a query will have and sets the number for JS.
 *
 * @since 1.0.0
 */
function themify_shop_infinite_scroll() {
	get_template_part( 'includes/pagination', 'product' );
}

/**
 * Disables title output following the setting applied in shop settings panel
 *
 * @param $button String
 *
 * @return String
 */
function themify_no_product_add_to_cart( $button ) {
	if ( in_the_loop() && themify_is_shop() && themify_get( 'setting-product_archive_hide_add_to_cart',false,true ) === 'no' ) {
		return '';
	}

	return $button;
}

/**
 * Disables add to cart button output following the setting applied in shop settings panel
 *
 * @param $title String
 *
 * @return String
 */
function themify_no_product_title( $title ) {
	if ( in_the_loop() && themify_is_shop() && themify_get( 'setting-product_archive_hide_title',false,true ) === 'no' ) {
		return '';
	}

	return $title;
}