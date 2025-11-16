<?php get_header(); ?>

<div id="content">

	<div id="contentleft">
    
        <div class="postarea">
    
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
			<div class="post">
            
                <h1><?php the_title(); ?></h1>
                <?php the_content('[ yazının devamı içeride... ]'); ?>
                <div class="clear"></div><?php edit_post_link('Edit it!', '', ''); ?>
            
            </div>
            
        </div>
        
        <div class="postcomments">
			<?php comments_template('',true); ?>
        </div>
        
        <?php endwhile; else: ?>
            
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
                    		
	</div>
			
<?php include(TEMPLATEPATH."/sidebar.php");?>

</div>



<?php get_footer(); ?>