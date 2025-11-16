<?php 

if(!function_exists('wd_team_scode')){
  function wd_team_scode($atts) {
    extract( shortcode_atts( array(
      'columns'     => 3,
      'itemperpage' => 16,
    ), $atts ) );
    
    ob_start(); ?>  
    
    <ul class="small-block-grid-1 large-block-grid-<?php echo $columns; ?> text-center">
      <?php $loop = new WP_Query( array( 'post_type' => 'team-member', 'posts_per_page' => $itemperpage, ) );
          while ( $loop->have_posts() ) : $loop->the_post();  ?> 
            <li>
              <div class="team-member-item">
              <div class="team-member-picture">
                <?php 
                  $post_thumbnail_id = get_post_meta(get_the_ID(), 'pciture', true);
                  print wp_get_attachment_image( $post_thumbnail_id, '400x300' );  ?>               
               </div>
              <h3 class="team-member-name"><?php the_title(); ?></h3>
              <h4><?php echo get_post_meta(get_the_ID(), 'job_title', true); ?></h4>
              <div class="team-member-desc text-left">
                <p><?php echo get_post_meta(get_the_ID(), 'description', true); ?></p>
              </div>
              </div>
            </li>
      <?php endwhile; ?>
    </ul>
    
    
    
   <?php  
      return ob_get_clean();
      }
  add_shortcode( 'wd_team', 'wd_team_scode' );
}
    