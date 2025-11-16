<div id="sidebar">

	<ul id="sidebarwidgeted">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
    
        <li id="search" class="widget widget_search">
            <form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label class="hidden" for="s"><?php _e("Pervane gibi döneceğine:"); ?></label>
                <div><input type="text" value="" name="s" id="s" />
                <input type="submit" id="searchsubmit" value="Ara !" />
                </div>
            </form>
        </li>


            <li id="pages" class="widget">
            <h4><?php _e("eeO Hakkında"); ?></h4>
                <ul>
		<?php wp_list_pages('title_li='); ?>
                </ul>
             </li>

            
    
           	<li id="meta" class="widget">
            <h4><?php _e("Müdüriyet"); ?></h4>
                <ul>
                    <?php wp_register(); ?>
                    <li><?php wp_loginout(); ?></li>
                    </ul>
		</li> 
        
			
		
        	<li id="recent-posts" class="widget">
            <h4><?php _e("Son Son @ Twitter"); ?></h4>
                <ul>
                <?php twitter_messages('eeozlu', 2, true, true, '>>', true, true, false); ?>
		</ul>
		</li>	
        
		
        		
	<?php endif; ?>
	</ul>
			
</div>