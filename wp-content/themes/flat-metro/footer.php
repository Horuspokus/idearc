


<?php  
		if(get_option('wd_theme_custom_js','') !=''){
			echo '<script type="text/javascript">
				'.get_option('wd_theme_custom_js').'
			</script>';
		}
   wp_footer() ?>
  </body>
</html>