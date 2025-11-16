<?php 



if( !function_exists( 'wd_get_tile_info' ) ){
  function wd_get_tile_info( $value, $color = NULL, $column = NULL, $content = NULL, $title = NULL , $tile_img_bg = NULL,$tile_url=NULL,$tile_title_link=NULL,$featured_post = NULL,$icon=NULL ){
    $output = array();
    $dash_position = strpos($value, '-');
    $type = substr( $value, 0, $dash_position );
    switch ($type) {
      case 'page':
        $output['tile size'] = "medium";
        $output['tile type'] = "page";
        $output['id']        = substr( $value, $dash_position + 1 );
        break;
	case 'semi_large':
        $output['tile size'] = "semi_large";
        
        if(isset($output['content'])){
          $output['tile type'] = "custom";
        }else{
          $output['tile type'] = "semi_large";          
        }        
        
        $output['id']        = substr( $value, $dash_position + 1 );
        $output['title']     = $title;
        break;
		
		case 'semi_small':
        $output['tile size'] = "semi_small";
        
        if(isset($output['content'])){
          $output['tile type'] = "custom";
        }else{
          $output['tile type'] = "semi_small";          
        }        
        
        $output['id']        = substr( $value, $dash_position + 1 );
        $output['title']     = $title;
        break;
		
      case 'social':
        $output['tile size'] = "medium";
        $output['tile type'] = "social";
        $output['id']        = substr( $value, $dash_position + 1 );
        break;
				
      case 'vide':
        $output['tile size'] = "medium";
        $output['tile type'] = "vide";
        $output['id']        = substr( $value, $dash_position + 1 );
        break;
				
      case 'link':
        $output['tile size'] = "medium";
        $output['tile type'] = "link";
        $output['id']        = substr( $value, $dash_position + 1 );
        break;
        
      case 'wide':
        $output['tile size'] = "wide";
        $output['tile type'] = "wide";
        $output['id']        = substr( $value, $dash_position + 1 );
        $output['title']     = $title;
        break; 
		
      case 'big':
        $output['tile size'] = "big";
        
        if(isset($output['content'])){
          $output['tile type'] = "custom";
        }else{
          $output['tile type'] = "big";          
        }        
        
        $output['id']        = substr( $value, $dash_position + 1 );
        $output['title']     = $title;
        break;
		
		
      
      default:          
        break;
    } 
   
    if( isset($color)) {  
      $output['color'] = $color;
    }
    if( isset($tile_img_bg)) {  
      $output['wdtile_bg'] = $tile_img_bg;
    }
    
    if( isset($column)) {  
      $output['column'] = $column;
    }
    
    if( isset($content)) {  
      $output['content'] = $content;
    }
		
    if( isset($tile_url)) {
    	
      $output['url'] = $tile_url;
			
    }
    if( isset($tile_title_link)) {
    	
      $output['url_title'] = $tile_title_link;
			
    }
    if( isset($featured_post)) {
    	
      $output['featured_post'] = $featured_post;
			
    }
    if( isset($icon)) {
    	
      $output['icon'] = $icon;
			
    }
    
    return $output;
  }
}


/*///////////////////////////////// Register Panel Scripts and Styles /////////////////////////////////////////*/
function wd_admin_register() {
   
  wp_register_script( 'wd-admin-main', get_template_directory_uri() . '/inc/js/script.js', 
              array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-tabs', 
              'jquery-ui-droppable', 'jquery-ui-sortable' ) , false , false );   
  wp_register_style( 'wd-style', get_template_directory_uri().'/inc/css/style.css', array(), '20120208', 'all' ); 

  if ( isset( $_GET['page'] ) && $_GET['page'] == 'option panel' ) {


  }
  wp_enqueue_script( 'wd-admin-main' );
  wp_enqueue_style( 'wd-style' );

}
add_action( 'admin_enqueue_scripts', 'wd_admin_register' ); 



if(!function_exists('wd_load_color_picker')){
  add_action( 'load-widgets.php', 'wd_load_color_picker' );
  function wd_load_color_picker() {      
      wp_enqueue_style( 'wp-color-picker' );          
      wp_enqueue_script( 'wp-color-picker' );      
  }
}




/*///////////////////////////////// Theme Options /////////////////////////////////////////*/
if(!function_exists('wd_panel_option')){
  add_action('admin_menu','wd_panel_option');  
  function wd_panel_option(){
  	
    add_theme_support( 'custom-header' );  
    
    add_theme_page('Flat-Metro Options', 'Flat-Metro Options', 'edit_theme_options', 'flat-metro-theme-option' , 'wd_theme_option');
  }
}


