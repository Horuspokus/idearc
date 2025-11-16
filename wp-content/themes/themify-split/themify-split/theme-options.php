<?php

/**
 * Main Themify class
 * @package themify
 * @since 1.0.0
 */
class Themify {

    /** Default sidebar layout
     * @var string */
    public $layout;
    public $post_filter = false;
    public $post_layout;
    public $hide_title;
    public $hide_meta;
    public $hide_meta_author;
    public $hide_meta_category;
    public $hide_meta_comment;
    public $hide_meta_tag;
    public $hide_date;
    public $hide_image;
    public $media_position;
    public $unlink_title;
    public $unlink_image;
    public $display_content = '';
    public $auto_featured_image;
    public $width = '';
    public $height = '';
    public $image_size = '';
    public $avatar_size = 96;
    public $page_navigation;
    public $posts_per_page;
    public $page_id = '';
    public $query_category = '';
    public $query_post_type = '';
    public $query_taxonomy = '';
    public $paged = '';
    public $query_all_post_types;
    public $is_shortcode = false;

    private const PAGE_IMAGE_WIDTH = 978;
    // Default Single Image Size
    private const SINGLE_IMAGE_WIDTH = 1440;
    private const SINGLE_IMAGE_HEIGHT = 1005;
    // List Post
    private const LIST_POST_WIDTH = 978;
    private const LIST_POST_HEIGHT = 400;
    // Grid4
    private const GRID4_WIDTH = 222;
    private const GRID4_HEIGHT = 140;
    // Grid3
    private const GRID3_WIDTH = 306;
    private const GRID3_HEIGHT = 180;
    // Grid2
    private const GRID2_WIDTH = 474;
    private const GRID2_HEIGHT = 250;
    // List Large
    private const LIST_LARGE_IMAGE_WIDTH = 680;
    private const LIST_LARGE_IMAGE_HEIGHT = 390;
    // List Thumb
    private const LIST_THUMB_IMAGE_WIDTH = 230;
    private const LIST_THUMB_IMAGE_HEIGHT = 200;
    // List Grid2 Thumb
    private const GRID2_THUMB_WIDTH = 120;
    private const GRID2_THUMB_HEIGHT = 100;
    // Sorting Parameters
    public $order = 'DESC';
    public $orderby = 'date';
    public $order_meta_key = false;
    
    
    public $page_title;
    public $image_page_single_width;
    public $image_page_single_height;
    public $hide_page_image;
    public $excerpt_length;
    public $isPage=false;

	public $post_module_hook = null;
	public $post_module_tax = null;
	public $more_text='';
	public $more_link='';
	public $themify_post_title_tag='';
	public $lightboxed_permalink = false;

    function __construct() {
	add_action('template_redirect', array($this, 'template_redirect'), 5);
    }

    private function themify_set_global_options() {
	///////////////////////////////////////////
	//Global options setup
	///////////////////////////////////////////
	$this->layout = themify_get('setting-default_layout', 'sidebar1', true);
	$this->post_layout = themify_get('setting-default_post_layout', 'list-post', true);

	$this->hide_title = themify_get('setting-default_post_title', false, true);
	$this->unlink_title = themify_get('setting-default_unlink_post_title', false, true);
	$this->media_position = themify_get('setting-default_media_position', 'above', true);
	$this->hide_image = themify_get('setting-default_post_image', false, true);
	$this->unlink_image = themify_get('setting-default_unlink_post_image', false, true);
	$this->auto_featured_image = themify_check('setting-auto_featured_image', true);

	$this->hide_meta = themify_get('setting-default_post_meta', false, true);
	$this->hide_meta_author = themify_get('setting-default_post_meta_author', false, true);
	$this->hide_meta_category = themify_get('setting-default_post_meta_category', false, true);
	$this->hide_meta_comment = themify_get('setting-default_post_meta_comment', false, true);
	$this->hide_meta_tag = themify_get('setting-default_post_meta_tag', false, true);
	$this->width = themify_get('setting-image_post_width', '', true);
	$this->height = themify_get('setting-image_post_height', '', true);
	$this->hide_date = themify_get('setting-default_post_date', '', true);

	// Set Order & Order By parameters for post sorting
	$this->order = themify_get('setting-index_order', $this->order, true);
	$this->orderby = themify_get('setting-index_orderby', $this->orderby, true);

	if ($this->orderby === 'meta_value' || $this->orderby === 'meta_value_num') {
	    $this->order_meta_key = themify_get('setting-index_meta_key', '', true);
	}

	$this->display_content = themify_get('setting-default_layout_display', '', true);
	$this->excerpt_length = themify_get('setting-default_excerpt_length', '', true);
	$this->avatar_size = apply_filters('themify_author_box_avatar_size', $this->avatar_size);
	$this->posts_per_page = get_option('posts_per_page');
    }

