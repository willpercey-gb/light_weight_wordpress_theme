<?php
 
// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Loader
 */
require_once( plugin_dir_path( __FILE__ ) . '/loader.php' );


/**
 * Theme functions
 */
 

// this function can be used by a theme to check if there's an active custom 404 page
function pp_404_is_active() {
  return pp_404page()->pp_404_is_active();
}

// this function can be used by a theme to activate native support
function pp_404_set_native_support() {
  pp_404page()->pp_404_set_native_support();
}

// this function can be used by a theme to get the title of the custom 404 page in native support
function pp_404_get_the_title() {
  return pp_404page()->pp_404_get_the_title();
}

// this function can be used by a theme to print out the title of the custom 404 page in native support
function pp_404_the_title() {
  pp_404page()->pp_404_the_title();
}

// this function can be used by a theme to get the content of the custom 404 page in native support
function pp_404_get_the_content() {
  return pp_404page()->pp_404_get_the_content();
}

// this function can be used by a theme to print out the content of the custom 404 page in native support
function pp_404_the_content() {
  return pp_404page()->pp_404_the_content();
}

?>