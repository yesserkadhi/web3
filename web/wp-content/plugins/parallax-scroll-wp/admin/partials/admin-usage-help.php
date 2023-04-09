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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <div id="icon-options-general" class="icon32"></div>
    <h2><?php _e('Logo Slider WP: Usage & Help', 'logoslider-domain'); ?></h2>

    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-2">




            <!-- main content -->
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <?php

                    /*
                     * Add Header File
                     */
                    include_once plugin_dir_path( __FILE__ ) . '/shortcode_meta_display/__section_meta_header.php';

                    ?>
                    <div class="postbox">
                        <div class="inside lgx-settings-inside">

                            <h3 class="clear"><?php _e('Quick Usage Guidelines', 'parallax-scroll-wp'); ?></h3>
                            <h4 style="margin: 25px 0 15px 0;">Thanks for downloading and activating the plugin. It's extremely easy to configure and use. Just follow the below steps: </h4>
                            <ol>
                                <li><?php _e('To create a parallax section, please go to the "Add New"', 'parallax-scroll-wp'); ?></li>
                                <li><?php _e('Add your desired background and content here.', 'parallax-scroll-wp'); ?></li>
                                <li><?php _e('Now customize or find your appropriate settings from the setting section.', 'parallax-scroll-wp'); ?></li>                                
                                <li><?php _e('Please read the option description/ instruction carefully from the bottom of each option. ', 'parallax-scroll-wp'); ?></li>
                                <li><?php _e('Now use the shortcode on any post, page, widget, or theme to display the parallax section. ', 'parallax-scroll-wp'); ?></li>
                            </ol>                      
                    
                            <p style="margin-top:25px;">Read the details user manual from here: <a class="button button-primary" href="https://docs.logichunt.com/wp-parallax-scroll/" target="_blank">Documentation</a></p>

                            <br />
                            <br />
                            <hr>
                            <div style="margin-left: -5%;">
                                <?php

                                /*
                                 * Add Get Pro blocks
                                 */
                                include_once plugin_dir_path( __FILE__ ) . '/shortcode_meta_display/__section_meta_get_pro.php';

                                ?>
                            </div>
                            <hr>
                            <br />
                        </div> <!-- .inside -->
                    </div> <!-- .postbox -->
                </div> <!-- .meta-box-sortables .ui-sortable -->
            </div> <!-- post-body-content -->
            <?php
            include_once('sidebar.php');
            ?>

        </div> <!-- #post-body .metabox-holder .columns-2 -->

        <br class="clear">
    </div> <!-- #poststuff -->

</div> <!-- .wrap -->