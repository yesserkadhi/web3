<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('alpha_color_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'alpha_color_cf7_theme_setup9', 9 );
	function alpha_color_cf7_theme_setup9() {
		
		if (alpha_color_exists_cf7()) {
			add_action( 'wp_enqueue_scripts', 								'alpha_color_cf7_frontend_scripts', 1100 );
			add_filter( 'alpha_color_filter_merge_styles',						'alpha_color_cf7_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'alpha_color_filter_tgmpa_required_plugins',			'alpha_color_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'alpha_color_cf7_tgmpa_required_plugins' ) ) {
	
	function alpha_color_cf7_tgmpa_required_plugins($list=array()) {
		if (alpha_color_storage_isset('required_plugins', 'contact-form-7')) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> alpha_color_storage_get_array('required_plugins', 'contact-form-7'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'alpha_color_exists_cf7' ) ) {
	function alpha_color_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'alpha_color_cf7_frontend_scripts' ) ) {
	
	function alpha_color_cf7_frontend_scripts() {
		if (alpha_color_is_on(alpha_color_get_theme_option('debug_mode')) && alpha_color_get_file_dir('plugins/contact-form-7/contact-form-7.css')!='')
			wp_enqueue_style( 'alpha-color-contact-form-7',  alpha_color_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'alpha_color_cf7_merge_styles' ) ) {
	
	function alpha_color_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}
?>