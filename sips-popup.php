<?php
/*
* Plugin Name: Simple Image Popup Shortcode
* Plugin URI: http://evosit.com
* Description: Simple plugin to generate image in popup box.
* Version: 1.0
* Author: Purva Bathe
* Author URI: http://evosit.com
*/
function sips_min_jquery() {
    if (!is_admin()) {
       wp_enqueue_script('jquery');
   }
}
add_action('init', 'sips_min_jquery');

function sips_enqueue_style() {
	wp_enqueue_style( 'popup-css',  plugins_url('/css/popup.css',__FILE__) , false ); 
}

function sips_enqueue_script() {
	wp_enqueue_script('popup_js', plugins_url('/js/popup.js',__FILE__), false );
}
add_action( 'wp_enqueue_scripts', 'sips_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'sips_enqueue_script' );

function sips_shortcode( $atts )
{
ob_start();
$atts = shortcode_atts(
		array(
			'img_url' => '',
			'height' => '200',
			'width' => '200',
			
		),
		$atts
	);
	$height = $atts['height'];
	$width = $atts['width'];
	
	$output .= '<div class="simplePopup">';
	$output .= '<a class="js-open-modal" href="#" data-modal-id="popup1"><img src="'.$atts['img_url'].'" height="'.$height.'" width="'.$width.'"></a>';
	$output .= '<div id="popup1" class="modal-box">
				<a href="#" class="js-modal-close close">×</a>
			  
			<div class="modal-body">
				<p><img src="'.$atts['img_url'].'"></p>
			  </div>
			</div>';
	$output .= '</div>';
ob_clean();
	return $output;
}
add_shortcode('sips_popup', 'sips_shortcode');
?>