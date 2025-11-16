<?php 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
 
require_once( $path_to_wp.'/wp-load.php' );
require_once( $path_to_wp.'/wp-includes/functions.php');
 
echo ' Import Files loaded'; 
echo ' Import Slider'; 
 
$slider_array = array(get_template_directory()."inc/import/files/home_slider.zip");
$slider = new RevSlider();
 
foreach($slider_array as $filepath){
 $slider->importSliderFromPost(true,true,$filepath);  
}
 
echo ' Slider processed';
 ?>