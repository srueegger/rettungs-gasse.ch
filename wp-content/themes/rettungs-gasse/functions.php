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
add_image_size( 'site-logo', 115, 9999, false );
add_image_size( 'fullwidth-image', 1920, 9999, false );
add_image_size( 'news-image', 510, 9999, false );
add_image_size( 'testimonial-image', 100, 100, true );

/***************************************
 * Add Wordpress Menus
 ***************************************/
function rg_lindahls_menu() {
	register_nav_menu( 'main-menu', 'Hauptmenü' );
	register_nav_menu( 'social-menu', 'Social Media Menü' );
	register_nav_menu( 'footer-menu', 'Footer Menü' );
}
add_action( 'after_setup_theme', 'rg_lindahls_menu' );

/***************************************
 * 		Enqueue scripts and styles.
 ***************************************/
function rg_startup_scripts() {
	global $wp_query;
	wp_enqueue_style( "rg-google-font", "https://fonts.googleapis.com/css?family=Lato:300i,400,400i,700,700i,900,900i" );
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', DIST_JS."/jquery.min.js", null, '3.2.1', false );
	wp_enqueue_script( 'jquery-migrate', DIST_JS."/jquery-migrate.min.js", array('jquery'), '1.4.1', false );
	wp_enqueue_script( "jquery-ui", DIST_JS ."/jquery-ui.min.js", array('jquery'), '1.12.1', false );
	wp_enqueue_style( "jquery-ui", DIST_CSS . '/jquery-ui.min.css' );
	if (WP_DEBUG) {
		wp_enqueue_style( "rettungsgasse-style", DEV_CSS . '/theme.css' );
		wp_register_script( "rettungsgasse-script", DEV_JS ."/theme.js", array('jquery-ui', 'jquery'), '1.0', true );
	}else{
		wp_enqueue_style( "rettungsgasse-style", DIST_CSS . '/theme.min.css' );
		wp_register_script( "rettungsgasse-script", DIST_JS ."/theme.min.js", array('jquery-ui', 'jquery'), '1.0', true );
	}
	wp_enqueue_script( 'rettungsgasse-script' );
}
add_action( "wp_enqueue_scripts", "rg_startup_scripts" );


/***************************************
 * 		Lindahls ACF Init
 ***************************************/
function rg_acf_init() {
 	#acf_update_setting('google_api_key', 'AIzaSyCHQJgXa8qiFPJUqCL4Ia4iLWuvA1V6VMY');
 	$args = array(
		'page_title' => 'Einstellungen für das rettungs-gasse.ch Wordpress Theme',
		'menu_title' => 'Theme Einstellungen',
		'menu_slug' => 'rg-theme-settings',
		'parent_slug' => 'themes.php',
		);
	acf_add_options_sub_page($args);
}
add_action( 'acf/init', 'rg_acf_init' );

/***************************************
 * Remove Menus from Backend
 ***************************************/
function rg_remove_menus() {
	#remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
	#remove_menu_page( 'tools.php' );
	#remove_menu_page( 'edit.php?post_type=acf-field-group' );
}
add_action( 'admin_menu', 'rg_remove_menus' );

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
*	 Register Sidebars
***************************************/
function rg_widgets_init() {
	register_sidebar( array(
		'name' => 'Seiten Sidebar',
		'id' => 'sidebar-page',
		'description' => 'Diese Sidebar zeigt Widgets auf Textseiten an.',
		'before_widget' => '<div class="widget-sidebar-container %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div><div class="widget-content">',
	));
	register_sidebar( array(
		'name' => 'Footer Sidebar 1',
		'id' => 'sidebar-footer-1',
		'description' => 'Diese Sidebar zeigt Widgets im linken Footer an.',
		'before_widget' => '<div class="widget-container footer-widet-column-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="my-4">',
		'after_title' => '</h4>',
	));
	register_sidebar( array(
		'name' => 'Footer Sidebar 2',
		'id' => 'sidebar-footer-2',
		'description' => 'Diese Sidebar zeigt Widgets im mittleren Footer an.',
		'before_widget' => '<div class="widget-container footer-widet-column-2 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="my-4">',
		'after_title' => '</h4>',
	));
	register_sidebar( array(
		'name' => 'Footer Sidebar 3',
		'id' => 'sidebar-footer-3',
		'description' => 'Diese Sidebar zeigt Widgets im rechten Footer an.',
		'before_widget' => '<div class="widget-container footer-widet-column-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="my-4">',
		'after_title' => '</h4>',
	));
}
add_action( 'widgets_init', 'rg_widgets_init' );

/***************************************
*	 Change Class Gravity Forms Submit Buttons
***************************************/
function rg_form_submit_button($button, $form) {
	return '<input type="submit" class="btn btn-primary w-25" id="gform_submit_button_' . $form['id'] . '" value="' . $form['button']['text'] . '">';
}
#add_filter( 'gform_submit_button', 'rg_form_submit_button', 10, 2 );

/***************************************
*	 Print Slider Controls
***************************************/
function rg_print_slider_controls($slider_id) {
	$output = '<a class="carousel-control-prev" href="#'.$slider_id.'" role="button" data-slide="prev"><i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i><span class="sr-only">'.get_field('sr_slide_prev', 'option').'</span></a><a class="carousel-control-next" href="#'.$slider_id.'" role="button" data-slide="next"><i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i><span class="sr-only">'.get_field('sr_slide_next', 'option').'</span></a>';
	echo $output;
}

/***************************************
*	 Change the_excerpt() Ending
***************************************/
function rg_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'rg_excerpt_more');

/***************************************
*	 Change posts_per_page for Team Archive
***************************************/
function rg_set_posts_per_page_for_towns_cpt( $query ) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'team' ) ) {
		$query->set( 'posts_per_page', '-1' );
	}
}
add_action( 'pre_get_posts', 'rg_set_posts_per_page_for_towns_cpt' );