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
	public $post_filter=false;
	public $post_layout;
	
	public $hide_title;
	public $hide_meta;
	public $hide_meta_author;
	public $hide_meta_category;
	public $hide_meta_comment;
	public $hide_meta_tag;
	public $hide_date;
	public $hide_image;
	
	public $unlink_title;
	public $unlink_image;
	
	public $display_content = '';
	public $media_position='above';
	public $auto_featured_image;
	
	public $width = '';
	public $height = '';
	public $image_size='';
	public $avatar_size = 70;
	public $page_navigation;
	public $posts_per_page;
	
	public $is_shortcode = false;
	public $page_id = '';
	public $query_category = '';
	public $query_post_type = '';
	public $query_taxonomy = '';
	public $paged = '';
	public $query_all_post_types;


	public $gallery_shortcode_slider_id = 0;
	public $gallery_post_type_slider_id = 0;
	
	private const PAGE_IMAGE_WIDTH = 1038;
	// Default Single Image Size
	private const SINGLE_IMAGE_WIDTH = 1038;
	private const SINGLE_IMAGE_HEIGHT = 500;
	// List Post
	private const LIST_POST_WIDTH = 1038;
	private const LIST_POST_HEIGHT = 1038;
	// Grid6
	private const GRID6_WIDTH = 180;
	private const GRID6_HEIGHT = 120;
	// Grid5
	private const GRID5_WIDTH = 210;
	private const GRID5_HEIGHT = 130;
	// Grid4
	private const GRID4_WIDTH = 262;
	private const GRID4_HEIGHT = 262;
	
	// Grid3
	private const GRID3_WIDTH = 362;
	private const GRID3_HEIGHT = 362;
	
	// Grid2
	private const GRID2_WIDTH = 561;
	private const GRID2_HEIGHT = 561;

	// List Grid2 Thumb
	private const GRID2_THUMB_WIDTH = 120;
	private const GRID2_THUMB_HEIGHT = 120;
	
	// List Large
	private const LIST_LARGE_IMAGE_WIDTH = 400;
	private const LIST_LARGE_IMAGE_HEIGHT = 400;
	 
	// List Thumb
	private const LIST_THUMB_IMAGE_WIDTH = 221;
	private const LIST_THUMB_IMAGE_HEIGHT = 221;
	

	// Index Portfolio
	private const INDEX_PORTFOLIO_IMAGE_WIDTH = 262;
	private const INDEX_PORTFOLIO_IMAGE_HEIGHT = 262;

	// Single Portfolio
	private const SINGLE_PORTFOLIO_IMAGE_WIDTH = 640;
	private const SINGLE_PORTFOLIO_IMAGE_HEIGHT = 640;
	
	// Sorting Parameters
	public $order = 'DESC';
	public $orderby = 'date';
	public $order_meta_key = false;

	public $gallery_by_shortcode_auto;
	public $gallery_by_shortcode_transition;
	public $gallery_by_shortcode_bgmode;
	
	public $page_title;
	public $image_page_single_width;
	public $image_page_single_height;
	public $hide_page_image;
	public $excerpt_length;
	public $isPage=false;
	public $more_text='';
	public $more_link='';
	public $themify_post_title_tag='';
	public $post_module_hook = null;
	public $post_module_tax = null;
	public $lightboxed_permalink = false;

	public $lightbox_portfolio;

	function __construct() {
	    add_action('template_redirect', array($this, 'template_redirect'),5);
	}
	
	
	private function themify_set_global_options() {
		///////////////////////////////////////////
		//Global options setup
		///////////////////////////////////////////
	    
		$this->layout = themify_get('setting-default_layout', 'sidebar1',true);
		
		$this->post_layout = themify_get( 'setting-default_post_layout', 'list-post',true );
		
		$this->hide_title = themify_get('setting-default_post_title', '', true);
		$this->unlink_title = themify_get('setting-default_unlink_post_title', '', true);
		
		$this->hide_image = themify_get('setting-default_post_image', '', true);
		$this->unlink_image = themify_get('setting-default_unlink_post_image', '', true);
		$this->auto_featured_image = themify_check('setting-auto_featured_image', '', true);
		
		$this->hide_meta = themify_get('setting-default_post_meta', '', true);
        $this->hide_meta_author=themify_get('setting-default_post_meta_author', '', true);
        $this->hide_meta_category=themify_get('setting-default_post_meta_category', '', true);
        $this->hide_meta_comment=themify_get('setting-default_post_meta_comment', '', true);
        $this->hide_meta_tag=themify_get('setting-default_post_meta_tag', '', true);
		$this->hide_date = themify_get('setting-default_post_date', '', true);

		$this->order = themify_get('setting-index_order', $this->order, true);
		$this->orderby = themify_get('setting-index_orderby', $this->orderby, true);

		if ($this->orderby === 'meta_value' || $this->orderby === 'meta_value_num') {
		    $this->order_meta_key = themify_get('setting-index_meta_key', '', true);
		}

		$this->width = themify_get('setting-image_post_width', '', true);
		$this->height = themify_get('setting-image_post_height', '', true);
		
		$this->display_content = themify_get('setting-default_layout_display', '', true);
		$this->excerpt_length = themify_get( 'setting-default_excerpt_length' , '', true);
		$this->avatar_size = apply_filters('themify_author_box_avatar_size', $this->avatar_size);
		$this->posts_per_page = get_option('posts_per_page');
		$this->lightbox_portfolio = themify_get( 'setting-default_portfolio_index_disable_lightbox_portfolio', false, true ) !== 'on';
	}

	function template_redirect() {
		$this->themify_set_global_options();

		if( is_singular() ) {
			$this->display_content = 'content';
		}
		
		if (is_page() || themify_is_shop()) {
			if (post_password_required()) {
			    return;
			}
			$this->page_id = get_the_ID();
			$this->paged=get_query_var( 'paged' ) ;
			if(empty($this->paged)){
			    $this->paged=get_query_var( 'page',1 );
			}
			global $paged;
			$paged = $this->paged;
			
			$this->layout = themify_get_both('page_layout', 'setting-default_page_layout', 'sidebar1');
			$this->hide_page_image = themify_get('setting-hide_page_image', false, true) === 'yes' ? 'yes' : 'no';
			$this->image_page_single_width = themify_get('setting-page_featured_image_width', self::PAGE_IMAGE_WIDTH, true);
			$this->image_page_single_height = themify_get('setting-page_featured_image_height', 0, true);
			$this->page_title = themify_get_both('hide_page_title', 'setting-hide_page_title', 'no');
			
			if(!themify_is_shop()){

			    $post_query_category = themify_get('query_category','');
			    $portfolio_query_category = themify_get('portfolio_query_category','');
			    $section_query_category = themify_get('section_query_category','');

			    if( $portfolio_query_category!=='') {
				    $this->query_category = $portfolio_query_category;
				    $this->query_taxonomy = 'portfolio-category';
				    $this->query_post_type = 'portfolio';
				    $this->post_layout =themify_get('portfolio_layout','grid4');
				    $this->display_content = themify_get('portfolio_display_content','excerpt');
				    $this->hide_meta = themify_get_both('portfolio_hide_meta_all','setting-default_portfolio_index_post_meta_category','yes');
				    $this->hide_date = themify_get_both('portfolio_hide_date','setting-default_portfolio_index_post_date','yes');
				    $this->hide_title = themify_get_both('portfolio_hide_title','setting-default_portfolio_index_title');
				    $this->unlink_title = themify_get_both('portfolio_unlink_title','setting-default_portfolio_index_unlink_post_title');
				    $this->width = themify_get_both('portfolio_image_width','setting-default_portfolio_index_image_post_width','');
				    $this->height = themify_get_both('portfolio_image_height','setting-default_portfolio_index_image_post_height','');
				    $this->page_navigation = themify_get('portfolio_hide_navigation');
				    $this->posts_per_page = themify_get('portfolio_posts_per_page');	
				    $this->hide_image = themify_get('portfolio_hide_image');
				    $this->unlink_image = themify_get('portfolio_unlink_image');
				    $this->order = themify_get('portfolio_order','desc');
				    $this->orderby = themify_get('portfolio_orderby','date');
				    if( $this->orderby==='meta_value' || $this->orderby==='meta_value_num') {
					    $this->order_meta_key = themify_get( 'portfolio_meta_key', '' );
				    }

			    } 
			    elseif( $section_query_category!=='') {
				    $this->query_category = $section_query_category;
				    $this->query_taxonomy = 'section-category';
				    $this->query_post_type = 'section';
				    $this->hide_title = themify_get('section_hide_title');
				    $this->posts_per_page = themify_get('section_posts_per_page');
				    $this->order = themify_get('section_order','desc');
				    $this->orderby = themify_get('section_orderby','date');
				    if( $this->orderby==='meta_value' || $this->orderby==='meta_value_num') {
					    $this->order_meta_key = themify_get( 'section_meta_key', '' );
				    }
				    $this->hide_image=$this->unlink_title=$this->hide_title =$this->unlink_image = '';
			    } 
			    elseif($post_query_category!=='') {
				    $this->query_category = $post_query_category;
				    $this->query_taxonomy = 'category';
				    $this->query_post_type = 'post';
				    $this->post_layout = themify_get( 'layout', 'list-post' );
				    $this->hide_title = themify_get('hide_title',$this->hide_title);
				    $this->unlink_title = themify_get('unlink_title',$this->unlink_title);
				    $this->media_position = themify_get('media_position',$this->media_position);
				    $this->hide_image = themify_get('hide_image',$this->hide_image);
				    $this->unlink_image = themify_get('unlink_image',$this->unlink_image);
				    $this->hide_meta = themify_get('hide_meta_all',$this->hide_meta);
				    $this->posts_per_page = themify_get('posts_per_page',$this->posts_per_page);
				    $this->order = themify_get( 'order','desc');
				    $this->orderby = themify_get( 'orderby', 'date' );
				    $this->display_content = themify_get('display_content','excerpt');
				    $this->hide_date=themify_get('hide_date',$this->hide_date);
				    $this->width = themify_get('image_width',$this->width);
				    $this->height = themify_get('image_height',$this->height);
				    // Post Meta Values ///////////////////////
				    $post_meta_keys = array(
					    '_author' 	=> 'post_meta_author',
					    '_category' => 'post_meta_category',
					    '_comment'  => 'post_meta_comment',
					    '_tag' 	 	=> 'post_meta_tag'
				    );
				    $post_meta_key = 'setting-default_';
				    foreach($post_meta_keys as $k => $v){
					    $this->{'hide_meta'.$k} = themify_get_both('hide_meta'.$k,$post_meta_key . $v,'');
				    }
				    if( $this->orderby==='meta_value' || $this->orderby==='meta_value_num') {
					    $this->order_meta_key = themify_get( 'meta_key', $this->order_meta_key);
				    }
			    }
			}
		}
		elseif (is_post_type_archive( 'portfolio' ) ||  is_tax('portfolio-category')) {
			$this->layout = themify_get('setting-default_portfolio_index_layout','sidebar-none',true);
			$this->post_layout = themify_get('setting-default_portfolio_index_post_layout','list-post',true);
			$this->display_content = themify_get('setting-default_portfolio_index_display','none',true);
			$this->hide_title = themify_get('setting-default_portfolio_index_title','no',true);
			$this->unlink_title = themify_get('setting-default_portfolio_index_unlink_post_title','no',true);
			$this->hide_meta = themify_get('setting-default_portfolio_index_post_meta_category','yes',true);
			$this->hide_date = themify_get('setting-default_portfolio_index_post_date','yes',true);
			$this->width = themify_get('setting-default_portfolio_index_image_post_width','',true);
			$this->height = themify_get('setting-default_portfolio_index_image_post_height','',true);
			$this->unlink_image = $this->hide_image = '';
		}
		elseif (is_post_type_archive( 'section' ) ||  is_tax('section-category')) {
			$this->post_layout = themify_get('setting-default_section_index_post_layout','list-post',true);
			$this->layout = themify_get('setting-default_section_index_layout','sidebar-none',true);
			$this->hide_meta = themify_get('setting-default_section_index_post_meta_category','yes',true);
			$this->hide_date = themify_get('setting-default_section_index_post_date','yes',true);
			$this->hide_image=$this->unlink_title=$this->hide_title =$this->unlink_image = '';
		}
		elseif( is_singular('post') || is_singular('portfolio')  || is_singular( 'team' )) {
			$this->media_position = 'above';
			if(is_singular('portfolio')){
				$this->layout = themify_get_both('layout','setting-default_portfolio_single_layout','sidebar-none');
				$this->hide_meta = themify_get_both('hide_meta_all','setting-default_portfolio_single_post_meta_category','yes');
				$this->hide_title = themify_get_both('hide_post_title','setting-default_portfolio_single_title','');
				$this->unlink_title =themify_get_both('unlink_post_title','setting-default_portfolio_single_unlink_post_title');
				$this->hide_date = themify_get_both('hide_post_date','setting-default_portfolio_single_post_date');
				$this->width = themify_get_both('image_width','setting-default_portfolio_single_image_post_width','');
				$this->height = themify_get_both('image_height','setting-default_portfolio_single_image_post_height','');
				$this->hide_image=themify_get('hide_post_image');
				$this->unlink_image=themify_get('unlink_post_image'); 
			} 
			elseif(is_singular( 'team' )){
			    $this->layout = themify_get('setting-default_team_single_layout','sidebar1',true );
			    $this->hide_image = themify_get('setting-default_team_single_hide_image','',true);
			    $this->unlink_image=themify_get('setting-default_team_single_unlink_image','',true); 
			    $this->hide_title = themify_get_both('hide_post_title','setting-default_portfolio_single_title');
			    $this->unlink_title =themify_get_both('unlink_post_title','setting-default_portfolio_single_unlink_post_title');
			    $this->width = themify_get_both('image_width','setting-default_team_single_image_post_width','');
			    $this->height = themify_get_both('image_height','setting-default_team_single_image_post_height','');
			}
			else {
				$this->layout = themify_get_both('layout','setting-default_page_post_layout','sidebar1');
				$this->hide_title = themify_get_both('hide_post_title','setting-default_page_post_title','');
				$this->unlink_title = themify_get_both('unlink_post_title','setting-default_page_unlink_post_title','');
				$this->hide_date = themify_get_both('hide_post_date','setting-default_page_post_date','');
				$this->hide_image=themify_get_both('hide_post_image','setting-default_page_post_image','');
				$this->unlink_image=themify_get_both('unlink_post_image','setting-default_page_unlink_post_image',''); 
				// Post Meta Values ///////////////////////
				$post_meta_keys = array(
					'_author' 	=> 'post_meta_author',
					'_category' => 'post_meta_category',
					'_comment'  => 'post_meta_comment',
					'_tag' 	 	=> 'post_meta_tag'
				);
				$post_meta_key = 'setting-default_page_';
				$this->hide_meta = themify_get_both('hide_meta_all',$post_meta_key . 'post_meta','');
				foreach($post_meta_keys as $k => $v){
					$this->{'hide_meta'.$k} = themify_get_both('hide_meta'.$k,$post_meta_key . $v,'');
				}
                                $this->width  = themify_get_both('image_width','setting-image_post_single_width','');
                                $this->height = themify_get_both('image_height','setting-image_post_single_height','');
			}
		}
		elseif ( is_archive() ) {
			$excluded_types = apply_filters( 'themify_exclude_CPT_for_sidebar', array('post', 'page', 'attachment', 'tbuilder_layout', 'tbuilder_layout_part', 'section'));
            $postType = get_post_type();
			if ( !in_array($postType, $excluded_types,true) ) {
			    $this->layout = themify_get( 'setting-custom_post_'. $postType .'_archive',$this->layout ,true );
			}
		}
		
		if($this->width==='' && $this->height===''){
		    if(is_single()){
			$this->width =is_singular('portfolio')?self::SINGLE_PORTFOLIO_IMAGE_WIDTH:self::SINGLE_IMAGE_WIDTH;
			$this->height = is_singular('portfolio')?self::SINGLE_PORTFOLIO_IMAGE_HEIGHT:self::SINGLE_IMAGE_HEIGHT;
		    }
		    elseif($this->query_post_type==='portfolio' || is_post_type_archive('portfolio') || is_tax('portfolio-category')){
			$this->width =self::INDEX_PORTFOLIO_IMAGE_WIDTH;
			$this->height =self::INDEX_PORTFOLIO_IMAGE_HEIGHT;
		    }
		    else{
			switch ($this->post_layout){
				case 'grid6':
				$this->width = self::GRID6_WIDTH;
				$this->height = self::GRID6_HEIGHT;
			    break;
				case 'grid5':
				$this->width = self::GRID5_WIDTH;
				$this->height = self::GRID5_HEIGHT;
			    break;
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
