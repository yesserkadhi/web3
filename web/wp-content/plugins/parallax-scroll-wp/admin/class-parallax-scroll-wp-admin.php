<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://logichunt.com
 * @since      1.0.0
 *
 * @package    Parallax_Scroll_Wp
 * @subpackage Parallax_Scroll_Wp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Parallax_Scroll_Wp
 * @subpackage Parallax_Scroll_Wp/admin
 * @author     LogicHunt <info@logichunt.com>
 */
class Parallax_Scroll_Wp_Admin {

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
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $meta_form;

	    /**
     * The plugin plugin_base_file of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string plugin_base_file The plugin plugin_base_file of the plugin.
     */
    protected $plugin_base_file;



	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


		$this->init_meta_form();


        $this->plugin_base_file = plugin_basename(plugin_dir_path(__FILE__).'../' . $this->plugin_name . '.php');

	}


/**
     *
     * Initialized Dynamic Meta field 
     *
     */
    private function init_meta_form() {

        //wp_die( trailingslashit( dirname(  ) )  );
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/LgxMetaForm.php';
        $this->meta_form = new ClassParallaxScrollWpMetaForm();		

    }


	

     /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */
    public function add_links_admin_plugin_page_title( $links ) {

        return array_merge( array(
            'create' => '<a href="' . admin_url( 'post-new.php?post_type=lgx_parallax' ) . '" >' . esc_html__( 'Create Section',  $this->plugin_name) . '</a>',
            'docs'    => '<a style="font-weight: bold;" href="' .esc_url('https://docs.logichunt.com/wp-parallax-scroll') . '" target="_blank">' . esc_html__( 'Docs',  $this->plugin_name) . '</a>',
            'support' => '<a style="color:#00a500;  font-weight: bold;" target="_blank" href="' .esc_url('https://logichunt.com/support/') . '" target="_blank">' . esc_html__( 'Support',  $this->plugin_name) . '</a>',
           
        ), $links );


    }



    /**
     * Add support link to plugin description in /wp-admin/plugins.php
     *
     * @param  array  $plugin_meta
     * @param  string $plugin_file
     *
     * @return array
     */
    public function add_links_admin_plugin_page_description($plugin_meta, $plugin_file) {

        if ($this->plugin_base_file == $plugin_file) {
            $plugin_meta[] = sprintf(
                '<a href="%s">%s</a>', 'https://logichunt.com/support/', __('Get Support', $this->plugin_name)
            );
        }

        return $plugin_meta;
    }


    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    2.0.0
     */
    public function add_plugin_admin_menu() {

        $this->plugin_screen_hook_suffix  = add_submenu_page('edit.php?post_type=lgx_parallax', __('Usage & Help', 'wp-counter-up'), __('Usage & Help', $this->plugin_name), 'manage_options', 'lgx_counter_help_usage', array($this, 'display_plugin_admin_usage_help'));

    }


    function display_plugin_admin_usage_help() {
        global $wpdb;

        $plugin_data = get_plugin_data(plugin_dir_path(__DIR__) . '/../' . $this->plugin_base_file);

        include('partials/admin-usage-help.php');
    }



    

    /**
     * Change Feature image input Position
     * new: changing_meta_box_position_of_icon
     *  Since 2.0.0
     */
    public  function changing_meta_box_position_of_featured_image(){

       // remove_meta_box( 'postimagediv', 'lgx_parallax', 'side' );
        add_meta_box('postimagediv', __('Background Image'), 'post_thumbnail_meta_box', 'lgx_parallax', 'normal', 'high');

    }

    /**
     * Ensure post thumbnail support is turned on.
     * Since 1.1.0
     */
    public function add_thumbnail_support() {
        if ( ! current_theme_supports( 'post-thumbnails' ) ) {
            add_theme_support( 'post-thumbnails' );
        }
        add_post_type_support( 'lgx_parallax', 'thumbnail' );
    }


    /**
     * Add support link to plugin description in /wp-admin/plugins.php
     *
     * @param  array  $plugin_meta
     * @param  string $plugin_file
     *
     * @return array
     */
    public function support_link($plugin_meta, $plugin_file) {

        if ($this->plugin_base_file == $plugin_file) {
            $plugin_meta[] = sprintf(
                '<a href="%s">%s</a>', 'http://logichunt.com/support', __('Support',  $this->plugin_name)
            );
        }

        return $plugin_meta;
    }


    
    /**
     * Modified get post for post type order
     *
     */
    public function modify_query_get_posts($query) {

        if ( ! is_admin() && ( isset( $query->query_vars['post_type'] ) &&  ( is_array( $query->query_vars['post_type'] ) && in_array( 'lgx_parallax', $query->query_vars['post_type'] ) ) ) ) {

            //$order  =   isset( $query->query_vars['order'] )  ?  $query->query_vars['order'] : '';

            //var_dump( '<pre>', $query );
            //wp_die(  );

           // $query->set( 'orderby', 'menu_order' ); // hided from v3.2.0
           // $query->set( 'order' , 'ASC' ); // hided from v3.2.0
           

        } elseif ( is_admin() ) {
            if ( $query->is_main_query() ) {
                $currentScreen = get_current_screen();
                if ( is_object( $currentScreen ) && $currentScreen->id == 'edit-lgx_parallax' && $currentScreen->post_type == 'lgx_parallax' ) {
                    $query->set( 'post_type', 'lgx_parallax' );
                    $query->set( 'orderby', 'menu_order' );
                    $query->set( 'order' , 'ASC' );
                }
            }
        }
    }





    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wp_Counter_Up_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wp_Counter_Up_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        //wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-counter-up-admin.css', array(), $this->version, 'all' );

        wp_enqueue_style( $this->plugin_name . '-admin-icon', plugin_dir_url( __FILE__ ) . 'css/lgx-icon.css', array(), $this->version, 'all' );
        wp_enqueue_style( $this->plugin_name . '-admin-reset', plugin_dir_url( __FILE__ ) . 'css/lgx_admin_reset.min.css', array(), $this->version, 'all' );

        $currentScreen = get_current_screen();

        if(( $currentScreen->post_type == 'lgx_parallax' ) ) {

            wp_enqueue_style( $this->plugin_name . '-alertify', plugin_dir_url( __FILE__ ) . 'css/alertify.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->plugin_name . '-admin', plugin_dir_url( __FILE__ ) . 'css/lgx_app_admin_style.min.css', array( 'wp-color-picker' ), $this->version, 'all' );
		
        }
    
    
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wp_Counter_Up_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wp_Counter_Up_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        //wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-counter-up-admin.js', array( 'jquery' ), $this->version, false );

        $currentScreen = get_current_screen();
        /*   echo '<pre>';
           print_r($currentScreen);
           echo '</pre>';*/
		   if(( $currentScreen->post_type == 'lgx_parallax' ) ) {

            $translation_array = array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'check_nonce' => wp_create_nonce('save_lgx_parallax_nonce'),
            );


            wp_register_script($this->plugin_name . '-alertify', plugin_dir_url( __FILE__ ) . 'js/alertify.min.js', array(), $this->version, true );
            wp_register_script($this->plugin_name . '-wp-color-picker-alpha' , plugin_dir_url( __FILE__ ) . 'js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), $this->version, true );
            wp_register_script($this->plugin_name . '-admin', plugin_dir_url( __FILE__ ) . 'js/lgx_app_admin_script.js', array( 'jquery', 'jquery-ui-sortable', $this->plugin_name . '-wp-color-picker-alpha', $this->plugin_name . '-alertify' ), $this->version, true );

            wp_localize_script($this->plugin_name . '-admin', 'wpnpaddon', $translation_array);

            wp_enqueue_script( $this->plugin_name . '-admin' );

            if ( ! did_action( 'wp_enqueue_media' ) ) {
                wp_enqueue_media();
            }


        }

	}





    /**
     * Determines whether or not the current user has the ability to save meta data associated with this post.
     *
     * user_can_save
     *
     * @param        int $post_id // The ID of the post being save
     * @param        bool /Whether or not the user has the ability to save this post.
     *
     * @since 1.0
     */
    public function user_can_save_for_lgx_counter_meta( $post_id, $action, $nonce ) {

       // wp_die($post_id);

        $is_autosave    = wp_is_post_autosave( $post_id );
        $is_revision    = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $nonce ) && wp_verify_nonce( $nonce, $action ) );

        // Return true if the user is able to save; otherwise, false.
        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;

    }


    /**
     * Register post type for shortcode Counter Generator
     *
     *
     */
    public function register_post_type_for_lgx_parallax_generator() {
    

        $labels = array(
            'name'               => _x( 'All Parallax Sections', 'Parallax Scroll', $this->plugin_name ),
            'singular_name'      => _x( 'Parallax Scroll', 'Parallax Items', $this->plugin_name ),
            'menu_name'          => __( 'Parallax Scroll', $this->plugin_name ),
            'view_item'          => __( 'View Items', $this->plugin_name ),
            'all_items'          => __( 'All Sections', $this->plugin_name ),
            'add_new'            => __( 'Add New', $this->plugin_name ),
            'edit_item'          => __( 'Edit Item', $this->plugin_name ),
            'update_item'        => __( 'Update Item', $this->plugin_name ),
            'search_items'       => __( 'Search In Item', $this->plugin_name ),
            'not_found'          => __( 'No Item found', $this->plugin_name ),
            'not_found_in_trash' => __( 'No Item found in trash', $this->plugin_name )
        );

     
        $args   = array(
            'label'               => __( 'Parallax Scroll', $this->plugin_name ),
            'description'         => __( 'Crate Shortcode for Parallax Scroll Section', $this->plugin_name ),
            'labels'              => $labels,
            'supports'            => array( 'title','thumbnail','editor'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'can_export'          => true,
            'has_archive'         => false,
            'query_var' 		  => true,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,// set false from v1.0.0
            'menu_position'       => 80, //
            'menu_icon'			  => 'dashicons-editor-insertmore',
            'capability_type'     => 'post',
        );


        register_post_type( 'lgx_parallax', $args);
    }



    /**
     * Add meta box for custom post type
     *
     * @since    2.0.0
     */
    public function adding_meta_boxes_for_lgx_parallax_generator() {
        add_meta_box(
            'lgx_parallax_generator_meta_box_panel',
            __( 'Logo Slider Shortcode Meta Field Panel', $this->plugin_name),
            array(
                $this,
                'meta_fields_display_for_lgx_parallax' //Pattern --> meta_box_panel_display_for_{post_type}
            ),
            'lgx_parallax',
            'normal',
            'high'
        );
    }



    /**
     * Render Meta Box under logosliderwp
     *
     * logosliderwp meta field
     *
     * @param $post
     *
     * @since 1.0
     *
     */
    public function meta_fields_display_for_lgx_parallax( $post ) {

        require_once plugin_dir_path( __FILE__ ) . 'partials/shortcode_meta_display/meta_fields_display_for_post_lgx_parallax.php';

    }


    /**
     * Determines whether or not the current user has the ability to save meta data associated with this post.
     *
     * Save lgx_lsp_shortcodes Meta Field
     *
     * @param        int $post_id //The ID of the post being save
     * @param         bool //Whether or not the user has the ability to save this post.
     */
    public function save_post_metadata_of_lgx_parallax_generator( $post_id, $post ) {


        $post_type = 'lgx_parallax';

        // If this isn't a 'book' post, don't update it.
        if ( $post_type != $post->post_type ) {
            return;
        }

        if ( ! empty( $_POST['post_meta_lgx_parallax_generator'] ) ) {

             
          //  $postData  = ( isset($_POST['post_meta_lgx_parallax_generator']) ? array_map("strip_tags", wp_unslash($_POST['post_meta_lgx_parallax_generator'])) : '' );
           // echo '<pre>';  print_r($postData); echo '</pre>'; wp_die();

        $savable_Data = array();


        if ( $this->user_can_save_for_lgx_counter_meta( $post_id, 'post_meta_lgx_parallax_generator', $_POST['post_meta_lgx_parallax_generator']['nonce'] ) ) {

           // echo '<pre>';  print_r($_POST['post_meta_lgx_parallax_generator']); echo '</pre>'; wp_die();


            $savable_Data['lgx_meta_parallax_type']         = sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_meta_parallax_type'] );

            //Basic Section
            $savable_Data['lgx_section_width']              = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_section_width'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_section_width'] ) : '100%');
            $savable_Data['lgx_section_container']          = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_section_container'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_section_container'] ) : 'container-fluid');
            $savable_Data['lgx_section_bg_color_en']        = ((isset($_POST['post_meta_lgx_parallax_generator']['lgx_section_bg_color_en'])) ? 'yes' : 'no');
            $savable_Data['lgx_section_bg_color']           = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_section_bg_color'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_section_bg_color'] ) : 'rgba(0,0,0,0.5)');
            $savable_Data['lgx_justify_content']            = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_justify_content'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_justify_content'] ) : 'flex-start');
            $savable_Data['lgx_align_items']                = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_align_items'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_align_items'] ) : 'flex-start');

            
            //CSS
            $savable_Data['lgx_bg_img_attachment']          = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_bg_img_attachment'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_bg_img_attachment'] ) : 'fixed');
            $savable_Data['lgx_bg_img_size_type']           = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_bg_img_size_type'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_bg_img_size_type'] ) : 'cover');
            $savable_Data['lgx_bg_img_size_custom']         = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_bg_img_size_custom'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_bg_img_size_custom'] ) : '50%');
            $savable_Data['lgx_bg_img_repeat_type']         = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_bg_img_repeat_type'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_bg_img_repeat_type'] ) : 'no-repeat');
            
            //jQuery
            $savable_Data['lgx_parallax_jquery_speed']      = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_parallax_jquery_speed'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_parallax_jquery_speed'] ) : 0.2);
            
            //Responsive
            $savable_Data['lgx_sec_height_large_desktop']   =  (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_sec_height_large_desktop'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_sec_height_large_desktop'] ): '550px');
            $savable_Data['lgx_sec_height_desktop']         =  (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_sec_height_desktop'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_sec_height_desktop'] ): '500px');
            $savable_Data['lgx_sec_height_tablet']          =  (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_sec_height_tablet'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_sec_height_tablet'] ): '450px');
            $savable_Data['lgx_sec_height_mobile']          =  (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_sec_height_mobile'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_sec_height_mobile'] ): '400px');

            //Margin
            $savable_Data['lgx_margin_top']                 = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_margin_top'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_margin_top'] ) : '0px');
            $savable_Data['lgx_margin_bottom']              = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_margin_bottom'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_margin_bottom'] ) : '0px');
            $savable_Data['lgx_margin_left']                = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_margin_left'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_margin_left'] ) : '0px');
            $savable_Data['lgx_margin_right']               = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_margin_right'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_margin_right'] ) : '0px');
       

            //Margin
            $savable_Data['lgx_padding_top']                 = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_padding_top'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_padding_top'] ) : '50px');
            $savable_Data['lgx_padding_bottom']              = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_padding_bottom'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_padding_bottom'] ) : '50px');
            $savable_Data['lgx_padding_left']                = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_padding_left'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_padding_left'] ) : '0px');
            $savable_Data['lgx_padding_right']               = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_padding_right'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_padding_right'] ) : '0px');
        
            // Preloader
            $savable_Data['lgx_preloader_en']               = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_preloader_en'])) ? 'yes' : 'no');
            $savable_Data['lgx_preloader_bg_color']         = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_preloader_bg_color'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_preloader_bg_color'])  : '#ffffff');
            $savable_Data['lgx_preloader_icon']             = (( isset($_POST['post_meta_lgx_parallax_generator']['lgx_preloader_icon'])) ? sanitize_text_field( $_POST['post_meta_lgx_parallax_generator']['lgx_preloader_icon'])  : '');
        


              //   echo '<pre>';  print_r($savable_Data); echo '</pre>'; wp_die();

                update_post_meta( $post_id, '_save_meta_lgx_parallax_generator', $savable_Data );
            }
        }
    }// End  Meta Save


    /**
     * @param array $classes
     * @return array|mixed
     */


    public function add_meta_box_css_class_for_lgx_parallax_generator($classes = array()) {

        $add_classes = array( 'lgx_logo_slider_meta_box_postbox', 'lgx_logo_slider_meta_box_postbox_free' , 'lgx_app_admin_meta_box_postbox',);

        foreach ( $add_classes as $class ) {
            if ( ! in_array( $class, $classes ) ) {
                $classes[] = sanitize_html_class( $class );
            }
        }

        return $classes;
    }



    public function add_new_column_head_for_lgx_parallax_generator($default_columns) {
        unset( $default_columns['date'] );

        $default_columns['title']            = __( 'Title',  $this->plugin_name);
        $default_columns['shortcode']        = __( 'Shortcode', $this->plugin_name );
        //   $default_columns['php_shortcode']    = __( 'Theme or Plugin Code', $this->plugin_name );
        $default_columns['date']             = __( 'Date', $this->plugin_name );

        return $default_columns;
    }

    public function define_admin_column_value_for_lgx_parallax_generator($column, $post_id) {
        if(!empty($post_id)) {
            switch ($column) {
                case 'shortcode':

                    echo sprintf( __( '<input type="text" class="lgx_logo_slider_list_copy_input"  readonly="readonly" value="[lgx_parallax id=&quot;%s&quot;]">.', $this->plugin_name ), esc_attr($post_id) );                  
                  
                    break;

                case 'php_shortcode':
                    
                    echo sprintf( __( '<input type="text" class="lgx_logo_slider_list_copy_input" style="width: 360px; text-align: center;" readonly="readonly" value="<?php echo do_shortcode( \'[lgx_parallax id=&quot;%s&quot;]\' ); ?>"', $this->plugin_name ), esc_attr($post_id) );                  
        
                    break;

                default:
                    break;
            }
        }
    }


}
