<?php
/*
Plugin Name: Custom Post Types and Taxonomies
Plugin URI: https://rueegger.me
Description: Erstellt die Custom Post Type für rettungs-gasse.ch
Version: 1.1.0
Author: Samuel Rüegger
Author URI: https://rueegger.me
*/

function rg_cpttax_create_posttypes(){
	//Testimonials
	$labels = array(
		'name'					=> 'Testimonials',
		'singular_name'			=> 'Testimonial',
		'menu_name'				=> 'Testimonials',
		'parent-item-colon'		=> 'Testimonial Eltern',
		'all_items'				=> 'Alle Testimonials',
		'view_item'				=> 'Testimonial ansehen',
		'add_new_item'			=> 'Neues Testimonial hinzufügen',
		'add_new'				=> 'Testimonial hinzufügen',
		'edit_item'				=> 'Testimonial bearbeiten',
		'update_item'			=> 'Testimonial aktualisieren',
		'search_items'			=> 'Testimonial suchen',
		'not_found'				=> 'Keine Testimonials gefunden',
		'not_found_in_trash'	=> 'Keine Testimonials im Papierkorb gefunden'
	);
	$supports = array(
		'title',
		'editor',
		'author',
		'revisions',
		'custom-fields'
	);
	$args = array(
		'label'					=> 'testimonials',
		'description'			=> 'Testimonialverwaltung für rettungs-gasse.ch.',
		'slug'					=> _x('testimonials', 'rg_custom'),
		'labels'				=> $labels,
		'supports'				=> $supports,
		'hierarchical'			=> false,
		'public'				=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> false,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> false,
		'exclude_from_search'	=> true,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'menu_icon'				=> 'dashicons-testimonial',
		'rewrite'				=> false,
	);
	register_post_type( 'testimonials', $args );
	
	//FAQ
	$labels = array(
		'name'					=> 'FAQs',
		'singular_name'			=> 'FAQ',
		'menu_name'				=> 'FAQ',
		'parent-item-colon'		=> 'FAQ Eltern',
		'all_items'				=> 'Alle FAQs',
		'view_item'				=> 'FAQ ansehen',
		'add_new_item'			=> 'Neuer FAQ hinzufügen',
		'add_new'				=> 'FAQ hinzufügen',
		'edit_item'				=> 'FAQ bearbeiten',
		'update_item'			=> 'FAQ aktualisieren',
		'search_items'			=> 'FAQ suchen',
		'not_found'				=> 'Keine FAQs gefunden',
		'not_found_in_trash'	=> 'Keine FAQs im Papierkorb gefunden'
	);
	$supports = array(
		'title',
		'editor',
		'author',
		'revisions',
		'custom-fields'
	);
	$args = array(
		'label'					=> 'faq',
		'description'			=> 'FAQ Verwaltung für rettungs-gasse.ch.',
		'slug'					=> _x('faq', 'rg_custom'),
		'labels'				=> $labels,
		'supports'				=> $supports,
		'hierarchical'			=> false,
		'public'				=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> false,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> false,
		'exclude_from_search'	=> true,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'menu_icon'				=> 'dashicons-editor-help',
		'rewrite'				=> false,
	);
	register_post_type( 'faq', $args );
	
	//Team
	$labels = array(
		'name'					=> 'Team',
		'singular_name'			=> 'Team',
		'menu_name'				=> 'Team',
		'parent-item-colon'		=> 'Team Eltern',
		'all_items'				=> 'Alle Team Einträge',
		'view_item'				=> 'Team Eintrag ansehen',
		'add_new_item'			=> 'Neuer Team Eintrag hinzufügen',
		'add_new'				=> 'Hinzufügen',
		'edit_item'				=> 'Team Eintrag bearbeiten',
		'update_item'			=> 'Team Eintrag aktualisieren',
		'search_items'			=> 'Team Eintrag suchen',
		'not_found'				=> 'Keine Team Einträge gefunden',
		'not_found_in_trash'	=> 'Keine Team Einträge im Papierkorb gefunden'
	);
	$supports = array(
		'title',
		'author',
		'revisions',
		'custom-fields'
	);
	$args = array(
		'label'					=> 'team',
		'description'			=> 'Team Verwaltung für rettungs-gasse.ch.',
		'slug'					=> _x('team', 'rg_custom'),
		'labels'				=> $labels,
		'supports'				=> $supports,
		'hierarchical'			=> false,
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> true,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'menu_icon'				=> 'dashicons-groups',
		'rewrite'				=> array(
			'slug' => _x('team', 'rg_custom'),
			'with_front' => false,
		),
	);
	register_post_type( 'team', $args );

}
add_action( 'init', 'rg_cpttax_create_posttypes' );

function create_rg_taxonomies() {
	
	//Testimonial Kategorien
	register_taxonomy(
		'testimonials_categories',
		'testimonials',
		array(
			'labels' => array(
				'name'			=> 'Kategorien',
				'singular_name'	=> 'Kategorie',
				'menu_name'		=> 'Kategorien',
				'all_items'		=> 'Alle Kategorien',
				'edit_item'		=> 'Kategorie bearbeiten',
				'view_item'		=> 'Kategorie ansehen',
				'update_item'	=> 'Kategorie aktualisieren',
				'add_new_item'	=> 'Neue Kategorie hinzufügen',
				'new_item_name'	=> 'Neue Kategorie',
				'search_items'	=> 'Kategorie suchen',
				'not_found'		=> 'Keine Kategorie gefunden'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
		)
	);
	
	//FAQ Kategorien
	register_taxonomy(
		'faq_categories',
		'faq',
		array(
			'labels' => array(
				'name'			=> 'Kategorien',
				'singular_name'	=> 'Kategorie',
				'menu_name'		=> 'Kategorien',
				'all_items'		=> 'Alle Kategorien',
				'edit_item'		=> 'Kategorie bearbeiten',
				'view_item'		=> 'Kategorie ansehen',
				'update_item'	=> 'Kategorie aktualisieren',
				'add_new_item'	=> 'Neue Kategorie hinzufügen',
				'new_item_name'	=> 'Neue Kategorie',
				'search_items'	=> 'Kategorie suchen',
				'not_found'		=> 'Keine Kategorie gefunden'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
		)
	);
	
	//Team Funktionen
	register_taxonomy(
		'team_functions',
		'team',
		array(
			'labels' => array(
				'name'			=> 'Funktionen',
				'singular_name'	=> 'Funktion',
				'menu_name'		=> 'Funktionen',
				'all_items'		=> 'Alle Funktionen',
				'edit_item'		=> 'Funktion bearbeiten',
				'view_item'		=> 'Funktion ansehen',
				'update_item'	=> 'Funktion aktualisieren',
				'add_new_item'	=> 'Neue Funktion hinzufügen',
				'new_item_name'	=> 'Neue Funktion',
				'search_items'	=> 'Funktion suchen',
				'not_found'		=> 'Keine Funktion gefunden'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
		)
	);
	
}
add_action( 'init', 'create_rg_taxonomies', 0 );