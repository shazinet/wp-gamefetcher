<?php
/**
 * Plugin Name: WP GameFetcher
 * Plugin URI: https://yourwebsite.com/wp-gamefetcher
 * Description: A WordPress plugin to fetch and display game data from the rawg.io API.
 * Version: 1.0.0
 * Author: Hamidreza Sheikholeslami
 * Author URI: https://hoomaan.dev/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-gamefetcher
 */



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// load text domain
function wp_gamefetcher_load_textdomain() {

	load_plugin_textdomain( 'wp-gamefetcher', false, plugin_dir_path( __FILE__ ) . 'languages/' );

}
add_action( 'plugins_loaded', 'wp_gamefetcher_load_textdomain' );



// include plugin dependencies: admin only
if ( is_admin() ) {

	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';
    
}



// include plugin dependencies: admin and public
require_once plugin_dir_path( __FILE__ ) . 'includes/api.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/enqueue.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/widget.php';



// default plugin options
function wp_gamefetcher_options_default() {

	return array(
		'api_url'   => 'https://api.rawg.io/api/games',
		'api_key'   => '4a0759f479e24aa1bd70e4e9b8893a1f',
	);

}