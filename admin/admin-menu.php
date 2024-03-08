<?php // WP GameFetcher - Admin Menu



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// add sub-level administrative menu
function wp_gamefetcher_add_sublevel_menu() {
	
	/*
	
	add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug, 
		callable $function = ''
	);
	
	*/
	
	add_submenu_page(
		'options-general.php',
		esc_html__('WP GameFetcher Settings', 'wp-gamefetcher'),
		esc_html__('WP GameFetcher', 'wp-gamefetcher'),
		'manage_options',
		'wp_gamefetcher',
		'wp_gamefetcher_display_settings_page'
	);
	
}
add_action( 'admin_menu', 'wp_gamefetcher_add_sublevel_menu' );