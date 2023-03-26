<?php
/* Advanced Product Fields for WooCommerce support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('alpha_color_advanced_product_fields_theme_setup9')) {
	add_action( 'after_setup_theme', 'alpha_color_advanced_product_fields_theme_setup9', 9 );
	function alpha_color_advanced_product_fields_theme_setup9() {
		if (is_admin()) {
			add_filter( 'alpha_color_filter_tgmpa_required_plugins',			'alpha_color_advanced_product_fields_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'alpha_color_advanced_product_fields_tgmpa_required_plugins' ) ) {
	
	function alpha_color_advanced_product_fields_tgmpa_required_plugins($list=array()) {
		if (alpha_color_storage_isset('required_plugins', 'advanced-product-fields-for-woocommerce')) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> alpha_color_storage_get_array('required_plugins', 'advanced-product-fields-for-woocommerce'),
					'slug' 		=> 'advanced-product-fields-for-woocommerce',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if advanced_product_fields installed and activated
if ( !function_exists( 'alpha_color_exists_advanced_product_fields' ) ) {
	function alpha_color_exists_advanced_product_fields() {
		return function_exists('wapf');
	}
}

?>