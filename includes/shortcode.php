<?php // WP GameFetcher - Shortcode Rendering: [wp_gamefetcher]



// Disable direct file access
if (!defined('ABSPATH')) {
    exit;
}



// Shortcode rendering
function wp_gamefetcher_shortcode($atts) {
    // Default values for parameters
    $atts = shortcode_atts(
        array(
            'ordering'  => '-rating',
            'page_size' => 5,
        ),
        $atts,
        'wp_gamefetcher'
    );

    // Sanitize input values
    $ordering = sanitize_text_field($atts['ordering']);
    $page_size = absint($atts['page_size']);

    $data = wp_gamefetcher_get_data(array(
        'ordering'  => $ordering,
        'page_size' => $page_size,
    ));

    if (isset($data['error'])) {
        // Display the error message
        return '<p class="wp-gamefetcher-error">' . esc_html($data['error']) . '</p>';
    }

    ob_start();

    echo '<div class="wp-gamefetcher-card-list">';

    foreach ($data['results'] as $game) {
        echo '<div class="wp-gamefetcher-card">';
        echo '<div class="wp-gamefetcher-image" style="background-image: url(' . esc_url($game['background_image']) . ');"></div>';
        echo '<div class="wp-gamefetcher-card-content">';
        echo '<h3>' . esc_html($game['name']) . '</h3>';
        echo '<div class="wp-gamefetcher-cta">';
        echo '<a href="' . esc_url('https://rawg.io/games/' . $game['slug']) . '" target="_blank"><button class="wp-gamefetcher-button">' . esc_html__('More info...', 'wp-gamefetcher') . '</button></a>';
        echo '<p>★ ' . esc_html__('Rating:', 'wp-gamefetcher') . ' ' . esc_html($game['rating']) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';

    return ob_get_clean();
}

add_shortcode('wp-gamefetcher', 'wp_gamefetcher_shortcode');