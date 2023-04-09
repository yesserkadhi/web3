<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://logichunt.com
 * @since      1.0.0
 *
 * @package    Parallax_Scroll_Wp
 * @subpackage Parallax_Scroll_Wp/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Parallax_Scroll_Wp
 * @subpackage Parallax_Scroll_Wp/includes
 * @author     LogicHunt <info@logichunt.com>
 */
class Parallax_Scroll_Wp_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'parallax-scroll-wp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
