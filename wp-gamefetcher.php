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



// include plugin dependencies: admin only
if ( is_admin() ) {

	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';

}