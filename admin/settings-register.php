<?php // WP GameFetcher - Register Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// register plugin settings
function wp_gamefetcher_register_settings() {
	
	/*
	
	register_setting( 
		string   $option_group, 
		string   $option_name, 
		callable $sanitize_callback = ''
	);
	
	*/
	
	register_setting( 
		'wp_gamefetcher_options', 
		'wp_gamefetcher_options', 
		'wp_gamefetcher_callback_validate_options' 
	);

    /*
	
	add_settings_section( 
		string   $id, 
		string   $title, 
		callable $callback, 
		string   $page
	);
	
	*/
	
	add_settings_section( 
		'wp_gamefetcher_section_api', 
		esc_html__('API Settings', 'wp-gamefetcher'), 
		'wp_gamefetcher_callback_section_api', 
		'wp_gamefetcher'
	);

    /*
	
	add_settings_field(
    	string   $id, 
		string   $title, 
		callable $callback, 
		string   $page, 
		string   $section = 'default', 
		array    $args = []
	);
	
	*/
	
	add_settings_field(
		'api_url',
		esc_html__('API URL', 'wp-gamefetcher'),
		'wp_gamefetcher_callback_field_api',
		'wp_gamefetcher', 
		'wp_gamefetcher_section_api', 
		[ 'id' => 'api_url', 'label' => esc_html__('API URL from rawg.io', 'wp-gamefetcher') ]
	);
	
	add_settings_field(
		'api_key',
		esc_html__('API Key', 'wp-gamefetcher'),
		'wp_gamefetcher_callback_field_api',
		'wp_gamefetcher', 
		'wp_gamefetcher_section_api', 
		[ 'id' => 'api_key', 'label' => esc_html__('API Key from rawg.io', 'wp-gamefetcher') ]
	);
}
add_action( 'admin_init', 'wp_gamefetcher_register_settings' );