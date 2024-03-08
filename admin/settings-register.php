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
}
add_action( 'admin_init', 'wp_gamefetcher_register_settings' );



// callback: API section
function wp_gamefetcher_callback_section_api() {
	
	echo '<p>'. esc_html__('These settings enable you to customize the WP Login screen.', 'wp-gamefetcher') .'</p>';
	
}