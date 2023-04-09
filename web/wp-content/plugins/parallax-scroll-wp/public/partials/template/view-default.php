<div id="lgx_parallax_app_<?php echo esc_attr($lgx_app_id);?>" class="lgx_parallax_app">

    <?php   echo(('yes'==$lgx_preloader_en) ? '<div id="lgx_lsw_preloader_'.esc_attr($lgx_app_id).'"" class="lgx_lsw_preloader"> <img src="'.((!empty($lgx_preloader_icon)) ? esc_attr($lgx_preloader_icon) : esc_attr($lgx_lsw_loading_icon)).'" /></div>' : ''); ?>

    <div id="lgx_parallax_<?php echo esc_attr($lgx_app_id). rand ( 100, 999 );?>" 
        class="lgx_parallax <?php echo (($lgx_meta_parallax_type == 'jquery') ? 'jarallax' :''); ?>  lgx_parallax_free" <?php echo wp_kses_data($lgx_parallax_jquery_data); ?> >
        <div class="lgx_parallax_app_inner lgx_app_layout_<?php echo esc_attr($lgx_meta_parallax_type);?> ">
            <div class="lgx_parallax_app_<?php echo esc_attr($lgx_section_container);?>">  
                <div id="lgx_parallax_app_content_wrap_<?php echo esc_attr($lgx_app_id). rand ( 100, 999 );?>" 
                    class="lgx_parallax_app_content_wrapper" > 
                    
                    <?php echo do_shortcode( wp_kses_post($lgx_parallax_post->post_content) );?>
                    <?php  //echo do_shortcode( $lgx_parallax_post->post_content);?>

                </div> <!-- //.CONTENT WRAP END-->
            </div><!--//.APP CONTAINER END-->
        </div> <!--//.INNER END-->
    </div> <!-- APP CONTAINER END -->

</div> <!--//.APP END-->