if(!function_exists('wd_theme_option')){
  function wd_theme_option() {
    
    wp_enqueue_media(); 
    
    global $wd_tiles; 
    
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style( 'wp-color-picker' );
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {   
        $('.wd-color-picker').wpColorPicker();
        
        
        // detect the change
        $('.wd-color-picker').bind("change keyup paste input",function() {
            $(this).parent().parent().parent().css('background', "#F00");
        });
        
        $('.iris-square-value').on('mousedown', function(e) {
          //alert('clicked');
        }).on('mouseup', function(e) {
          $(this).parent().parent().parent().parent().parent().parent().css('background', $(this).parent().parent().parent().parent().parent().find('.wd-color-picker').val() );
        })
        
       $('.option-item.tile .iris-square-value').each(function( index ) { 
        $(this).parent().parent().parent().parent().parent().parent().css('background', $(this).parent().parent().parent().parent().parent().find('.wd-color-picker').val() );
       });
        
      //---------------logo script-----------  
      jQuery('#wd_upload_btn').click(function(){
      wp.media.editor.send.attachment = function(props, attachment){
        jQuery('#wd_logo_filed').val(attachment.url);
      }   

      
      wp.media.editor.open(this);
      
      return false;
      });
      //------favicon script-----    
      jQuery('#wd_upload_favicon').click(function(){
      wp.media.editor.send.attachment = function(props, attachment){
        jQuery('#wd_favicon_filed').val(attachment.url);
      }
      wp.media.editor.open(this);
      
      return false;
      });
      //------ Menu Background image -----    
      jQuery('#wd_upload_btn_bg').click(function(){
        var that = this;
        wp.media.editor.send.attachment = function(props, attachment){
          jQuery('#wd_menu_bg_img_filed').val(attachment.url);
          //JQuery(that).parent().append('<img src="'+ attachment.url +'" />')
        }
        wp.media.editor.open(this);        
        return false;
      });
      //------tile baground image-----    
      jQuery('.wd_tile-bg').click(function(){
      	var that = this;
	      wp.media.editor.send.attachment = function(props, attachment){
	        jQuery(that).val(attachment.url);
	      }
	      wp.media.editor.open(this);
	      
	      return false;
      });
    //-------------------------------------
        
        
        $('.option-item.big.tile select').change(function () {
         var optionSelected = $(this).find("option:selected");
         var valueSelected  = optionSelected.val();
         
         if( valueSelected == 'big-custom_text'){
          $(this).parent().find('textarea').show();
         }else{
          $(this).parent().find('textarea').hide();
         }
        });
        
        /**********inpute url ************/
        $('.option-item.medium.tile select.tile').change(function () {
         var optionSelected = $(this).find("option:selected");
         var valueSelected  = optionSelected.val();
         
         if( valueSelected == 'link-link'){
         	
          $(this).parent().find('.wd_link').show();
         }else{
         	
          $(this).parent().find('.wd_link').hide();
         }
        });
        /**********featured post ***********/
        $('.option-item.wide.tile select.featured').change(function () {
         var optionSelected = $(this).find("option:selected");
         var valueSelected  = optionSelected.val();
         
         if( valueSelected == 'wide-feature_blog_post'){
         	
          $(this).parent().find('.wd_featured').show();
         }else{
         	
          $(this).parent().find('.wd_featured').hide();
         }
        });
        
    });             
    </script>
    <?php  
    // Get lsit of Start screens layouts 
    $start_screans = wd_get_start_screens();
    
  
    if(isset($_POST['wd_start_screan'])){
      update_option('wd_start_screan', $_POST['wd_start_screan']);
    }
  
    $sreen_index = get_option('wd_start_screan');
    if(is_numeric($sreen_index)){ 
       $current_start_screan = $start_screans[$sreen_index];
    }else {
       $current_start_screan = $start_screans[0];
    }
       
  
       
    $wide_tiles = array( 
      'twitter'           => "Latest Tweets", 
      'testimonials'      => "Testimonials", 
      'feature_blog_post' => "Featured Post/Page", 
      'featured_project'  => "Featured Project" ,
      'boss_pic'          => "Boss Picture linked to team page" , 
      'next_event'        => "Next Event" );
       
    $big_tiles = array( 
      'portfolio_slider' => "Portfolio Slider", 
      'blog_slider'      => "Blog Post Slider", 
      //'gallery_slider'   => "Gallery Slider", 
      'slider_video'   => "Slider",
      'custom_text'      => "Custom Text" ); 
	  
	  $semi_large_tiles = array(
      'custom_text'      => "Custom HTML" 
	  ); 
	 

    
  	if(!empty($_POST)){	      
  	    
  	  // create tile array to save
      $tiles = array();
      $tiles[] = '';

      foreach ($current_start_screan as $key => $value) {
        //if(isset($_POST['tile-'. $key])){
          $column = (isset($_POST['column-'. $key])) ? $_POST['column-'. $key] : NULL;
          $color  = (isset($_POST['color-'. $key]))  ? $_POST['color-'. $key]  : NULL;
          $icon  = (isset($_POST['icon-'. $key]))  ? $_POST['icon-'. $key]  : NULL;
          $tile_img_bg  = (isset($_POST['tile-bg-'. $key]))  ? $_POST['tile-bg-'. $key]  : NULL;
          $title  = (isset($_POST['title-'. $key]))  ? $_POST['title-'. $key]  : NULL;
          $tile_url = (isset($_POST['url-'. $key]))  ? $_POST['url-'. $key]  : NULL;
          $tile_title_link = (isset($_POST['link-title-'. $key]))  ? $_POST['link-title-'. $key]  : NULL;
          $the_tile  = (isset($_POST['tile-'. $key]))  ? $_POST['tile-'. $key]  : NULL;
          $featured_post  = (isset($_POST['featured-post-'. $key]))  ? $_POST['featured-post-'. $key]  : NULL;
         
          
          $content  = (isset($_POST['content-'. $key]))  ? str_replace("\\", '', $_POST['content-'. $key])  : NULL;
					
          
          
          $tiles[] = wd_get_tile_info( $the_tile, $color, $column, $content, $title ,$tile_img_bg ,$tile_url,$tile_title_link,$featured_post,$icon ) ;
       
        //}
      }
      unset($tiles[0]);
      
      // save the tiles array
      update_option('tiles', $tiles );   
      $wd_tiles = get_option('tiles');
      
      
      if(isset($_POST['wd_show_logo']))
        update_option('wd_show_logo', $_POST['wd_show_logo']); 
      else
        update_option('wd_show_logo', ''); 
      
      
      if(isset($_POST['wd_on_hover_show_menu']))
        update_option('wd_on_hover_show_menu', $_POST['wd_on_hover_show_menu']); 
      else
        update_option('wd_on_hover_show_menu', ''); 
	  
	   if(isset($_POST['wd_menu_fix']))
        update_option('wd_menu_fix', $_POST['wd_menu_fix']); 
      else
        update_option('wd_menu_fix', ''); 
            
      if(isset($_POST['wd_show_menu_inleft']))
        update_option('wd_show_menu_inleft', $_POST['wd_show_menu_inleft']); 
      else
        update_option('wd_show_menu_inleft', ''); 
      
   if( isset($_POST['settings']['_wd_menu_bg_img']) && $_POST['settings']['_wd_menu_bg_img'] != "" )    
        update_option('wd_menu_bg_img',          $_POST['settings']['_wd_menu_bg_img']);
  
      if( isset($_POST['settings']['_wd_logo']) && $_POST['settings']['_wd_logo'] != "" )    
        update_option('wd_logo', $_POST['settings']['_wd_logo']); 
			
			if(isset($_POST['wd_show_title']))
        update_option('wd_show_title', $_POST['wd_show_title']); 
      else
        update_option('wd_show_title', 'of'); 
      
      update_option('wd_favicon', $_POST['settings']['_wd_favicon']);
      if( isset($_POST['settings']['_wd_tilebg']) )
			 update_option('wd_tilebg', $_POST['settings']['_wd_tilebg']);

      update_option('wd_menu_bg',      $_POST['wd_menu_bg']);
	  update_option('wd_menu_text_color',      $_POST['wd_menu_text_color']);
      
      update_option('wd_menu_ahover_bg',  $_POST['wd_menu_ahover_bg']);
      update_option('wd_menu_submenu_bg', $_POST['wd_menu_submenu_bg']);
      
      update_option('wd_copyright', $_POST['wd_copyright']);
      update_option('wd_margin_logo', $_POST['wd_margin_logo']);
      
      
	  if(isset($_POST['wd_page_transition']))
        update_option('wd_page_transition', $_POST['wd_page_transition']); 
      else
        update_option('wd_page_transition', 58);
      
      update_option('twitter', $_POST['twitter']);
      update_option('facebook', $_POST['facebook']);
      update_option('flickr', $_POST['flickr']);
      update_option('google_plus', $_POST['google_plus']);
      
	  if(isset($_POST['wd_theme_custom_css']))
      update_option('wd_theme_custom_css',               $_POST['wd_theme_custom_css']);
	  
	  if(isset($_POST['wd_theme_custom_js']))
	  update_option('wd_theme_custom_js',               $_POST['wd_theme_custom_js']);
      
      update_option('wd_lt_twitter_user', $_POST['wd_lt_twitter_user']);   
      update_option('wd_lt_consumer_key', $_POST['wd_lt_consumer_key']);    
      update_option('wd_lt_consumer_secret', $_POST['wd_lt_consumer_secret']);    
      update_option('wd_lt_oauth_token', $_POST['wd_lt_oauth_token']);    
      update_option('wd_lt_oauth_token_secret', $_POST['wd_lt_oauth_token_secret']);
      
  
  		} ?>
  	
  	
  	
  	
  
  <h2><?php echo __('Theme Options', THEME_NAME); ?></h2>
  
  <?php if(!empty($_POST)): ?>
    <div id="message" class="updated fade">
      <p><?php echo __('Configuration updated!!', THEME_NAME); ?> </p>
    </div>
  <?php endif;  ?>    
      
      
  <div class="wd-cpanel">
    <form id="wd-Panel"  method="POST" action="">
      <div id="tabs">
        <ul>
          <li><a href="#tabs-0"><?php echo __('General Settings', THEME_NAME); ?></a></li>
          <li><a href="#tabs-1"><?php echo __('Menu Settings', THEME_NAME); ?></a></li>
          <li><a href="#tabs-2"><?php echo __('Start Screan Tiles', THEME_NAME); ?></a></li>
          <li><a href="#tabs-3"><?php echo __('Social Icons', THEME_NAME); ?></a></li>
          <li><a href="#tabs-4"><?php echo __('Latest Tweets Configuration', THEME_NAME); ?></a></li>
          <li><a href="#tabs-5"><?php echo __('Theme Custom Css & js', THEME_NAME); ?></a></li>
          <li><a href="#tabs-6"><?php echo __('Import Demos', 'webdevia'); ?></a></li>
        </ul>
        <div id="tabs-0"> 
          <table class="form-table">
            <tbody>
            	
               <tr valign="top">
                <td scope="row">
                  <h3><?php echo __('Page transition effect', THEME_NAME); ?></h3>
                  <?php $animation=array('moveToLeft','moveToRight','moveToTop','moveToBottom','moveFromRight','moveFromLeft','moveFromBottom','moveFromTop','moveToLeftFade','ToRightFade','moveToTopFade','moveToBottomFade','moveToLeftEasing','moveToRightEasing','moveToTopEasing','moveToBottomEasing','scaleDown-moveFromRight','scaleDown-moveFromLeft','scaleDown-moveFromBottom','scaleDown-moveFromTop','scaleUpDown','scaleDownUp','moveToLeft-scaleUp','moveToRight-scaleUp','moveToTop-scaleUp','moveToBottom-scaleUp','scaleUpCenter','rotateRightSideFirst-moveFromRight','rotateLeftSideFirst-moveFromLeft','rotateTopSideFirst-moveFromTop','rotateBottomSideFirst-moveFromBottom','flipOutRight','flipOutLeft','flipOutTop','flipOutBottom','rotateFall','rotateOutNewspaper','rotatePushLeft','rotatePushRight','rotatePushTop','rotatePushBottom','rotatePullRight','rotatePullLeft','rotatePullBottom','rotatePullTop','rotateFoldLeft','rotateFoldRight','rotateFoldTop','rotateFoldBottom','moveToRightFade','rotateUnfoldRight','rotateUnfoldTop','rotateUnfoldBottom','rotateRoomLeftIn','rotateRoomRightOut','rotateRoomTopOut','rotateRoomBottomOut','rotateCubeLeftOut','rotateCubeRightOut','rotateCubeTopOut','rotateCubeBottomOut','rotateCarouselLeftOut','rotateCarouselRightOut','rotateCarouselTopOut','rotateCarouselBottomOut','rotateSidesOut','rotateSlideIn') ?>
                  <select name="wd_page_transition"> 
                  	<?php 
                  	if(get_option('wd_page_transition')==false)  update_option('wd_page_transition', 58); 
                  	foreach($animation as $key => $value){ ?>
                  	<option value="<?php echo $key + 1 ?>" <?php if(get_option('wd_page_transition') == ($key + 1) )  echo 'selected'; ?>>
                  	  <?php echo $value ?></option>
                  	<?php  } ?>
                  </select>
                    
                </td>
              </tr>
             
             
              <tr>
                <td>

                  <h3><?php echo __('Website Title:', THEME_NAME); ?></h3>
                  <label><input type="checkbox" <?php if(get_option('wd_show_title') != 'of') print 'checked'; ?>  name="wd_show_title" value="on" id="wd_show_title"/>Show Website Title</label>  
										<label for="wd_show_title"></label>               
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  <h3>Logo:</h3>
                  <label><input type="checkbox" <?php if(get_option('wd_show_logo') == 'on') print 'checked'; ?>  name="wd_show_logo" value="on" id="wd_show_logo"/><?php echo __('Show The Logo',THEME_NAME)?></label>  
                <td></td>
              </tr>
              
              <tr valign="top">
                <th scope="row">
                  <h3>Space:</h3>
                  <label><input type="text"   name="wd_margin_logo"  id="wd_margin_logo" value="<?php echo get_option('wd_margin_logo',''); ?>"/></label>  
                  <p class="description">space between logo and tiles (ex. 10px) </p>
                <td></td>
              </tr>
              
              <tr valign="top">
                <th scope="row">
                  <input type="text" name="settings[_wd_logo]" id="wd_logo_filed" />
                  <input class="button" name="_unique_name_button" id="wd_upload_btn" value="Upload" />
                </th>
                <td> <?php 
                $wd_logo = get_option('wd_logo');
                if(!empty($wd_logo)): ?> <img src="<?php print $wd_logo; ?>" style="max-height: 100px;" /> <?php endif;  ?></td>
              </tr>
              <!--favicon-->
                <tr valign="top">
                <th scope="row">
                  <h3>Favicon:</h3>
                  <input type="text" name="settings[_wd_favicon]" id="wd_favicon_filed" />
                  <input class="button" name="_unique_name_favicon" id="wd_upload_favicon" value="Upload" />
                </th>
                <td> <?php 
                $wd_favicon = get_option('wd_favicon');
                if(!empty($wd_favicon)): ?> <img src="<?php print $wd_favicon; ?>" style="max-height: 100px;" /> <?php endif;  ?></td>
              </tr>

              <!-- *************** -->
              <tr valign="top">
                <th scope="row">
                  <label for="blogdescription"><?php echo __('Footer Copyright text' , THEME_NAME); ?></label></th>
                  <?php 
                  $copyright = get_option('wd_copyright');
                  $copyright = (!empty($copyright)) ?  get_option('wd_copyright') : '&copy; 2013 Flat Metro All rights reserved.'; ?>
                <td><input type="text" class="wd_txt_big" name="wd_copyright" placeholder="Footer Copyright text" value="<?php echo $copyright; ?>"></td>
              </tr>
          
            </tbody>
          </table>
          
        </div>
        <div id="tabs-1"> 
          <table class="form-table">
            <tbody>
            	<tr>
                <td>
                	<label>
                		
                		<?php echo __('Menu background image:', THEME_NAME); ?>
                  <input type="text" name="settings[_wd_menu_bg_img]" id="wd_menu_bg_img_filed" />
                  <input class="button" name="_unique_name_button" id="wd_upload_btn_bg" value="Upload" />
                  
                  </label>
                </td>
                
                <?php $wd_menu_bg_img = get_option('wd_menu_bg_img');
                  if(!empty($wd_menu_bg_img) && $wd_menu_bg_img != "none" ): ?> 
                    <td class="img-container"> 
                      <img src="<?php print $wd_menu_bg_img; ?>" style="max-height: 100px;" /> 
                      <span class="remove-img">X</span>
                    </td>
                  <?php endif; ?>
              </tr>
              
               <tr valign="top">
                
                  <label>
                  	<input type="checkbox" <?php if(get_option('wd_on_hover_show_menu') == 'on') print 'checked'; ?>  name="wd_on_hover_show_menu" value="on" id="wd_on_hover_show_menu"/>
                  	<?php echo __('Show Menu on Hover',THEME_NAME)?></label> 
                <td></td>
              </tr>
              
              <tr valign="top">
                <th scope="row">
                  <label>
                  	<input type="checkbox" <?php if(get_option('wd_menu_fix') == 'on') print 'checked'; ?>  name="wd_menu_fix" value="on" id="wd_menu_fix"/>
                  	<?php echo __('Fixed Menu',THEME_NAME)?></label> 
                <td></td>
              </tr>
              
              <tr valign="top">
                <th scope="row" colspan="2">
                  <label><input type="checkbox" <?php if(get_option('wd_show_menu_inleft') == 'on') print 'checked'; ?>  name="wd_show_menu_inleft" value="on" id="wd_show_menu_inleft"/><?php echo __('Show Menu on the Left Side',THEME_NAME)?></label>                  
               </th>
              </tr>
              
               <tr valign="top">
                <th scope="row"><?php echo __('Menu Background Color:',THEME_NAME)?></th>
                <td><?php $wd_menu_bg = get_option('wd_menu_bg'); ?>
                  <input name="wd_menu_bg" type="text" value="<?php print $wd_menu_bg; ?>" class="wd-color-picker" data-default-color="#C0392B"></td>
              </tr>
              <tr valign="top">
                <th scope="row"><?php echo __('Menu Text Color:',THEME_NAME)?></th>
                <td><?php $wd_menu_text_color = get_option('wd_menu_text_color'); ?>
                  <input name="wd_menu_text_color" type="text" value="<?php print $wd_menu_text_color; ?>" class="wd-color-picker" data-default-color="#C0392B"></td>
              </tr>
              <tr valign="top">
                <th scope="row"><?php echo __('Menu link hover background:',THEME_NAME)?></th>
                <td><?php $wd_menu_ahover_bg = get_option('wd_menu_ahover_bg'); ?>
                  <input name="wd_menu_ahover_bg" type="text" value="<?php print $wd_menu_ahover_bg; ?>" class="wd-color-picker" data-default-color="#C0392B"></td>
              </tr>
              <tr valign="top">
                <th scope="row"><?php echo __('Sub-Menu link background:',THEME_NAME)?></th>
                <td><?php $wd_menu_submenu_bg = get_option('wd_menu_submenu_bg'); ?>
                  <input name="wd_menu_submenu_bg" type="text" value="<?php print $wd_menu_submenu_bg; ?>" class="wd-color-picker" data-default-color="#C0392B"></td>
              </tr>
            	
            	</tbody>
            	</table>
            </div>
            
        <div id="tabs-2">
          <h3><?php echo __('Select a Layout', THEME_NAME ) ?>:</h3>
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="0" <?php if($sreen_index == '0') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-0.png"/> </label> 
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="1" <?php if($sreen_index == '1') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-1.png"/> </label>
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="2" <?php if($sreen_index == '2') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-2.png"/> </label>
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="3" <?php if($sreen_index == '3') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-3.png"/> </label>
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="4" <?php if($sreen_index == '4') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-4.png"/> </label>
            <!-- modefie -->
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="5" <?php if($sreen_index == '5') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-5.png"/> </label>
          <!--  -->
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="6" <?php if($sreen_index == '6') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-2.png"/> </label>
            <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="7" <?php if($sreen_index == '7') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-7.png"/> </label>
            <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="8" <?php if($sreen_index == '8') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-8.png"/> </label>
            
            <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="9" <?php if($sreen_index == '9') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-9.png"/> </label>
            
          <br/> 
          
          <h3><?php echo __('Tiles Settings:', THEME_NAME ) ?></h3>
          <div style="background: url('<?php echo get_template_directory_uri() ?>/images/panel-bg.jpg'); overflow: hidden; padding: 80px 15px; min-width:1600px;">
            <?php           
            $pages_id = wd_get_page_id(); 
            $old_column = 1;
            foreach ($current_start_screan as $tile_postion => $tile) {
              if( $tile_postion == 1 || $tile['column'] != $old_column  ) {
                if( $tile_postion != 1 || $tile['column'] != $old_column  ) {
                  echo "</div> ";
                } ?> 
                <div class="large-4 columns">
                <?php $old_column = $tile['column'];
              }
                if( isset($tile['type']) && $tile['type'] == 'medium') : ?>
                  <div class="option-item medium tile tile-<?php echo $tile_postion ?>">
                    <div class="label"><span><?php echo 'Position '. $tile_postion ?></span></div>
                    <select class="tile" name="tile-<?php echo $tile_postion ?>"> 
                      <optgroup label="Pages">            <?php           
                      
                      foreach ( $pages_id as $key => $page_id ) { 
                        ( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $page_id) ? ($selected = 'selected=selected') : $selected = ''; ?>              
                        <option value="page-<?php print $page_id ?>" <?php echo $selected ?> ><?php print get_the_title($page_id) ?></option>   <?php               
                      } ?>
                      </optgroup>
                      <optgroup label="Social Icons">
                        <option value="social-facebook" <?php if($wd_tiles[$tile_postion]['id'] == 'facebook') {$selected = 'selected=selected'; echo $selected; }else{  $selected = '';echo $selected;} ?>>Facebook</option>
                        <option value="social-twitter" <?php if($wd_tiles[$tile_postion]['id'] == 'twitter') {$selected = 'selected=selected'; echo $selected; }else{  $selected = '';echo $selected;} ?>>Twitter</option>
                      </optgroup>
                      <optgroup label="link-link">
                        <option value="link-link" <?php if($wd_tiles[$tile_postion]['id'] == 'link') {$selected_link = 'selected=selected'; echo $selected_link; }else{  $selected_link = '';echo $selected_link;} ?> >Tile with link</option>
                      </optgroup>
                      <optgroup label="vide">
                        <option value="vide-vide" <?php if($wd_tiles[$tile_postion]['id'] == 'vide') {$selected = 'selected=selected'; echo $selected; }else{  $selected = '';echo $selected;} ?>>Empty Tile</option>
                      </optgroup>
                    </select>
                    <div class="wd_link"  <?php if( $selected_link == '' ):?> style="display: none" <?php  endif; ?>> 
                   <label>Title <input class="wd_link" name="link-title-<?php echo $tile_postion ?>" value="<?php if(isset($wd_tiles[$tile_postion]['url_title'])) print $wd_tiles[$tile_postion]['url_title'] ?>">
                    </label>
                    <label>URL<input class="wd_link" name="url-<?php echo $tile_postion ?>" value="<?php if(isset($wd_tiles[$tile_postion]['url'])) print $wd_tiles[$tile_postion]['url'] ?>">
                  </label>
                  <?php  
                  $icons = 'a:586:{i:0;s:14:"---- None ----";s:8:"fa-500px";s:8:"fa-500px";s:9:"fa-adjust";s:9:"fa-adjust";s:6:"fa-adn";s:6:"fa-adn";s:15:"fa-align-center";s:15:"fa-align-center";s:16:"fa-align-justify";s:16:"fa-align-justify";s:13:"fa-align-left";s:13:"fa-align-left";s:14:"fa-align-right";s:14:"fa-align-right";s:9:"fa-amazon";s:9:"fa-amazon";s:12:"fa-ambulance";s:12:"fa-ambulance";s:9:"fa-anchor";s:9:"fa-anchor";s:10:"fa-android";s:10:"fa-android";s:12:"fa-angellist";s:12:"fa-angellist";s:20:"fa-angle-double-down";s:20:"fa-angle-double-down";s:20:"fa-angle-double-left";s:20:"fa-angle-double-left";s:21:"fa-angle-double-right";s:21:"fa-angle-double-right";s:18:"fa-angle-double-up";s:18:"fa-angle-double-up";s:13:"fa-angle-down";s:13:"fa-angle-down";s:13:"fa-angle-left";s:13:"fa-angle-left";s:14:"fa-angle-right";s:14:"fa-angle-right";s:11:"fa-angle-up";s:11:"fa-angle-up";s:8:"fa-apple";s:8:"fa-apple";s:10:"fa-archive";s:10:"fa-archive";s:13:"fa-area-chart";s:13:"fa-area-chart";s:20:"fa-arrow-circle-down";s:20:"fa-arrow-circle-down";s:20:"fa-arrow-circle-left";s:20:"fa-arrow-circle-left";s:22:"fa-arrow-circle-o-down";s:22:"fa-arrow-circle-o-down";s:22:"fa-arrow-circle-o-left";s:22:"fa-arrow-circle-o-left";s:23:"fa-arrow-circle-o-right";s:23:"fa-arrow-circle-o-right";s:20:"fa-arrow-circle-o-up";s:20:"fa-arrow-circle-o-up";s:21:"fa-arrow-circle-right";s:21:"fa-arrow-circle-right";s:18:"fa-arrow-circle-up";s:18:"fa-arrow-circle-up";s:13:"fa-arrow-down";s:13:"fa-arrow-down";s:13:"fa-arrow-left";s:13:"fa-arrow-left";s:14:"fa-arrow-right";s:14:"fa-arrow-right";s:11:"fa-arrow-up";s:11:"fa-arrow-up";s:9:"fa-arrows";s:9:"fa-arrows";s:13:"fa-arrows-alt";s:13:"fa-arrows-alt";s:11:"fa-arrows-h";s:11:"fa-arrows-h";s:11:"fa-arrows-v";s:11:"fa-arrows-v";s:11:"fa-asterisk";s:11:"fa-asterisk";s:5:"fa-at";s:5:"fa-at";s:11:"fa-backward";s:11:"fa-backward";s:16:"fa-balance-scale";s:16:"fa-balance-scale";s:6:"fa-ban";s:6:"fa-ban";s:12:"fa-bar-chart";s:12:"fa-bar-chart";s:10:"fa-barcode";s:10:"fa-barcode";s:7:"fa-bars";s:7:"fa-bars";s:16:"fa-battery-empty";s:16:"fa-battery-empty";s:15:"fa-battery-full";s:15:"fa-battery-full";s:15:"fa-battery-half";s:15:"fa-battery-half";s:18:"fa-battery-quarter";s:18:"fa-battery-quarter";s:25:"fa-battery-three-quarters";s:25:"fa-battery-three-quarters";s:6:"fa-bed";s:6:"fa-bed";s:7:"fa-beer";s:7:"fa-beer";s:10:"fa-behance";s:10:"fa-behance";s:17:"fa-behance-square";s:17:"fa-behance-square";s:7:"fa-bell";s:7:"fa-bell";s:9:"fa-bell-o";s:9:"fa-bell-o";s:13:"fa-bell-slash";s:13:"fa-bell-slash";s:15:"fa-bell-slash-o";s:15:"fa-bell-slash-o";s:10:"fa-bicycle";s:10:"fa-bicycle";s:13:"fa-binoculars";s:13:"fa-binoculars";s:16:"fa-birthday-cake";s:16:"fa-birthday-cake";s:12:"fa-bitbucket";s:12:"fa-bitbucket";s:19:"fa-bitbucket-square";s:19:"fa-bitbucket-square";s:12:"fa-black-tie";s:12:"fa-black-tie";s:7:"fa-bold";s:7:"fa-bold";s:7:"fa-bolt";s:7:"fa-bolt";s:7:"fa-bomb";s:7:"fa-bomb";s:7:"fa-book";s:7:"fa-book";s:11:"fa-bookmark";s:11:"fa-bookmark";s:13:"fa-bookmark-o";s:13:"fa-bookmark-o";s:12:"fa-briefcase";s:12:"fa-briefcase";s:6:"fa-btc";s:6:"fa-btc";s:6:"fa-bug";s:6:"fa-bug";s:11:"fa-building";s:11:"fa-building";s:13:"fa-building-o";s:13:"fa-building-o";s:11:"fa-bullhorn";s:11:"fa-bullhorn";s:11:"fa-bullseye";s:11:"fa-bullseye";s:6:"fa-bus";s:6:"fa-bus";s:13:"fa-buysellads";s:13:"fa-buysellads";s:13:"fa-calculator";s:13:"fa-calculator";s:11:"fa-calendar";s:11:"fa-calendar";s:19:"fa-calendar-check-o";s:19:"fa-calendar-check-o";s:19:"fa-calendar-minus-o";s:19:"fa-calendar-minus-o";s:13:"fa-calendar-o";s:13:"fa-calendar-o";s:18:"fa-calendar-plus-o";s:18:"fa-calendar-plus-o";s:19:"fa-calendar-times-o";s:19:"fa-calendar-times-o";s:9:"fa-camera";s:9:"fa-camera";s:15:"fa-camera-retro";s:15:"fa-camera-retro";s:6:"fa-car";s:6:"fa-car";s:13:"fa-caret-down";s:13:"fa-caret-down";s:13:"fa-caret-left";s:13:"fa-caret-left";s:14:"fa-caret-right";s:14:"fa-caret-right";s:22:"fa-caret-square-o-down";s:22:"fa-caret-square-o-down";s:22:"fa-caret-square-o-left";s:22:"fa-caret-square-o-left";s:23:"fa-caret-square-o-right";s:23:"fa-caret-square-o-right";s:20:"fa-caret-square-o-up";s:20:"fa-caret-square-o-up";s:11:"fa-caret-up";s:11:"fa-caret-up";s:18:"fa-cart-arrow-down";s:18:"fa-cart-arrow-down";s:12:"fa-cart-plus";s:12:"fa-cart-plus";s:5:"fa-cc";s:5:"fa-cc";s:10:"fa-cc-amex";s:10:"fa-cc-amex";s:17:"fa-cc-diners-club";s:17:"fa-cc-diners-club";s:14:"fa-cc-discover";s:14:"fa-cc-discover";s:9:"fa-cc-jcb";s:9:"fa-cc-jcb";s:16:"fa-cc-mastercard";s:16:"fa-cc-mastercard";s:12:"fa-cc-paypal";s:12:"fa-cc-paypal";s:12:"fa-cc-stripe";s:12:"fa-cc-stripe";s:10:"fa-cc-visa";s:10:"fa-cc-visa";s:14:"fa-certificate";s:14:"fa-certificate";s:15:"fa-chain-broken";s:15:"fa-chain-broken";s:8:"fa-check";s:8:"fa-check";s:15:"fa-check-circle";s:15:"fa-check-circle";s:17:"fa-check-circle-o";s:17:"fa-check-circle-o";s:15:"fa-check-square";s:15:"fa-check-square";s:17:"fa-check-square-o";s:17:"fa-check-square-o";s:22:"fa-chevron-circle-down";s:22:"fa-chevron-circle-down";s:22:"fa-chevron-circle-left";s:22:"fa-chevron-circle-left";s:23:"fa-chevron-circle-right";s:23:"fa-chevron-circle-right";s:20:"fa-chevron-circle-up";s:20:"fa-chevron-circle-up";s:15:"fa-chevron-down";s:15:"fa-chevron-down";s:15:"fa-chevron-left";s:15:"fa-chevron-left";s:16:"fa-chevron-right";s:16:"fa-chevron-right";s:13:"fa-chevron-up";s:13:"fa-chevron-up";s:8:"fa-child";s:8:"fa-child";s:9:"fa-chrome";s:9:"fa-chrome";s:9:"fa-circle";s:9:"fa-circle";s:11:"fa-circle-o";s:11:"fa-circle-o";s:17:"fa-circle-o-notch";s:17:"fa-circle-o-notch";s:14:"fa-circle-thin";s:14:"fa-circle-thin";s:12:"fa-clipboard";s:12:"fa-clipboard";s:10:"fa-clock-o";s:10:"fa-clock-o";s:8:"fa-clone";s:8:"fa-clone";s:8:"fa-cloud";s:8:"fa-cloud";s:17:"fa-cloud-download";s:17:"fa-cloud-download";s:15:"fa-cloud-upload";s:15:"fa-cloud-upload";s:7:"fa-code";s:7:"fa-code";s:12:"fa-code-fork";s:12:"fa-code-fork";s:10:"fa-codepen";s:10:"fa-codepen";s:9:"fa-coffee";s:9:"fa-coffee";s:6:"fa-cog";s:6:"fa-cog";s:7:"fa-cogs";s:7:"fa-cogs";s:10:"fa-columns";s:10:"fa-columns";s:10:"fa-comment";s:10:"fa-comment";s:12:"fa-comment-o";s:12:"fa-comment-o";s:13:"fa-commenting";s:13:"fa-commenting";s:15:"fa-commenting-o";s:15:"fa-commenting-o";s:11:"fa-comments";s:11:"fa-comments";s:13:"fa-comments-o";s:13:"fa-comments-o";s:10:"fa-compass";s:10:"fa-compass";s:11:"fa-compress";s:11:"fa-compress";s:17:"fa-connectdevelop";s:17:"fa-connectdevelop";s:9:"fa-contao";s:9:"fa-contao";s:12:"fa-copyright";s:12:"fa-copyright";s:19:"fa-creative-commons";s:19:"fa-creative-commons";s:14:"fa-credit-card";s:14:"fa-credit-card";s:7:"fa-crop";s:7:"fa-crop";s:13:"fa-crosshairs";s:13:"fa-crosshairs";s:7:"fa-css3";s:7:"fa-css3";s:7:"fa-cube";s:7:"fa-cube";s:8:"fa-cubes";s:8:"fa-cubes";s:10:"fa-cutlery";s:10:"fa-cutlery";s:11:"fa-dashcube";s:11:"fa-dashcube";s:11:"fa-database";s:11:"fa-database";s:12:"fa-delicious";s:12:"fa-delicious";s:10:"fa-desktop";s:10:"fa-desktop";s:13:"fa-deviantart";s:13:"fa-deviantart";s:10:"fa-diamond";s:10:"fa-diamond";s:7:"fa-digg";s:7:"fa-digg";s:15:"fa-dot-circle-o";s:15:"fa-dot-circle-o";s:11:"fa-download";s:11:"fa-download";s:11:"fa-dribbble";s:11:"fa-dribbble";s:10:"fa-dropbox";s:10:"fa-dropbox";s:9:"fa-drupal";s:9:"fa-drupal";s:8:"fa-eject";s:8:"fa-eject";s:13:"fa-ellipsis-h";s:13:"fa-ellipsis-h";s:13:"fa-ellipsis-v";s:13:"fa-ellipsis-v";s:9:"fa-empire";s:9:"fa-empire";s:11:"fa-envelope";s:11:"fa-envelope";s:13:"fa-envelope-o";s:13:"fa-envelope-o";s:18:"fa-envelope-square";s:18:"fa-envelope-square";s:9:"fa-eraser";s:9:"fa-eraser";s:6:"fa-eur";s:6:"fa-eur";s:11:"fa-exchange";s:11:"fa-exchange";s:14:"fa-exclamation";s:14:"fa-exclamation";s:21:"fa-exclamation-circle";s:21:"fa-exclamation-circle";s:23:"fa-exclamation-triangle";s:23:"fa-exclamation-triangle";s:9:"fa-expand";s:9:"fa-expand";s:15:"fa-expeditedssl";s:15:"fa-expeditedssl";s:16:"fa-external-link";s:16:"fa-external-link";s:23:"fa-external-link-square";s:23:"fa-external-link-square";s:6:"fa-eye";s:6:"fa-eye";s:12:"fa-eye-slash";s:12:"fa-eye-slash";s:13:"fa-eyedropper";s:13:"fa-eyedropper";s:11:"fa-facebook";s:11:"fa-facebook";s:20:"fa-facebook-official";s:20:"fa-facebook-official";s:18:"fa-facebook-square";s:18:"fa-facebook-square";s:16:"fa-fast-backward";s:16:"fa-fast-backward";s:15:"fa-fast-forward";s:15:"fa-fast-forward";s:6:"fa-fax";s:6:"fa-fax";s:9:"fa-female";s:9:"fa-female";s:14:"fa-fighter-jet";s:14:"fa-fighter-jet";s:7:"fa-file";s:7:"fa-file";s:17:"fa-file-archive-o";s:17:"fa-file-archive-o";s:15:"fa-file-audio-o";s:15:"fa-file-audio-o";s:14:"fa-file-code-o";s:14:"fa-file-code-o";s:15:"fa-file-excel-o";s:15:"fa-file-excel-o";s:15:"fa-file-image-o";s:15:"fa-file-image-o";s:9:"fa-file-o";s:9:"fa-file-o";s:13:"fa-file-pdf-o";s:13:"fa-file-pdf-o";s:20:"fa-file-powerpoint-o";s:20:"fa-file-powerpoint-o";s:12:"fa-file-text";s:12:"fa-file-text";s:14:"fa-file-text-o";s:14:"fa-file-text-o";s:15:"fa-file-video-o";s:15:"fa-file-video-o";s:14:"fa-file-word-o";s:14:"fa-file-word-o";s:10:"fa-files-o";s:10:"fa-files-o";s:7:"fa-film";s:7:"fa-film";s:9:"fa-filter";s:9:"fa-filter";s:7:"fa-fire";s:7:"fa-fire";s:20:"fa-fire-extinguisher";s:20:"fa-fire-extinguisher";s:10:"fa-firefox";s:10:"fa-firefox";s:7:"fa-flag";s:7:"fa-flag";s:17:"fa-flag-checkered";s:17:"fa-flag-checkered";s:9:"fa-flag-o";s:9:"fa-flag-o";s:8:"fa-flask";s:8:"fa-flask";s:9:"fa-flickr";s:9:"fa-flickr";s:11:"fa-floppy-o";s:11:"fa-floppy-o";s:9:"fa-folder";s:9:"fa-folder";s:11:"fa-folder-o";s:11:"fa-folder-o";s:14:"fa-folder-open";s:14:"fa-folder-open";s:16:"fa-folder-open-o";s:16:"fa-folder-open-o";s:7:"fa-font";s:7:"fa-font";s:12:"fa-fonticons";s:12:"fa-fonticons";s:11:"fa-forumbee";s:11:"fa-forumbee";s:10:"fa-forward";s:10:"fa-forward";s:13:"fa-foursquare";s:13:"fa-foursquare";s:10:"fa-frown-o";s:10:"fa-frown-o";s:11:"fa-futbol-o";s:11:"fa-futbol-o";s:10:"fa-gamepad";s:10:"fa-gamepad";s:8:"fa-gavel";s:8:"fa-gavel";s:6:"fa-gbp";s:6:"fa-gbp";s:13:"fa-genderless";s:13:"fa-genderless";s:13:"fa-get-pocket";s:13:"fa-get-pocket";s:5:"fa-gg";s:5:"fa-gg";s:12:"fa-gg-circle";s:12:"fa-gg-circle";s:7:"fa-gift";s:7:"fa-gift";s:6:"fa-git";s:6:"fa-git";s:13:"fa-git-square";s:13:"fa-git-square";s:9:"fa-github";s:9:"fa-github";s:13:"fa-github-alt";s:13:"fa-github-alt";s:16:"fa-github-square";s:16:"fa-github-square";s:8:"fa-glass";s:8:"fa-glass";s:8:"fa-globe";s:8:"fa-globe";s:9:"fa-google";s:9:"fa-google";s:14:"fa-google-plus";s:14:"fa-google-plus";s:21:"fa-google-plus-square";s:21:"fa-google-plus-square";s:16:"fa-google-wallet";s:16:"fa-google-wallet";s:17:"fa-graduation-cap";s:17:"fa-graduation-cap";s:11:"fa-gratipay";s:11:"fa-gratipay";s:11:"fa-h-square";s:11:"fa-h-square";s:14:"fa-hacker-news";s:14:"fa-hacker-news";s:16:"fa-hand-lizard-o";s:16:"fa-hand-lizard-o";s:14:"fa-hand-o-down";s:14:"fa-hand-o-down";s:14:"fa-hand-o-left";s:14:"fa-hand-o-left";s:15:"fa-hand-o-right";s:15:"fa-hand-o-right";s:12:"fa-hand-o-up";s:12:"fa-hand-o-up";s:15:"fa-hand-paper-o";s:15:"fa-hand-paper-o";s:15:"fa-hand-peace-o";s:15:"fa-hand-peace-o";s:17:"fa-hand-pointer-o";s:17:"fa-hand-pointer-o";s:14:"fa-hand-rock-o";s:14:"fa-hand-rock-o";s:18:"fa-hand-scissors-o";s:18:"fa-hand-scissors-o";s:15:"fa-hand-spock-o";s:15:"fa-hand-spock-o";s:8:"fa-hdd-o";s:8:"fa-hdd-o";s:9:"fa-header";s:9:"fa-header";s:13:"fa-headphones";s:13:"fa-headphones";s:8:"fa-heart";s:8:"fa-heart";s:10:"fa-heart-o";s:10:"fa-heart-o";s:12:"fa-heartbeat";s:12:"fa-heartbeat";s:10:"fa-history";s:10:"fa-history";s:7:"fa-home";s:7:"fa-home";s:13:"fa-hospital-o";s:13:"fa-hospital-o";s:12:"fa-hourglass";s:12:"fa-hourglass";s:16:"fa-hourglass-end";s:16:"fa-hourglass-end";s:17:"fa-hourglass-half";s:17:"fa-hourglass-half";s:14:"fa-hourglass-o";s:14:"fa-hourglass-o";s:18:"fa-hourglass-start";s:18:"fa-hourglass-start";s:8:"fa-houzz";s:8:"fa-houzz";s:8:"fa-html5";s:8:"fa-html5";s:11:"fa-i-cursor";s:11:"fa-i-cursor";s:6:"fa-ils";s:6:"fa-ils";s:8:"fa-inbox";s:8:"fa-inbox";s:9:"fa-indent";s:9:"fa-indent";s:11:"fa-industry";s:11:"fa-industry";s:7:"fa-info";s:7:"fa-info";s:14:"fa-info-circle";s:14:"fa-info-circle";s:6:"fa-inr";s:6:"fa-inr";s:12:"fa-instagram";s:12:"fa-instagram";s:20:"fa-internet-explorer";s:20:"fa-internet-explorer";s:10:"fa-ioxhost";s:10:"fa-ioxhost";s:9:"fa-italic";s:9:"fa-italic";s:9:"fa-joomla";s:9:"fa-joomla";s:6:"fa-jpy";s:6:"fa-jpy";s:11:"fa-jsfiddle";s:11:"fa-jsfiddle";s:6:"fa-key";s:6:"fa-key";s:13:"fa-keyboard-o";s:13:"fa-keyboard-o";s:6:"fa-krw";s:6:"fa-krw";s:11:"fa-language";s:11:"fa-language";s:9:"fa-laptop";s:9:"fa-laptop";s:9:"fa-lastfm";s:9:"fa-lastfm";s:16:"fa-lastfm-square";s:16:"fa-lastfm-square";s:7:"fa-leaf";s:7:"fa-leaf";s:10:"fa-leanpub";s:10:"fa-leanpub";s:10:"fa-lemon-o";s:10:"fa-lemon-o";s:13:"fa-level-down";s:13:"fa-level-down";s:11:"fa-level-up";s:11:"fa-level-up";s:12:"fa-life-ring";s:12:"fa-life-ring";s:14:"fa-lightbulb-o";s:14:"fa-lightbulb-o";s:13:"fa-line-chart";s:13:"fa-line-chart";s:7:"fa-link";s:7:"fa-link";s:11:"fa-linkedin";s:11:"fa-linkedin";s:18:"fa-linkedin-square";s:18:"fa-linkedin-square";s:8:"fa-linux";s:8:"fa-linux";s:7:"fa-list";s:7:"fa-list";s:11:"fa-list-alt";s:11:"fa-list-alt";s:10:"fa-list-ol";s:10:"fa-list-ol";s:10:"fa-list-ul";s:10:"fa-list-ul";s:17:"fa-location-arrow";s:17:"fa-location-arrow";s:7:"fa-lock";s:7:"fa-lock";s:18:"fa-long-arrow-down";s:18:"fa-long-arrow-down";s:18:"fa-long-arrow-left";s:18:"fa-long-arrow-left";s:19:"fa-long-arrow-right";s:19:"fa-long-arrow-right";s:16:"fa-long-arrow-up";s:16:"fa-long-arrow-up";s:8:"fa-magic";s:8:"fa-magic";s:9:"fa-magnet";s:9:"fa-magnet";s:7:"fa-male";s:7:"fa-male";s:6:"fa-map";s:6:"fa-map";s:13:"fa-map-marker";s:13:"fa-map-marker";s:8:"fa-map-o";s:8:"fa-map-o";s:10:"fa-map-pin";s:10:"fa-map-pin";s:12:"fa-map-signs";s:12:"fa-map-signs";s:7:"fa-mars";s:7:"fa-mars";s:14:"fa-mars-double";s:14:"fa-mars-double";s:14:"fa-mars-stroke";s:14:"fa-mars-stroke";s:16:"fa-mars-stroke-h";s:16:"fa-mars-stroke-h";s:16:"fa-mars-stroke-v";s:16:"fa-mars-stroke-v";s:9:"fa-maxcdn";s:9:"fa-maxcdn";s:11:"fa-meanpath";s:11:"fa-meanpath";s:9:"fa-medium";s:9:"fa-medium";s:9:"fa-medkit";s:9:"fa-medkit";s:8:"fa-meh-o";s:8:"fa-meh-o";s:10:"fa-mercury";s:10:"fa-mercury";s:13:"fa-microphone";s:13:"fa-microphone";s:19:"fa-microphone-slash";s:19:"fa-microphone-slash";s:8:"fa-minus";s:8:"fa-minus";s:15:"fa-minus-circle";s:15:"fa-minus-circle";s:15:"fa-minus-square";s:15:"fa-minus-square";s:17:"fa-minus-square-o";s:17:"fa-minus-square-o";s:9:"fa-mobile";s:9:"fa-mobile";s:8:"fa-money";s:8:"fa-money";s:9:"fa-moon-o";s:9:"fa-moon-o";s:13:"fa-motorcycle";s:13:"fa-motorcycle";s:16:"fa-mouse-pointer";s:16:"fa-mouse-pointer";s:8:"fa-music";s:8:"fa-music";s:9:"fa-neuter";s:9:"fa-neuter";s:14:"fa-newspaper-o";s:14:"fa-newspaper-o";s:15:"fa-object-group";s:15:"fa-object-group";s:17:"fa-object-ungroup";s:17:"fa-object-ungroup";s:16:"fa-odnoklassniki";s:16:"fa-odnoklassniki";s:23:"fa-odnoklassniki-square";s:23:"fa-odnoklassniki-square";s:11:"fa-opencart";s:11:"fa-opencart";s:9:"fa-openid";s:9:"fa-openid";s:8:"fa-opera";s:8:"fa-opera";s:16:"fa-optin-monster";s:16:"fa-optin-monster";s:10:"fa-outdent";s:10:"fa-outdent";s:12:"fa-pagelines";s:12:"fa-pagelines";s:14:"fa-paint-brush";s:14:"fa-paint-brush";s:14:"fa-paper-plane";s:14:"fa-paper-plane";s:16:"fa-paper-plane-o";s:16:"fa-paper-plane-o";s:12:"fa-paperclip";s:12:"fa-paperclip";s:12:"fa-paragraph";s:12:"fa-paragraph";s:8:"fa-pause";s:8:"fa-pause";s:6:"fa-paw";s:6:"fa-paw";s:9:"fa-paypal";s:9:"fa-paypal";s:9:"fa-pencil";s:9:"fa-pencil";s:16:"fa-pencil-square";s:16:"fa-pencil-square";s:18:"fa-pencil-square-o";s:18:"fa-pencil-square-o";s:8:"fa-phone";s:8:"fa-phone";s:15:"fa-phone-square";s:15:"fa-phone-square";s:12:"fa-picture-o";s:12:"fa-picture-o";s:12:"fa-pie-chart";s:12:"fa-pie-chart";s:13:"fa-pied-piper";s:13:"fa-pied-piper";s:17:"fa-pied-piper-alt";s:17:"fa-pied-piper-alt";s:12:"fa-pinterest";s:12:"fa-pinterest";s:14:"fa-pinterest-p";s:14:"fa-pinterest-p";s:19:"fa-pinterest-square";s:19:"fa-pinterest-square";s:8:"fa-plane";s:8:"fa-plane";s:7:"fa-play";s:7:"fa-play";s:14:"fa-play-circle";s:14:"fa-play-circle";s:16:"fa-play-circle-o";s:16:"fa-play-circle-o";s:7:"fa-plug";s:7:"fa-plug";s:7:"fa-plus";s:7:"fa-plus";s:14:"fa-plus-circle";s:14:"fa-plus-circle";s:14:"fa-plus-square";s:14:"fa-plus-square";s:16:"fa-plus-square-o";s:16:"fa-plus-square-o";s:12:"fa-power-off";s:12:"fa-power-off";s:8:"fa-print";s:8:"fa-print";s:15:"fa-puzzle-piece";s:15:"fa-puzzle-piece";s:5:"fa-qq";s:5:"fa-qq";s:9:"fa-qrcode";s:9:"fa-qrcode";s:11:"fa-question";s:11:"fa-question";s:18:"fa-question-circle";s:18:"fa-question-circle";s:13:"fa-quote-left";s:13:"fa-quote-left";s:14:"fa-quote-right";s:14:"fa-quote-right";s:9:"fa-random";s:9:"fa-random";s:8:"fa-rebel";s:8:"fa-rebel";s:10:"fa-recycle";s:10:"fa-recycle";s:9:"fa-reddit";s:9:"fa-reddit";s:16:"fa-reddit-square";s:16:"fa-reddit-square";s:10:"fa-refresh";s:10:"fa-refresh";s:13:"fa-registered";s:13:"fa-registered";s:9:"fa-renren";s:9:"fa-renren";s:9:"fa-repeat";s:9:"fa-repeat";s:8:"fa-reply";s:8:"fa-reply";s:12:"fa-reply-all";s:12:"fa-reply-all";s:10:"fa-retweet";s:10:"fa-retweet";s:7:"fa-road";s:7:"fa-road";s:9:"fa-rocket";s:9:"fa-rocket";s:6:"fa-rss";s:6:"fa-rss";s:13:"fa-rss-square";s:13:"fa-rss-square";s:6:"fa-rub";s:6:"fa-rub";s:9:"fa-safari";s:9:"fa-safari";s:11:"fa-scissors";s:11:"fa-scissors";s:9:"fa-search";s:9:"fa-search";s:15:"fa-search-minus";s:15:"fa-search-minus";s:14:"fa-search-plus";s:14:"fa-search-plus";s:9:"fa-sellsy";s:9:"fa-sellsy";s:9:"fa-server";s:9:"fa-server";s:8:"fa-share";s:8:"fa-share";s:12:"fa-share-alt";s:12:"fa-share-alt";s:19:"fa-share-alt-square";s:19:"fa-share-alt-square";s:15:"fa-share-square";s:15:"fa-share-square";s:17:"fa-share-square-o";s:17:"fa-share-square-o";s:9:"fa-shield";s:9:"fa-shield";s:7:"fa-ship";s:7:"fa-ship";s:15:"fa-shirtsinbulk";s:15:"fa-shirtsinbulk";s:16:"fa-shopping-cart";s:16:"fa-shopping-cart";s:10:"fa-sign-in";s:10:"fa-sign-in";s:11:"fa-sign-out";s:11:"fa-sign-out";s:9:"fa-signal";s:9:"fa-signal";s:14:"fa-simplybuilt";s:14:"fa-simplybuilt";s:10:"fa-sitemap";s:10:"fa-sitemap";s:11:"fa-skyatlas";s:11:"fa-skyatlas";s:8:"fa-skype";s:8:"fa-skype";s:8:"fa-slack";s:8:"fa-slack";s:10:"fa-sliders";s:10:"fa-sliders";s:13:"fa-slideshare";s:13:"fa-slideshare";s:10:"fa-smile-o";s:10:"fa-smile-o";s:7:"fa-sort";s:7:"fa-sort";s:17:"fa-sort-alpha-asc";s:17:"fa-sort-alpha-asc";s:18:"fa-sort-alpha-desc";s:18:"fa-sort-alpha-desc";s:18:"fa-sort-amount-asc";s:18:"fa-sort-amount-asc";s:19:"fa-sort-amount-desc";s:19:"fa-sort-amount-desc";s:11:"fa-sort-asc";s:11:"fa-sort-asc";s:12:"fa-sort-desc";s:12:"fa-sort-desc";s:19:"fa-sort-numeric-asc";s:19:"fa-sort-numeric-asc";s:20:"fa-sort-numeric-desc";s:20:"fa-sort-numeric-desc";s:13:"fa-soundcloud";s:13:"fa-soundcloud";s:16:"fa-space-shuttle";s:16:"fa-space-shuttle";s:10:"fa-spinner";s:10:"fa-spinner";s:8:"fa-spoon";s:8:"fa-spoon";s:10:"fa-spotify";s:10:"fa-spotify";s:9:"fa-square";s:9:"fa-square";s:11:"fa-square-o";s:11:"fa-square-o";s:17:"fa-stack-exchange";s:17:"fa-stack-exchange";s:17:"fa-stack-overflow";s:17:"fa-stack-overflow";s:7:"fa-star";s:7:"fa-star";s:12:"fa-star-half";s:12:"fa-star-half";s:14:"fa-star-half-o";s:14:"fa-star-half-o";s:9:"fa-star-o";s:9:"fa-star-o";s:8:"fa-steam";s:8:"fa-steam";s:15:"fa-steam-square";s:15:"fa-steam-square";s:16:"fa-step-backward";s:16:"fa-step-backward";s:15:"fa-step-forward";s:15:"fa-step-forward";s:14:"fa-stethoscope";s:14:"fa-stethoscope";s:14:"fa-sticky-note";s:14:"fa-sticky-note";s:16:"fa-sticky-note-o";s:16:"fa-sticky-note-o";s:7:"fa-stop";s:7:"fa-stop";s:14:"fa-street-view";s:14:"fa-street-view";s:16:"fa-strikethrough";s:16:"fa-strikethrough";s:14:"fa-stumbleupon";s:14:"fa-stumbleupon";s:21:"fa-stumbleupon-circle";s:21:"fa-stumbleupon-circle";s:12:"fa-subscript";s:12:"fa-subscript";s:9:"fa-subway";s:9:"fa-subway";s:11:"fa-suitcase";s:11:"fa-suitcase";s:8:"fa-sun-o";s:8:"fa-sun-o";s:14:"fa-superscript";s:14:"fa-superscript";s:8:"fa-table";s:8:"fa-table";s:9:"fa-tablet";s:9:"fa-tablet";s:13:"fa-tachometer";s:13:"fa-tachometer";s:6:"fa-tag";s:6:"fa-tag";s:7:"fa-tags";s:7:"fa-tags";s:8:"fa-tasks";s:8:"fa-tasks";s:7:"fa-taxi";s:7:"fa-taxi";s:13:"fa-television";s:13:"fa-television";s:16:"fa-tencent-weibo";s:16:"fa-tencent-weibo";s:11:"fa-terminal";s:11:"fa-terminal";s:14:"fa-text-height";s:14:"fa-text-height";s:13:"fa-text-width";s:13:"fa-text-width";s:5:"fa-th";s:5:"fa-th";s:11:"fa-th-large";s:11:"fa-th-large";s:10:"fa-th-list";s:10:"fa-th-list";s:13:"fa-thumb-tack";s:13:"fa-thumb-tack";s:14:"fa-thumbs-down";s:14:"fa-thumbs-down";s:16:"fa-thumbs-o-down";s:16:"fa-thumbs-o-down";s:14:"fa-thumbs-o-up";s:14:"fa-thumbs-o-up";s:12:"fa-thumbs-up";s:12:"fa-thumbs-up";s:9:"fa-ticket";s:9:"fa-ticket";s:8:"fa-times";s:8:"fa-times";s:15:"fa-times-circle";s:15:"fa-times-circle";s:17:"fa-times-circle-o";s:17:"fa-times-circle-o";s:7:"fa-tint";s:7:"fa-tint";s:13:"fa-toggle-off";s:13:"fa-toggle-off";s:12:"fa-toggle-on";s:12:"fa-toggle-on";s:12:"fa-trademark";s:12:"fa-trademark";s:8:"fa-train";s:8:"fa-train";s:14:"fa-transgender";s:14:"fa-transgender";s:18:"fa-transgender-alt";s:18:"fa-transgender-alt";s:8:"fa-trash";s:8:"fa-trash";s:10:"fa-trash-o";s:10:"fa-trash-o";s:7:"fa-tree";s:7:"fa-tree";s:9:"fa-trello";s:9:"fa-trello";s:14:"fa-tripadvisor";s:14:"fa-tripadvisor";s:9:"fa-trophy";s:9:"fa-trophy";s:8:"fa-truck";s:8:"fa-truck";s:6:"fa-try";s:6:"fa-try";s:6:"fa-tty";s:6:"fa-tty";s:9:"fa-tumblr";s:9:"fa-tumblr";s:16:"fa-tumblr-square";s:16:"fa-tumblr-square";s:9:"fa-twitch";s:9:"fa-twitch";s:10:"fa-twitter";s:10:"fa-twitter";s:17:"fa-twitter-square";s:17:"fa-twitter-square";s:11:"fa-umbrella";s:11:"fa-umbrella";s:12:"fa-underline";s:12:"fa-underline";s:7:"fa-undo";s:7:"fa-undo";s:13:"fa-university";s:13:"fa-university";s:9:"fa-unlock";s:9:"fa-unlock";s:13:"fa-unlock-alt";s:13:"fa-unlock-alt";s:9:"fa-upload";s:9:"fa-upload";s:6:"fa-usd";s:6:"fa-usd";s:7:"fa-user";s:7:"fa-user";s:10:"fa-user-md";s:10:"fa-user-md";s:12:"fa-user-plus";s:12:"fa-user-plus";s:14:"fa-user-secret";s:14:"fa-user-secret";s:13:"fa-user-times";s:13:"fa-user-times";s:8:"fa-users";s:8:"fa-users";s:8:"fa-venus";s:8:"fa-venus";s:15:"fa-venus-double";s:15:"fa-venus-double";s:13:"fa-venus-mars";s:13:"fa-venus-mars";s:10:"fa-viacoin";s:10:"fa-viacoin";s:15:"fa-video-camera";s:15:"fa-video-camera";s:8:"fa-vimeo";s:8:"fa-vimeo";s:15:"fa-vimeo-square";s:15:"fa-vimeo-square";s:7:"fa-vine";s:7:"fa-vine";s:5:"fa-vk";s:5:"fa-vk";s:14:"fa-volume-down";s:14:"fa-volume-down";s:13:"fa-volume-off";s:13:"fa-volume-off";s:12:"fa-volume-up";s:12:"fa-volume-up";s:8:"fa-weibo";s:8:"fa-weibo";s:9:"fa-weixin";s:9:"fa-weixin";s:11:"fa-whatsapp";s:11:"fa-whatsapp";s:13:"fa-wheelchair";s:13:"fa-wheelchair";s:7:"fa-wifi";s:7:"fa-wifi";s:14:"fa-wikipedia-w";s:14:"fa-wikipedia-w";s:10:"fa-windows";s:10:"fa-windows";s:12:"fa-wordpress";s:12:"fa-wordpress";s:9:"fa-wrench";s:9:"fa-wrench";s:7:"fa-xing";s:7:"fa-xing";s:14:"fa-xing-square";s:14:"fa-xing-square";s:15:"fa-y-combinator";s:15:"fa-y-combinator";s:8:"fa-yahoo";s:8:"fa-yahoo";s:7:"fa-yelp";s:7:"fa-yelp";s:10:"fa-youtube";s:10:"fa-youtube";s:15:"fa-youtube-play";s:15:"fa-youtube-play";s:17:"fa-youtube-square";s:17:"fa-youtube-square";}';
 									$icons = unserialize( $icons ); ?>
                  <select name="icon-<?php echo $tile_postion ?>">
                  	<?php foreach ( $icons as $key => $value ) {?>
                  		<?php if($wd_tiles[$tile_postion]['icon'] == $value) {$icon_selected = 'selected=selected'; }else{  $icon_selected = '';} ?>
                  	<option value="<?php echo $value ?>" <?php echo $icon_selected ?>> <?php echo $value ?></option>
                  	<?php } ?>
                  </select>
                  
                    </div>
                 			
                    <?php $color = isset($wd_tiles[$tile_postion]['color']) ? $wd_tiles[$tile_postion]['color'] : '#1BA1E2'; ?>
                    <input name="color-<?php echo $tile_postion ?>"   type="text" value="<?php print $color; ?>" class="wd-color-picker" data-default-color="#C0392B">
                   
                  <?php 
                      $tile_background = isset( $wd_tiles[$tile_postion]['wdtile_bg'] ) ? $wd_tiles[$tile_postion]['wdtile_bg'] : '';
					
                   
                    ?>
                    <input type="text" name="tile-bg-<?php echo $tile_postion ?>"  class="wd_tile-bg" value="<?php print $tile_background; ?>"/>
                    <!-- <input class="button" name="_unique_tile-bg-<?php echo $tile_postion ?>" class="wd_tile-bg-btn" value="Upload" />-->
                    <input name="column-<?php echo $tile_postion ?>"  type="hidden" value="<?php print $tile['column']; ?>">
                    
                  </div> 
                <?php endif; ?>
                
                
                <!------------------------------------------------------------semi largge tiles --------------------------------------------------------------------------------->
    
    
    
   				<?php if( isset($tile['type']) && $tile['type'] == 'semi_large') : ?>
                  <div class="option-item big tile tile-<?php echo $tile_postion ?>">
                    <div class="label"><span><?php echo 'Position '. $tile_postion ?></span></div>
                    <select name="tile-<?php echo $tile_postion ?>">             <?php
                      
                      foreach ( $semi_large_tiles as $key => $semi_large_tile ) { 
                        ( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key) ? ($selected = 'selected = "selected"') : $selected = ''; ?>              
                        <option value="semi_large-<?php print $key ?>" <?php echo $selected ?> ><?php print $semi_large_tile ?></option>   <?php               
                      } ?>
                      
                    </select>
                    <input name="color-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['color']; ?>" class="wd-color-picker" data-default-color="#C0392B">
                    <input name="column-<?php echo $tile_postion ?>" type="hidden" value="<?php print $tile['column']; ?>">
    
                    
                    <textarea name="content-<?php echo $tile_postion ?>" rows="5" cols="40"
                      <?php if( $selected == '' ): ?> style="display: none;" <?php endif; ?>><?php 
                      
                      if(isset($wd_tiles[$tile_postion]['content'])) 
                        print $wd_tiles[$tile_postion]['content'] ?>
                    </textarea>
                    
                    <?php foreach ( $wide_tiles as $key => $wide_tile ) : 
                        if( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key): ?>               
                        <div>Title: <input name="tile-title-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['title'] ?>"> </div>           
                     <?php endif;
                     endforeach; 
                     $tile_background = isset( $wd_tiles[$tile_postion]['wdtile_bg'] ) ? $wd_tiles[$tile_postion]['wdtile_bg'] : '';
                     ?>
                     	
                      <input type="text" id="tile<?php echo $tile_postion ?>tile" name="tile-bg-<?php echo $tile_postion ?>"  class="wd_tile-bg" value="<?php print $tile_background; ?>"/>
                      <input type="button" value="Delete" class="button" onclick="tile<?php echo $tile_postion ?>tile.value='  '" />
                    <div class="cleafix"></div>
                  </div> 
                <?php endif; ?>
                
                
                
                <!------------------------------------------------------------semi small tiles --------------------------------------------------------------------------------->
    
    
    
   				<?php if( isset($tile['type']) && $tile['type'] == 'semi_small') : ?>
                  <div class="option-item big tile tile-<?php echo $tile_postion ?>">
                    <div class="label"><span><?php echo 'Position '. $tile_postion ?></span></div>
                    <select name="tile-<?php echo $tile_postion ?>">             <?php
                      
                      foreach ( $semi_large_tiles as $key => $semi_large_tile ) { 
                        ( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key) ? ($selected = 'selected = "selected"') : $selected = ''; ?>              
                        <option value="semi_small-<?php print $key ?>" <?php echo $selected ?> ><?php print $semi_large_tile ?></option>   <?php               
                      } ?>
                      
                    </select>
                    <input name="color-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['color']; ?>" class="wd-color-picker" data-default-color="#C0392B">
                    <input name="column-<?php echo $tile_postion ?>" type="hidden" value="<?php print $tile['column']; ?>">
    
                    
                    <textarea name="content-<?php echo $tile_postion ?>" rows="5" cols="40"
                      <?php if( $selected == '' ): ?> style="display: none;" <?php endif; ?>><?php 
                      
                      if(isset($wd_tiles[$tile_postion]['content'])) 
                        print $wd_tiles[$tile_postion]['content'] ?>
                    </textarea>
                    
                    <?php foreach ( $wide_tiles as $key => $wide_tile ) : 
                        if( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key): ?>               
                        <div>Title: <input name="tile-title-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['title'] ?>"> </div>           
                     <?php endif;
                     endforeach; ?>
                     <?php $tile_background = isset( $wd_tiles[$tile_postion]['wdtile_bg'] ) ? $wd_tiles[$tile_postion]['wdtile_bg'] : '';?>
                      <input type="text" id="tile<?php echo $tile_postion ?>tile" name="tile-bg-<?php echo $tile_postion ?>"  class="wd_tile-bg" value="<?php print $tile_background; ?>"/>
                      
                      <input type="button" value="Delete" class="button" onclick="tile<?php echo $tile_postion ?>tile.value='  '" />
                    <div class="cleafix"></div>
                  </div> 
                <?php endif; ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
                <?php if( isset($tile['type']) && $tile['type'] == 'wide') : ?>
                	
                	
                	
                  <div class="option-item wide tile tile-<?php echo $tile_postion ?>">
                    <div class="label"><span><?php echo 'Position '. $tile_postion ?></span></div>
                    <select class="featured" name="tile-<?php echo $tile_postion ?>"><?php
                      
                      foreach ( $wide_tiles as $key => $wide_tile ) : 
                        ( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key) ? ($selected = 'selected = "selected"') : $selected = ''; ?>               
                        <option value="wide-<?php print $key ?>" <?php echo $selected ?> ><?php print $wide_tile ?></option>    <?php               
                      endforeach; ?>

                    
                     <optgroup label="Pages">            <?php
                      
                      foreach ( $pages_id as $key => $page_id ) { 
                        ( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $page_id) ? ($selected = 'selected=selected') : $selected = ''; ?>              
                        <option value="page-<?php print $page_id ?>" <?php echo $selected ?> ><?php print get_the_title($page_id) ?></option>   <?php               
                      } ?>
                      </optgroup>

                    </select>
		                    
		                 
											<select class="wd_featured" name="featured-post-<?php echo $tile_postion ?>" <?php if( $wd_tiles[$tile_postion]['id'] != 'feature_blog_post' ): ?> style="display: none;" <?php endif; ?>>	
												<?php $posts = get_posts(array('post_type' => 'post'));
		                    $pages = get_posts(array('post_type' => 'page'));?>
												<optgroup label="Post">
													<?php foreach ( $posts as $key => $post ) { ?>
														<?php if($wd_tiles[$tile_postion]['featured_post'] == $post->ID) { ($sele = 'selected=selected');}else{ $sele = '';} ?> 
														<option value="<?php echo $post->ID ?>" <?php echo $sele ?>><?php echo $post->post_title ?></option>
													<?php 
													} ?>
												</optgroup>
												<optgroup label="Pages">
													<?php foreach ( $pages as $key => $post ) { ?>
														<?php if($wd_tiles[$tile_postion]['featured_post'] == $post->ID) { ($selec = 'selected=selected');}else{ $selec = '';} ?> 
														<option value="<?php echo $post->ID ?>" <?php echo $selec ?>><?php echo $post->post_title ?></option>
													<?php 
													} ?>
												</optgroup>
		                	</select>
                	
                    <input name="color-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['color']; ?>" class="wd-color-picker" data-default-color="#C0392B">
                    <input name="column-<?php echo $tile_postion ?>" type="hidden" value="<?php print $tile['column']; ?>">
                    
                     <?php foreach ( $wide_tiles as $key => $wide_tile ) : 
                        if( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key): 
                        
                        $wide_tile = isset($wd_tiles[$tile_postion]['title']) ? $wd_tiles[$tile_postion]['title'] : $wide_tile;
                        ?>               
                        <div>Title: <input name="title-<?php echo $tile_postion ?>" type="text" value="<?php print $wide_tile; ?>"> </div>           
                     <?php endif;
                     endforeach; ?>
                     
                  </div> 
                  
                <?php endif; ?>
    
    				
    
                <?php if( isset($tile['type']) && $tile['type'] == 'big') : ?>
                  <div class="option-item big tile tile-<?php echo $tile_postion ?>">
                    <div class="label"><span><?php echo 'Position '. $tile_postion ?></span></div>
                    <select name="tile-<?php echo $tile_postion ?>">             <?php
                      
                      foreach ( $big_tiles as $key => $big_tile ) { 
                        ( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key) ? ($selected = 'selected = "selected"') : $selected = ''; ?>              
                        <option value="big-<?php print $key ?>" <?php echo $selected ?> ><?php print $big_tile ?></option>   <?php               
                      } ?>
                      
                    </select>
                    <input name="color-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['color']; ?>" class="wd-color-picker" data-default-color="#C0392B">
                    <input name="column-<?php echo $tile_postion ?>" type="hidden" value="<?php print $tile['column']; ?>">
    
                    
                    <textarea name="content-<?php echo $tile_postion ?>" rows="5" cols="40"
                      <?php if( $selected == '' ): ?> style="display: none;" <?php endif; ?>><?php 
                      
                      if(isset($wd_tiles[$tile_postion]['content'])) 
                        print $wd_tiles[$tile_postion]['content'] ?>
                    </textarea>
                    
                    <?php foreach ( $wide_tiles as $key => $wide_tile ) : 
                        if( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key): ?>               
                        <div>Title: <input name="tile-title-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['title'] ?>"> </div>           
                     <?php endif;
                     endforeach; ?>
                       <?php $tile_background = isset( $wd_tiles[$tile_postion]['wdtile_bg'] ) ? $wd_tiles[$tile_postion]['wdtile_bg'] : '';?>
                      <input type="text" id="tile<?php echo $tile_postion ?>tile" name="tile-bg-<?php echo $tile_postion ?>"  class="wd_tile-bg" value="<?php print $tile_background; ?>"/>
                      
                    <div class="cleafix"></div>
                  </div> 
                <?php endif;
            } 
             ?>
          </div>
          <div style="clear: both;"><br/><br/><br/></div>
        </div>
        </div>
        <div id="tabs-3">
            <h3><?php echo __('Social pages' ,THEME_NAME); ?></h3>
            
            <table class="form-table">
              <tbody>
                <tr valign="top">
                  <th scope="row">
                    <label for="blogname">Twitter</label></th>
                  <td><input type="text" name="twitter" placeholder="Your twitter profile link" value="<?php echo get_option('twitter'); ?>"></td>
                </tr>
                
                <tr valign="top">
                  <th scope="row">
                    <label for="blogdescription">Facebook</label></th>
                  <td><input type="text" name="facebook" placeholder="Your Facebook page link" value="<?php echo get_option('facebook'); ?>"></td>
                </tr>                
                <tr valign="top">
                  <th scope="row">
                    <label for="blogdescription">Flickr</label></th>
                  <td><input type="text" name="flickr" placeholder="Your Flickr page link" value="<?php echo get_option('flickr'); ?>"></td>
                </tr>                
                <tr valign="top">
                  <th scope="row">
                    <label for="blogdescription">Google Plus</label></th>
                  <td><input type="text" name="google_plus" placeholder="Your Google Plus page link" value="<?php echo get_option('google_plus'); ?>"></td>
                </tr>
  
              </tbody>
            </table>
        </div>
        
        <div id="tabs-4">
          <table class="form-table">
            <tbody>
              <tr valign="top"><th scope="row"><label for="wd_lt_twitter_user"><?php echo __('Twitter Username', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_twitter_user'); ?>" name="wd_lt_twitter_user"></td>
              </tr>
              <tr valign="top"><th scope="row"><label for="wd_lt_consumer_key"><?php echo __('Consumer Key', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_consumer_key'); ?>" name="wd_lt_consumer_key"></td>
              </tr>
              <tr valign="top"><th scope="row"><label for="wd_lt_consumer_secret"><?php echo __('Consumer Secret', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_consumer_secret'); ?>" name="wd_lt_consumer_secret"></td>
              </tr>
              <tr valign="top"><th scope="row"><label for="wd_lt_oauth_token"><?php echo __('oAuth Token', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_oauth_token'); ?>" name="wd_lt_oauth_token"></td>
              </tr>
              <tr valign="top"><th scope="row"><label for="wd_lt_oauth_token_secret"><?php __('oAuth Token Secret', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_oauth_token_secret'); ?>" value="<?php echo get_option('facebook'); ?>" name="wd_lt_oauth_token_secret"></td>
              </tr>
            </tbody>
          </table>
          
          <p>To get those information:</p>
          
            <ol class="wd_txt_desc" style="display: block;">
              <li>Go to the <a target="_blank" href="https://dev.twitter.com/apps/new">Twitter Developer Center</a> 
                to create an app, and create an account if necessary (you can use your Twitter account)</li>
              <li>Give it a name, description and website, at least, and validate</li>
              <li>In the next page, find the 4 informations (consumer key, consumer secret, oauth token and oauth token secret).</li>
              <li>Write them in the fields below (they are big strings of characters).</li>
            </ol>
          
        </div>
        <div id="tabs-5">
        <table class="form-table">
          <tbody>
              <tr>
                <td>
                  <strong><?php echo __('Custom css', THEME_NAME); ?></strong>
                </td>
                <td>
                  <textarea rows="10" cols="70" name="wd_theme_custom_css" placeholder="Put your style here"><?php echo get_option('wd_theme_custom_css'); ?></textarea>
                </td>
              </tr>
               <tr>
                <td>
                  <strong><?php echo __('Custom JavaScript',THEME_NAME)?></strong>
                </td>

                <td>
                  <textarea rows="10" cols="70" name="wd_theme_custom_js" placeholder="Put your JavaScript here"><?php echo get_option('wd_theme_custom_js'); ?></textarea>
                </td>
              </tr>
          </tbody>
        </table>				
        </div>
        <div id="tabs-6">
        <div id="wd-metaboxes-general" class="wrap wd-page wd-page-info">
             <table class="form-table">
              <tbody>
                <tr>
                  <td>
                    <p>Choose demo content you want to import</p>
                    <em class="wd-field-description">Demo Site</em>
                  </td>
                  <td>
                    <select name="import_example" id="import_example" class="form-control wd-form-element">
                      <option value="demo-1">Agency</option>
                      <option value="demo-2">School</option>
                      <option value="demo-3">Food</option>
                      <option value="demo-4">Medical</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <em class="wd-field-description">Import Type</em>
                  </td>
                  <td>
                    <select name="import_option" id="import_option" class="form-control wd-form-element">
                      <option value="">Please Select</option>
                      <option value="complete_content">All</option>
                      <option value="content">Content</option>
                      <option value="widgets">Widgets</option>
                      <option value="options">Options</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Do you want to import media files?</p>
                  </td>
                  <td>
                    <input type="checkbox" value="1" class="wd-form-element" name="import_attachments" id="import_attachments" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="submit" class="button button-primary" value="Import" name="import" id="import_demo_data" />
                  </td>
                  <td>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span><?php _e('The import process may take some time. Please be patient.', 'wd') ?> </span><br />
                  </td>
                  <td colspan="2">
                    <div class="import_load">
                      <div class="wd-progress-bar-wrapper html5-progress-bar">
                          <div class="progress-bar-wrapper">
                              <progress id="progressbar" value="0" max="100"></progress>
                          </div>
                          <div class="progress-value">0%</div>
                          <div class="progress-bar-message">
                          </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align: center;">
                    <div class="alert alert-warning">
                      <strong><?php _e('Important notes:', 'wd') ?></strong>
                      <ul>
                          <li><?php _e('Please note that import process will take time needed to download all attachments from demo web site.', 'wd'); ?></li>
                          <li> <?php _e('If you plan to use shop, please install <b>WooCommerce</b> before you run import.', 'wd')?></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery(document).on('click', '#import_demo_data', function(e) {
                    e.preventDefault();
                    if (jQuery( "#import_option" ).val() == "") {
                      alert('Please select Import Type.');
                      return false;
                    }
                    if (confirm('Are you sure, you want to import Demo Data now?')) {
                        jQuery('.import_load').css('display','block');
                        var progressbar = jQuery('#progressbar')
                        var import_opt = jQuery( "#import_option" ).val();
                        var import_expl = jQuery( "#import_example" ).val();
                        var p = 0;
                        if(import_opt == 'content'){
                            for(var i = 1; i <= 10; i++){
                                var str;
                                if (i < 10) str = 'demo-file-0'+i+'.xml';
                                else str = 'demo-file-'+i+'.xml';
                                jQuery.ajax({
                                    type: 'POST',
                                    url: ajaxurl,
                                    data: {
                                        action: 'wd_dataImport',
                                        xml: str,
                                        example: import_expl,
                                        import_attachments: (jQuery("#import_attachments").is(':checked') ? 1 : 0)
                                    },
                                    success: function(data, textStatus, XMLHttpRequest){
                                        console.log('Success!!' + data );
                                        p += 10;
                                        jQuery('.progress-value').html((p) + '%');
                                        progressbar.val(p);
                                        if (p == 90) {
                                            str = 'demo-file-10.xml';
                                            jQuery.ajax({
                                                type: 'POST',
                                                url: ajaxurl,
                                                data: {
                                                    action: 'wd_dataImport',
                                                    xml: str,
                                                    example: import_expl,
                                                    import_attachments: (jQuery("#import_attachments").is(':checked') ? 1 : 0)
                                                },
                                                success: function(data, textStatus, XMLHttpRequest){
                                                    p+= 10;
                                                    jQuery('.progress-value').html((p) + '%');
                                                    progressbar.val(p);
                                                    jQuery('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
                                                },
                                                error: function(MLHttpRequest, textStatus, errorThrown){
                                                }
                                            });
                                        }
                                    },
                                    error: function(MLHttpRequest, textStatus, errorThrown){
                                        console.log('Error!!');
                                    }
                                });
                            }
                        } else if(import_opt == 'widgets') {
                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                data: {
                                    action: 'wd_widgetsImport',
                                    example: import_expl
                                },
                                success: function(data, textStatus, XMLHttpRequest){
                                    console.log('widgets imported');
                                    jQuery('.progress-value').html((100) + '%');
                                    progressbar.val(100);
                                },
                                error: function(MLHttpRequest, textStatus, errorThrown){
                                }
                            });
                            jQuery('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
                        } else if(import_opt == 'options'){
                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                data: {
                                    action: 'wd_optionsImport',
                                    example: import_expl
                                },
                                success: function(data, textStatus, XMLHttpRequest){
                                    jQuery('.progress-value').html((100) + '%');
                                    progressbar.val(100);
                                },
                                error: function(MLHttpRequest, textStatus, errorThrown){
                                }
                            });
                            jQuery('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
                        }else if(import_opt == 'complete_content'){
                            for(var i=1;i<10;i++){
                                var str;
                                if (i < 10) str = 'demo-file-0'+i+'.xml';
                                else str = 'demo-file-'+i+'.xml';
                                jQuery.ajax({
                                    type: 'POST',
                                    url: ajaxurl,
                                    data: {
                                        action: 'wd_dataImport',
                                        xml: str,
                                        example: import_expl,
                                        import_attachments: (jQuery("#import_attachments").is(':checked') ? 1 : 0)
                                    },
                                    success: function(data, textStatus, XMLHttpRequest){
                                        p+= 10;
                                        jQuery('.progress-value').html((p) + '%');
                                        progressbar.val(p);
                                        if (p == 90) {
                                            str = 'demo-file-10.xml';
                                            jQuery.ajax({
                                                type: 'POST',
                                                url: ajaxurl,
                                                data: {
                                                    action: 'wd_dataImport',
                                                    xml: str,
                                                    example: import_expl,
                                                    import_attachments: (jQuery("#import_attachments").is(':checked') ? 1 : 0)
                                                },
                                                success: function(data, textStatus, XMLHttpRequest){
                                                    jQuery.ajax({
                                                        type: 'POST',
                                                        url: ajaxurl,
                                                        data: {
                                                            action: 'wd_otherImport',
                                                            example: import_expl
                                                        },
                                                        success: function(data, textStatus, XMLHttpRequest){
                                                            jQuery('.progress-value').html((100) + '%');
                                                            progressbar.val(100);
                                                            jQuery('.progress-bar-message').html('<div class="alert alert-success">Import is completed.</div>');
                                                        },
                                                        error: function(MLHttpRequest, textStatus, errorThrown){
                                                        }
                                                    });
                                                },
                                                error: function(MLHttpRequest, textStatus, errorThrown){
                                                }
                                            });
                                        }
                                    },
                                    error: function(MLHttpRequest, textStatus, errorThrown){
                                    }
                                });
                            }
                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                data: {
                                    action: 'wd_widgetsImport',
                                    example: import_expl
                                },
                                success: function(data, textStatus, XMLHttpRequest){
                                    console.log('widgets imported');
                                    jQuery('.progress-value').html((100) + '%');
                                    progressbar.val(100);
                                },
                                error: function(MLHttpRequest, textStatus, errorThrown){
                                }
                            });
                        }
                    }
                    return false;
                });
            });
        </script>

        </div>
      </div>
      </div>
      <div class="eight columns"> <p><button  type="submit" name="search" value="Update Options" class="button success" />Update Options</button></p></div>   
    </form>
  </div>
  
  	
  <div style="clear: both;">
    <br/><br/><br/><br/><br/><br/>
  </div>
  
  
  <div class="wb-item">
    <div class="icon-themes">
  
  	</div>
  </div>
  <?php
  }
}


