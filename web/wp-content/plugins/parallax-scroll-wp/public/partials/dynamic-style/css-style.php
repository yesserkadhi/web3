<?php
if (!defined('WPINC')) {
    die;
}


//Style Settings

$lgx_style_css= '';

$lgx_style_css .= '#lgx_parallax_app_'. esc_attr($lgx_app_id).' .lgx_parallax{
                  background: url('.esc_url($thumb_url).') '.esc_attr($lgx_bg_img_repeat_type).' center top;
                  }';

$lgx_style_css .= '#lgx_parallax_app_'. esc_attr($lgx_app_id).' .lgx_parallax {
        background-attachment: '. esc_attr($lgx_bg_img_attachment).';
        background-size: '. (($lgx_bg_img_size_type == 'custom') ? esc_attr($lgx_bg_img_size_custom) : esc_attr($lgx_bg_img_size_type)).';
    }';

/**
 *  Inline Style
 */

wp_add_inline_style( 'lgx_parallax_style', $lgx_style_css );