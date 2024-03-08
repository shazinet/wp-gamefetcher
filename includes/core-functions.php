<?php // WP GameFetcher - Core Functionality



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// custom login logo url
function wp_gamefetcher_custom_login_url( $url ) {
	
	$options = get_option( 'wp_gamefetcher_options', wp_gamefetcher_options_default() );
	
	if ( isset( $options['api_url'] ) && ! empty( $options['api_url'] ) ) {
		
		$url = esc_url( $options['api_url'] );
		
	}
	
	return $url;
	
}
add_filter( 'login_headerurl', 'wp_gamefetcher_custom_login_url' );