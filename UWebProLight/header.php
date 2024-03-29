<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uwebpro_light
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="" rel="stylesheet"> <!-- FONT -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
if (!function_exists('wp_body_open')){
	function wp_body_open(){
		do_action('wp_body_open');
	}
}
?>
	<header>

	</header>
	<div id="content" class="site-content">






