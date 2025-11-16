<?php
/**************************************************************************************************
 * Portfolio Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Portfolio' ,false) ) {

	class Themify_Portfolio extends Themify_Shortcode_Base{

	    protected $post_type = 'portfolio';
	    protected $tax = 'portfolio-category';
	    protected $taxonomies;

		function __construct() {
		    parent::__construct();

		    add_filter( "builder_is_{$this->post_type}_active", '__return_true' );
		    add_filter( 'template_include', array($this,'lightbox'), 1001 ); /* priority 1000 is Builder's lightbox */
		}
		
		function register() {
		    
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
				'unlink_title' => '',
				'unlink_image' => '',
				'image' => 'no', // no
				'image_w' => 221,
				'image_h' => 221,
				'display' => 'none', // excerpt, content
				'post_meta' => '', // yes
				'post_date' => '', // yes
				'more_link' => false, // true goes to post type archive, and admits custom link
				'more_text' => __('More &rarr;', 'themify'),
				'limit' => 4,
				'category' => 'all', // integer category ID
				'order' => 'DESC', // ASC
				'orderby' => 'date', // title, rand
				'style' => 'grid4', // grid4, grid3, grid2, list-post, slider
				'auto' => 'default', // autoplay pause length
				'effect' => 'default', // transition effect
				'speed' => 'default', // transition speed
				'visible' => 'default', // number of items visible at the same time
				'scroll' => 'default', // number of items to scroll at once
				'wrap' => 'default',
				'slider_nav' => 'default',
				'pager' => 'default',
				'sorting' => 'no', // yes
				'paged' => '0', // internal use for pagination, dev: previously was 1
			);
			return do_shortcode( $this->shortcode( shortcode_atts( $attr, $atts )) );
		}

		
		/**
		 * Display an additional column in list
		 * @param array
		 * @return array
		 */
		function type_column_header( $columns ) {
			return $columns;
		}

		/**
		 * Main shortcode rendering
		 * @param array $atts
		 * @return string|void
		 */
		function shortcode($atts = array()){
			if( is_singular('portfolio') ){
				if( '' === $atts['image_w'] ){
					$atts['image_w'] = themify_get('setting-default_portfolio_single_image_post_width',670,true);
				}
				if( '' === $atts['image_h'] ){
					$atts['image_h']  = themify_get('setting-default_portfolio_single_image_post_height',0,true);
				}
				if( '' === $atts['title'] ){
					$atts['title'] = themify_get('setting-default_portfolio_single_title','no',true);
				}
				if( '' === $atts['unlink_title']  ){
					$atts['unlink_title']  = themify_get('setting-default_portfolio_single_unlink_post_title','no',true);
				}
				if( '' === $atts['post_date']  ){
					$atts['post_date']  = themify_get('setting-default_portfolio_index_post_date','yes',true);
				}
				if( '' === $atts['post_meta']  ){
					$atts['post_meta'] = themify_get('setting-default_portfolio_single_meta','yes',true);
				}
			} else {
				if( '' === $atts['image_w'] ){
					$atts['image_w'] = themify_get('setting-default_portfolio_index_image_post_width',221,true);
				}
				if( '' === $atts['image_h']  ){
					$atts['image_h']  = themify_get('setting-default_portfolio_index_image_post_height',221,true);
				}
				if( '' === $atts['title']){
					$atts['title'] = themify_get('setting-default_portfolio_index_title','no',true);
				}
				if( '' === $atts['unlink_title'] ){
					$atts['unlink_title']  = themify_get('setting-default_portfolio_index_unlink_post_title','no',true);
				}
				// Reverse logic
				if( '' === $atts['post_date']  ){
					$atts['post_date']  = themify_get('setting-default_portfolio_index_post_date','yes',true);
				}
				if( '' === $atts['post_meta'] ){
					$atts['post_meta'] =themify_get('setting-default_portfolio_index_post_meta_category','yes',true);
				}
			}
			if($atts['effect']==='default'){
			    $atts['effect'] =themify_get('setting-portfolio_slider_effect','',true);
			}
			if($atts['speed']==='default'){
			    $atts['speed'] =themify_get('setting-portfolio_slider_transition_speed',500,true);
			}
			if($atts['visible']==='default'){
			    $atts['visible'] =themify_get('setting-portfolio_slider_visible',1,true);
			}
			if($atts['scroll']==='default'){
			    $atts['scroll'] =themify_get('setting-portfolio_slider_scroll',1,true);
			}
			if($atts['wrap']==='default'){
			    $atts['wrap'] =themify_get('setting-portfolio_slider_wrap',1,true);
			}
			if($atts['slider_nav']==='default'){
			    $atts['slider_nav'] =themify_get('setting-portfolio_slider_slider_nav',1,true);
			}
			if($atts['pager']==='default'){
			    $atts['pager'] =themify_get('setting-portfolio_slider_pager',1,true);
			}
			return parent::shortcode($atts);
		}

		public function lightbox( $template ){
			if (!empty( $_GET['post_in_lightbox'] )  && is_singular($this->post_type) ) {
				add_filter( 'show_admin_bar', '__return_false' );
				$template = get_template_directory() . '/portfolio-lightbox.php';
			}
			return $template;
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
new Themify_Portfolio();
