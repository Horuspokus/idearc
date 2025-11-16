<?php
/**
 * Template for search form.
 * @package themify
 * @since 1.0.0
 */
?>
<form method="get" id="searchform" action="<?php echo rtrim(home_url(),'/'); ?>/">
	<?php echo themify_get_icon('fas search','fa')?>
	<input type="text" name="s" id="s" placeholder="<?php _e('Search', 'themify'); ?>">
</form>