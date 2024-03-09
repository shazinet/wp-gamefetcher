<?php // WP GameFetcher - Enqueue Styles and Scripts



// Disable direct file access
if (!defined('ABSPATH')) {
    exit;
}



// Enqueue frontend styles
function wp_gamefetcher_frontend_enqueue_styles() {
    wp_enqueue_style('wp-gamefetcher-frontend-styles', plugin_dir_url(__FILE__) . '../public/css/game-list-style.css');
}

add_action('wp_enqueue_scripts', 'wp_gamefetcher_frontend_enqueue_styles');


// Enqueue Gutenberg Block
function enqueue_wp_gamefetcher_block() {
    wp_enqueue_script(
        'wp-gamefetcher-block',
        plugin_dir_url(__FILE__) . 'wp-gamefetcher-block.js',
        array('wp-blocks', 'wp-components', 'wp-editor'),
        null,
        true
    );
}

add_action('enqueue_block_editor_assets', 'enqueue_wp_gamefetcher_block');