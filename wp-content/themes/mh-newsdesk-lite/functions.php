<?php

/***** Fetch Options *****/

$mh_newsdesk_lite_lite_options = get_option('mh_newsdesk_lite_options');

/***** Custom Hooks *****/

function mh_newsdesk_lite_before_page_content() {
    do_action('mh_newsdesk_lite_before_page_content');
}

function mh_newsdesk_lite_before_post_content() {
    do_action('mh_newsdesk_lite_before_post_content');
}

/***** Theme Setup *****/

if (!function_exists('mh_newsdesk_lite_themes_setup')) {
	function mh_newsdesk_lite_themes_setup() {
		$header = array(
			'default-image'	=> '',
			'default-text-color' => '1f1e1e',
			'width' => 300,
			'height' => 100,
			'flex-width' => true,
			'flex-height' => true
		);
		add_theme_support('custom-header', $header);

		load_theme_textdomain('mh-newsdesk-lite', get_template_directory() . '/languages');

		add_post_type_support('page', 'excerpt');

		add_theme_support('automatic-feed-links');
		add_theme_support('html5', array( 'search-form'));
		add_theme_support('custom-background', array('default-color' => 'efefef'));
		add_theme_support('post-thumbnails');

		add_image_size('content-single', 777, 437, true);
		add_image_size('content-list', 260, 146, true);
		add_image_size('cp-thumb-small', 120, 67, true);

		register_nav_menus(array(
			'main_nav' => __('Main Navigation', 'mh-newsdesk-lite'),
		));

		add_filter('use_default_gallery_style', '__return_false');
		add_filter('widget_text', 'do_shortcode');
	}
}
add_action('after_setup_theme', 'mh_newsdesk_lite_themes_setup');

/***** Set Content Width *****/

if (!function_exists('mh_newsdesk_lite_content_width')) {
	function mh_newsdesk_lite_content_width() {
		global $content_width;
		if (!isset($content_width)) {
			if (is_page_template('page-full.php')) {
				$content_width = 1180;
			} else {
				$content_width = 777;
			}
		}
	}
}
add_action('template_redirect', 'mh_newsdesk_lite_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_newsdesk_lite_scripts')) {
	function mh_newsdesk_lite_scripts() {
		wp_enqueue_style('mh-google-fonts', "//fonts.googleapis.com/css?family=Oswald:400,700,300|PT+Serif:400,400italic,700,700italic", array(), null);
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_style('mh-style', get_stylesheet_uri(), false, '1.0.9');
		wp_enqueue_script('mh-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (!is_admin()) {
			if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
				wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_newsdesk_lite_scripts');

if (!function_exists('mh_newsdesk_lite_admin_scripts')) {
	function mh_newsdesk_lite_admin_scripts($hook) {
		if ('appearance_page_newsdesk' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_newsdesk_lite_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_newsdesk_lite_widgets_init')) {
	function mh_newsdesk_lite_widgets_init() {
		register_sidebar(array('name' => __('Global Sidebar', 'mh-newsdesk-lite'), 'id' => 'sidebar', 'description' => __('Sidebar used globally throughout your site.', 'mh-newsdesk-lite'), 'before_widget' => '<div class="sb-widget clearfix">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 1 - Large Column (Top)', 'mh-newsdesk-lite'), 'id' => 'home-1', 'description' => __('Large column on Homepage.', 'mh-newsdesk-lite'), 'before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 2 - First Column', 'mh-newsdesk-lite'), 'id' => 'home-2', 'description' => __('First column on Homepage.', 'mh-newsdesk-lite'), 'before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 3 - Second Column', 'mh-newsdesk-lite'), 'id' => 'home-3', 'description' => __('Second column on Homepage.', 'mh-newsdesk-lite'), 'before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 4 - Large Column (Bottom)', 'mh-newsdesk-lite'), 'id' => 'home-4', 'description' => __('Large column on Homepage.', 'mh-newsdesk-lite'), 'before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => __('Home 5 - Sidebar', 'mh-newsdesk-lite'), 'id' => 'home-5', 'description' => __('Sidebar on Homepage.', 'mh-newsdesk-lite'), 'before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>'));
	}
}
add_action('widgets_init', 'mh_newsdesk_lite_widgets_init');

/***** Include Several Functions *****/

require_once('includes/mh-options.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-widgets.php');

if (is_admin()) {
	require_once('admin/admin.php');
}

?>