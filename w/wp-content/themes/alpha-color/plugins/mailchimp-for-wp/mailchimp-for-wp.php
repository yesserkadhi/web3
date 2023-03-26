<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('alpha_color_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'alpha_color_mailchimp_theme_setup9', 9 );
	function alpha_color_mailchimp_theme_setup9() {
		if (alpha_color_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'alpha_color_mailchimp_frontend_scripts', 1100 );
			add_filter( 'alpha_color_filter_merge_styles',					'alpha_color_mailchimp_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'alpha_color_filter_tgmpa_required_plugins',		'alpha_color_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'alpha_color_mailchimp_tgmpa_required_plugins' ) ) {
	
	function alpha_color_mailchimp_tgmpa_required_plugins($list=array()) {
		if (alpha_color_storage_isset('required_plugins', 'mailchimp-for-wp')) {
			$list[] = array(
				'name' 		=> alpha_color_storage_get_array('required_plugins', 'mailchimp-for-wp'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'alpha_color_exists_mailchimp' ) ) {
	function alpha_color_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'alpha_color_mailchimp_frontend_scripts' ) ) {
	
	function alpha_color_mailchimp_frontend_scripts() {
		if (alpha_color_exists_mailchimp()) {
			if (alpha_color_is_on(alpha_color_get_theme_option('debug_mode')) && alpha_color_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'alpha-color-mailchimp-for-wp',  alpha_color_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'alpha_color_mailchimp_merge_styles' ) ) {
	
	function alpha_color_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (alpha_color_exists_mailchimp()) { require_once ALPHA_COLOR_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp.styles.php'; }
?>