<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://logichunt.com
 * @since      1.0.0
 *
 * @package    Wp_Counter_Up
 * @subpackage Wp_Counter_Up/public/partials
 */

//if( (LGX_WCU_PLUGIN_BASE == 'wp-counter-up/wp-counter-up.php') && (LGX_WCU_PLUGIN_META_FIELD_PRO == 'enabled') ) {
//	die('<p style="color: red;">Please buy a pro version of this plugin.</p>');
//}


//echo '<pre>';print_r($lgx_generator_meta); echo '</pre>';
//wp_die($atts['id']);

$lgx_app_id                      = $atts['id'];
$lgx_parallax_post               = get_post( $lgx_app_id );

$thumb_url          = '';
if (has_post_thumbnail( $lgx_app_id )) {
    $thumb_url          = wp_get_attachment_image_src( get_post_thumbnail_id( $lgx_app_id), true );
    $thumb_url          = $thumb_url[0];
}


//Showcase Type
$lgx_meta_parallax_type          = $lgx_generator_meta['lgx_meta_parallax_type'];

//Basic
$lgx_section_width              = $lgx_generator_meta['lgx_section_width'];
$lgx_section_container          = $lgx_generator_meta['lgx_section_container'];
$lgx_section_bg_color_en        = $lgx_generator_meta['lgx_section_bg_color_en'];
$lgx_section_bg_color           = $lgx_generator_meta['lgx_section_bg_color'];
$lgx_justify_content            = $lgx_generator_meta['lgx_justify_content'];
$lgx_align_items               = $lgx_generator_meta['lgx_align_items'];

//CSS
$lgx_bg_img_attachment          = $lgx_generator_meta['lgx_bg_img_attachment'];
$lgx_bg_img_size_type           = $lgx_generator_meta['lgx_bg_img_size_type'];
$lgx_bg_img_size_custom         = $lgx_generator_meta['lgx_bg_img_size_custom'];
$lgx_bg_img_repeat_type         = $lgx_generator_meta['lgx_bg_img_repeat_type'];

//jQuery
$lgx_parallax_jquery_speed      = $lgx_generator_meta['lgx_parallax_jquery_speed'];

// Responsive
$lgx_sec_height_large_desktop   = $lgx_generator_meta['lgx_sec_height_large_desktop'];
$lgx_sec_height_desktop         = $lgx_generator_meta['lgx_sec_height_desktop'];
$lgx_sec_height_tablet          = $lgx_generator_meta['lgx_sec_height_tablet'];
$lgx_sec_height_tablet          = $lgx_generator_meta['lgx_sec_height_mobile'];

//Margin
$lgx_margin_top                 = $lgx_generator_meta['lgx_margin_top'];
$lgx_margin_bottom              = $lgx_generator_meta['lgx_margin_bottom'];
$lgx_margin_left                = $lgx_generator_meta['lgx_margin_left'];
$lgx_margin_right               = $lgx_generator_meta['lgx_margin_right'];


//Padding
$lgx_padding_top                 = $lgx_generator_meta['lgx_padding_top'];
$lgx_padding_bottom              = $lgx_generator_meta['lgx_padding_bottom'];
$lgx_padding_left                = $lgx_generator_meta['lgx_padding_left'];
$lgx_padding_right               = $lgx_generator_meta['lgx_padding_right'];

//Pre-loader
$lgx_preloader_en               = $lgx_generator_meta['lgx_preloader_en'];
$lgx_preloader_bg_color         = $lgx_generator_meta['lgx_preloader_bg_color'];
$lgx_preloader_icon             = $lgx_generator_meta['lgx_preloader_icon'];



/**
 *
 * Global Style Declaration
 *
 */

wp_enqueue_style('lgx_parallax_style');

$lgx_parallax_jquery_data= '';

if($lgx_meta_parallax_type == 'jquery') {   
    
    wp_enqueue_script('lgx_parallax_script2');
 
        
    $lgx_parallax_jquery_data = ((!empty($thumb_url)) ? 'data-jarallax data-speed="'. esc_attr($lgx_parallax_jquery_speed).' " style="background-image: url(\''. esc_url($thumb_url) .'\');"' : '' );
    
   // $lgx_parallax_jquery_data = ((!empty($thumb_url)) ? 'data-parallax="scroll" data-image-src="'.$thumb_url.'" data-speed="'.$lgx_parallax_jquery_speed.'"' : '' );
}

if($lgx_preloader_en == 'yes') {    

    wp_enqueue_script('lgx_parallax_wp_script');
}


if($lgx_meta_parallax_type == 'css') {
    include 'dynamic-style/css-style.php';
}

include 'dynamic-style/loader-pre-style.php';

include 'dynamic-style/general-style.php';

/**
 *
 * Plugin view
 *
 */

include 'template/view-default.php';


/**
 *  Load Dynamic Style 
 */



if( (LGX_WCU_PLUGIN_BASE == 'wp-counter-up-pro/wp-counter-up-pro.php') ) {   
    
    //include 'dynamic-style/pro-style-pro.php';
}
