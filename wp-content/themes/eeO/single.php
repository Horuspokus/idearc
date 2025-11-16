<?php get_header(); ?>

<div id="content">

	<div id="contentleft">
	
		<div class="postarea">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
			<div class="post">
			
                <h1><?php the_title(); ?></h1>
                    
                     <div class="postauthor">
                    <p><?php _e("Yazar:"); ?> <?php the_author_posts_link(); ?> <?php _e(" | Tarih:"); ?> <?php the_time('j F Y'); ?> | <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__('ilk yorumu sen yap, havan olsun'), __('1 yorum'), __('% yorum')); ?></a> | <?php edit_post_link(__('Edit it!'), '', ''); ?></p>
                </div>
                
                <?php the_content('[ yazının devamı içeride... ]'); ?><div class="clear"></div>
                        
                <!--
                <?php trackback_rdf(); ?>
                -->
                
                <div class="postmeta">
                    <p><?php _e("Kategoriler:"); ?> <?php the_category(', ') ?> | <?php _e("Etiketler:"); ?> <?php the_tags('') ?></p>
                </div>
                
                <div class="clear"></div>
                
                <div class="authorbox">
                    <p><?php echo get_avatar( get_the_author_email(), '64' ); ?><strong><?php _e("Kimdir O: "); ?><?php the_author(); ?></strong><br /><?php the_author_meta( 'description' ); ?>Mühendis olan yazarımız, içkilerden Mojito'yu pek sever hatta nanelerini yer. Hayattaki tek derdi günün birinde bir kotra satın alıp okyanus geçmektir. Âlem hakkındaki diğer bilgileri gereksizdir, kaale alınmayacak bir çok görüşün sahibidir.</p>
                    <div class="clear"></div>
                </div>
                    
            </div>
			
		</div>
	
		
        <div class="postcomments">
            
			<?php comments_template('',true); ?>
        
        </div>

		<?php endwhile; else: ?>

		<p><?php _e('ONDAN BULAMADIK, BUNDAN VERSEK OLUR MU? AAA ONDAN DA YOKK!!'); ?></p><?php endif; ?>
		
	</div>
	
<?php include(TEMPLATEPATH."/sidebar.php");?>

</div>

<?php get_footer(); ?>