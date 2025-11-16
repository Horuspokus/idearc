<?php get_header(); ?>

<div id="content">

	<div id="contentleft">
    
		<div class="postarea">
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
			<div <?php post_class(); ?>>
            
                <h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                
               <div class="postauthor">
                    <p><?php _e("Yazar:"); ?> <?php the_author_posts_link(); ?> <?php _e(" | Tarih:"); ?> <?php the_time('j F Y'); ?> | <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__('ilk yorumu sen yap, havan olsun'), __('1 yorum'), __('% yorum')); ?></a> | <?php edit_post_link(__('Edit it!'), '', ''); ?></p>
                </div>
                
                <?php the_content('[ yazının devamı içeride... ]'); ?><div class="clear"></div>
                
               <div class="postmeta">
                    <p><?php _e("Kategoriler:"); ?> <?php the_category(', ') ?> | <?php _e("Etiketler:"); ?> <?php the_tags('') ?></p>
                </div>
            		
            </div>
            
			<?php endwhile; else: ?>
                    
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
            
        <?php wp_pagenavi(); ?>
        </div>
	
	</div>
			
	<?php include(TEMPLATEPATH."/sidebar.php");?>

</div>

<?php get_footer(); ?>