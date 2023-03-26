<?php
/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://logichunt.com
 * @since      1.0.0
 *
 * @package    logosliderwpcarousel
 * @subpackage logosliderwpcarousel/admin/partials
 */
if (!defined('WPINC')) {
    die;
}

//print_r($post->ID);

wp_nonce_field( 'post_meta_lgx_parallax_generator', 'post_meta_lgx_parallax_generator[nonce]' );


if ( ! isset( $post->ID) ) {
    return;
}

$save_meta_lgx_parallax_generator = get_post_meta( $post->ID, '_save_meta_lgx_parallax_generator', true );

$lgx_meta_showcase_type = (isset($save_meta_lgx_parallax_generator['lgx_meta_parallax_type'] ) ? $save_meta_lgx_parallax_generator['lgx_meta_parallax_type'] : 'css') ;


?>

<div class="lgx_logo_slider_post_type_container ">
    <div class="lgx_logo_slider_card">


    <?php include_once plugin_dir_path( __FILE__ ) . '/__section_meta_header.php'; ?>
    

        <div class="lgx_logo_slider_card_body">

        <?php

            /*
            * Add Shortcode usage information
            */
            include plugin_dir_path( __FILE__ ) . '/__section_meta_help_block.php';

            ?>

            <div class="lgx_row">

                <div class="lgx_col_12">
                    <div class="lgx_logo_slider_info_box lgx_logo_slider_info_box_lead " style="padding: 0; margin-bottom: -9px;">
                        <div class="lgx_logo_slider_settings_box" >
                            <table class="form-table">
                                <tbody>
                                <tr>
                                    <th scope="row">
                                        <label for="showcase_type">Select Parallax Effect Type</label>
                                    </th>
                                    <td>
                                        <select name="post_meta_lgx_parallax_generator[lgx_meta_parallax_type]" id="lgx_meta_parallax_type" class="lgx_meta_showcase_type lgx_meta_parallax_type" style="width: 100%">
                                            <option data-logo-slider-layout="css" value="css" <?php echo ( $lgx_meta_showcase_type == 'css' ) ? 'selected="selected"' : '' ?>>CSS Effect</option>
                                            <option data-logo-slider-layout="jquery" value="jquery" <?php echo ( $lgx_meta_showcase_type == 'jquery' ) ? 'selected="selected"' : '' ?>>jQuery Effect</option>
                                        </select>
                                    </td>
                                    <td>

                                    <?php include_once plugin_dir_path( __FILE__ ) . '/__section_meta_get_pro.php';  ?>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- ./lgx_logo_slider_settings_box -->
                    </div><!-- ./lgx_logo_slider_info_box -->
                </div><!-- ./lgx_col_12 -->

            </div><!-- ./lgx_row -->


            <div class="lgx_row">

                <div class="lgx_col_12">
                    <div class="lgx_logo_slider_info_box">
                        <div class="lgx_logo_slider_settings_box">

                            <div class="lgx_logo_slider_tab_box_container">
                                <div class="lgx_logo_slider_nav_tab_wrapper">
                                
                                    <a class="lgx_logo_slider_nav_tab lgx_active" data-active-tab="lgx_tab_section"><i class="dashicons dashicons-editor-insertmore"></i> Section</a>
                                  
                                    <a class="lgx_logo_slider_nav_tab lgx_logo_slider_layout" data-active-tab="lgx_tab_layout" style="width: 100px;">
                                        <?php echo  ( ( $lgx_meta_showcase_type == 'css' ) ? '<i class="dashicons dashicons-images-alt2"></i> CSS' : '' ) ;?>
                                        <?php echo  ( ( $lgx_meta_showcase_type == 'jquery' ) ? '<i class="dashicons dashicons-images-alt"></i>  jQuery' : '' ) ;?>
                                    </a>
                                    <a class="lgx_logo_slider_nav_tab" data-active-tab="lgx_tab_responsive"><i class="dashicons dashicons-smartphone"></i> Responsive</a>
                                    <a class="lgx_logo_slider_nav_tab" data-active-tab="lgx_tab_margin"><i class="dashicons dashicons-editor-expand"></i> Margin</a>
                                    <a class="lgx_logo_slider_nav_tab" data-active-tab="lgx_tab_padding"><i class="dashicons dashicons-editor-contract"></i> Padding</a>
                                    <a class="lgx_logo_slider_nav_tab" data-active-tab="lgx_tab_preloader"><i class="dashicons dashicons-editor-expand"></i> Preloader</a>

                                </div><!-- ./lgx_logo_slider_nav_tab_wrapper -->

                                <div class="lgx_logo_slider_tab_content_wrapper">

                                <div class="lgx_logo_slider_tab_content lgx_active" data-tab-id="lgx_tab_section">
                                        <table class="form-table  lgx_form_table">
                                            <tbody> <?php require_once plugin_dir_path( __FILE__ ) . '/tabs/_meta_tab_basic.php';?> </tbody>
                                        </table>
                                    </div><!-- .//tab_content -->

                                    <div class="lgx_logo_slider_tab_content" data-tab-id="lgx_tab_layout">

                                   
                                        <div class="lgx_logo_slider_tab_inner lgx_logo_slider_tab_inner_layout_css" <?php echo  ( ( $lgx_meta_showcase_type == 'css' ) ? 'style="display: block"' : '' ) ;?> >
                                            <table class="form-table  lgx_form_table">
                                                <tbody><?php require_once plugin_dir_path( __FILE__ ) . '/tabs/_meta_tab_css.php' ?></tbody>
                                            </table>

                                        </div><!--//.CSS  -->


                                        <div class="lgx_logo_slider_tab_inner lgx_logo_slider_tab_inner_layout_jquery" <?php echo  ( ( $lgx_meta_showcase_type == 'jquery' ) ? 'style="display: block"' : '' ) ;?> >
                                            <table class="form-table  lgx_form_table">
                                                <tbody><?php require_once plugin_dir_path( __FILE__ ) . '/tabs/_meta_tab_jquery.php' ?></tbody>
                                            </table>

                                        </div><!--//.jQuery  -->


                                    </div><!-- .//tab_content: Dynamic -->



                                    <div class="lgx_logo_slider_tab_content" data-tab-id="lgx_tab_responsive">
                                        <table class="form-table  lgx_form_table">
                                            <tbody>
                                            <?php

                                            /*
                                             * Add Responsive Settings
                                             */
                                            require_once plugin_dir_path( __FILE__ ) . '/tabs/_meta_tab_responsive.php';
                                            ?>
                                            </tbody>
                                        </table>
                                    </div><!-- ./lgx_logo_slider_tab_content -->



                               <div class="lgx_logo_slider_tab_content" data-tab-id="lgx_tab_margin">
                                        <table class="form-table  lgx_form_table">
                                            <tbody>
                                            <?php require_once plugin_dir_path( __FILE__ ) . '/tabs/_meta_tab_margin.php';?>
                                            </tbody>
                                        </table>
                                    </div><!-- ./lgx_logo_slider_tab_content -->


                                    <div class="lgx_logo_slider_tab_content" data-tab-id="lgx_tab_padding">
                                        <table class="form-table  lgx_form_table">
                                            <tbody>
                                            <?php require_once plugin_dir_path( __FILE__ ) . '/tabs/_meta_tab_padding.php';?>
                                            </tbody>
                                        </table>
                                    </div><!-- ./lgx_logo_slider_tab_content -->


                                    <div class="lgx_logo_slider_tab_content" data-tab-id="lgx_tab_preloader">
                                        <table class="form-table  lgx_form_table">
                                            <tbody> <?php   require_once plugin_dir_path( __FILE__ ) . '/tabs/_meta_tab_preloader.php'; ?> </tbody>
                                        </table>
                                    </div><!-- .//tab_content -->


                                </div><!-- ./lgx_logo_slider_tab_content_wrapper -->
                            </div><!-- ./lgx_logo_slider_tab_box_container -->
                        </div><!-- ./lgx_logo_slider_settings_box -->
                    </div><!-- ./lgx_logo_slider_info_box -->
                </div><!-- ./lgx_col_12 -->

            </div><!-- ./lgx_row -->


            <?php

            /*
             * Add Shortcode usage information
             */
        //   include plugin_dir_path( __FILE__ ) . '/__section_meta_help_block.php';

            ?>
        </div><!--//.lgx_logo_slider_card_body-->

    </div><!--// lgx_logo_slider_card-->
</div><!--// lgx_logo_slider_post_type_container-->

