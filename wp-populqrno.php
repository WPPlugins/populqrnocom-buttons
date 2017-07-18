<?php
/*
Plugin Name: WP-Populqrno.COM
Plugin URI: http://populqrno.com/wp-populqrno/
Description: Social Bookmarking Sharing Button Widget.
Version: 1.0
Author: Populqrno.COM Team
Author URI: http://populqrno.com/

*/
define('SHARE_IT_TAG', '[wp-populqrno]');
define('BitLyKey', 'R_fe7284ee32bc962288b562dc8aaf9c85');
define('BitLyUsername', 'tursiainfo');

// install short URLs
register_activation_hook(__FILE__,'wp-populqrno_shorturl_install'); 
register_deactivation_hook( __FILE__, 'wp-populqrno_shorturl_remove' );
function wp-populqrno_shorturl_install() {
	add_option("ats-shorturl", '1', '', 'yes');
}
function wp-populqrno_shorturl_remove() {
	delete_option('ats-shorturl');
}
// Icons Size
register_activation_hook(__FILE__,'wp-populqrno_size_install'); 
register_deactivation_hook( __FILE__, 'wp-populqrno_size_remove' );
function wp-populqrno_size_install() {
	add_option("ats-size", 'small', '', 'yes');
}
function wp-populqrno_size_remove() {
	delete_option('ats-size');
}
// Align Icons
register_activation_hook(__FILE__,'wp-populqrno_align_install'); 
register_deactivation_hook( __FILE__, 'wp-populqrno_align_remove' );
function wp-populqrno_align_install() {
	add_option("ats-align", 'justify', '', 'yes');
}
function wp-populqrno_align_remove() {
	delete_option('ats-align');
}
// mode
register_activation_hook(__FILE__,'wp-populqrno_mode_install'); 
register_deactivation_hook( __FILE__, 'wp-populqrno_mode_remove' );
function wp-populqrno_mode_install() {
	add_option("ats-mode", 'automatic', '', 'yes');
}
function wp-populqrno_mode_remove() {
	delete_option('ats-mode');
}
// Short URLs - bit.ly API
function bitly($url) {
	$bitly = file_get_contents("http://api.bitly.com/v3/shorten?login=".BitLyUsername."&apiKey=".BitLyKey."&longUrl=".$url."&format=txt");
	return $bitly;
}
// Random KeyGenerator
function RandomKey() {
$minlength=1000000;
 $maxlength=9999999;
 $length = mt_rand ($minlength, $maxlength);
return $length;
}

// Show All Buttons
function ats_buttons() {
	global $post;
	$width = '100%';
	
	// Align Buttons
	if (get_option('ats-align') == "left") {
		$align = 'left'; // Align left
	}
	else if (get_option('ats-align') == "center") {
		$align = 'center'; // Align center
	}
	else if (get_option('ats-align') == "right") {
		$align = 'right'; // Align right
	}
	else {
		$align = 'justify'; // Double Align
	}

	// Icons folder
	if (get_option('ats-size') == "large") {
		$folder = get_settings('home') . '/wp-content/plugins/wp-populqrno/images/large/';
	}
	else {
		$folder = get_settings('home') . '/wp-content/plugins/wp-populqrno/images/';
	}
	
	// URL type
	if (get_option('ats-shorturl') == 0) {
		$url = get_permalink($post->ID);
	}
	else {
		$url = bitly(get_permalink($post->ID)); 
	}
	$title = str_replace(' ','+',get_the_title( $post->ID )); // Replace empty spaces with +
	$txt .= "";
	$txt .= "\n"
					  // Populqrno
					  .'<a href="http://populqrno.com/submit/?url='.$url.'&phase=1&randkey='.RandomKey().'&id=c_1" title="Сподели в Populqrno">
					  <img src="' . $folder . 'populqrno.png" alt="Populqrno" border="0" />
					  </a>' . "\n"
					  . '</div>' . "\n";
					  	
	return $txt;
}


function wp-populqrno($content) {
	$buttons = ats_buttons();
	if (get_option('ats-mode') == "shortcode") { // shortcode
		return str_replace(SHARE_IT_TAG, $buttons, $content);
	}
	else if (get_option('ats-mode') == "manual") { // PHP code
		return $content;
	}
	else { // auto-add
		if (is_single()) {
			$content .= $buttons;
			return $content;
		}
	}
	return $content;
}

add_filter('the_content', 'wp-populqrno');

function ats_include_admin() {  
     include('wp-populqrno-admin.php');  
}  

function ats_admin() {
	add_options_page("WP-Populqrno", "WP-Populqrno", 1, "wp-populqrno", "ats_include_admin");
}

add_action('admin_menu', 'ats_admin');
?>