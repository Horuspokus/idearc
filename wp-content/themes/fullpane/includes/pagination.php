<?php
/**
 * Partial template for pagination
 */


if ( 'numbered' === themify_get( 'setting-entries_nav','numbered',true )) {
	themify_pagenav();
} else { 
    Themify_Enqueue_Assets::loadThemeStyleModule('post-nav');
    ?>
	<div class="post-nav tf_box tf_clearfix">
		<span class="prev"><?php next_posts_link(__('&laquo; Older Entries', 'themify')) ?></span>
		<span class="next"><?php previous_posts_link(__('Newer Entries &raquo;', 'themify')) ?></span>
	</div>
<?php 
}
