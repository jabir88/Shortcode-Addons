<?php

function check_VC_plugin_At_Oxi_Addons() {
    if (!function_exists('is_plugin_active')) {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }
    if (is_plugin_active('js_composer/js_composer.php')) {
        add_action('vc_before_init', 'Oxi_Addons_VC_extension');

        function Oxi_Addons_VC_extension() {
            vc_map(array(
                "name" => __("Shortcode Addons"),
                "base" => "Oxi_Addons_VC",
                "category" => __("Content"),
                "params" => array(
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "heading" => __("ID"),
                        "param_name" => "id",
                        "description" => __("Input your Addons ID in input box")
                    ),
                )
            ));
        }

    }
}

add_action('admin_init', 'check_VC_plugin_At_Oxi_Addons');

function shortcode_addons_load() {
    register_widget('shortcode_addons_widget');
}

add_action('widgets_init', 'shortcode_addons_load');

// Creating the widget 
class shortcode_addons_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
// Base ID of your widget
                'shortcode_addons_widget',
// Widget name will appear in UI
                __('Shortcode Addons', 'shortcode_addons_widget_widget'),
// Widget description
                array('description' => __('Shortcode Addons Widget', 'shortcode_addons_widget_widget'),)
        );
    }

// Creating widget front-end

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        echo oxi_addons_shortcode_extension($title, 'user');
        echo $args['after_widget'];
    }

// Widget Backend 
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('1', 'shortcode_addons_widget_widget');
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Style ID:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}
