<?php
/***************************************
 *	 CREATE GLOBAL VARIABLES
 ***************************************/
define( 'HOME_URI', home_url() );
define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/dist-assets/images' );
define( 'DEV_CSS', THEME_URI . '/dev-assets/css' );
define( 'DEV_JS', THEME_URI . '/dev-assets/js' );
define( 'DIST_CSS', THEME_URI . '/dist-assets/css' );
define( 'DIST_JS', THEME_URI . '/dist-assets/js' );

/***************************************
 * Include helpers
 ***************************************/
require_once 'inc/wordpress-bootstrap-navwalker.php';

/***************************************
 * 		Theme Support
 ***************************************/
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

/***************************************
 * Custom Image Size
 ***************************************/
#add_image_size( 'site-logo', 300, 9999, false );

/***************************************
 * Add Wordpress Menus
 ***************************************/
function soswi_lindahls_menu() {
	register_nav_menu( 'main-menu', 'Hauptmenü' );
}
add_action( 'after_setup_theme', 'soswi_lindahls_menu' );

/***************************************
 * 		Enqueue scripts and styles.
 ***************************************/
function soswi_startup_scripts() {
	global $wp_query;
	#wp_enqueue_style( "lindahls-google-font", "https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" );
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', DIST_JS."/jquery.min.js", null, '3.2.1', false );
	wp_enqueue_script( 'jquery-migrate', DIST_JS."/jquery-migrate.min.js", array('jquery'), '1.4.1', false );
	wp_enqueue_script( "jquery-ui", DIST_JS ."/jquery-ui.min.js", array('jquery'), '1.12.1', false );
	wp_enqueue_style( "jquery-ui", DIST_CSS . '/jquery-ui.min.css' );
	if (WP_DEBUG) {
		wp_enqueue_style( "specialolympics-style", DEV_CSS . '/theme.css' );
		wp_register_script( "specialolympics-script", DEV_JS ."/theme.js", array('jquery-ui', 'jquery'), '1.0', true );
	}else{
		wp_enqueue_style( "specialolympics-style", DIST_CSS . '/theme.min.css' );
		wp_register_script( "specialolympics-script", DIST_JS ."/theme.min.js", array('jquery-ui', 'jquery'), '1.0', true );
	}
	wp_enqueue_script( 'specialolympics-script' );
}
add_action( "wp_enqueue_scripts", "soswi_startup_scripts" );


/***************************************
 * 		Lindahls ACF Init
 ***************************************/
function soswi_acf_init() {
 	#acf_update_setting('google_api_key', 'AIzaSyCHQJgXa8qiFPJUqCL4Ia4iLWuvA1V6VMY');
 	
 	$args = array(
		'page_title' => 'Einstellungen für das specialolympics.ch Wordpress Theme',
		'menu_title' => 'Theme Einstellungen',
		'menu_slug' => 'soswi-theme-settings',
		'parent_slug' => 'themes.php',
		);
	acf_add_options_sub_page($args);
}
#add_action( 'acf/init', 'soswi_acf_init' );

/***************************************
 * Remove Menus from Backend
 ***************************************/
function soswi_remove_menus() {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
	#remove_menu_page( 'tools.php' );
	#remove_menu_page( 'edit.php?post_type=acf-field-group' );
}
#add_action( 'admin_menu', 'soswi_remove_menus' );

/***************************************
 * Gravity Forms CSV Export with semikolon
 ***************************************/
function soswi_gform_export_separator($separator, $formId) {
	return ";";
}
add_filter( 'gform_export_separator', 'soswi_gform_export_separator', 10, 2);

/***************************************
*	 Add Bootstrap 4 Classes to Gravityforms
***************************************/
function add_bootstrap_container_class( $field_container, $field, $form, $css_class, $style, $field_content ) {
	$id = $field->id;
	$field_id = is_admin() || empty( $form ) ? "field_{$id}" : 'field_' . $form['id'] . "_$id";
	return '<li id="' . $field_id . '" class="' . $css_class . ' form-group">{FIELD_CONTENT}</li>';
}
add_filter( 'gform_field_container', 'add_bootstrap_container_class', 10, 6 );

/***************************************
*	 Register Sidebar
***************************************/
function soswi_widgets_init() {
	register_sidebar( array(
		'name' => 'Footer Sidebar',
		'id' => 'sidebar-footer',
		'description' => 'Diese Sidebar zeigt Widgets im Footer an. Es sollten nur 3 Widgets hinzugefügt werden!',
		'before_widget' => '<div class="col-12 col-md-4 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
}
#add_action( 'widgets_init', 'soswi_widgets_init' );

/***************************************
*	 Change Class Gravity Forms Submit Buttons
***************************************/
function soswi_form_submit_button($button, $form) {
	return '<input type="submit" class="btn btn-primary w-25" id="gform_submit_button_' . $form['id'] . '" value="' . $form['button']['text'] . '">';
}
#add_filter( 'gform_submit_button', 'soswi_form_submit_button', 10, 2 );
