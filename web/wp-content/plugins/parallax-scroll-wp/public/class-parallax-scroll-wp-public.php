<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://logichunt.com
 * @since      1.0.0
 *
 * @package    Parallax_Scroll_Wp
 * @subpackage Parallax_Scroll_Wp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Parallax_Scroll_Wp
 * @subpackage Parallax_Scroll_Wp/public
 * @author     LogicHunt <info@logichunt.com>
 */
class Parallax_Scroll_Wp_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Parallax_Scroll_Wp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Parallax_Scroll_Wp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style( 'lgx_parallax_style', plugin_dir_url( __FILE__ ) . 'assets/css/parallax-wp-public.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Parallax_Scroll_Wp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Parallax_Scroll_Wp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( 'lgx_parallax_script', plugin_dir_url( __FILE__ ) . 'assets/js/parallax.js', array( 'jquery' ), $this->version, false );
		
		wp_register_script( 'lgx_parallax_script2', plugin_dir_url( __FILE__ ) . 'assets/lax/jarallax.min.js', array( 'jquery' ), $this->version, false );
		
		wp_register_script( 'lgx_parallax_wp_script', plugin_dir_url( __FILE__ ) . 'assets/js/parallax-wp-public.js', array( 'jquery' ), $this->version, false );

	}


	

    /**
     *
     *  Version 2 Started
     *
     */

    public function register_lgx_parallax_generator_shortcode() {

        add_shortcode('lgx_parallax', array( $this, 'display_lgx_parallax_shortcode_generator' ) );
    }


    public function display_lgx_parallax_shortcode_generator($atts) {

        if ( ! isset( $atts['id'] ) ) {

            return '<p style="color: red;">Error: The showcase ID is missing. Please add a Showcase ID.</p>';

        } else {

            $lgx_generator_meta = get_post_meta( $atts['id'], '_save_meta_lgx_parallax_generator', true );

            if(empty($lgx_generator_meta)) {
                return '<p style="color: red;">Error: The Parallax ID is not valid. Please add a valid Parallax ID.</p>';
            }

            //echo '<pre>';print_r($lgx_generator_meta['showcase_type']);echo '</pre>';
            $lgx_lsw_loading_icon = plugin_dir_url( __FILE__ ). 'assets/img/loader.gif';

            ob_start();

            include('partials/view-controller.php');

            return ob_get_clean();
        }

    }


}
