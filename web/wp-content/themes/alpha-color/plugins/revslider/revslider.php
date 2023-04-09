<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('alpha_color_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'alpha_color_revslider_theme_setup9', 9 );
	function alpha_color_revslider_theme_setup9() {
		if (alpha_color_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'alpha_color_revslider_frontend_scripts', 1100 );
			add_filter( 'alpha_color_filter_merge_styles',			'alpha_color_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'alpha_color_filter_tgmpa_required_plugins','alpha_color_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'alpha_color_revslider_tgmpa_required_plugins' ) ) {
	
	function alpha_color_revslider_tgmpa_required_plugins($list=array()) {
		if (alpha_color_storage_isset('required_plugins', 'revslider')) {
			$path = alpha_color_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || alpha_color_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> alpha_color_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
					'version'	=> '6.5.31',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'alpha_color_exists_revslider' ) ) {
	function alpha_color_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'alpha_color_revslider_frontend_scripts' ) ) {
	
	function alpha_color_revslider_frontend_scripts() {
		if (alpha_color_is_on(alpha_color_get_theme_option('debug_mode')) && alpha_color_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'alpha-color-revslider',  alpha_color_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'alpha_color_revslider_merge_styles' ) ) {
	
	function alpha_color_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>