    function template_redirect() {
	$this->themify_set_global_options();

	if (is_singular()) {
	    $this->display_content = 'content';
	}


	if (is_page() || themify_is_shop()) {
	    if (post_password_required()) {
		return;
	    }
	    $this->page_id = get_the_ID();
	    // Set Page Number for Pagination
	    $this->paged = get_query_var('paged');
	    if (empty($this->paged)) {
		$this->paged = get_query_var('page', 1);
	    }

	    $this->layout = themify_get_both('page_layout', 'setting-default_page_layout', 'sidebar1');
	    $this->page_title = !themify_theme_is_fullpage_scroll() ? themify_get_both('hide_page_title', 'setting-hide_page_title', 'no') : 'yes';
	    $this->hide_page_image = themify_get('setting-hide_page_image', false, true) === 'yes' ? 'yes' : 'no';
	    $this->image_page_single_width = themify_get('setting-page_featured_image_width', self::PAGE_IMAGE_WIDTH, true);
	    $this->image_page_single_height = themify_get('setting-page_featured_image_height', 0, true);
	    if(!themify_is_shop()){
		// Post query query ///////////////////
		$post_query_category = themify_get('query_category', '');
		$portfolio_query_category = themify_get('portfolio_query_category', '');

		if ('' !== $portfolio_query_category) {

		    // GENERAL QUERY POST TYPES
		    $this->query_category = $portfolio_query_category;
		    $this->query_post_type = 'portfolio';
		    $this->query_taxonomy = $this->query_post_type . '-category';
		    $this->post_layout = themify_get('portfolio_layout','list-post');
		    $this->hide_meta = themify_get_both('portfolio_hide_meta_all', 'setting-default_portfolio_index_post_meta_category', 'no');
		    $this->hide_title = themify_get_both('portfolio_hide_title', 'setting-default_portfolio_index_title', 'no');
		    $this->unlink_title = themify_get_both('portfolio_unlink_title', 'setting-default_portfolio_index_unlink_post_title', 'no');
		    $this->unlink_image = themify_get_both('portfolio_unlink_image', 'setting-default_portfolio_index_unlink_post_image', 'no');
		    $this->hide_image = themify_get_both('portfolio_hide_image', 'setting-default_portfolio_index_post_image', 'no');
		    $this->page_navigation = themify_get('portfolio_hide_navigation', 'no');
		    $this->display_content = themify_get('portfolio_display_content', 'excerpt');
		    $this->posts_per_page = themify_get('portfolio_posts_per_page');
		    $this->order = themify_get('portfolio_order','desc');
		    $this->orderby = themify_get('portfolio_orderby','date');

		    if ($this->orderby === 'meta_value' || $this->orderby === 'meta_value_num') {
			$this->order_meta_key = themify_get('portfolio_meta_key', '');
		    }

		    $this->width = themify_get_both('portfolio_image_width', 'setting-default_portfolio_index_image_post_width', '');
		    $this->height = themify_get_both('portfolio_image_height', 'setting-default_portfolio_index_image_post_height', '');

		} 
		elseif ($post_query_category !== '') {

		    // GENERAL QUERY POSTS
		    $this->query_category = $post_query_category;
		    $this->query_taxonomy = 'category';
		    $this->query_post_type = 'post';
		    $this->post_layout = themify_get('layout', 'list-post');
		    $this->hide_title = themify_get('hide_title', $this->hide_title);
		    $this->unlink_title = themify_get('unlink_title', $this->unlink_title);
		    $this->media_position = themify_get('media_position', $this->media_position);
		    $this->hide_image = themify_get('hide_image', $this->hide_image);
		    $this->unlink_image = themify_get('unlink_image', $this->unlink_image);
		    $this->hide_date = themify_get('hide_date', $this->hide_date);
		    $this->display_content = themify_get('display_content', 'excerpt');
		    $this->width = themify_get('image_width', $this->width);
		    $this->height = themify_get('image_height', $this->height);
		    $this->page_navigation = themify_get('hide_navigation');
		    $this->posts_per_page = themify_get('posts_per_page', $this->posts_per_page);
		    $this->hide_meta = themify_get('hide_meta_all', $this->hide_meta);
		    $this->order = themify_get('order', 'desc');
		    $this->orderby = themify_get('orderby', 'date');
		    $this->post_filter = themify_get_both('post_filter', 'setting-post_filter', 'no');
		    // Post Meta Values ///////////////////////
		    $post_meta_keys = array(
			'_author' => 'post_meta_author',
			'_category' => 'post_meta_category',
			'_comment' => 'post_meta_comment',
			'_tag' => 'post_meta_tag'
		    );
		    $post_meta_key = 'setting-default_';
		    foreach ($post_meta_keys as $k => $v) {
			$this->{'hide_meta' . $k} = themify_get_both('hide_meta' . $k, $post_meta_key . $v, '');
		    }
		    if ($this->orderby === 'meta_value' || $this->orderby === 'meta_value_num') {
			$this->order_meta_key = themify_get('meta_key', $this->order_meta_key);
		    }
		}
	    }
	} 
	elseif (is_post_type_archive('portfolio') || is_tax('portfolio-category')) {
	    $this->layout = themify_get('setting-default_portfolio_index_layout', 'sidebar-none', true);
	    $this->post_layout = themify_get('setting-default_portfolio_index_post_layout', 'grid3', true);
	    $this->display_content = themify_get('setting-default_portfolio_index_display', 'none', true);
	    $this->hide_title = themify_get('setting-default_portfolio_index_title', 'no', true);
	    $this->unlink_image = themify_get('setting-default_portfolio_index_unlink_post_image', 'no', true);
	    $this->unlink_title = themify_get('setting-default_portfolio_index_unlink_post_title', 'no', true);
	    $this->hide_meta = themify_get('setting-default_portfolio_index_post_meta_category', 'yes', true);
	    $this->hide_date = themify_get('setting-default_portfolio_index_post_date', 'yes', true);
	    $this->width = themify_get('setting-default_portfolio_index_image_post_width', '', true);
	    $this->height = themify_get('setting-default_portfolio_index_image_post_height', '', true);
	    $this->hide_image='';
	} 
	elseif (is_single()) {

	    $this->media_position = 'above';
	    $this->display_content = '';
	    if (is_singular('portfolio')) {
		$this->layout = themify_get_both('layout', 'setting-default_portfolio_single_layout', 'sidebar-none');
		$this->hide_title = themify_get_both('hide_post_title', 'setting-default_portfolio_single_title', false);
		$this->unlink_title = themify_get_both('unlink_post_title', 'setting-default_portfolio_single_unlink_post_title', false);
		$this->unlink_image = themify_get_both('unlink_post_image', 'setting-default_portfolio_single_unlink_post_image', false);
		$this->hide_meta = themify_get_both('hide_post_meta', 'setting-default_portfolio_single_post_meta_category', 'no');
		$this->width = themify_get_both('image_width', 'setting-default_portfolio_single_image_post_width', '');
		$this->height = themify_get_both('image_height', 'setting-default_portfolio_single_image_post_height', '', true);
		$this->hide_image = themify_get( 'hide_post_image');
	    } 
	    else {
		$this->layout = themify_get_both('layout', 'setting-default_page_post_layout', 'sidebar1');
		$this->hide_title = themify_get_both('hide_post_title', 'setting-default_page_post_title', false);
		$this->unlink_title = themify_get_both('unlink_post_title', 'setting-default_page_unlink_post_title', false);
		$this->hide_date = themify_get_both('hide_post_date', 'setting-default_page_post_date', false);
		$this->hide_image = themify_get_both('hide_post_image', 'setting-default_page_post_image', false);
		$this->unlink_image = themify_get_both('unlink_post_image', 'setting-default_page_unlink_post_image', false);
		// Post Meta Values ///////////////////////
		$post_meta_keys = array(
		    '_author' => 'post_meta_author',
		    '_category' => 'post_meta_category',
		    '_comment' => 'post_meta_comment',
		    '_tag' => 'post_meta_tag'
		);
		$post_meta_key = 'setting-default_page_';
		$this->hide_meta = themify_get_both('hide_meta_all', $post_meta_key . 'post_meta', false);
		foreach ($post_meta_keys as $k => $v) {
		    $this->{'hide_meta' . $k} = themify_get_both('hide_meta' . $k, $post_meta_key . $v, false);
		}

		$this->width = themify_get_both('image_width', 'setting-image_post_single_width', '');
		$this->height = themify_get_both('image_height', 'setting-image_post_single_height', '');
	    }
	} 
	elseif (is_archive()) {
	    $this->post_filter = themify_get('setting-post_filter', 'no', true);
	    $excluded_types = apply_filters('themify_exclude_CPT_for_sidebar', array('post', 'page', 'attachment', 'tbuilder_layout', 'tbuilder_layout_part', 'section'));
	    $postType = get_post_type();
	    if (!in_array($postType, $excluded_types, true)) {
		$this->layout = themify_get('setting-custom_post_' . $postType . '_archive', $this->layout, true);
	    }
	}
	if ($this->width === '' && $this->height === '') {
	    if (is_single()) {
		$this->width = self::SINGLE_IMAGE_WIDTH;
		$this->height = self::SINGLE_IMAGE_HEIGHT;
	    }
	    else {
		switch ($this->post_layout) {
		    case 'grid4':
			$this->width = self::GRID4_WIDTH;
			$this->height = self::GRID4_HEIGHT;
			break;
		    case 'grid3':
			$this->width = self::GRID3_WIDTH;
			$this->height = self::GRID3_HEIGHT;
			break;
		    case 'grid2':
			$this->width = self::GRID2_WIDTH;
			$this->height = self::GRID2_HEIGHT;
			break;
		    case 'list-large-image':
			$this->width = self::LIST_LARGE_IMAGE_WIDTH;
			$this->height = self::LIST_LARGE_IMAGE_HEIGHT;
			break;
		    case 'list-thumb-image':
			$this->width = self::LIST_THUMB_IMAGE_WIDTH;
			$this->height = self::LIST_THUMB_IMAGE_HEIGHT;
			break;
		    case 'grid2-thumb':
			$this->width = self::GRID2_THUMB_WIDTH;
			$this->height = self::GRID2_THUMB_HEIGHT;
			break;
		    default :
			$this->width = self::LIST_POST_WIDTH;
			$this->height = self::LIST_POST_HEIGHT;
			break;
		}
	    }
	}
    }

}

global $themify;
$themify = new Themify();
