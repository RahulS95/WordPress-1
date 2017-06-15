<?php

/***** Theme Info Page *****/

if (!function_exists('mh_newsdesk_lite_add_theme_info_page')) {
	function mh_newsdesk_lite_add_theme_info_page() {
		add_theme_page(__('Welcome to MH Newsdesk lite', 'mh-newsdesk-lite'), __('Theme Info', 'mh-newsdesk-lite'), 'edit_theme_options', 'newsdesk', 'mh_newsdesk_lite_display_theme_info_page');
	}
}
add_action('admin_menu', 'mh_newsdesk_lite_add_theme_info_page');

if (!function_exists('mh_newsdesk_lite_display_theme_info_page')) {
	function mh_newsdesk_lite_display_theme_info_page() {
		$theme_data = wp_get_theme(); ?>
		<div class="theme-info-wrap">
			<h1><?php printf(__('Welcome to %1s %2s', 'mh-newsdesk-lite'), $theme_data->Name, $theme_data->Version ); ?></h1>
			<div class="theme-description"><?php echo $theme_data->Description; ?></div>
			<hr>
			<div class="theme-links clearfix">
				<p><strong><?php _e('Important Links:', 'mh-newsdesk-lite'); ?></strong>
					<a href="http://www.mhthemes.com/themes/mh/newsdesk-lite/" target="_blank"><?php _e('Theme Info Page', 'mh-newsdesk-lite'); ?></a>
					<a href="http://www.mhthemes.com/support/" target="_blank"><?php _e('Support Center', 'mh-newsdesk-lite'); ?></a>
					<a href="http://wordpress.org/support/view/theme-reviews/mh-newsdesk-lite?filter=5" target="_blank"><?php _e('Rate this theme', 'mh-newsdesk-lite'); ?></a>
				</p>
			</div>
			<hr>
			<div id="getting-started">
				<h3><?php printf(__('Getting Started with %s', 'mh-newsdesk-lite'), $theme_data->Name); ?></h3>
				<div class="row clearfix">
					<div class="col-1-2">
						<div class="section">
							<h4><?php _e('Theme Documentation', 'mh-newsdesk-lite'); ?></h4>
							<p class="about"><?php printf(__('Need any help to setup and configure %s? Please have a look at the instructions on the theme info page or read the documentations and tutorials in our support center.', 'mh-newsdesk-lite'), $theme_data->Name); ?></p>
							<p>
								<a href="http://www.mhthemes.com/themes/mh/newsdesk-lite/" target="_blank" class="button button-secondary"><?php _e('Visit Documentation', 'mh-newsdesk-lite'); ?></a>
							</p>
						</div>
						<div class="section">
							<h4><?php _e('Theme Options', 'mh-newsdesk-lite'); ?></h4>
							<p class="about"><?php printf(__('%s supports the theme customizer for all theme settings. Click "Customize Theme" to open the customizer now.',  'mh-newsdesk-lite'), $theme_data->Name); ?></p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php _e('Customize Theme', 'mh-newsdesk-lite'); ?></a>
							</p>
						</div>
						<div class="section">
							<h4><?php _e('Upgrade to Premium', 'mh-newsdesk-lite'); ?></h4>
							<p class="about"><?php _e('Need more features and options? Check out the premium version of this theme which comes with more features, additional widgets and advanced customization options for your website.', 'mh-newsdesk-lite'); ?></p>
							<p>
								<a href="http://www.mhthemes.com/themes/mh/newsdesk/" target="_blank" class="button button-secondary"><?php _e('Learn more about the Premium Version', 'mh-newsdesk-lite'); ?></a>
							</p>
						</div>
					</div>
					<div class="col-1-2">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php _e('Theme Screenshot', 'mh-newsdesk-lite'); ?>" />
					</div>
				</div>
			</div>
			<hr>
			<div id="theme-author">
				<p><?php printf(__('%1s is proudly brought to you by %2s. If you like this WordPress theme, %3s.', 'mh-newsdesk-lite'),
					$theme_data->Name,
					'<a target="_blank" href="http://www.mhthemes.com/" title="MH Themes">MH Themes</a>',
					'<a target="_blank" href="http://wordpress.org/support/view/theme-reviews/mh-newsdesk-lite?filter=5" title="MH Newsdesk lite Review">' . __('rate it', 'mh-newsdesk-lite') . '</a>'); ?>
				</p>
			</div>
		</div> <?php
	}
}

?>