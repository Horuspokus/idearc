<?php

/**************************************************************************************************
 * Testimonial Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Testimonial',false) ) {

	class Themify_Testimonial extends Themify_Shortcode_Base{

		protected $post_type = 'testimonial';
		protected $tax = 'testimonial-category';
		protected $taxonomies;

		function __construct() {
		    parent::__construct();
		    add_filter( "builder_is_{$this->post_type}_active", '__return_true' );
		}

		/**
		 * Register post type and taxonomy
		 */
		function register() {
			$cpt = array(
				'plural' => __('Testimonials', 'themify'),
				'singular' => __('Testimonial', 'themify'),
			);
			register_post_type( $this->post_type, array(
				'labels' => array(
					'name' => $cpt['plural'],
					'singular_name' => $cpt['singular'],
					'add_new' => __( 'Add New', 'themify' ),
					'add_new_item' => __( 'Add New Testimonial', 'themify' ),
					'edit_item' => __( 'Edit Testimonial', 'themify' ),
					'new_item' => __( 'New Testimonial', 'themify' ),
					'view_item' => __( 'View Testimonial', 'themify' ),
					'search_items' => __( 'Search Testimonials', 'themify' ),
					'not_found' => __( 'No Testimonials found', 'themify' ),
					'not_found_in_trash' => __( 'No Testimonials found in Trash', 'themify' ),
					'menu_name' => __( 'Testimonials', 'themify' ),
				),
				'supports' => isset( $cpt['supports'] )? $cpt['supports'] : array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),

				'hierarchical' => false,
				'public' => true,
				'query_var' => true,
				'can_export' => true,
				'capability_type' => 'post'
			));
			register_taxonomy( $this->tax, array( $this->post_type ), array(
				'labels' => array(
					'name' => sprintf( __( '%s Categories', 'themify' ), $cpt['singular'] ),
					'singular_name' => sprintf( __( '%s Category', 'themify' ), $cpt['singular'] )
				),
				'public' => true,
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => true,
				'rewrite' => true,
				'query_var' => true
			));
		}

		/**
		 * Add shortcode to WP
		 * @param $atts Array shortcode attributes
		 * @return String
		 * @since 1.0.0
		 */
		function init_shortcode( $atts ) {
			
			$attr = array(
				'id' => '',
				'title' => 'no', 
				'image' => 'no',
				'image_w' => 144,
				'image_h' => 144,
				'display' => 'content', // excerpt, none
				'more_link' => false, // true goes to post type archive, and admits custom link
				'more_text' => __('More &rarr;', 'themify'),
				'limit' => 4,
				'category' => 'all', // integer category ID
				'order' => 'DESC', // ASC
				'orderby' => 'date', // title, rand
				'style' => 'grid2', // grid3, grid4, list-post, slider
				'show_author' => 'yes', // no
				'auto' => 4000, // autoplay pause length
				'effect' => '', // transition effect
				'speed' => 500, // transition speed
				'wrap' => 'no',
				'slider_nav' => 'no',
				'pager' => 'yes'
			);
			return do_shortcode( $this->shortcode( shortcode_atts( $attr, $atts ), $this->post_type ) );
		}

		/**
		 * Display an additional column in list
		 * @param array
		 * @return array
		 */
		function type_column_header( $columns ) {
			unset( $columns['date'] );
			$columns['icon'] = __('Icon', 'themify');
			$columns['testimonial_name'] = __('Name', 'themify');
			return $columns;
		}

		/**
		 * Display shortcode, type, size and color in columns in tiles list
		 * @param string $column key
		 * @param number $post_id
		 * @return string
		 */
		function type_column( $column, $post_id ) {
			switch( $column ) {
				case 'shortcode' :
					echo '<code>[' . $this->post_type . ' id="' . $post_id . '"]</code>';
					break;

				case 'icon' :
					the_post_thumbnail( array( 50, 50 ) );
					break;

				case 'testimonial_name' :
					echo get_post_meta( $post_id, 'testimonial_name', true );
					break;
			}
		}


		/**
		 * Main shortcode rendering
		 * @param array $atts
		 * @param $post_type
		 * @return string|void
		 */
		function shortcode($atts = array()) {
		    $atts['pager_type']='image_pagination';
		    return parent::shortcode($atts);
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
new Themify_Testimonial();
