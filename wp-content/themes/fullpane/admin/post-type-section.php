<?php
/**************************************************************************************************
 * Section Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Section',false ) ) {

	class Themify_Section extends Themify_Shortcode_Base{

		protected $post_type = 'section';
		protected $tax = 'section-category';
		protected $taxonomies;

		function __construct() {
		    $section = get_posts(
			    array(
				     'post_type' => 'section',
				     'no_found_rows'=>true,
				     'posts_per_page' => 1
			    )
		    );
		    if(empty($section)){
			return;
		    }
		    parent::__construct();
		    add_action( 'admin_init', array( $this, 'add_menu_meta_box' ) );

		    add_filter('themify_default_layout_condition', array( $this, 'sidebar_condition' ), 12);
		    add_filter('themify_default_layout', array( $this, 'sidebar' ), 12);
		}

		/**
		 * Register post type and taxonomy
		 */
		function register() {
			$cpt = array(
				'plural' => __('Sections', 'themify'),
				'singular' => __('Section', 'themify'),
				'supports' => array('title', 'editor', 'author', 'custom-fields')
			);
			register_post_type( $this->post_type, array(
				'labels' => array(
					'name' => $cpt['plural'],
					'singular_name' => $cpt['singular'],
					'add_new' => __( 'Add New', 'themify' ),
					'add_new_item' => __( 'Add New Section', 'themify' ),
					'edit_item' => __( 'Edit Section', 'themify' ),
					'new_item' => __( 'New Section', 'themify' ),
					'view_item' => __( 'View Section', 'themify' ),
					'search_items' => __( 'Search Sections', 'themify' ),
					'not_found' => __( 'No Sections found', 'themify' ),
					'not_found_in_trash' => __( 'No Sections found in Trash', 'themify' ),
					'menu_name' => __( 'Sections', 'themify' ),
				),
				'supports' => isset($cpt['supports'])? $cpt['supports'] : array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'),
				'hierarchical' => false,
				'public' => true,
				'query_var' => true,
				'can_export' => true,
				'capability_type' => 'post',
				'show_in_nav_menus' => false,
			));
			register_taxonomy( $this->tax, array( $this->post_type ), array(
				'labels' => array(
					'name' => sprintf(__( '%s Categories', 'themify' ), $cpt['singular']),
					'singular_name' => sprintf(__( '%s Category', 'themify' ), $cpt['singular'])
				),
				'public' => true,
				'show_in_nav_menus' => false,
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
			    'category' => 'all'
			);
			return do_shortcode( $this->shortcode( shortcode_atts( $attr, $atts )) );
		}

		
		/**
		* Outputs Section post category classes
		* @return string
		*/
	       public static function category_classes($post_id) {
		       $sectioncats = get_the_terms($post_id, 'section-category');
		       $categoryclass = '';
		       foreach($sectioncats as $sectioncat) {
			       $categoryclass .= ' section-category-' . $sectioncat->term_id . ' section-category-' . $sectioncat->slug;
		       }
		       return $categoryclass;
	       }


		public static function section_background( $classes = '' ) {
			$post_class = get_post_class();
			$post_id = get_the_ID();
			$out = '';
			$class = '';
			$class = join( ' ', get_post_class( $classes ) );
			$data_bg = '';
			$image = get_post_meta( $post_id, 'background_image', true );
			if ( $image ) {
				$data_bg = "data-bg='$image'";
				$repeat = get_post_meta( $post_id, 'background_repeat', true );
				if ( $repeat ) {
					$class .= " $repeat";
				}
			}
			if ( '' != $data_bg ) {
				$out .= $data_bg;
			}
			if ( '' != $class ) {
				$out .= " class='$class'";
			}
			echo $out;
		}


		/**************************************************************************************************
		 * Body Classes for index and single
		 **************************************************************************************************/

		/**
		 * Changes condition to filter sidebar layout class
		 * @param bool $condition
		 * @return bool
		 */
		function sidebar_condition($condition) {
			// if layout is not set or is the home page and front page displays is set to latest posts
			return $condition || is_tax('section-category') || is_singular('section');
		}
		/**
		 * Returns modified sidebar layout class
		 * @param string $class Original body class
		 * @return string
		 */
		function sidebar($class) {
			return 'sidebar-none';
		}

		/**************************************************************************************************
		 * Section meta box for Menus screen
		 **************************************************************************************************/

		/**
 		 * Add section ID to menu. Useful for query section pages pointing to IDs in the page.
		 */
		function add_menu_meta_box() {
			add_meta_box( $this->post_type . '-menu', __( 'Sections', 'themify' ), array( $this, 'menu_meta_box' ), 'nav-menus', 'side', 'high' );
		}

		/**
 		 * Meta box for section post type in menus screen.
		 */
		public function menu_meta_box() {

			$sections = get_posts( array( 'post_type' => 'section', 'posts_per_page' => -1 ) );
			?><div id="posttype-section" class="posttypediv">
				<div id="tabs-panel-posttype-section-most-recent" class="tabs-panel tabs-panel-active">
					<ul id="sectionchecklist-most-recent" class="categorychecklist form-no-clear">
					<?php if( ! empty( $sections ) ) : foreach( $sections as $section ) : ?>
						<li><label class="menu-item-title"><input type="checkbox" class="menu-item-checkbox" name="menu-item[-<?php echo esc_attr( $section->ID ); ?>][menu-item-object-id]" value="<?php echo esc_attr( $section->ID ); ?>"> <?php echo esc_attr( $section->post_title ); ?></label><input type="hidden" class="menu-item-db-id" name="menu-item[-<?php echo esc_attr( $section->ID ); ?>][menu-item-db-id]" value="0"><input type="hidden" class="menu-item-object" name="menu-item[-<?php echo esc_attr( $section->ID ); ?>][menu-item-object]" value="custom"><input type="hidden" class="menu-item-parent-id" name="menu-item[-<?php echo esc_attr( $section->ID ); ?>][menu-item-parent-id]" value="0"><input type="hidden" class="menu-item-type" name="menu-item[-<?php echo esc_attr( $section->ID ); ?>][menu-item-type]" value="custom"><input type="hidden" class="menu-item-title" name="menu-item[-<?php echo esc_attr( $section->ID ); ?>][menu-item-title]" value="<?php echo esc_attr( $section->post_title ); ?>"><input type="hidden" class="menu-item-url" name="menu-item[-<?php echo esc_attr( $section->ID ); ?>][menu-item-url]" value="#<?php echo esc_attr( $section->post_name ); ?>">
					<?php endforeach; endif; ?>
					</ul>
				</div><!-- /.tabs-panel -->

				<p class="button-controls">
					<span class="list-controls">
						<a href="<?php echo add_query_arg( array( 'selectall' => 1 ), admin_url( 'nav-menus.php' ) ); ?>#posttype-section" class="select-all"><?php _e( 'Select All', 'themify' ) ?></a>
					</span>

					<span class="add-to-menu">
						<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php _e( 'Add to Menu', 'themify' ); ?>" name="add-post-type-menu-item" id="submit-posttype-section">
						<span class="spinner"></span>
					</span>
				</p>
			</div><!-- /.posttypediv --><?php
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
new Themify_Section();