function wd_get_start_screens(){   
  $start_screans = array();
  
  $start_screans[] = array( 
    1  => array('type' => 'wide',   'column' => '1'),
    2  => array('type' => 'wide',   'column' => '1'),
    3  => array('type' => 'medium', 'column' => '1'),
    4  => array('type' => 'medium', 'column' => '1'),
    
    5  => array('type' => 'big',    'column' => '2'),
    6  => array('type' => 'medium', 'column' => '2'),
    7  => array('type' => 'medium', 'column' => '2'),
    
    8  => array('type' => 'medium', 'column' => '3'),
    9  => array('type' => 'medium', 'column' => '3'),
    10 => array('type' => 'medium', 'column' => '3'),
    11 => array('type' => 'medium', 'column' => '3'),
    12 => array('type' => 'wide',   'column' => '3'),
     );
  $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'wide',   'column' => '1'),
    4  => array('type' => 'wide',   'column' => '1'),
    
    5  => array('type' => 'big',    'column' => '2'),
    6  => array('type' => 'medium', 'column' => '2'),
    7  => array('type' => 'medium', 'column' => '2'),
    
    8  => array('type' => 'wide',   'column' => '3'),
    9  => array('type' => 'medium', 'column' => '3'),
    10 => array('type' => 'medium', 'column' => '3'),
    11 => array('type' => 'medium', 'column' => '3'),
    12 => array('type' => 'medium', 'column' => '3'),
     );
  $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'wide',   'column' => '1'),
    4  => array('type' => 'wide',   'column' => '1'),
    
    5  => array('type' => 'medium', 'column' => '2'),
    6  => array('type' => 'medium', 'column' => '2'),
    7  => array('type' => 'big',    'column' => '2'),
    
    8  => array('type' => 'wide',   'column' => '3'),
    9  => array('type' => 'medium', 'column' => '3'),
    10 => array('type' => 'medium', 'column' => '3'),
    11 => array('type' => 'medium', 'column' => '3'),
    12 => array('type' => 'medium', 'column' => '3'),
     );
     
  $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'medium', 'column' => '1'),
    4  => array('type' => 'medium', 'column' => '1'),
    5  => array('type' => 'wide',   'column' => '1'),
    
    6  => array('type' => 'big',    'column' => '2'),
    7  => array('type' => 'medium', 'column' => '2'),
    8  => array('type' => 'medium', 'column' => '2'),
    
    9  => array('type' => 'big',    'column' => '3'),
   10  => array('type' => 'medium', 'column' => '3'),
   11 => array('type' => 'medium',  'column' => '3'),
     );
     
  $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'medium', 'column' => '1'),
    4  => array('type' => 'medium', 'column' => '1'),
    5  => array('type' => 'medium', 'column' => '1'),
    6  => array('type' => 'medium', 'column' => '1'),
    
    7  => array('type' => 'big',    'column' => '2'),
    8  => array('type' => 'medium', 'column' => '2'),
    9  => array('type' => 'medium', 'column' => '2'),
    
   10  => array('type' => 'wide',    'column' => '3'),
   11  => array('type' => 'medium', 'column' => '3'),
   12  => array('type' => 'medium', 'column' => '3'),
   13  => array('type' => 'medium', 'column' => '3'),
   14  => array('type' => 'medium', 'column' => '3'),
   );
  //----------------------
  $start_screans[] = array( 
    1  => array('type' => 'big',   'column' => '1'),
    2  => array('type' => 'wide',   'column' => '1'),
    3  => array('type' => 'medium', 'column' => '1'),
    4  => array('type' => 'medium', 'column' => '1'),
    
    
    5  => array('type' => 'wide', 'column' => '2'),
    6  => array('type' => 'medium', 'column' => '2'),
    7 => array('type' => 'medium', 'column' => '2'),
    8 => array('type' => 'medium', 'column' => '2'),
    9 => array('type' => 'medium',   'column' => '2'),
     );
	 $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'wide',   'column' => '1'),
    4  => array('type' => 'wide',   'column' => '1'),
    
    5  => array('type' => 'medium', 'column' => '2'),
    6  => array('type' => 'medium', 'column' => '2'),
    7  => array('type' => 'big',    'column' => '2'),
    
    8  => array('type' => 'wide',   'column' => '3'),
    9  => array('type' => 'medium', 'column' => '3'),
    10 => array('type' => 'medium', 'column' => '3'),
    11 => array('type' => 'medium', 'column' => '3'),
    12 => array('type' => 'medium', 'column' => '3'),
     );
	 $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'medium',   'column' => '1'),
    4  => array('type' => 'medium',   'column' => '1'),
    5  => array('type' => 'medium',   'column' => '1'),
    6  => array('type' => 'medium',   'column' => '1'),
    7  => array('type' => 'medium',   'column' => '1'),
    8  => array('type' => 'medium',   'column' => '1'),
    9  => array('type' => 'medium',   'column' => '1'),
    10  => array('type' => 'medium',   'column' => '1'),
    
    11  => array('type' => 'big', 'column' => '2'),
    12  => array('type' => 'medium', 'column' => '2'),
    13  => array('type' => 'medium',    'column' => '2'),
    14  => array('type' => 'medium',    'column' => '2'),
    15  => array('type' => 'medium',    'column' => '2'),
    16  => array('type' => 'medium',    'column' => '2'),
    17  => array('type' => 'medium',    'column' => '2'),
    
    18  => array('type' => 'wide',   'column' => '3'),
    19  => array('type' => 'wide', 'column' => '3'),
    20 => array('type' => 'medium', 'column' => '3'),
    21 => array('type' => 'medium', 'column' => '3'),
    22 => array('type' => 'medium', 'column' => '3'),
    23 => array('type' => 'medium', 'column' => '3'),
    24 => array('type' => 'medium', 'column' => '3'),
    25 => array('type' => 'medium', 'column' => '3'),
    
     );
	 $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'wide',   'column' => '1'),
    4  => array('type' => 'medium',   'column' => '1'),
    5  => array('type' => 'medium',   'column' => '1'),
    6  => array('type' => 'medium',   'column' => '1'),
    7  => array('type' => 'medium',   'column' => '1'),
    
    8  => array('type' => 'big', 'column' => '2'),
    9  => array('type' => 'medium', 'column' => '2'),
    10  => array('type' => 'medium',    'column' => '2'),
    11  => array('type' => 'medium', 'column' => '2'),
    12  => array('type' => 'medium',    'column' => '2'),
    
    13  => array('type' => 'wide',   'column' => '3'),
    14  => array('type' => 'medium', 'column' => '3'),
    15 => array('type' => 'medium', 'column' => '3'),
    16 => array('type' => 'medium', 'column' => '3'),
    17 => array('type' => 'medium', 'column' => '3'),
    18 => array('type' => 'medium', 'column' => '3'),
    19 => array('type' => 'medium', 'column' => '3'),
     );
	 $start_screans[] = array( 
    1  => array('type' => 'big', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'medium',   'column' => '1'),
    4  => array('type' => 'semi_small',   'column' => '1'),
    5  => array('type' => 'semi_large',   'column' => '1'),
    6  => array('type' => 'semi_large',   'column' => '1'),
    7  => array('type' => 'semi_small',   'column' => '1'),
    8  => array('type' => 'big',   'column' => '1'),
    9  => array('type' => 'big',   'column' => '1'),
    //10  => array('type' => 'wide',   'column' => '1'),
	);
  //----------------------------------------------
   return $start_screans;
 }

//-----  Test if the tiles array has third column --------------


 function wd_is_third($wd_tiles){
   
    $array_keys = array_keys($wd_tiles);    
    $last_key = end( $array_keys );
    
    if( isset( $wd_tiles[ $last_key ] )){
      
      if( $wd_tiles[ $last_key ]['column'] == 3 ){
      	$wd_columns = "3";
        return $wd_columns;
      }elseif( $wd_tiles[ $last_key ]['column'] == 2 ){
        $wd_columns = "2";
        return $wd_columns;
      }else {
      	$wd_columns = "1";
        return $wd_columns;
      }
      
	  }else{
	    return false;
	  }
	
	
 }

?>