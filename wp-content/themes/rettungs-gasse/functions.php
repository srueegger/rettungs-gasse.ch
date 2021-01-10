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
require_once 'inc/acf.php';
require_once 'inc/check-required-plugins.php';
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
add_image_size( 'news-image', 510, 263, true );
add_image_size( 'presse-image', 540, 9999, false );
add_image_size( 'testimonial-image', 100, 100, true );
add_image_size( 'testimonial-image-big', 255, 255, true );
add_image_size( 'team-list-image', 510, 510, true );
add_image_size( 'team-small-image', 280, 280, true );
add_image_size( 'container-image', 730, 9999, false );
add_image_size( 'content-slider', 487, 9999, false );
add_image_size( 'download-image', 475, 9999, false);
add_image_size( 'team-rechteck-container', 475, 271, true );

/***************************************
 * Add Wordpress Menus
 ***************************************/
function rg_setup_menu() {
	register_nav_menu( 'main-menu', 'Hauptmenü' );
	register_nav_menu( 'social-menu', 'Social Media Menü' );
	register_nav_menu( 'footer-menu', 'Footer Menü' );
}
add_action( 'after_setup_theme', 'rg_setup_menu' );

/***************************************
 * 		Enqueue scripts and styles.
 ***************************************/
function rg_startup_scripts() {
	wp_enqueue_style( "rg-google-font", "https://fonts.googleapis.com/css?family=Lato:300i,400,400i,700,700i,900,900i" );
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', DIST_JS."/jquery.min.js", null, '3.5.1', false );
	wp_enqueue_script( 'jquery-migrate', DIST_JS."/jquery-migrate.min.js", array('jquery'), '1.4.1', false );
	wp_enqueue_script( "jquery-ui", DIST_JS ."/jquery-ui.min.js", array('jquery'), '1.12.1', true );
	wp_enqueue_style( "jquery-ui", DIST_CSS . '/jquery-ui.min.css' );
	if (WP_DEBUG) {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/css/theme.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/js/theme.js' ) );
		wp_enqueue_style( "rettungsgasse-style", DEV_CSS . '/theme.css', array('rg-google-font'), $modificated_css );
		wp_register_script( "rettungsgasse-script", DEV_JS ."/theme.js", array('jquery-ui', 'jquery'), $modificated_js, true );
	}else{
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/css/theme.min.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/js/theme.min.js' ) );
		wp_enqueue_style( "rettungsgasse-style", DIST_CSS . '/theme.min.css', array('rg-google-font'), $modificated_css );
		wp_register_script( "rettungsgasse-script", DIST_JS ."/theme.min.js", array('jquery-ui', 'jquery'), $modificated_js, true );
	}
	wp_enqueue_script( 'rettungsgasse-script' );
	wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBNKcSZiv-2W3sMQ0uxPYDKl5wI6Fzlad0', '', '' );
	wp_enqueue_script( 'raisenow-widget', 'https://widget.raisenow.com/widgets/lema/helfe-077a/js/dds-init-widget-'.ICL_LANGUAGE_CODE.'.js', array('jquery'), true );
}
add_action( "wp_enqueue_scripts", "rg_startup_scripts" );


/***************************************
 * 		ACF Init
 ***************************************/
function rg_acf_init() {
 	acf_update_setting('google_api_key', 'AIzaSyBNKcSZiv-2W3sMQ0uxPYDKl5wI6Fzlad0');
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
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'tools.php' );
	//remove_menu_page( 'edit.php?post_type=acf-field-group' );
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
	return '<input type="submit" class="btn btn-primary" id="gform_submit_button_' . $form['id'] . '" value="' . $form['button']['text'] . '">';
}
add_filter( 'gform_submit_button', 'rg_form_submit_button', 10, 2 );

/***************************************
*	 Print Slider Controls
***************************************/
function rg_print_slider_controls($slider_id) {
	$output = '<a class="carousel-control-prev" href="#'.$slider_id.'" role="button" data-slide="prev"><i class="fa fa-chevron-left fa-2x slide-control-left" aria-hidden="true"></i><span class="sr-only">'.get_field('sr_slide_prev', 'option').'</span></a><a class="carousel-control-next" href="#'.$slider_id.'" role="button" data-slide="next"><i class="fa fa-chevron-right fa-2x slide-control-right" aria-hidden="true"></i><span class="sr-only">'.get_field('sr_slide_next', 'option').'</span></a>';
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
function rg_set_posts_per_page_for_team_cpt( $query ) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'team' ) ) {
		$query->set( 'posts_per_page', '-1' );
	}
}
add_action( 'pre_get_posts', 'rg_set_posts_per_page_for_team_cpt' );

/***************************************
*	 Change posts_per_page for Presse Archive
***************************************/
function rg_set_posts_per_page_for_presse_cpt( $query ) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'presse' ) ) {
		$query->set( 'posts_per_page', '-1' );
	}
}
add_action( 'pre_get_posts', 'rg_set_posts_per_page_for_presse_cpt' );

/***************************************
 * Customize User Roles
 ***************************************/
function rg_userroles(){
	remove_role( 'subscriber' );
	remove_role( 'editor' );
	remove_role( 'contributor' );
	remove_role( 'author' );
}
add_action( 'init', 'rg_userroles' );

/***************************************
 * Add Option to Remove Gravityf Labels
 ***************************************/
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/***************************************
 * Allow SVG Upload
 ***************************************/
function rg_svg_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'rg_svg_mime_types');

/***************************************
 * Remove Some Item from Customizer
 ***************************************/
function rg_remove_styles_sections(){
	global $wp_customize;
	$wp_customize->remove_control('site_icon');
}
add_action( 'customize_register', 'rg_remove_styles_sections', 20 );

/***************************************
 * Save Testimonial from Gravityform
 ***************************************/
function rg_save_testimonial_post( $entry, $form ) {
	$title = rgar($entry, '1.3').' '.rgar($entry, '1.6');
	$terms = rgar($entry, '7');
	$args = array(
		'post_author' => 2,
		'post_content' => rgar($entry, '3'),
		'post_title' => $title,
		'post_status' => 'draft',
		'post_type' => 'testimonials',
	);
	$filename = rgar($entry, '8');
	$filetype = wp_check_filetype( basename( $filename ), null );
	$attachment = array(
		'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ), 
		'post_mime_type' => $filetype['type'],
		'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
		'post_content' => '',
		'post_status' => 'inherit'
	);
	$attach_id = wp_insert_attachment( $attachment, $filename );
	$post_id = wp_insert_post($args);
	update_field('job', rgar($entry, '2'), $post_id);
	update_field('image', $attach_id, $post_id);
	preg_match_all('!\d+!', $terms, $matches);
	$term_ids = $matches[0];
	$term_ids = array_map('intval', $term_ids);
	$term_ids = array_unique($term_ids);
	if(!empty($matches)):
		wp_set_object_terms($post_id, $term_ids, 'testimonials_categories');
	endif;
}
add_action( 'gform_after_submission_5', 'rg_save_testimonial_post', 10, 2 );

/***************************************
*	 Set String Translation
***************************************/
function __rg_trans($value, $echo = true) {
	icl_register_string('rettungsgasse-wptheme', $value, $value);
	$result = icl_t('rettungsgasse-wptheme', $value, $value);
	if ($echo):
		echo $result;
		return;
	endif;
	return $result;
}