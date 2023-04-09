<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('alpha_color_gdpr_theme_setup9')) {
	add_action( 'after_setup_theme', 'alpha_color_gdpr_theme_setup9', 9 );
	function alpha_color_gdpr_theme_setup9() {
		if (alpha_color_exists_gdpr()) {
			add_filter( 'alpha_color_filter_merge_styles',					'alpha_color_gdpr_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'alpha_color_filter_tgmpa_required_plugins',		'alpha_color_gdpr_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'alpha_color_gdpr_tgmpa_required_plugins' ) ) {
	
	function alpha_color_gdpr_tgmpa_required_plugins($list=array()) {
		if (alpha_color_storage_isset('required_plugins', 'gdpr-framework')) {
			$list[] = array(
				'name' 		=> alpha_color_storage_get_array('required_plugins', 'gdpr-framework'),
				'slug' 		=> 'gdpr-framework',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'alpha_color_exists_gdpr' ) ) {
	function alpha_color_exists_gdpr() {
		return function_exists('__gdpr_load_plugin') || defined('GDPR_VERSION');
	}
}


