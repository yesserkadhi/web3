<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Implements features of FREE version of YITH WooCommerce Request A Quote
 *
 * @class   YITH_YWRAQ_Admin
 * @package YITH WooCommerce Request A Quote
 * @since   1.0.0
 * @author  YITH
 */

if ( ! defined( 'ABSPATH' ) || ! defined( 'YITH_YWRAQ_VERSION' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'YITH_YWRAQ_Admin' ) ) {

	/**
	 * Class YITH_YWRAQ_Admin
	 */
	class YITH_YWRAQ_Admin {

		/**
		 * Single instance of the class
		 *
		 * @var \YWRAQ
		 */

		protected static $instance;

		/**
		 * Panel object
		 *
		 * @var Panel Object
		 */
		protected $panel;

		/**
		 * Premium tab template file name
		 *
		 * @var string
		 */
		protected $premium = 'premium.php';

		/**
		 * Panel page
		 *
		 * @var string
		 */
		protected $panel_page = 'yith_woocommerce_request_a_quote';

		/**
		 * Premium live
		 *
		 * @var string
		 */
		protected $premium_landing = 'https://yithemes.com/themes/plugins/yith-woocommerce-request-a-quote/';


		/**
		 * Messages
		 *
		 * @var string List of messages
		 */
		protected $messages = array();

		/**
		 * Returns single instance of the class
		 *
		 * @return \YITH_YWRAQ_Admin
		 * @since 1.0.0
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * Initialize plugin and registers actions and filters to be used
		 *
		 * @since  1.0
		 */
		public function __construct() {

			$this->create_menu_items();

			// Add action links.
			add_filter( 'plugin_action_links_' . plugin_basename( YITH_YWRAQ_DIR . '/' . basename( YITH_YWRAQ_FILE ) ), array( $this, 'action_links' ) );
			add_filter( 'yith_show_plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 5 );
			add_action( 'init', array( $this, 'add_page' ) );

			// custom styles and javascripts.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );
		}

		/**
		 * Enqueue styles and scripts
		 *
		 * @access public
		 * @return void
		 * @since 1.0.0
		 */
		public function enqueue_styles_scripts() {
			// load the script in selected pages.
			global $pagenow;
			$request = $_REQUEST;//phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( 'admin.php' === $pagenow && isset( $request['page'] ) && 'yith_woocommerce_request_a_quote' === $request['page'] ) {
				$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
				wp_enqueue_script( 'yith_ywraq_admin', YITH_YWRAQ_ASSETS_URL . '/js/yith-ywraq-admin' . $suffix . '.js', array( 'jquery' ), YITH_YWRAQ_VERSION, true );
			}
		}


		/**
		 * Create Menu Items
		 *
		 * Print admin menu items
		 *
		 * @since  1.0
		 * @author Emanuela Castorina
		 */
		private function create_menu_items() {

			// Add a panel under YITH Plugins tab.
			add_action( 'admin_menu', array( $this, 'register_panel' ), 5 );
			add_action( 'yith_ywraq_premium_tab', array( $this, 'premium_tab' ) );
		}

		/**
		 * Add a panel under YITH Plugins tab
		 *
		 * @return   void
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @use      /Yit_Plugin_Panel class
		 * @see      plugin-fw/lib/yit-plugin-panel.php
		 */
		public function register_panel() {

			if ( ! empty( $this->panel ) ) {
				return;
			}

			$admin_tabs = array(
				'general' => __( 'General Options', 'yith-woocommerce-request-a-quote' ),
				'request' => __( 'Request Quote Page', 'yith-woocommerce-request-a-quote' ),
				'premium' => __( 'Premium Version', 'yith-woocommerce-request-a-quote' ),
			);

			$args = array(
				'create_menu_page' => true,
				'parent_slug'      => '',
				'plugin_slug'      => YITH_YWRAQ_SLUG,
				'page_title'       => 'YITH Request a Quote for WooCommerce',
				'menu_title'       => 'Request a Quote',
				'capability'       => 'manage_options',
				'parent'           => '',
				'parent_page'      => 'yith_plugin_panel',
				'page'             => $this->panel_page,
				'admin-tabs'       => $admin_tabs,
				'class'            => yith_set_wrapper_class(),
				'options-path'     => YITH_YWRAQ_DIR . '/plugin-options',
			);

			/* === Fixed: not updated theme  === */
			if ( ! class_exists( 'YIT_Plugin_Panel_WooCommerce' ) ) {
				require_once YITH_YWRAQ_DIR . '/plugin-fw/lib/yit-plugin-panel-wc.php';
			}

			$this->panel = new YIT_Plugin_Panel_WooCommerce( $args );

			add_action( 'woocommerce_admin_field_ywraq_upload', array( $this->panel, 'yit_upload' ) );

		}


		/**
		 * Add a page "Request a Quote".
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_page() {
			global $wpdb;

			$option_value = get_option( 'ywraq_page_id' );

			if ( $option_value > 0 && get_post( $option_value ) ) {
				return;
			}

			$page_found = $wpdb->get_var( "SELECT `ID` FROM `{$wpdb->posts}` WHERE `post_name` = 'request-quote' LIMIT 1;" ); //phpcs:ignore
			if ( $page_found ) :
				if ( ! $option_value ) {
					update_option( 'ywraq_page_id', $page_found );
				}
				return;
			endif;

			$page_data = array(
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'post_author'    => 1,
				'post_name'      => esc_sql( _x( 'request-quote', 'page_slug', 'yit' ) ),
				'post_title'     => __( 'Request a Quote', 'yit' ),
				'post_content'   => '[yith_ywraq_request_quote]',
				'post_parent'    => 0,
				'comment_status' => 'closed',
			);
			$page_id   = wp_insert_post( $page_data );

			update_option( 'ywraq_page_id', $page_id );
		}

		/**
		 * Premium Tab Template
		 *
		 * Load the premium tab template on admin page
		 *
		 * @return   void
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 */
		public function premium_tab() {
			$premium_tab_template = YITH_YWRAQ_TEMPLATE_PATH . 'admin/' . $this->premium;
			if ( file_exists( $premium_tab_template ) ) {
				include_once $premium_tab_template;
			}
		}


		/**
		 * Action Links
		 *
		 * Add the action links to plugin admin page.
		 *
		 * @param array $links Links plugin array.
		 *
		 * @return   mixed Array
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @use      plugin_action_links_{$plugin_file_name}
		 */
		public function action_links( $links ) {
			$links[] = sprintf( '<a href="%s">%s</a>', admin_url( "admin.php?page={$this->panel_page}" ), _x( 'Settings', 'Action links', 'yith-woocommerce-request-a-quote' ) );

			if ( ! defined( 'YITH_YWRAQ_FREE_INIT' ) && class_exists( 'YIT_Plugin_Licence' ) ) {
				$links[] = sprintf( '<a href="%s">%s</a>', YIT_Plugin_Licence::get_license_activation_url(), __( 'License', 'yith-woocommerce-request-a-quote' ) );
			}

			return $links;
		}




		/**
		 * Add the action links to plugin admin page
		 *
		 * @param   array $new_row_meta_args  Plugin Meta New args.
		 * @param   string $plugin_meta        Plugin Meta.
		 * @param   string $plugin_file        Plugin file.
		 * @param   array  $plugin_data        Plugin data.
		 * @param   string $status             Status.
		 * @param   string $init_file          Init file.
		 *
		 * @return   Array
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @use      plugin_row_meta
		 */
		public function plugin_row_meta( $new_row_meta_args, $plugin_meta, $plugin_file, $plugin_data, $status, $init_file = 'YITH_YWRAQ_FREE_INIT' ) {
			if ( defined( $init_file ) && constant( $init_file ) === $plugin_file ) {
				$new_row_meta_args['slug'] = YITH_YWRAQ_SLUG;
			}

			return $new_row_meta_args;
		}

		/**
		 * Get the premium landing uri
		 *
		 * @since   1.0.0
		 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
		 * @return  string The premium landing link
		 */
		public function get_premium_landing_uri() {
			return apply_filters( 'yith_plugin_fw_premium_landing_uri', $this->premium_landing, YITH_YWRAQ_SLUG );
		}
	}
}

/**
 * Unique access to instance of YITH_YWRAQ_Admin class
 *
 * @return \YITH_YWRAQ_Admin
 */
function YITH_YWRAQ_Admin() { //phpcs:ignore
	return YITH_YWRAQ_Admin::get_instance();
}

YITH_YWRAQ_Admin();
