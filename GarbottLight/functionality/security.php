<?php

if ( ! defined( 'ABSPATH' ) ) {

    exit;

}



require( 'security/functions.php' );

if (! get_option( 'http_security_htaccess_flag' ) )

	require( 'security/http-headers.php' );

require( 'security/settings.php' );



if ( is_admin() ){ // admin actions

  add_action( 'network_admin_menu', 'http_security_network_options_page' );

  add_action( 'admin_menu', 'http_security_options_page' );

  add_action( 'admin_init', 'register_http_security_settings' );

  add_action( 'wpmu_new_blog', 'http_security_copy_main_site_options', 10, 6 );

}

