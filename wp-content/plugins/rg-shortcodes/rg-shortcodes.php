<?php
/*
Plugin Name: Shortcodes for rettungs-gasse.ch
Plugin URI: https://rueegger.me
Description: Rendert die Shortcodes für rettungs-gasse.ch
Version: 1.0.0
Author: Samuel Rüegger
Author URI: https://rueegger.me
*/

function rg_shortcode_button($atts = array(), $content){
	extract(shortcode_atts(array(
		'href' => home_url(),
		'target' => '_self'
	), $atts));
	$output = '<a target="'.$target.'" href="'.$href.'" class="btn btn-primary btn-lg my-3">'.$content.'</a>';
	return $output;
}
add_shortcode( 'button', 'rg_shortcode_button' );