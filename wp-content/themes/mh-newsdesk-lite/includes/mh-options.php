<?php

function mh_newsdesk_lite_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

    class MH_Customize_Header_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

	class MH_Customize_Text_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="textfield"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

    class MH_Customize_Button_Control extends WP_Customize_Control {
        public function render_content() {  ?>
			<p>
				<a href="http://www.mhthemes.com/themes/mh/newsdesk/" target="_blank" class="button button-secondary"><?php echo esc_html($this->label); ?></a>
			</p> <?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_theme_options', array('title' => __('Theme Options', 'mh-newsdesk-lite'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_general', array('title' => __('General', 'mh-newsdesk-lite'), 'priority' => 1, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_upgrade', array('title' => __('Upgrade to Premium', 'mh-newsdesk-lite'), 'priority' => 2, 'panel' => 'mh_theme_options'));

    /***** Add Settings *****/

	$wp_customize->add_setting('mh_newsdesk_lite_options[excerpt_length]', array('default' => '35', 'type' => 'option', 'sanitize_callback' => 'mh_newsdesk_lite_sanitize_integer'));
    $wp_customize->add_setting('mh_newsdesk_lite_options[excerpt_more]', array('default' => __('Read More', 'mh-newsdesk-lite'), 'type' => 'option', 'sanitize_callback' => 'mh_newsdesk_lite_sanitize_text'));
	$wp_customize->add_setting('mh_newsdesk_lite_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_newsdesk_lite_sanitize_select'));
	$wp_customize->add_setting('mh_newsdesk_lite_options[premium_version_label]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
	$wp_customize->add_setting('mh_newsdesk_lite_options[premium_version_text]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
	$wp_customize->add_setting('mh_newsdesk_lite_options[premium_version_button]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));

    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => __('Custom Excerpt Length in Words', 'mh-newsdesk-lite'), 'section' => 'mh_general', 'settings' => 'mh_newsdesk_lite_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => __('Custom Excerpt More-Text', 'mh-newsdesk-lite'), 'section' => 'mh_general', 'settings' => 'mh_newsdesk_lite_options[excerpt_more]', 'priority' => 2, 'type' => 'text'));
	$wp_customize->add_control('sidebar', array('label' => __('Sidebar', 'mh-newsdesk-lite'), 'section' => 'mh_general', 'settings' => 'mh_newsdesk_lite_options[sidebar]', 'priority' => 3, 'type' => 'select', 'choices' => array('right' => __('Right Sidebar', 'mh-newsdesk-lite'), 'left' => __('Left Sidebar', 'mh-newsdesk-lite'))));
	$wp_customize->add_control(new MH_Customize_Header_Control($wp_customize, 'premium_version_label', array('label' => __('Need more features and options?', 'mh-newsdesk-lite'), 'section' => 'mh_upgrade', 'settings' => 'mh_newsdesk_lite_options[premium_version_label]', 'priority' => 1)));
	$wp_customize->add_control(new MH_Customize_Text_Control($wp_customize, 'premium_version_text', array('label' => __('Check out the premium version of this theme which comes with more features, additional widgets and advanced customization options for your website.', 'mh-newsdesk-lite'), 'section' => 'mh_upgrade', 'settings' => 'mh_newsdesk_lite_options[premium_version_text]', 'priority' => 2)));
	$wp_customize->add_control(new MH_Customize_Button_Control($wp_customize, 'premium_version_button', array('label' => __('Learn more about the premium version', 'mh-newsdesk-lite'), 'section' => 'mh_upgrade', 'settings' => 'mh_newsdesk_lite_options[premium_version_button]', 'priority' => 3)));
}
add_action('customize_register', 'mh_newsdesk_lite_customize_register');

/***** Data Sanitization *****/

function mh_newsdesk_lite_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_newsdesk_lite_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_newsdesk_lite_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_newsdesk_lite_sanitize_select($input) {
    $valid = array(
        'enable' => __('Enable', 'mh-newsdesk-lite'),
        'disable' => __('Disable', 'mh-newsdesk-lite'),
        'right' => __('Right Sidebar', 'mh-newsdesk-lite'),
        'left' => __('Left Sidebar', 'mh-newsdesk-lite')
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_newsdesk_lite_theme_options')) {
	function mh_newsdesk_lite_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_newsdesk_lite_options', array()),
			mh_newsdesk_lite_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_newsdesk_lite_default_options')) {
	function mh_newsdesk_lite_default_options() {
		$default_options = array(
			'excerpt_length' => '35',
			'excerpt_more' => __('Read More', 'mh-newsdesk-lite'),
			'sidebar' => 'right'
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_newsdesk_lite_customizer_css() {
	wp_enqueue_style('mh-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_newsdesk_lite_customizer_css');

?>