<?php // WP GameFetcher - Core Functionality



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// URL Generator
function wp_gamefetcher_url_generator() {
	
	$options = get_option( 'wp_gamefetcher_options', wp_gamefetcher_options_default() );
	
	if ( isset( $options['api_url'] ) && ! empty( $options['api_url'] ) ) {
		
		$api_url = esc_url( $options['api_url'] );
		
	}
	if ( isset( $options['api_key'] ) && ! empty( $options['api_key'] ) ) {
		
		$api_key = sanitize_text_field( $options['api_key'] );
		
	}

    $url = "{$api_url}?key={$api_key}";
	
	return $url;
	
}


// // WP GameFetcher Shortcode: [wp_gamefetcher]
// function wp_gamefetcher_shortcode($atts) {
    
//     // Default values for parameters
//     $atts = shortcode_atts(
//         array(
//             'ordering'  => '-rating',
//             'page_size' => 5,
//         ),
//         $atts,
//         'wp_gamefetcher'
//     );

//     $url = wp_gamefetcher_url_generator();
    
//     // Add the ordering and page_size parameters to the API request
//     $api_url = "{$url}&ordering={$atts['ordering']}&page_size={$atts['page_size']}";

//     $response = wp_remote_get($api_url);

//     if (!is_wp_error($response) && $response['response']['code'] === 200) {
//         $data = json_decode($response['body'], true);
//     }

//     // Add error handling for API request
//     if (is_wp_error($response)) {
//         return '<p class="wp-gamefetcher-error">Error: ' . esc_html($response->get_error_message()) . '</p>';
//     }

//     if ($response['response']['code'] !== 200) {
//         return '<p class="wp-gamefetcher-error">Error: Unable to fetch data. Please check your API credentials and try again.</p>';
//     }

//     if (empty($data['results'])) {
//         return '<p class="wp-gamefetcher-error">Error: No data returned from the API.</p>';
//     }

//     ob_start();

//     echo '<div class="wp-gamefetcher-card-list">';

//     foreach ($data['results'] as $game) {
//         echo '<div class="wp-gamefetcher-card">';
//         echo '<div class="wp-gamefetcher-image" style="background-image: url(' . esc_url($game['background_image']) . ');"></div>';
//         echo '<div class="wp-gamefetcher-card-content">';
//             echo '<h3>' . esc_html($game['name']) . '</h3>';
//             echo '<div class="wp-gamefetcher-cta">';
//                 echo '<a href="https://rawg.io/games/' . esc_html($game['slug']) . '" target="_blank"><button class="wp-gamefetcher-button">More info</button></a>';
//                 echo '<p>★ Rating: ' . esc_html($game['rating']) . '</p>';
//             echo '</div>';
//         echo '</div>';
//         echo '</div>';
//     }

//     echo '</div>';

//     return ob_get_clean();
// }

// add_shortcode('wp_gamefetcher', 'wp_gamefetcher_shortcode');





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

    // Generate a unique transient key based on the shortcode attributes
    $transient_key = 'wp_gamefetcher_' . md5(serialize($atts));

    // Try to get data from transient
    $cached_data = get_transient($transient_key);

    if (false === $cached_data) {
        // Transient doesn't exist or has expired, fetch data from the API

        $url = wp_gamefetcher_url_generator();

        // Add the ordering and page_size parameters to the API request
        $api_url = "{$url}&ordering={$atts['ordering']}&page_size={$atts['page_size']}";

        $response = wp_remote_get($api_url);

        if (!is_wp_error($response) && $response['response']['code'] === 200) {
            $data = json_decode($response['body'], true);

            // Cache the data for 1 hour (adjust as needed)
            set_transient($transient_key, $data, HOUR_IN_SECONDS);
        } else {
            // Add error handling for API request
            return '<p class="wp-gamefetcher-error">Error: Unable to fetch data. Please check your API credentials and try again.</p>';
        }
    } else {
        // Use cached data
        $data = $cached_data;
    }

    if (empty($data['results'])) {
        return '<p class="wp-gamefetcher-error">Error: No data returned from the API.</p>';
    }

    ob_start();

    echo '<div class="wp-gamefetcher-card-list">';

    foreach ($data['results'] as $game) {
        echo '<div class="wp-gamefetcher-card">';
        echo '<div class="wp-gamefetcher-image" style="background-image: url(' . esc_url($game['background_image']) . ');"></div>';
        echo '<div class="wp-gamefetcher-card-content">';
        echo '<h3>' . esc_html($game['name']) . '</h3>';
        echo '<div class="wp-gamefetcher-cta">';
        echo '<a href="https://rawg.io/games/' . esc_html($game['slug']) . '" target="_blank"><button class="wp-gamefetcher-button">More info</button></a>';
        echo '<p>★ Rating: ' . esc_html($game['rating']) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';

    return ob_get_clean();
}

add_shortcode('wp_gamefetcher', 'wp_gamefetcher_shortcode');














function wp_gamefetcher_frontend_enqueue_styles() {
    wp_enqueue_style('wp-gamefetcher-frontend-styles', plugin_dir_url(__FILE__) . '../public/css/game-list-style.css');
}

add_action('wp_enqueue_scripts', 'wp_gamefetcher_frontend_enqueue_styles');