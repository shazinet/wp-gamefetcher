<?php // WP GameFetcher - Settings Validation



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// callback: validate options
function wp_gamefetcher_callback_validate_options( $input ) {
	
	// API URL
	if ( isset( $input['api_url'] ) ) {
		
		$input['api_url'] = esc_url( $input['api_url'] );
		
	}
	
	// API Key
	if ( isset( $input['api_key'] ) ) {
		
		$input['api_key'] = sanitize_text_field( $input['api_key'] );
		
	}
	
	return $input;
	
}