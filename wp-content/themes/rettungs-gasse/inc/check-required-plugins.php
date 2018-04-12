<?php
/***************************************
*	 Überprüfen ob alle notwendigen Plugins vorhanden sind
***************************************/
function sa_admin_notice_need_plugins_error() {
	//Advanced Custom Fields Multilingual
	if(!class_exists('WPML_ACF')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Advanced Custom Fields Multilingual</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Advanced Custom Fields: Font Awesome
	if(!class_exists('acf_plugin_font_awesome')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Advanced Custom Fields: Font Awesome</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Advanced Custom Fields: Nav Menu Field
	if(!class_exists('ACF_Nav_Menu_Field_Plugin')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Advanced Custom Fields: Nav Menu Field</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Advanced Custom Fields PRO
	if(!class_exists('acf_pro')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Advanced Custom Fields PRO</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Gravity Forms + Custom Post Types
	if(!class_exists('GFCPTAddon')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Gravity Forms + Custom Post Types</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Gravity Forms
	if(!class_exists('GFSettings')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Gravity Forms</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Gravity Forms Multilingual
	if(!class_exists('WPML_GFML_Requirements')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Gravity Forms Multilingual</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Gravity Forms MailChimp Add-On
	if(!class_exists('GF_MailChimp_Bootstrap')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Gravity Forms MailChimp Add-On</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Intuitive Custom Post Order
	if(!class_exists('Hicpo')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Intuitive Custom Post Order</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Language Fallback
	if(!class_exists('Language_Fallback')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Language Fallback</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//Post Type Select for Advanced Custom Fields
	if(!class_exists('acf_field_posttype_select')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>Post Type Select for Advanced Custom Fields</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//SAR Friendly SMTP
	if(!function_exists('sar_friendly_smtp')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>SAR Friendly SMTP</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//WPML Multilingual CMS
	if(!class_exists('SitePress')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>WPML Multilingual CMS</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//WPML String Translation
	if(!class_exists('WPML_ST_Strings')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>WPML String Translation</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
	//WPML Translation Management
	if(!class_exists('WPML_TM_Requirements')):
		$class = 'notice notice-error';
		$message = 'Das Plugin <strong>WPML Translation Management</strong> wird zwingend benötigt!';
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	endif;
}
add_action( 'admin_notices', 'sa_admin_notice_need_plugins_error' );