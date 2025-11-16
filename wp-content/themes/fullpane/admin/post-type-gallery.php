<?php

/**************************************************************************************************
 * Gallery Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Gallery' ,false) ) {

	class Themify_Gallery extends Themify_Shortcode_Base{

		protected $post_type = 'gallery';
		protected $tax = 'gallery-category';
		protected $taxonomies;

		function __construct() {
			parent::__construct();

			add_filter( 'themify_gallery_plugins_args', array( $this, 'enable_gallery_area' ) );
			add_filter( 'themify_default_layout_condition', array( $this, 'sidebar_condition' ), 12 );
			add_filter( 'themify_default_layout', array( $this, 'sidebar' ), 12 );
		}

		/**
		 * Initialize gallery content area for fullscreen gallery
		 * @param $args
		 * @return mixed
		 */
		function enable_gallery_area( $args ) {
			$args['contentImagesAreas'] = empty($args['contentImagesAreas']) ? '.type-gallery' : $args['contentImagesAreas'].', .type-gallery';
			return $args;
		}

		/**
		 * Register post type and taxonomy
		 */
		function register() {
			$cpt = array(
				'plural' => __('Galleries', 'themify'),
				'singular' => __('Gallery', 'themify'),
			);
			register_post_type( $this->post_type, array(
				'labels' => array(
					'name' => $cpt['plural'],
					'singular_name' => $cpt['singular'],
					'add_new' => __( 'Add New', 'themify' ),
					'add_new_item' => __( 'Add New Gallery', 'themify' ),
					'edit_item' => __( 'Edit Gallery', 'themify' ),
					'new_item' => __( 'New Gallery', 'themify' ),
					'view_item' => __( 'View Gallery', 'themify' ),
					'search_items' => __( 'Search Galleries', 'themify' ),
					'not_found' => __( 'No Galleries found', 'themify' ),
					'not_found_in_trash' => __( 'No Galleries found in Trash', 'themify' ),
					'menu_name' => __( 'Galleries', 'themify' ),
				),
				'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
				'hierarchical' => false,
				'public' => true,
				'exclude_from_search' => false,
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
			if ( is_admin() ) {
				add_filter( 'attachment_fields_to_edit', array($this, 'attachment_fields_to_edit'), 10, 2 );
				add_action( 'edit_attachment', array($this, 'attachment_fields_to_save'), 10, 2 );
			}
		}

	function attachment_fields_to_edit( $form_fields, $post ) {

		if ( ! preg_match( '!^image/!', get_post_mime_type( $post->ID ) ) ) {
			return $form_fields;
		}

		$include = get_post_meta( $post->ID, 'themify_gallery_featured', true );

		$name = 'attachments[' . $post->ID . '][themify_gallery_featured]';

		$form_fields['themify_gallery_featured'] = array(
			'label' => __( 'Larger', 'themify' ),
			'input' => 'html',
			'helps' => __('Show larger image in the gallery.', 'themify'),
			'html'  => '<span class="setting"><label for="' . $name . '" class="setting"><input type="checkbox" name="' . $name . '" id="' . $name . '" value="featured" ' . checked( $include, 'featured', false ) . ' />' . '</label></span>',
		);

		return $form_fields;
	}

	function attachment_fields_to_save( $attachment_id ) {
		if( isset( $_REQUEST['attachments'][$attachment_id]['themify_gallery_featured'] ) && preg_match( '!^image/!', get_post_mime_type( $attachment_id ) ) ) {
			update_post_meta($attachment_id, 'themify_gallery_featured', 'featured');
		} else {
			update_post_meta($attachment_id, 'themify_gallery_featured', '');
		}
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
				'style' => 'slider', // And only slider
				'auto' => '4000', // off, 1000 - 100000
				'transition' => 'normal', // fast, slow
				'bgmode' => 'cover', // best-fit
			);
			if ( ! isset( $atts['image_w'] ) || '' === $atts['image_w'] ) {
				if ( ! isset( $atts['style'] ) ) {
				    $atts['style'] = $attr['style'];
				}
				if($atts['style']==='slider'){
				    $attr['image_w']=1280;
				    $attr['image_h']=500;
				}
			}
			return do_shortcode( $this->shortcode( shortcode_atts( $attr, $atts )) );
		}

		/**
		 * Main shortcode rendering
		 * @param array $atts
		 * @param $post_type
		 * @return string|void
		 */
		function shortcode($atts = array()) {
			if ( false === stripos( $atts['style'], 'slider' ) ) {
				return parent::shortcode($atts);
			}
			$galleries = $this->get_posts($atts);

			// Collect markup to be returned
			$out = '';

			if ( $galleries ) {
				global $themify;
				$isShortcode=$themify->is_shortcode===true;
				$themify_save = clone $themify; // save a copy
				$themify->hide_title = isset($atts['title']) && $atts['title']==='yes'?'yes':'no';
				$themify->hide_image = isset($atts['image']) && $atts['image']==='yes'?'yes':'no';
				$themify->unlink_title =  isset($atts['unlink_title']) && $atts['unlink_title']==='yes'?'yes':'no';
				$themify->unlink_image =  isset($atts['unlink_image']) && $atts['unlink_image']==='yes'?'yes':'no';
				$themify->hide_meta_category = 'no';
				$themify->hide_meta_tag = 'no';
				$themify->hide_meta_author = 'yes';
				$themify->hide_date = isset($atts['post_date']) && $atts['post_date']==='yes'?'no': 'yes';
				$themify->width = $atts['image_w'];
				$themify->height = $atts['image_h'];
				$themify->display_content = $atts['display'];
				$themify->more_link = $atts['more_link'];
				$themify->more_text = $atts['more_text'];
				$themify->post_layout = explode(' ',$atts['style']);
				$themify->post_layout=trim($themify->post_layout[0]);
				$themify->is_shortcode = true;
				$class=apply_filters( 'themify_loops_wrapper_class', array($this->post_type,$atts['style'] ),$this->post_type,$themify->post_layout,'shortcode' );
				$out = '<div data-lazy="1" class="loops-wrapper shortcode ' .implode(' ',$class) .' tf_clear">';
				ob_start();
				include(THEME_DIR.'/includes/twg-slider.php');
				$out.= ob_get_contents();
				ob_end_clean();
				$out .= $this->section_link($atts['more_link'], $atts['more_text']);
				$out.='</div>';
				$galleries=null;
				$themify->is_shortcode=$isShortcode;
				// END SHORTCODE RENDERING

				$themify = clone $themify_save; // revert to original $themify state
				wp_reset_postdata();
			}
			return $out;
		}




		/**************************************************************************************************
		 * Body Classes for Portfolio index and single
		 **************************************************************************************************/

		/**
		 * Changes condition to filter sidebar layout class
		 * @param bool $condition
		 * @return bool
		 */
		function sidebar_condition( $condition ) {
			return $condition || is_singular('gallery');
		}
		/**
		 * Returns modified sidebar layout class
		 * @param string $class Original body class
		 * @return string
		 */
		function sidebar( $class ) {
			if ( is_singular( 'gallery' ) ) {
				$class = 'sidebar-none';
			}
			return $class;
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
new Themify_Gallery();
