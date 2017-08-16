<?php

class Squirrel_Customizer {

    public static function Squirrel_Register($wp_customize) {
        self::Squirrel_Sections($wp_customize);
        self::Squirrel_Controls($wp_customize);
    }

    public static function Squirrel_Sections($wp_customize) {
        /**
         * General Section
         */
        $wp_customize->add_section('general_setting_section', array(
            'title' => __('General Settings', 'squirrel'),
            'description' => __('Allows you to customize header logo, favicon settings for Squirrel Theme.', 'squirrel'), //Descriptive tooltip
            'panel' => '',
            'priority' => '10',
            'capability' => 'edit_theme_options'
                )
        );
        /**
         * Home Page Main Headings
         */
        $wp_customize->add_section('home_feature_main_headings', array(
            'title' => __('Home Page Headings', 'squirrel'),
            'description' => __('Allows you to setup home page headings section for Squirrel Theme.', 'squirrel'),
            'panel' => '',
            'priority' => '11',
            'capability' => 'edit_theme_options'
                )
        );
        /**
         * Home Page Top Feature Area
         */
        $wp_customize->add_section('home_top_feature_area', array(
            'title' => __('Top Feature Area', 'squirrel'),
            'description' => __('Allows you to setup Top feature area section for Squirrel Theme.', 'squirrel'), //Descriptive tooltip
            'panel' => '',
            'priority' => '12',
            'capability' => 'edit_theme_options'
                )
        );
        /**
         * Add panel for home page feature area
         */
        $wp_customize->add_panel('home_page_feature_area_panel', array(
            'title' => __('Home Page Feature Area', 'squirrel'),
            'description' => __('Allows you to setup home page feature area section for Squirrel Theme.', 'squirrel'),
            'priority' => '13',
            'capability' => 'edit_theme_options'
        ));

        /**
         * Home Page left feature
         */
        $wp_customize->add_section('home_page_left_feature_area', array(
            'title' => __('Home page Left Area', 'squirrel'),
            'description' => __('Allows you to setup left feature area on home page for Squirrel Theme.', 'squirrel'),
            'panel' => 'home_page_feature_area_panel',
            'priority' => '',
            'capability' => 'edit_theme_options'
                )
        );
        /**
         * Home Page right feature
         */
        $wp_customize->add_section('home_page_right_feature_area', array(
            'title' => __('Home page Right Area', 'squirrel'),
            'description' => __('Allows you tosetup left feature area on home page for Squirrel Theme.', 'squirrel'),
            'panel' => 'home_page_feature_area_panel',
            'priority' => '',
            'capability' => 'edit_theme_options'
                )
        );
        /**
         * Home Page Feature area setting
         */
        $wp_customize->add_section('home_page_full_width', array(
            'title' => __('Home Page Bottom FullWidth Area', 'squirrel'),
            'description' => __('Allows you to setup Home Page Bottom FullWidth Area Section for Squirrel Theme.', 'squirrel'),
            'panel' => 'home_page_feature_area_panel',
            'priority' => '',
            'capability' => 'edit_theme_options'
                )
        );
    }

    public static function Squirrel_Section_Content() {
        $section_content = array(
            'general_setting_section' => array(
                'squirrel_logo',
                'squirrel_favicon'
            ),
            'home_feature_main_headings' => array(
                'squirrel_first_head',
                'squirrel_second_head'
            ),
            'home_top_feature_area' => array(
                'squirrel_image1',
                'squirrel_slidehead',
                'squirrel_slidedesc',
            ),
            'home_page_left_feature_area' => array(
                'squirrel_leftcolhead',
                'squirrel_leftcoldesc'
            ),
            'home_page_right_feature_area' => array(
                'squirrel_rightcolhead',
                'squirrel_rightcoldesc'
            ),
            'home_page_full_width' => array(
                'squirrel_fullcolhead',
                'squirrel_fullcoldesc'
            )
        );
        return $section_content;
    }

