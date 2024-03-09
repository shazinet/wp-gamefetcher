<?php // WP GameFetcher - Widget



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



class WP_GameFetcher_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wp_gamefetcher_widget',
            __('WP GameFetcher Widget', 'wp-gamefetcher'),
            array('description' => esc_html__( 'Display game cards using WP GameFetcher.', 'wp-gamefetcher' ))
        );
    }

    public function widget($args, $instance) {
    echo $args['before_widget'];

    // Display title if set
    if (!empty($instance['title'])) {
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
    }

    // Display WP GameFetcher content without images
    echo '<ul class="wp-gamefetcher-list">';
    echo do_shortcode('[wp_gamefetcher ordering="-rating" page_size="5"]');
    echo '</ul>';

    echo $args['after_widget'];
}



    public function form($instance) {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-gamefetcher'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
    </p>
    <?php
}


    public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
    return $instance;
}

}


function register_wp_gamefetcher_widget() {
    register_widget('WP_GameFetcher_Widget');
}

add_action('widgets_init', 'register_wp_gamefetcher_widget');
