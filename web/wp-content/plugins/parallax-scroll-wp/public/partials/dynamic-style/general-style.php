<?php
if (!defined('WPINC')) {
    die;
}


//Style Settings

$lgx_style_general = '';

$lgx_style_general .= '#lgx_parallax_app_'. $lgx_app_id.' .lgx_parallax {
          width:'.$lgx_section_width.';
    }';

$lgx_style_general .= ' #lgx_parallax_app_'. $lgx_app_id.' .lgx_parallax_app_inner {
    '. (('yes' == $lgx_section_bg_color_en) ? 'background-color: '.$lgx_section_bg_color.';' : '').'
    }';


    
$lgx_style_general .= ' #lgx_parallax_app_'. $lgx_app_id.' .lgx_parallax_app_content_wrapper {
        align-items: '.$lgx_align_items.'; 
        justify-content: '.$lgx_justify_content.';
    }';


        
$lgx_style_general .= ' #lgx_parallax_app_'. $lgx_app_id.' .lgx_parallax{
    margin-top: '.$lgx_margin_top.'; 
    margin-bottom: '.$lgx_margin_bottom.'; 
    margin-left: '.$lgx_margin_left.'; 
    margin-right: '.$lgx_margin_right.'; 
  
}';

        
$lgx_style_general .= ' #lgx_parallax_app_'. $lgx_app_id.' .lgx_parallax_app_inner {
    padding-top: '.$lgx_padding_top.'; 
    padding-bottom: '.$lgx_padding_bottom.'; 
    padding-left: '.$lgx_padding_left.'; 
    padding-right: '.$lgx_padding_right.'; 
  
}';

    $lgx_style_general .= '@media (max-width: 767px) {
        #lgx_parallax_app_'. $lgx_app_id.' .lgx_parallax_app_content_wrapper{
            min-height: '.$lgx_sec_height_tablet.';
        }
    }';
$lgx_style_general .= '@media (min-width: 768px) {
        #lgx_parallax_app_'. $lgx_app_id.' .lgx_parallax_app_content_wrapper{
            min-height: '.$lgx_sec_height_tablet.';
        }
    }';
$lgx_style_general .= '@media (min-width: 992px) {
        #lgx_parallax_app_'. $lgx_app_id.' .lgx_parallax_app_content_wrapper{
            min-height: '.$lgx_sec_height_desktop.';
        }
    }';
$lgx_style_general .= '@media (min-width: 1200px) {
        #lgx_parallax_app_'. $lgx_app_id.' .lgx_parallax_app_content_wrapper{
            min-height: '.$lgx_sec_height_large_desktop.';
        }
    }';




/**
 *  Inline Style
 */

wp_add_inline_style( 'lgx_parallax_style', $lgx_style_general );