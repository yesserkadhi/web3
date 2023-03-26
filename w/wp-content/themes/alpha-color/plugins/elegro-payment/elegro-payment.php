<?php
/* elegro Crypto Payment support functions
------------------------------------------------------------------------------- */
// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'alpha_color_elegro_payment_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'alpha_color_elegro_payment_theme_setup9', 9 );
	function alpha_color_elegro_payment_theme_setup9() {
		if ( alpha_color_exists_elegro_payment() ) {
            add_action('wp_enqueue_scripts', 'alpha_color_elegro_payment_frontend_scripts', 1100);
			add_filter( 'alpha_color_filter_merge_styles', 'alpha_color_elegro_payment_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'alpha_color_filter_tgmpa_required_plugins', 'alpha_color_elegro_payment_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'alpha_color_elegro_payment_tgmpa_required_plugins' ) ) {
	function alpha_color_elegro_payment_tgmpa_required_plugins( $list = array() ) {
            if (alpha_color_storage_isset('required_plugins', 'elegro-payment')) {
			$list[] = array(
                'name' 		=> esc_html__('elegro Crypto Payment', 'alpha-color'),
				'slug'     => 'elegro-payment',
				'required' => false,
			);
		}
		return $list;
	}
}


// Check if this plugin installed and activated
if ( ! function_exists( 'alpha_color_exists_elegro_payment' ) ) {
	function alpha_color_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}

// Merge custom styles
if ( ! function_exists( 'alpha_color_elegro_payment_merge_styles' ) ) {
	function alpha_color_elegro_payment_merge_styles( $list ) {
		$list[] = 'plugins/elegro-payment/elegro-payment.css';
		return $list;
	}
}
// Enqueue custom styles
if (!function_exists('alpha_color_elegro_payment_frontend_scripts')) {
    function alpha_color_elegro_payment_frontend_scripts()
    {
        if (alpha_color_exists_elegro_payment()) {
            if (alpha_color_is_on(alpha_color_get_theme_option('debug_mode')) && alpha_color_get_file_dir('plugins/elegro-payment/elegro-payment.css') != '')
                wp_enqueue_style('alpha-color-elegro-payment', alpha_color_get_file_url('plugins/elegro-payment/elegro-payment.css'), array(), null);
        }
    }
}