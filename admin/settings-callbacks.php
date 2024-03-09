<?php // WP GameFetcher - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// callback: API section
function wp_gamefetcher_callback_section_api() {
	
	echo '<p>'. esc_html__('These settings enable you to customize the WP Login screen.', 'wp-gamefetcher') .'</p>';
	
}

// callback: API input fields
function wp_gamefetcher_callback_field_api( $args ) {
	
	$options = get_option( 'wp_gamefetcher_options', wp_gamefetcher_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	echo '<input id="wp_gamefetcher_options_'. $id .'" name="wp_gamefetcher_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="wp_gamefetcher_options_'. $id .'">'. $label .'</label>';
	
}