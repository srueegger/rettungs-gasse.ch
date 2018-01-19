<?php
/*
Plugin Name: Custom Post Types and Taxonomies
Plugin URI: https://rueegger.me
Description: Erstellt die Custom Post Type für rettungs-gasse.ch
Version: 1.6.5
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
		'menu_position'			=> 21,
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
		'menu_position'			=> 22,
		'show_in_nav_menus'		=> false,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> false,
		'exclude_from_search'	=> false,
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
		'menu_position'			=> 23,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'menu_icon'				=> 'dashicons-groups',
		'rewrite'				=> array(
			'slug' => _x('team', 'rg_custom'),
			'with_front' => false,
		),
	);
	register_post_type( 'team', $args );
	
	//Add Settings Page to Post Type
	$args = array(
		'page_title' => 'Team Einstellungen',
		'menu_title' => 'Einstellungen',
		'menu_slug' => 'rg-team-settings',
		'parent_slug' => 'edit.php?post_type=team',
	);
	acf_add_options_sub_page($args);
	
	//Presse
	$labels = array(
		'name'					=> 'Presse',
		'singular_name'			=> 'Presse',
		'menu_name'				=> 'Presse',
		'parent-item-colon'		=> 'Presse Eltern',
		'all_items'				=> 'Alle Presse Einträge',
		'view_item'				=> 'Presse Eintrag ansehen',
		'add_new_item'			=> 'Neuer Presse Eintrag hinzufügen',
		'add_new'				=> 'Hinzufügen',
		'edit_item'				=> 'Presse Eintrag bearbeiten',
		'update_item'			=> 'Presse Eintrag aktualisieren',
		'search_items'			=> 'Presse Eintrag suchen',
		'not_found'				=> 'Keine Presse Einträge gefunden',
		'not_found_in_trash'	=> 'Keine Presse Einträge im Papierkorb gefunden'
	);
	$supports = array(
		'title',
		'author',
		'editor',
		'revisions',
		'custom-fields',
		'thumbnail'
	);
	$args = array(
		'label'					=> 'presse',
		'description'			=> 'Presseartikel Verwaltung für rettungs-gasse.ch.',
		'slug'					=> _x('presse', 'rg_custom'),
		'labels'				=> $labels,
		'supports'				=> $supports,
		'hierarchical'			=> false,
		'public'				=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'menu_position'			=> 24,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'menu_icon'				=> 'dashicons-microphone',
		'rewrite'				=> array(
			'slug' => _x('presse', 'rg_custom'),
			'with_front' => false,
		),
	);
	register_post_type( 'presse', $args );
	
	//Add Settings Page to Post Type
	$args = array(
		'page_title' => 'Presse Einstellungen',
		'menu_title' => 'Einstellungen',
		'menu_slug' => 'rg-presse-settings',
		'parent_slug' => 'edit.php?post_type=presse',
	);
	acf_add_options_sub_page($args);
	
	//Partner
	$labels = array(
		'name'					=> 'Partner',
		'singular_name'			=> 'Partner',
		'menu_name'				=> 'Partner',
		'parent-item-colon'		=> 'Partner Eltern',
		'all_items'				=> 'Alle Partner',
		'view_item'				=> 'Partner ansehen',
		'add_new_item'			=> 'Neuer Partner hinzufügen',
		'add_new'				=> 'Hinzufügen',
		'edit_item'				=> 'Partner bearbeiten',
		'update_item'			=> 'Partner aktualisieren',
		'search_items'			=> 'Partner suchen',
		'not_found'				=> 'Keine Partner gefunden',
		'not_found_in_trash'	=> 'Keine Partner im Papierkorb gefunden'
	);
	$supports = array(
		'title',
		'author',
		'revisions',
		'custom-fields',
	);
	$args = array(
		'label'					=> 'partner',
		'description'			=> 'Partnerverwaltung für rettungs-gasse.ch.',
		'slug'					=> _x('partner', 'rg_custom'),
		'labels'				=> $labels,
		'supports'				=> $supports,
		'hierarchical'			=> false,
		'public'				=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'menu_position'			=> 25,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> true,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'menu_icon'				=> 'dashicons-networking',
		'rewrite'				=> array(
			'slug' => _x('partner', 'rg_custom'),
			'with_front' => false,
		),
	);
	register_post_type( 'partner', $args );
	
	//Add Settings Page to Post Type
	$args = array(
		'page_title' => 'Partner Einstellungen',
		'menu_title' => 'Einstellungen',
		'menu_slug' => 'rg-partner-settings',
		'parent_slug' => 'edit.php?post_type=partner',
	);
	acf_add_options_sub_page($args);
	
	//Events
	$labels = array(
		'name'					=> 'Events',
		'singular_name'			=> 'Event',
		'menu_name'				=> 'Events',
		'parent-item-colon'		=> 'Events Eltern',
		'all_items'				=> 'Alle Events',
		'view_item'				=> 'Event ansehen',
		'add_new_item'			=> 'Neuer Event hinzufügen',
		'add_new'				=> 'Hinzufügen',
		'edit_item'				=> 'Event bearbeiten',
		'update_item'			=> 'Event aktualisieren',
		'search_items'			=> 'Event suchen',
		'not_found'				=> 'Keine Events gefunden',
		'not_found_in_trash'	=> 'Keine Events im Papierkorb gefunden'
	);
	$supports = array(
		'title',
		'editor',
		'author',
		'revisions',
		'thumbnail',
		'custom-fields',
	);
	$args = array(
		'label'					=> 'events',
		'description'			=> 'Eventverwaltung für rettungs-gasse.ch.',
		'slug'					=> _x('events', 'rg_custom'),
		'labels'				=> $labels,
		'supports'				=> $supports,
		'hierarchical'			=> false,
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'menu_position'			=> 20,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> true,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'menu_icon'				=> 'dashicons-megaphone',
		'rewrite'				=> array(
			'slug' => _x('events', 'rg_custom'),
			'with_front' => false,
		),
	);
	register_post_type( 'events', $args );

	//Add Settings Page to Post Type
	$args = array(
		'page_title' => 'Event Einstellungen',
		'menu_title' => 'Einstellungen',
		'menu_slug' => 'rg-events-settings',
		'parent_slug' => 'edit.php?post_type=events',
	);
	acf_add_options_sub_page($args);

	//Mitstreiter
	$labels = array(
		'name'					=> 'Mitstreiter',
		'singular_name'			=> 'Mitstreiter',
		'menu_name'				=> 'Mitstreiter',
		'parent-item-colon'		=> 'Mitstreiter Eltern',
		'all_items'				=> 'Alle Mitstreiter',
		'view_item'				=> 'Mitstreiter ansehen',
		'add_new_item'			=> 'Neuer Mitstreiter hinzufügen',
		'add_new'				=> 'Hinzufügen',
		'edit_item'				=> 'Mitstreiter bearbeiten',
		'update_item'			=> 'Mitstreiter aktualisieren',
		'search_items'			=> 'Mitstreiter suchen',
		'not_found'				=> 'Keine Mitstreiter gefunden',
		'not_found_in_trash'	=> 'Keine Mitstreiter im Papierkorb gefunden'
	);
	$supports = array(
		'title',
		'author',
		'revisions',
		'custom-fields',
	);
	$args = array(
		'label'					=> 'mitstreiter',
		'description'			=> 'Mitstreiterverwaltung für rettungs-gasse.ch.',
		'slug'					=> _x('mitstreiter', 'rg_custom'),
		'labels'				=> $labels,
		'supports'				=> $supports,
		'hierarchical'			=> false,
		'public'				=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'menu_position'			=> 25,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> true,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'menu_icon'				=> 'dashicons-image-filter',
		'rewrite'				=> array(
			'slug' => _x('mitstreiter', 'rg_custom'),
			'with_front' => false,
		),
	);
	register_post_type( 'mitstreiter', $args );

	//Add Settings Page to Post Type
	$args = array(
		'page_title' => 'Mitstreiter Einstellungen',
		'menu_title' => 'Einstellungen',
		'menu_slug' => 'rg-mitstreiter-settings',
		'parent_slug' => 'edit.php?post_type=mitstreiter',
	);
	acf_add_options_sub_page($args);

	//Downloads
	$labels = array(
		'name'					=> 'Downloads',
		'singular_name'			=> 'Download',
		'menu_name'				=> 'Downloads',
		'parent-item-colon'		=> 'Downloads Eltern',
		'all_items'				=> 'Alle Downloads',
		'view_item'				=> 'Download ansehen',
		'add_new_item'			=> 'Neuer Download hinzufügen',
		'add_new'				=> 'Hinzufügen',
		'edit_item'				=> 'Download bearbeiten',
		'update_item'			=> 'Download aktualisieren',
		'search_items'			=> 'Download suchen',
		'not_found'				=> 'Keine Download gefunden',
		'not_found_in_trash'	=> 'Keine Download im Papierkorb gefunden'
	);
	$supports = array(
		'title',
		'author',
		'revisions',
		'custom-fields',
	);
	$args = array(
		'label'					=> 'downloads',
		'description'			=> 'Downloadsverwaltung für rettungs-gasse.ch.',
		'slug'					=> _x('downloads', 'rg_custom'),
		'labels'				=> $labels,
		'supports'				=> $supports,
		'hierarchical'			=> false,
		'public'				=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'menu_position'			=> 25,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'show_in_rest'			=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> true,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'menu_icon'				=> 'dashicons-download',
		'rewrite'				=> array(
			'slug' => _x('downloads', 'rg_custom'),
			'with_front' => false,
		),
	);
	register_post_type( 'downloads', $args );

	//Add Settings Page to Post Type
	$args = array(
		'page_title' => 'Downloads Einstellungen',
		'menu_title' => 'Einstellungen',
		'menu_slug' => 'rg-downloads-settings',
		'parent_slug' => 'edit.php?post_type=downloads',
	);
	acf_add_options_sub_page($args);

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
	
	//Partner Kategorien
	register_taxonomy(
		'partner_categories',
		'partner',
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
				'search_items'	=> 'Kategorien suchen',
				'not_found'		=> 'Keine Kategorie gefunden'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
		)
	);

	//Mitstreiter Kategorien
	register_taxonomy(
		'mitstreiter_categories',
		'mitstreiter',
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
				'search_items'	=> 'Kategorien suchen',
				'not_found'		=> 'Keine Kategorie gefunden'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
		)
	);

	//Downloads Kategorien
	register_taxonomy(
		'downloads_categories',
		'downloads',
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
				'search_items'	=> 'Kategorien suchen',
				'not_found'		=> 'Keine Kategorie gefunden'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'rewrite' => array('slug' => 'downloads')
		)
	);
	
}
add_action( 'init', 'create_rg_taxonomies', 0 );