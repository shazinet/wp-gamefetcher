<?php // WP GameFetcher - API Functionality



// Disable direct file access
if (!defined('ABSPATH')) {
    exit;
}



// URL Generator
function wp_gamefetcher_url_generator() {
    $options = get_option('wp_gamefetcher_options', wp_gamefetcher_options_default());

    $api_url = isset($options['api_url']) && !empty($options['api_url']) ? esc_url($options['api_url']) : '';
    $api_key = isset($options['api_key']) && !empty($options['api_key']) ? sanitize_text_field($options['api_key']) : '';

    return "{$api_url}?key={$api_key}";
}



// Fetch data from the API
function wp_gamefetcher_fetch_data($atts) {
    $url = wp_gamefetcher_url_generator();

    // Add the ordering and page_size parameters to the API request
    $api_url = "{$url}&ordering={$atts['ordering']}&page_size={$atts['page_size']}";

    $response = wp_remote_get($api_url);

    // Check for API request errors
    if (is_wp_error($response)) {
        $error_message = esc_html__('Error: Unable to fetch data. Please try again later.', 'wp-gamefetcher');
        return array('error' => $error_message);
    }

    // Check for a successful API response
    if ($response['response']['code'] !== 200) {
        $error_message = esc_html__('Error: Unable to fetch data. Please check your API credentials and try again.', 'wp-gamefetcher');
        return array('error' => $error_message);
    }

    $data = json_decode($response['body'], true);

    // Check if there's an error in the API response
    if (isset($data['error'])) {
        return array('error' => $data['error']);
    }

    // Check if the API response contains results
    if (empty($data['results'])) {
        $error_message = esc_html__('Error: No data returned from the API.', 'wp-gamefetcher');
        return array('error' => $error_message);
    }

    return $data;
}





// Get or cache data
function wp_gamefetcher_get_data($atts) {
    // Generate a unique transient key based on the shortcode attributes
    $transient_key = 'wp_gamefetcher_' . md5(serialize($atts));

    // Try to get data from transient
    $cached_data = get_transient($transient_key);

    if (false === $cached_data) {
        // Transient doesn't exist or has expired, fetch data from the API
        $data = wp_gamefetcher_fetch_data($atts);

        if (isset($data['error'])) {
            // Return error message
            return $data;
        }

        if ($data !== false) {
            // Cache the data for 1 hour (adjust as needed)
            set_transient($transient_key, $data, HOUR_IN_SECONDS);
        }

        return $data;
    } else {
        // Use cached data
        return $cached_data;
    }
}
