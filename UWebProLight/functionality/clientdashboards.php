<?php
//User Ability
add_action( 'admin_menu', 'remove_menus' );
function remove_menus(){
	if ( !current_user_can( 'manage_options' ) ) {
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'options-general.php' );
		remove_menu_page( 'wpcf7' );
	}
}


add_action( 'admin_init', 'custom_menu_page_removing' );

add_action( 'admin_menu', 'remove_menus' );
function wps_admin_bar() {
    global $wp_admin_bar;
	if ( !current_user_can( 'manage_options' ) ) {
    $wp_admin_bar->remove_node('about');
    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('wporg');
    $wp_admin_bar->remove_node('documentation');
    $wp_admin_bar->remove_node('support-forums');
    $wp_admin_bar->remove_node('feedback');
    $wp_admin_bar->remove_node('view-site');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('delete-cache');
}
}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );


//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');


function remove_dashboard_widgets() {
    global $wp_meta_boxes;
 
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_postbox']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
 
}
 
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

	
//Start Will Box

add_action('wp_dashboard_setup', 'my_will_box');

//Adding another dashboard widgets
function my_will_box() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('add_will_box', 'Website Performance Mini Dashboard', 'will_box');
}

function will_box() {
echo '<h2 style="text-align:center;"><iframe src="https://datastudio.google.com/embed/reporting/1MzbgTtrVJ_8eD4a-wFIGzYD73L2kFaAI/page/6zXD" frameborder="0" style="border:0" allowfullscreen></iframe></h2>';
echo '<p>Need Help? <a href="https://uwebpro.com/support" target="_blank">Visit UWebPro Support</a>.</p>';
}
get_currentuserinfo() ;
global $user_level;

function remove_screen_options(){ __return_false;}
if( $user_level <= 8 ) add_filter('screen_options_show_screen', 'remove_screen_options');

function oz_remove_help_tabs( $old_help, $screen_id, $screen ){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter( 'contextual_help', 'oz_remove_help_tabs', 999, 3 );


//Dashboard styles
add_action('admin_head', 'my_dashboard');

function my_dashboard() {
  echo '<style>
 
.willbutton{
	display:block;
	color:black;
	border-radius:5px;
	width:250px;
	font-weight:bold;
	background-color:#7A7AFC;
	text-align:center;
	padding:10px;
	transition-duration: 0.5s;
}
.willbutton:hover{
	background-color:#2C0062;
	color:white;
	 
}
  
  /*---------------------------------------------------*/
  #footer-thankyou{
	  display:none;
  }
  #wpexplorer_dashboard_widget{
	  
  }
  
    #wpcontent {
		background: #f1f1f1;
	}
	
	.vid-tut iframe{width: 100%;}
	#wpexplorer_dashboard_widget {
	width: 100%;
	}
	#normal-sortables {
	display: grid;
	}
	#wpexplorer_dashboard_widget {
		width: 100%;
	}
	.metabox-holder .postbox-container .empty-container {
		border: 0;
	}
	#dashboard-widgets .postbox-container, #wpbody-content #dashboard-widgets.columns-4 .postbox-container {
		width: 100%;
	}
	
@media screen and (min-width:1800px){
#add_will_box iframe{
	width:100%;
	height:800px;
}
iframe{
	height:400px;
}
.vid-tut {
    width: 32%;
    float: left;
    margin-right: 1%;
}
}
@media only screen and (max-width: 1800px) and (min-width: 1500px){
#add_will_box iframe{
	width:100%;
	height:800px;
}
#wpbody-content #dashboard-widgets #postbox-container-1 {
    width: 100% !important;
}
iframe{
height:320px;}
.vid-tut {
    width: 32%;
    float: left;
    margin-right: 1%;
	}
}
@media only screen and (max-width: 1499px) and (min-width: 800px){
	 #add_will_box iframe{
width:100%;
height:800px;
  }
#wpbody-content #dashboard-widgets .postbox-container {
    width: 100%;
}
.vid-tut {
    width: 32%;
    float: left;
    margin-right: 1%;
	}
	iframe{
	height:310px;
}
}
@media only screen and (max-width: 1200px) and (min-width: 800px){
	 #add_will_box iframe{
width:100%;
height:500px;
  }
iframe{
	height:250px;
}
.vid-tut {
    width: 49%;
    float: left;
    margin-right: 1%;
	}
}
@media only screen and (max-width: 800px) and (min-width: 500px){
	 #add_will_box iframe{
width:100%;
height:400px;
  }
	.vid-tut {
    width: 100%;
	float:left;
	margin-right:1%;
	}
iframe{
	width:100%;
	height:500px;
}

}
@media only screen and (max-width: 650px) and (min-width: 500px){
	iframe{
	width:100%;
	height:400px;
}
	
}
@media only screen and (max-width: 499px) and (min-width: 435px){
	iframe{
	width:100%;
	height:300px;
}
}
@media only screen and (max-width: 434px) and (min-width: 300px){
	iframe{
	width:100%;
	height:250px;
}}
  </style>';
}