    public static function Squirrel_Settings() {
        $squirrel_settings = array(
            'squirrel_logo' => array(
                'id' => 'squirrel_options[squirrel_logo]',
                'label' => __('Custom Logo', 'squirrel'),
                'description' => __('Choose your own logo. Optimal Size: 300px Wide by 90px Height.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'image',
                'default' => get_template_directory_uri() . '/images/logo.png'
            ),
            'squirrel_favicon' => array(
                'id' => 'squirrel_options[squirrel_favicon]',
                'label' => __('Custom Favicon', 'squirrel'),
                'description' => __('Here you can upload a Favicon for your Website. Specified size is 16px x 16px.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'image',
                'default' => ''
            ),
            // Home Page Main Headings
            'squirrel_first_head' => array(
                'id' => 'squirrel_options[squirrel_first_head]',
                'label' => __('Home Page Main Heading', 'squirrel'),
                'description' => __('Enter your text for first heading.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('WordPress Theme to easily create your Website', 'squirrel')
            ),
            'squirrel_second_head' => array(
                'id' => 'squirrel_options[squirrel_second_head]',
                'label' => __('Home Page Sub Heading', 'squirrel'),
                'description' => __('Mention the Sub heading for your business here that will complement the punch line.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Just few Clicks and your website is <a href="#">ready for go.', 'squirrel')
            ),
            'squirrel_image1' => array(
                'id' => 'squirrel_options[squirrel_image1]',
                'label' => __('Top Feature Image', 'squirrel'),
                'description' => __('Choose your image for top feature image. Optimal size is 580px wide and 325px height.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'image',
                'default' => get_template_directory_uri() . '/images/slide-1.jpg'
            ),
            'squirrel_slidehead' => array(
                'id' => 'squirrel_options[squirrel_slidehead]',
                'label' => __('Top Feature Heading', 'squirrel'),
                'description' => __('Mention the heading for the Top Feature.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('We are scope, a design firm in England', 'squirrel')
            ),
            'squirrel_slidedesc' => array(
                'id' => 'squirrel_options[squirrel_slidedesc]',
                'label' => __('Top Feature Description', 'squirrel'),
                'description' => __('Enter your text for feature description.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('<p>Newfoundland dogs are good to save children from drowning, but you must have a pond of water handy and a child.</p><p>From drowning, but you must have a pond of water handy and a child.</p>', 'squirrel')
            ),
            // Left Feature Area
            'squirrel_leftcolhead' => array(
                'id' => 'squirrel_options[squirrel_leftcolhead]',
                'label' => __('Homepage Left Col Heading', 'squirrel'),
                'description' => __('Enter your text for home page left col.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Powerful Reporting', 'squirrel')
            ),
            'squirrel_leftcoldesc' => array(
                'id' => 'squirrel_options[squirrel_leftcoldesc]',
                'label' => __('Homepage Left Col Description', 'squirrel'),
                'description' => __('Enter your text for home page left col description.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Product Developers/ Internet Marketer make more products sales when they can easily display their products with the buy links in the perfecter location.', 'squirrel')
            ),
            // Right Feature Area
            'squirrel_rightcolhead' => array(
                'id' => 'squirrel_options[squirrel_rightcolhead]',
                'label' => __('Homepage Right Col Heading', 'squirrel'),
                'description' => __('Enter your text for right col heading.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Mobile Device Friendly', 'squirrel')
            ),
            'squirrel_rightcoldesc' => array(
                'id' => 'squirrel_options[squirrel_rightcoldesc]',
                'label' => __('Homepage Right Col Description', 'squirrel'),
                'description' => __('Enter your text for right col description.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Product Developers Internet Marketer make more sales when and they can easily display their products with the buy links in the perfect location.', 'squirrel')
            ),
            // FullWidth Feature Area
            'squirrel_fullcolhead' => array(
                'id' => 'squirrel_options[squirrel_fullcolhead]',
                'label' => __('Full Col Heading', 'squirrel'),
                'description' => __('Enter your text for full col heading', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Google Apps & Ms Exchange', 'squirrel')
            ),
            'squirrel_fullcoldesc' => array(
                'id' => 'squirrel_options[squirrel_fullcoldesc]',
                'label' => __('Full Col Description', 'squirrel'),
                'description' => __('Enter your text for full col description.', 'squirrel'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Product Developers/ Internet Marketer make more sales when they can easily display their products with the buy links in the perfect location. Products with the buy link.My husband and I are either goinuy a dog or have a child. We cant decide whether to ruin our carpets or ruin our lives.', 'squirrel')
            )
        );
        return $squirrel_settings;
    }

    public static function Squirrel_Controls($wp_customize) {
        $sections = self::Squirrel_Section_Content();
        $settings = self::Squirrel_Settings();
        foreach ($sections as $section_id => $section_content) {
            foreach ($section_content as $section_content_id) {
                switch ($settings[$section_content_id]['setting_type']) {
                    case 'image':
                        self::add_setting($wp_customize, $settings[$section_content_id]['id'], $settings[$section_content_id]['default'], $settings[$section_content_id]['type'], 'squirrel_sanitize_url');
                        $wp_customize->add_control(new WP_Customize_Image_Control(
                                $wp_customize, $settings[$section_content_id]['id'], array(
                            'label' => $settings[$section_content_id]['label'],
                            'description' => $settings[$section_content_id]['description'],
                            'section' => $section_id,
                            'settings' => $settings[$section_content_id]['id']
                                )
                        ));
                        break;
                    case 'text':
                        self::add_setting($wp_customize, $settings[$section_content_id]['id'], $settings[$section_content_id]['default'], $settings[$section_content_id]['type'], 'squirrel_sanitize_text');
                        $wp_customize->add_control(new WP_Customize_Control(
                                $wp_customize, $settings[$section_content_id]['id'], array(
                            'label' => $settings[$section_content_id]['label'],
                            'description' => $settings[$section_content_id]['description'],
                            'section' => $section_id,
                            'settings' => $settings[$section_content_id]['id'],
                            'type' => 'text'
                                )
                        ));
                        break;
                    case 'textarea':
                        self::add_setting($wp_customize, $settings[$section_content_id]['id'], $settings[$section_content_id]['default'], $settings[$section_content_id]['type'], 'squirrel_sanitize_textarea');

                        $wp_customize->add_control(new WP_Customize_Control(
                                $wp_customize, $settings[$section_content_id]['id'], array(
                            'label' => $settings[$section_content_id]['label'],
                            'description' => $settings[$section_content_id]['description'],
                            'section' => $section_id,
                            'settings' => $settings[$section_content_id]['id'],
                            'type' => 'textarea'
                                )
                        ));
                        break;
                    case 'link':
                        self::add_setting($wp_customize, $settings[$section_content_id]['id'], $settings[$section_content_id]['default'], $settings[$section_content_id]['type'], 'squirrel_sanitize_url');

                        $wp_customize->add_control(new WP_Customize_Control(
                                $wp_customize, $settings[$section_content_id]['id'], array(
                            'label' => $settings[$section_content_id]['label'],
                            'description' => $settings[$section_content_id]['description'],
                            'section' => $section_id,
                            'settings' => $settings[$section_content_id]['id'],
                            'type' => 'text'
                                )
                        ));
                        break;
                    default:
                        break;
                }
            }
        }
    }

    public static function add_setting($wp_customize, $setting_id, $default, $type, $sanitize_callback) {
        $wp_customize->add_setting($setting_id, array(
            'default' => $default,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array('Squirrel_Customizer', $sanitize_callback),
            'type' => $type
                )
        );
    }

    /**
     * adds sanitization callback funtion : textarea
     * @package Squirrel
     */
    public static function squirrel_sanitize_textarea($value) {
        $array = wp_kses_allowed_html('post');
        $allowedtags = array(
            'iframe' => array(
                'width' => array(),
                'height' => array(),
                'frameborder' => array(),
                'scrolling' => array(),
                'src' => array(),
                'marginwidth' => array(),
                'marginheight' => array()
            )
        );
        $data = array_merge($allowedtags, $array);
        $value = wp_kses($value, $data);
        return $value;
    }

    /**
     * adds sanitization callback funtion : url
     * @package Squirrel
     */
    public static function squirrel_sanitize_url($value) {
        $value = esc_url($value);
        return $value;
    }

    /**
     * adds sanitization callback funtion : text
     * @package Squirrel
     */
    public static function squirrel_sanitize_text($value) {
        $value = sanitize_text_field($value);
        return $value;
    }

    /**
     * adds sanitization callback funtion : email
     * @package Squirrel
     */
    public static function squirrel_sanitize_email($value) {
        $value = sanitize_email($value);
        return $value;
    }

    /**
     * adds sanitization callback funtion : number
     * @package Squirrel
     */
    public static function squirrel_sanitize_number($value) {
        $value = preg_replace("/[^0-9+ ]/", "", $value);
        return $value;
    }

}

// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('Squirrel_Customizer', 'Squirrel_Register'));

function inkthemes_registers() {
    wp_register_script('inkthemes_jquery_ui', '//code.jquery.com/ui/1.11.0/jquery-ui.js', array("jquery"), true);
    wp_register_script('inkthemes_customizer_script', get_template_directory_uri() . '/js/inkthemes_customizer.js', array("jquery", "inkthemes_jquery_ui"), true);
    wp_enqueue_script('inkthemes_customizer_script');
    wp_localize_script('inkthemes_customizer_script', 'ink_advert', array(
        'pro' => __('View PRO version', 'squirrel'),
        'url' => esc_url('http://www.inkthemes.com/wp-themes/multipurpose-wordpress-theme/'),
        'support_text' => __('Need Help!', 'squirrel'),
        'support_url' => esc_url('http://www.inkthemes.com/lets-connect/')
            )
    );
}

add_action('customize_controls_enqueue_scripts', 'inkthemes_registers');
