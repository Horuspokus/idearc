
<?php

if (have_posts()) {
    
    the_post();
    $post_type=get_post_type();
    Themify_Enqueue_Assets::loadThemeStyleModule('single');
    if($post_type==='highlight' || $post_type==='section' || $post_type==='gallery'){
	Themify_Enqueue_Assets::loadThemeStyleModule('loops/'.$post_type);
    }
    if($post_type==='portfolio' || $post_type==='gallery'){
	Themify_Enqueue_Assets::loadThemeStyleModule('single/'.$post_type);
    }
    themify_content_start(); // hook 

    if ($post_type==='team') {
	echo do_shortcode('[team style="list-post" id=' . get_the_ID() . ']');
    } 
    else {
	get_template_part('includes/loop', $post_type);
    }

    if($post_type!=='gallery'){
	wp_link_pages(array('before' => '<p class="post-pagination"><strong>' . __('Pages:', 'themify') . ' </strong>', 'after' => '</p>', 'next_or_number' => 'number'));

	get_template_part('includes/author-box');

	get_template_part('includes/post-nav', $post_type);

	themify_comments_template();
    }

    themify_content_end(); // hook 
}