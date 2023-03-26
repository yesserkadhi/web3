<?php
/* ThemeREX Updater support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'alpha_color_trx_updater_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'alpha_color_trx_updater_theme_setup9', 9 );
    function alpha_color_trx_updater_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'alpha_color_filter_tgmpa_required_plugins', 'alpha_color_trx_updater_tgmpa_required_plugins', 8 );
        }
    }
}


// Filter to add in the required plugins list
if ( ! function_exists( 'alpha_color_trx_updater_tgmpa_required_plugins' ) ) {
    
    function alpha_color_trx_updater_tgmpa_required_plugins( $list = array() ) {
        if ( alpha_color_storage_isset( 'required_plugins', 'trx_updater' ) ) {
            $path = alpha_color_get_file_dir( 'plugins/trx_updater/trx_updater.zip' );
            if ( ! empty( $path ) || alpha_color_get_theme_setting( 'tgmpa_upload' ) ) {
                $list[] = array(
                    'name'     => alpha_color_storage_get_array( 'required_plugins', 'trx_updater' ),
                    'slug'     => 'trx_updater',
                    'version'  => '2.0.0',
                    'source'   => ! empty( $path ) ? $path : 'upload://trx_updater.zip',
                    'required' => false,
                );
            }
        }
        return $list;
    }
}