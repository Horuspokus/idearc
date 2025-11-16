<?php

class Themify_Shortcode_Base {

    protected $post_type;
    protected $tax;
    protected $taxonomies;

    protected function __construct() {
	add_action('init', array($this, 'register'));
	add_filter('themify_post_types', array($this, 'extend_post_types'));
	add_filter('themify_types_excluded_in_search', array($this, 'exclude_in_search'));
	add_action("save_post_{$this->post_type}", array($this, 'save_post'), 100, 2);
	if($this->post_type!=='gallery'){
	    add_shortcode( $this->post_type, array( $this, 'init_shortcode' ) );
	}
	add_shortcode('themify_' . $this->post_type . '_posts', array($this, 'init_shortcode'));
	if (is_admin()) {
	    add_action('admin_init', array($this, 'manage_and_filter'));
	    add_filter('manage_edit-' . $this->tax . '_columns', array($this, 'taxonomy_header'), 10, 2);
	    add_filter('manage_' . $this->tax . '_custom_column', array($this, 'taxonomy_column_id'), 10, 3);

	    
	    add_filter( "manage_edit-{$this->post_type}_columns", array( $this, 'type_column_header' ), 10, 2 );
	    add_action( "manage_{$this->post_type}_posts_custom_column", array( $this, 'type_column' ), 10, 3 );
	    
	} else {
	    add_filter('post_class', array($this, 'remove_cpt_post_class'), 12);
	}
    }

    /**
     * Includes new post types registered in theme to array of post types managed by Themify
     * @param array
     * @return array
     */
    public function extend_post_types($types) {
	return array_merge($types, array($this->post_type));
    }

    /**
     * Show in Themify Settings module to exclude this post type in search results.
     * @param $types
     * @return mixed
     */
    public function exclude_in_search($types) {
	$types[$this->post_type] = $this->post_type;
	return $types;
    }

    /**
     * Run on post saving.
     * Set default taxonomy term.
     * @param number
     * @param object
     */
    public function save_post($post_id, $post) {
	if ('publish' === $post->post_status) {
	    // Set default term for custom taxonomy and assign to post
	    $terms = wp_get_post_terms($post_id, $this->tax);
	    if (empty($terms)) {
		wp_set_object_terms($post_id, __('Uncategorized', 'themify'), $this->tax);
	    }
	}
    }

    /**
     * Trigger at the end of __construct of this shortcode
     */
    public function manage_and_filter() {
	add_action('load-edit.php', array($this, 'filter_load'));
	add_filter('post_row_actions', array($this, 'remove_quick_edit'), 10, 1);
    }

    /**
     * Filter request to sort
     */
    public function filter_load() {
	global $typenow;
	if ($typenow === $this->post_type) {
	    add_action(current_filter(), array($this, 'setup_vars'), 20);
	    add_action('restrict_manage_posts', array($this, 'get_select'));
	    add_filter("manage_taxonomies_for_{$this->post_type}_columns", array($this, 'add_columns'));
	}
    }

    /**
     * Remove quick edit action from entries list in admin
     * @param $actions
     * @return mixed
     */
    public function remove_quick_edit($actions) {
	global $post;
	if ($post->post_type === $this->post_type)
	    unset($actions['inline hide-if-no-js']);
	return $actions;
    }

    /**
     * Setup vars when filtering posts in edit.php
     */
    public function setup_vars() {
	$this->post_type = get_current_screen()->post_type;
	$this->taxonomies = array_diff(get_object_taxonomies($this->post_type), get_taxonomies(array('show_admin_column' => 'false')));
    }

    /**
     * Select form element to filter the post list
     * @return string HTML
     */
    public function get_select() {
	$html = '';
	foreach ($this->taxonomies as $tax) {
	    $options = sprintf('<option value="">%s %s</option>', __('View All', 'themify'), get_taxonomy($tax)->label);
	    $class = is_taxonomy_hierarchical($tax) ? ' class="level-0"' : '';
	    foreach (get_terms($tax) as $taxon) {
		$options .= sprintf('<option %s%s value="%s">%s%s</option>', isset($_GET[$tax]) ? selected($taxon->slug, $_GET[$tax], false) : '', '0' !== $taxon->parent ? ' class="level-1"' : $class, $taxon->slug, '0' !== $taxon->parent ? str_repeat('&nbsp;', 3) : '', "{$taxon->name} ({$taxon->count})");
	    }
	    $html .= sprintf('<select name="%s" id="%s" class="postform">%s</select>', $tax, $tax, $options);
	}
	return print $html;
    }

    /**
     * Returns link wrapped in paragraph either to the post type archive page or a custom location
     * @param bool|string False does nothing, true goes to archive page, custom string sets custom location
     * @param string Text to link
     * @return string
     */
    protected function section_link($more_link, $more_text) {
	if ($more_link) {
	    if ('true' == $more_link) {
		$more_link = get_post_type_archive_link($this->post_type);
	    }
	    return '<p class="more-link-wrap"><a href="' . esc_url($more_link) . '" class="more-link">' . $more_text . '</a></p>';
	}
	return '';
    }

    /**
     * Display an additional column in categories list
     * @since 1.0.0
     */
    public function taxonomy_header($cat_columns) {
	$cat_columns['cat_id'] = 'ID';
	return $cat_columns;
    }
    
    
    /**
     * Display an additional column in list
     * @param array
     * @return array
     */
    function type_column_header( $columns ) {
	    unset( $columns['date'] );
	    $columns['icon'] = __('Icon', 'themify');
	    return $columns;
    }
    
    
    /**
     * Display shortcode, type, size and color in columns in tiles list
     * @param string $column key
     * @param number $post_id
     * @return string
     */
    function type_column( $column, $post_id ) {
	    if($column==='icon'){
		the_post_thumbnail( array( 50, 50 ) );
	    }
    }
    
