<?php

/**
 *
 * @link              https://logichunt.com
 * @since             1.0.0
 * @package           Parallax_Scroll_Wp
 *
 * @wordpress-plugin
 * Plugin Name:       Parallax Scroll
 * Plugin URI:        https://logichunt.com/product/wp-parallax-scroll
 * Description:       Amazing Section Builder Plugin to Build a Responsive and Attractive Section with Background Parallax Effect.
 * Version:           1.0.0
 * Author:            LogicHunt
 * Author URI:        https://logichunt.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       parallax-scroll-wp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


//plugin definition specific constants
defined( 'LGX_PARALLAX_VERSION' )   	 		or define( 'LGX_PARALLAX_VERSION', '1.0.0' );
defined( 'LGX_PARALLAX_PLUGIN' )         		or define( 'LGX_PARALLAX_PLUGIN', 'parallax-scroll-wp' );
defined( 'LGX_PARALLAX_PLUGIN_BASE' )           or define( 'LGX_PARALLAX_PLUGIN_BASE', plugin_basename( __FILE__ ) );
defined( 'LGX_PARALLAX_PLUGIN_ROOT_PATH' )      or define( 'LGX_PARALLAX_PLUGIN_ROOT_PATH', plugin_dir_path( __FILE__ ) );
defined( 'LGX_PARALLAX_PLUGIN_ROOT_URL' )       or define( 'LGX_PARALLAX_PLUGIN_ROOT_URL', plugin_dir_url( __FILE__ ) );
defined( 'LGX_PARALLAX_PLUGIN_TEXT_DOMAIN')     or define( 'LGX_PARALLAX_PLUGIN_TEXT_DOMAIN', 'parallax-scroll-wp');
	

if( (LGX_PARALLAX_PLUGIN_BASE == 'parallax-scroll-wp-pro/parallax-scroll-wp-pro.php') ) {
	defined( 'LGX_PARALLAX_PLUGIN_META_FIELD_PRO')  or define( 'LGX_PARALLAX_PLUGIN_META_FIELD_PRO', 'enabled');
} else {
	defined( 'LGX_PARALLAX_PLUGIN_META_FIELD_PRO')  or define( 'LGX_PARALLAX_PLUGIN_META_FIELD_PRO', 'disabled');
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-parallax-scroll-wp-activator.php
 */
function activate_parallax_scroll_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-parallax-scroll-wp-activator.php';
	Parallax_Scroll_Wp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-parallax-scroll-wp-deactivator.php
 */
function deactivate_parallax_scroll_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-parallax-scroll-wp-deactivator.php';
	Parallax_Scroll_Wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_parallax_scroll_wp' );
register_deactivation_hook( __FILE__, 'deactivate_parallax_scroll_wp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-parallax-scroll-wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_parallax_scroll_wp() {

	$plugin = new Parallax_Scroll_Wp();
	$plugin->run();

}
run_parallax_scroll_wp();
