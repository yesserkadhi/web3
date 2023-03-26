<?php
/* Elementor Builder support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('alpha_color_elm_theme_setup9')) {
    add_action('after_setup_theme', 'alpha_color_elm_theme_setup9', 9);

    function alpha_color_elm_theme_setup9()
    {


        if (alpha_color_exists_elementor()) {
            add_action( 'wp_enqueue_scripts', 'alpha_color_elm_frontend_scripts', 1100 );
            add_action( 'wp_enqueue_scripts', 'alpha_color_elm_responsive_styles', 2000 );

            add_action( 'init', 'alpha_color_elm_init_once', 3 );

            add_filter('alpha_color_filter_merge_styles', 'alpha_color_elm_merge_styles');
            add_filter( 'alpha_color_filter_merge_styles_responsive', 'alpha_color_elm_merge_styles_responsive' );

            add_action('elementor/editor/before_enqueue_scripts', 'alpha_color_elm_editor_scripts');
            add_action( 'elementor/element/before_section_end', 'alpha_color_elm_add_color_scheme_control', 10, 3 );


        }

        if (is_admin()) {
            add_filter('alpha_color_filter_tgmpa_required_plugins', 'alpha_color_elm_tgmpa_required_plugins');

        }
    }
}


// Filter to add in the required plugins list
if (!function_exists('alpha_color_elm_tgmpa_required_plugins')) {

    function alpha_color_elm_tgmpa_required_plugins($list = array())
    {
        if (alpha_color_storage_isset('required_plugins', 'elementor') && alpha_color_storage_get_array('required_plugins', 'elementor', 'install') !== false) {
            $list[] = array(
                'name' => alpha_color_storage_get_array('required_plugins', 'elementor'),
                'slug' => 'elementor',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if Elementor is installed and activated
if (!function_exists('alpha_color_exists_elementor')) {
    function alpha_color_exists_elementor()
    {
        return class_exists('Elementor\Plugin');
    }
}


// Merge custom styles
if (!function_exists('alpha_color_elm_merge_styles')) {
    function alpha_color_elm_merge_styles($list)
    {
        $list[] = 'plugins/elementor/elementor.css';
        return $list;
    }
}

// Enqueue styles for frontend
if ( ! function_exists( 'alpha_color_elm_frontend_scripts' ) ) {

    function alpha_color_elm_frontend_scripts() {
        $alpha_color_url = alpha_color_get_file_url( 'plugins/elementor/elementor.css' );
        if ( '' != $alpha_color_url ) {
            wp_enqueue_style( 'alpha-color-elementor', $alpha_color_url, array(), null );
        }
    }
}

// Enqueue responsive styles for frontend
if ( ! function_exists( 'alpha_color_elm_responsive_styles' ) ) {

    function alpha_color_elm_responsive_styles() {
        $alpha_color_url = alpha_color_get_file_url( 'plugins/elementor/elementor-responsive.css' );
        if ( '' != $alpha_color_url ) {
            wp_enqueue_style( 'alpha-color-elementor-responsive', $alpha_color_url, array(), null );
        }
    }
}

// Load required styles and scripts for Elementor Editor mode
if (!function_exists('alpha_color_elm_editor_scripts')) {
    function alpha_color_elm_editor_scripts()    {
        // Load font icons
        wp_enqueue_style('fontello-icons', alpha_color_get_file_url('css/font-icons/css/fontello.css'), array(), null);
        if (alpha_color_is_on(alpha_color_get_theme_option('debug_mode')) && alpha_color_get_file_dir('plugins/elementor/elementor.css') != '')
        wp_enqueue_style('alpha-color-elementor', alpha_color_get_file_url('plugins/elementor/elementor.css'), array(), null);
    }
}

// Add theme-specific controls to sections and columns
if ( !function_exists( 'alpha_color_elm_add_color_scheme_control' ) ) {

    function alpha_color_elm_add_color_scheme_control( $element, $section_id, $args ) {
        if ( is_object( $element ) ) {
            $el_name = $element->get_name();
            // Add color scheme selector
            if ( apply_filters(
                'alpha_color_filter_add_scheme_in_elements',
                ( in_array( $el_name, array( 'section', 'column' ) ) && 'section_advanced' === $section_id )
                || ( 'common' === $el_name && '_section_style' === $section_id ),
                $element, $section_id, $args
            ) ) {
                $element->add_control(
                    'scheme_heading', array(
                        'label' => esc_html__( 'Theme-specific params', 'alpha-color' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                    )
                );
                $element->add_control(
                    'scheme', array(
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'label'        => esc_html__( 'Color scheme', 'alpha-color' ),
                        'label_block'  => false,
                        'options'      => alpha_color_array_merge( array( '' => esc_html__( 'Inherit', 'alpha-color' ) ), alpha_color_get_list_schemes() ),
                        'default'      => '',
                        'prefix_class' => 'scheme_',
                    )
                );
            }
        }
    }
}

// Set Elementor's options at once
if ( ! function_exists( 'alpha_color_elm_init_once' ) ) {

    function alpha_color_elm_init_once() {
        if ( alpha_color_exists_elementor() && ! get_option( 'alpha_color_setup_elementor_options', false ) ) {
            // Set theme-specific values to the Elementor's options
            // Disable DOM optimization for Elementor 3.0+
            update_option( 'elementor_optimized_dom_output', 'disabled' );
            update_option( 'elementor_disable_color_schemes', 'yes' );
            update_option( 'elementor_disable_typography_schemes', 'yes' );
            update_option( 'elementor_space_between_widgets', 0 );
            update_option( 'elementor_stretched_section_container', '.page_wrap' );
            update_option( 'elementor_page_title_selector', '.sc_layouts_title_caption' );
            // Set flag to prevent change Elementor's options again
            update_option( 'alpha_color_setup_elementor_options', 1 );
        }
    }
}
?>
