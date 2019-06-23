<?php
/**
 * uwebpro_light functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uwebpro_light
 */

function my_custom_login()
{
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/inc/login/custom-login-style.css" />';
}
add_action('login_head', 'my_custom_login');

function my_login_logo_url() {
    return 'https://uwebpro.com/';
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Powered by UWebPro';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


if ( ! function_exists( 'uwebpro_light_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function uwebpro_light_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on uwebpro_light, use a find and replace
		 * to change 'uwebpro_light' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'uwebpro_light', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'uwebpro_light' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'uwebpro_light_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'uwebpro_light_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uwebpro_light_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'uwebpro_light_content_width', 640 );
}
add_action( 'after_setup_theme', 'uwebpro_light_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uwebpro_light_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uwebpro_light' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'uwebpro_light' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'uwebpro_light_widgets_init' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/** 
* START SHORTCODES
*/

function page_title_sc(){
   return get_the_title();
}
add_shortcode( 'page_title', 'page_title_sc' );


function page_template_location(){
	return get_template_part( 'template-parts/my', 'page' );
}
add_shortcode( 'my_page', 'page_template_location' );

/** 
* END SHORTCODES
*/

/**
 * Enqueue scripts and styles.
 */

function uwebpro_light_scripts() {
	wp_enqueue_style( 'uwebpro_light-style', get_stylesheet_uri() );

	wp_enqueue_script( 'uwebpro_light-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
    wp_enqueue_script('jQuery', 'https://code.jquery.com/jquery-3.4.1.min.js');
    wp_register_script('default_scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20151215', true);
    wp_enqueue_script('default_scripts');

	wp_enqueue_script( 'uwebpro_light-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'uwebpro_light_scripts' );


// Normalize CSS
function normalize_theme_styles() {

 wp_enqueue_style( 'normalize_css', get_stylesheet_directory_uri() . '/css/style-normalize.css' );

}
add_action( 'wp_enqueue_scripts', 'normalize_theme_styles' );

// END Normalize CSS

// Admin Design Files
function material_style() {

	wp_enqueue_style( 'material_css', get_stylesheet_directory_uri() . '/css/material.css' );
}

add_action('admin_enqueue_scripts', 'material_style');
add_action('login_enqueue_scripts', 'material_style');

// Responsive CSS
function responsive_styles() {

 wp_enqueue_style( 'responsive_css', get_stylesheet_directory_uri() . '/css/style-responsive.css' );

}
add_action( 'wp_enqueue_scripts', 'responsive_styles' );


// END Responsive CSS

function change_admin_footer(){
	echo '<span id="footer-note">Theme By <a href="https://uwebpro.com" target="_blank">UWebPro</a>.</span>';
   }
add_filter('admin_footer_text', 'change_admin_footer');


function remove_version() {
return '';
}
add_filter('the_generator', 'remove_version');

function howdy_message($translated_text, $text, $domain) {
    $new_message = str_replace('Howdy', 'UWebPro Systems User', $text);
    return $new_message;
}
add_filter('gettext', 'howdy_message', 10, 3);


/* Will Percey Functionality */
require_once __DIR__ . '/functionality/security.php';
require_once __DIR__ . '/functionality/removeyoastcomments.php';
//require_once __DIR__ . '/functionality/404page/404page.php';
require_once __DIR__ . '/functionality/duplicate_post.php';
//require_once __DIR__ . '/functionality/clientdashboards.php';

/* End Will Percey Functionality */
