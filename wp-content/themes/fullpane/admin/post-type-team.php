<?php
/**************************************************************************************************
 * Team Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Team',false ) ) {

	class Themify_Team extends Themify_Shortcode_Base{

	    protected $post_type = 'team';
	    protected $tax = 'team-category';
	    protected $taxonomies;

		function __construct() {
		    parent::__construct();
		    add_shortcode('progress_bar', array($this, 'progress_bar'));
		    add_shortcode('themify_progress_bar', array($this, 'progress_bar'));
		    add_shortcode($this->post_type . '-social', array($this, 'social'));
		    add_shortcode('themify_'.$this->post_type . '-social', array($this, 'social'));

		    add_filter('themify_default_layout_condition', array( $this, 'sidebar_condition' ), 13);
		    add_filter('themify_default_layout', array( $this, 'sidebar' ), 13);
		}

		/**
		 * Register post type and taxonomy
		 */
		function register() {
			$cpt = array(
				'plural' => __('Teams', 'themify'),
				'singular' => __('Team', 'themify'),
				'rewrite' => themify_get('themify_team_slug',apply_filters('themify_team_rewrite', 'team'),true)
			);
			register_post_type( $this->post_type, array(
				'labels' => array(
					'name' => $cpt['plural'],
					'singular_name' => $cpt['singular'],
					'add_new' => __( 'Add New', 'themify' ),
					'add_new_item' => __( 'Add New Team', 'themify' ),
					'edit_item' => __( 'Edit Team', 'themify' ),
					'new_item' => __( 'New Team', 'themify' ),
					'view_item' => __( 'View Team', 'themify' ),
					'search_items' => __( 'Search Teams', 'themify' ),
					'not_found' => __( 'No Teams found', 'themify' ),
					'not_found_in_trash' => __( 'No Teams found in Trash', 'themify' ),
					'menu_name' => __( 'Teams', 'themify' ),
				),
				'supports' => isset( $cpt['supports'] )? $cpt['supports'] : array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),

				'hierarchical' => false,
				'public' => true,
				'rewrite' => array( 'slug' => $cpt['rewrite'] ),
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
				'unlink_title' => '',
				'unlink_image' => '',
				'image_w' => 90,
				'image_h' => 90,
				'display' => 'content', // excerpt, none
				'more_link' => false, // true goes to post type archive, and admits custom link
				'more_text' => __('More &rarr;', 'themify'),
				'limit' => 4,
				'category' => 'all', // integer category ID
				'order' => 'DESC', // ASC
				'orderby' => 'date', // title, rand
				'style' => 'grid4', // grid3, grid2, list-post, slider
				'auto' => 4000, // autoplay pause length
				'effect' => 'scroll', // transition effect
				'speed' => 500, // transition speed
				'visible' => 1, // number of items visible at the same time
				'scroll' => 1, // number of items to scroll at once
				'wrap' => 'yes',
				'slider_nav' => 'yes',
				'pager' => 'yes'
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


		/**
		 * Progress bar shortcode rendering
		 * @param array $atts
		 * @return string
		 */
		function progress_bar( $atts = array() ) {
			extract( shortcode_atts( array(
				'label' => '',
				'color' => '#02daaf',
				'percentage' => '100'
				), $atts ) );
			$percentage .= strrpos($percentage, '%') === false ? '%' : '';
			return sprintf(
				'<div class="progress-bar">
					<i class="progress-bar-label" style="color:%s;">%s</i>
					<span class="progress-bar-bg" data-percent="%s" style="background-color:%s"></span>
				</div>',
				$color,
				$label,
				$percentage,
				$color
			);
		}

		/**
		 * Social shortcode rendering
		 * @param array $atts
		 * @return string
		 */
		function social( $atts = array() ) {
			extract( shortcode_atts( array(
				'link' => '',
				'image' => '',
				'icon' => '',
				), $atts ) );

			if ( '' != $icon ) {
				$icon = '<i>'.themify_get_icon($icon,'fa') .'</i>';
			}

			if ( '' != $image ) {
				$image = '<img src="' . $image . '" alt="social-link">';
			}

			return sprintf(
				'<a class="team-social-link" href="%s">%s %s</a>',
				$link,
				$icon,
				$image
			);
		}

		/**************************************************************************************************
		 * Body Classes for Portfolio index and single
		 **************************************************************************************************/

		/**
		 * Catches condition to filter body class when it's a singular team view
		 * @param $condition
		 * @return bool
		 */
		function sidebar_condition( $condition ) {
			return $condition || is_singular( 'team' );
		}

		/**
		 * Filters sidebar layout body class to output the correct one when it's a singular team view
		 * @param $class
		 * @return mixed|string
		 */
		function sidebar( $class ) {
			if ( is_singular( 'team' ) ) {
				$class = themify_get( 'setting-default_team_single_layout','sidebar1',true );
			}
			return $class;
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
new Themify_Team();
