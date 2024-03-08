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
}
add_action( 'admin_init', 'wp_gamefetcher_register_settings' );