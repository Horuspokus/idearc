<?php

/**************************************************************************************************
 * Highlight Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Highlight',false ) ) {

	class Themify_Highlight extends Themify_Shortcode_Base {

		protected $post_type = 'highlight';
		protected $tax = 'highlight-category';
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
				'plural' => __('Highlights', 'themify'),
				'singular' => __('Highlight', 'themify'),
			);
			register_post_type( $this->post_type, array(
				'labels' => array(
					'name' => $cpt['plural'],
					'singular_name' => $cpt['singular'],
					'add_new' => __( 'Add New', 'themify' ),
					'add_new_item' => __( 'Add New Highlight', 'themify' ),
					'edit_item' => __( 'Edit Highlight', 'themify' ),
					'new_item' => __( 'New Highlight', 'themify' ),
					'view_item' => __( 'View Highlight', 'themify' ),
					'search_items' => __( 'Search Highlights', 'themify' ),
					'not_found' => __( 'No Highlights found', 'themify' ),
					'not_found_in_trash' => __( 'No Highlights found in Trash', 'themify' ),
					'menu_name' => __( 'Highlights', 'themify' ),
				),
				'supports' => isset($cpt['supports'])? $cpt['supports'] : array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'),
				'hierarchical' => false,
				'public' => true,
				'query_var' => true,
				'can_export' => true,
				'capability_type' => 'post'
			));
			register_taxonomy( $this->tax, array( $this->post_type ), array(
				'labels' => array(
					'name' => sprintf(__( '%s Categories', 'themify' ), $cpt['singular']),
					'singular_name' => sprintf(__( '%s Category', 'themify' ), $cpt['singular'])
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
				'title' => 'yes', // no
				'image' => 'yes', // no
				'image_w' => 144,
				'image_h' => 144,
				'display' => 'content', // excerpt, none
				'more_link' => false, // true goes to post type archive, and admits custom link
				'more_text' => __('More &rarr;', 'themify'),
				'limit' => 6,
				'category' => 'all', // integer category ID
				'order' => 'DESC', // ASC
				'orderby' => 'date', // title, rand
				'style' => 'grid3', // grid4, grid2, list-post
			);
			return do_shortcode( $this->shortcode( shortcode_atts( $attr, $atts )) );
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
			}
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
new Themify_Highlight();