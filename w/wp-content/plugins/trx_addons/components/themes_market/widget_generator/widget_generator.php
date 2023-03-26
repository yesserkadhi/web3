<?php
/**
 * Themes market support: Widget Generator
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.34
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


if (!function_exists('trx_addons_widget_generator_add_page_template')) {
	add_filter( 'theme_page_templates', 'trx_addons_widget_generator_add_page_template');
	function trx_addons_widget_generator_add_page_template( $templates ) {
		$templates['widget_generator'] = __('Widget Generator', 'trx_addons');
		return $templates;
	}
}


// Redirect current page to the Widget Generator
if (!function_exists('trx_addons_widget_generator_get_page_template')) {
	add_filter('page_template', 'trx_addons_widget_generator_get_page_template', 2000);
	function trx_addons_widget_generator_get_page_template($template) {
		if (($GLOBALS['TRX_ADDONS_STORAGE']['_wp_page_template'] = get_post_meta(get_the_ID(), '_wp_page_template', true)) == 'widget_generator') {
			$template = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_THEMES_MARKET . 'widget_generator/tpl.widget_generator.php');
		}
		return $template;
	}
}
	
// Load required styles and scripts for the frontend
if ( !function_exists( 'trx_addons_widget_generator_load_scripts_front' ) ) {
	add_action("wp_enqueue_scripts", 'trx_addons_widget_generator_load_scripts_front', 11);
	function trx_addons_widget_generator_load_scripts_front() {
		if ($GLOBALS['TRX_ADDONS_STORAGE']['_wp_page_template']=='widget_generator') {
			wp_enqueue_script('trx_addons-widget_themes', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_THEMES_MARKET . 'widget_generator/widget.themes.js'), array(), null, true );
			wp_enqueue_style( 'trx_addons-widget_generator', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_THEMES_MARKET . 'widget_generator/widget_generator.css'), array(), null );
			wp_enqueue_script('trx_addons-widget_generator', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_THEMES_MARKET . 'widget_generator/widget_generator.js'), array('jquery'), null, true );
			$GLOBALS['TRX_ADDONS_STORAGE']['widget_generator_uid'] = trx_addons_rest_get_uid();
			wp_localize_script( 'trx_addons-widget_generator', 'TRX_ADDONS_WIDGET_GENERATOR', apply_filters('trx_addons_localize_script_widget_generator', array(
				'uid' => $GLOBALS['TRX_ADDONS_STORAGE']['widget_generator_uid'],
				'logo' => trx_addons_get_option('themes_market_logo'),
				'logo_link' => trx_addons_get_option('themes_market_logo_link'),
				'downloads_url' => '//trex3.dev.themerex.dnw',
				'widget_url' => '//trex3.dev.themerex.dnw/wp-content/plugins/trx_addons/components/themes_market/js/widget.themes.js',
				'msg_no_themes' => esc_html__('No themes found', 'trx_addons')
				) )
			);
		}
	}
}
?>