    /**
     * Display ID in additional column in categories list
     * @since 1.0.0
     */
    public function taxonomy_column_id($null, $column, $termid) {
	return $termid;
    }


    /**
     * Add columns when filtering posts in edit.php
     */
    public function add_columns($taxonomies) {
	return array_merge($taxonomies, $this->taxonomies);
    }

    /**
     * Remove custom post type class.
     * @param $classes
     * @return mixed
     */
    public function remove_cpt_post_class($classes) {
	$k = array_search($this->post_type, $classes);
	if ($k !== false) {
	    unset($classes[$k]);
	}
	return $classes;
    }
    
    
    protected function get_posts($atts){
	$post_type=$this->post_type;
	$args = array(
	    'post_type' => $post_type,
	    'posts_per_page' => $atts['limit'],
	    'no_found_rows' => true,
	    'order' => $atts['order'],
	    'orderby' => $atts['orderby'],
	    'suppress_filters' => false,
	    'meta_key' => isset($atts['meta_key']) ? $atts['meta_key'] : null
	);
	$args['tax_query'] = themify_parse_category_args($atts['category'], $this->tax );


	// Single post type or many single post types
	if ('' != $atts['id']) {
	    if (strpos($atts['id'], ',')) {
		$ids = explode(',', str_replace(' ', '', $atts['id']));
		foreach ($ids as $string_id) {
		    $int_ids[] = (int) $string_id;
		}
		$args['post__in'] = $int_ids;
		$args['orderby'] = 'post__in';
	    } 
	    else {
		$args['p'] = (int) $atts['id'];
	    }
	}
	// Get posts according to parameters
	return get_posts(apply_filters('themify_' . $post_type . '_shortcode_args', $args));

    }
    /**
     * Main shortcode rendering
     * @param array $atts
     * @param $post_type
     * @return string|void
     */
    protected function shortcode($atts) {
	
	$posts = $this->get_posts($atts);
	$out = '';

	if ($posts) {
		global $themify;
		$themify_save = clone $themify; // save a copy
		$themify->hide_title = isset($atts['title']) && $atts['title']==='yes'?$atts['title']:'no';
		$themify->hide_image = isset($atts['image']) && $atts['image']==='yes'?'yes':'no';
		$themify->unlink_title =  isset($atts['unlink_title']) && $atts['unlink_title']==='yes'?'yes':'no';
		$themify->unlink_image =  isset($atts['unlink_image']) && $atts['unlink_image']==='yes'?'yes':'no';
		$themify->hide_meta = isset($atts['post_meta']) && $atts['post_meta']==='yes'?'yes': 'no';
		$themify->hide_date = isset($atts['post_date']) && $atts['post_date']==='yes'?'yes': 'no';
		$themify->width = $atts['image_w'];
		$themify->height = $atts['image_h'];
		$themify->display_content = $atts['display'];
		$themify->more_link = $atts['more_link'];
		$themify->more_text = $atts['more_text'];
		$themify->post_layout=trim(explode(' ',$atts['style'])[0]);
		$class=apply_filters( 'themify_loops_wrapper_class', array($this->post_type,$atts['style'] ),$this->post_type,$themify->post_layout,'shortcode');
		$out .= '<div data-lazy="1" class="loops-wrapper shortcode ' . esc_attr( implode(' ',$class) ) .' tf_clear">';
			if ($themify->post_layout==='slider') {
				$out.= sprintf('<div data-lazy="1" data-page_type="%s" class="slideshow tf_carousel tf_swiper-container tf_rel tf_overflow" data-effect="%s" data-thumbs="%s" data-speed="%s" data-wrapvar="%s" data-slider_nav="%s" data-pager="%s" data-visible="%s" data-scroll="%s" data-auto="%s"><div class="tf_swiper-wrapper tf_lazy tf_rel tf_w tf_h">',
				    isset($atts['pager_type'])? esc_attr( $atts['pager_type'] ) :'', 
				    isset($atts['effect'])? esc_attr( $atts['effect'] ) :'',
				    isset($atts['thumbs'])? esc_attr( $atts['thumbs'] ) :'',
				    isset($atts['speed'])? esc_attr( $atts['speed'] ) :'',
				    isset($atts['wrap']) && $atts['wrap']==='no'?'0':'1',
				    isset($atts['slider_nav']) && $atts['slider_nav']==='no'?'0':'1',
				    isset($atts['pager']) && $atts['pager']==='no'?'0':'1',
				    isset($atts['visible'])? esc_attr( $atts['visible'] ):'1',
				    isset($atts['scroll'])? esc_attr( $atts['scroll'] ) :'1',
				    isset($atts['auto'])?(is_numeric($atts['auto']) ? $atts['auto'] * 1000 : $atts['auto']):'0'
				);
			}
			$template=isset($atts['template'])?$atts['template']:'includes/loop';
			$out .= themify_get_shortcode_template($posts, $template,$this->post_type);
			if ($themify->post_layout==='slider') {
				$out .= '</div></div>';
			}
			$out .= $this->section_link($atts['more_link'], $atts['more_text']);
		$out .= '</div>';

		$themify = clone $themify_save; // revert to original $themify state
		$themify_save=null;
		wp_reset_postdata();
	}
	return $out;
    }

    public static function loadStyles($post_type,$style){
	    static $loaded=array();
	    if(!isset($loaded[$post_type]) && ($post_type==='team' || $post_type==='gallery' || $post_type==='portfolio' || $post_type==='testimonial' || $post_type==='highlight' || $post_type==='section' )){
		$loaded[$post_type]=true;
		$file='loops/'.$post_type;
		Themify_Enqueue_Assets::loadThemeStyleModule($file);
	    }
   }

}
