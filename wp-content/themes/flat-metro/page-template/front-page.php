<?php
/*
Template Name: Start Screan
*/
?>


<?php get_header(); ?>

<div id="spaces-main" class="pt-perspective">
  <section class="page-section home-page">
    <div class="row metro-panel <?php if(wd_is_third($wd_tiles)=='1') echo 'layout-1' ?>">
      <div class="large-12 columns">
				<?php
				// If Menu is fixed don't show Logo and Tile in this place
				if(get_option('wd_menu_fix') == '') { ?>
	        <div class="row menu-row">
	          <div class="large-8 columns">
	            <h1 class="site-name">
								<?php if ( get_option( 'wd_show_logo' ) == 'on' && get_option( 'wd_logo' ) != '' ){ ?>
										<a href=" <?php echo home_url(); ?> " title="Home" rel="home" id="logo">
											<img src="<?php print get_option( 'wd_logo' ); ?>"
											     height="<?php echo get_custom_header()->height; ?>"
											     width="<?php echo get_custom_header()->width; ?>" alt="Home"/>
										</a>
									<?php }
									if ( get_option( 'wd_show_title' ) != 'of' ){ ?>
										<a href=" <?php echo home_url(); ?> "><?php bloginfo(); ?></a>
									<?php } ?>
	            </h1>
	          </div>
	          <div class="large-4 columns menu-button text-right">
		            <a class="showMenu"><i class="fa-bars fa icon-x back"></i></a>
		            <a class="showMenu search"><i class="fa-search fa icon-x back"></i></a>
	          </div>
	        </div>
				<?php } ?>
        <div class="row ">
          <?php global $wd_tiles; ?>
          

          <div id="before-tiles" class="large-12 columns">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('before-tiles')) : endif; ?>         
          </div>
           
               <?php 
					
				switch (wd_is_third($wd_tiles)) {
				    case "1":
				        echo "<div class='four large-12 columns special-layout'>";
				        break;
					case "2" :
						 echo "<div class='four large-8 columns'>";
				        break;
					default :
						echo "<div class='four large-4 columns'>";
				}
                ?>      
          
            <div class="row">
              <?php //wd_dsm($wd_tiles)
              
              foreach ($wd_tiles as $key => $tile) {
                if ( isset($tile['column']) && $tile['column'] == 1) {
                  if(wd_is_third($wd_tiles) == "1"){
                    print wd_get_tile_html( $key, 2 );
                  }elseif(wd_is_third($wd_tiles) == "2"){
                    print wd_get_tile_html( $key , 1);
                  }else{
                  	print wd_get_tile_html( $key  );
                  }
				  
				  
                }
              }
              ?>           
            </div>
          </div>
          
          
            <?php if(wd_is_third($wd_tiles) != "1"){ ?>         
          <div class="four large-4 columns">
            <div class="row">
              <?php 
              foreach ($wd_tiles as $key => $tile) {
                if ( isset($tile['column']) && $tile['column'] == 2) {
                  print wd_get_tile_html( $key ); 
                }
              }
              ?>           
            </div>
          </div> 
          <?php }  ?>
          
          
          <?php if(wd_is_third($wd_tiles) == "3"){ ?>
            <div class="four large-4 columns">
              <div class="row">
                <?php 
                foreach ($wd_tiles as $key => $tile) {
                  if ( isset($tile['column']) && $tile['column'] == 3) {
                    print wd_get_tile_html( $key ); 
                  }
                }
                ?>           
              </div>
            </div>
          <?php } ?>
          
          
          
          
          <div id="after-tiles" class="large-12 columns">
          	<?php if(wd_is_third($wd_tiles)) {
          		?>
          		<div class='row wd-info'>
          		<?php	
          		if (function_exists('dynamic_sidebar') && dynamic_sidebar('after-tiles')) : endif;
				
				?>
				</div>
				<?php
          	}else {
          		if (function_exists('dynamic_sidebar') && dynamic_sidebar('after-tiles')) : endif;
				
          	} ?>	
             
          </div>
                    
        </div>
        <div class="copyright"> <?php 
          $copyright = get_option('wd_copyright');
          $copyright = (!empty($copyright)) ?  get_option('wd_copyright') : '&copy; 2013 Flat Metro All rights reserved.';
          echo $copyright; ?></div>
      </div>
    </div>
  </section>      
  
  <?php
  /////// Generate Section  //////////
  foreach ($wd_tiles as $key => $wd_tile) {
    switch ($wd_tile['tile size']) {
      case 'medium':
        if($wd_tile['tile type'] == "page")
          print wd_get_section( $wd_tile['id'] );
        break;
    }
  } ?>
</div>

<?php get_footer();