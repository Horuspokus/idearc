<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Bodoslama giriş yasağı. Bu sayfa kuvvetle muhtemel dingonun ahırı değil. İlginize teşekkürler.');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e("Puwwsss.. Bu sayfaya şifre koymuşuz. Şifre mifre girmek lazım yorumları okumak için."); ?></p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<?php // You can start editing here. ?>

<?php if ($comments) : ?>
	<strong><?php comments_number(__('Henüz kimse lakırdamamış :)'), __('One Lakırtı.'), __('% Lakırtı.') );?> <?php _e("Konumuz:"); ?> &#8220;<?php the_title(); ?>&#8221;</strong>

	<ol class="commentlist">

	<?php foreach ($comments as $comment) : ?>
	
	<?php $comment_type = get_comment_type(); ?>
	<?php if($comment_type == 'comment') { ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 32 ); ?>
			<cite><?php comment_author_link() ?></cite> Says:
			<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e("Yorumun benim onaylamamı bekliyor. Ee normal."); ?></em>
			<?php endif; ?>
			<br />

			<small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('j F Y') ?> at <?php comment_time() ?></a> <?php edit_comment_link(__('edit'),'&nbsp;&nbsp;',''); ?></small>

			<?php comment_text() ?>

		</li>

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>
	
	<?php } else { $trackback = true; } ?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>
	
	<?php if ($trackback == true) { ?><br />
	<h4><?php _e("Trackbacks"); ?></h4>
	<ol id="trackbacks">
	<?php foreach ($comments as $comment) : ?>
	<?php $comment_type = get_comment_type(); ?>
	<?php if($comment_type != 'comment') { ?>
	<li><?php comment_author_link() ?></li>
	<?php } ?>
	<?php endforeach; ?>
	</ol>
	<?php } ?>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<?php // If comments are open, but there are no comments. ?>

	 <?php else : // comments are closed ?>
		<?php // If comments are closed. ?>
		<p class="nocomments"><?php _e("Yorum yapılacak bi'şey yok ki yorum formu kapalı."); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?><br />

<p><strong><?php _e("Sen de söyle. Söyle ki içinde kalmasın..."); ?> <br /><?php _e("Söylerim söylemesinde 'resim nerden şeyedeceğük' diyorsan "); ?> <a href="http://en.gravatar.com" >gravatar</a>'ını yükle de resmin olsun yorumunda, resmi olsun yorumun.</strong>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e("Yorum yazabilmek için"); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e("giriş"); ?></a> <?php _e("yapmalısın. Giriş yap ki yorum yazasın."); ?>.</p></div>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php _e(""); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> olarak şu an yorum yapmaya müsait pozisyondasın. Çıkış yapmak istiyorsan <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e("Log out of this account"); ?>"><?php _e("buraya tıkla."); ?> &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small><?php _e("Senin adın ne ?"); ?> <?php if ($req) _e("(mümkünse gerçek isimle)"); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small><?php _e("Elektronik posta ?? (söz yayımlanmayacak)"); ?> <?php if ($req) echo _e("(ama yazman gerekli)"); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e("Varsa web adresiniz ..."); ?></small></label></p>

<?php endif; ?>

<?php // <p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>

<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e("S a l ı v e r   G e l s i n"); ?>" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>