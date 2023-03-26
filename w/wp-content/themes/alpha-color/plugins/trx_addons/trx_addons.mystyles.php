<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('alpha_color_trx_addons_get_mycss')) {
    add_filter('alpha_color_filter_get_css', 'alpha_color_trx_addons_get_mycss', 10, 4);
    function alpha_color_trx_addons_get_mycss($css, $colors, $fonts, $scheme = '')
    {

        if (isset($css['fonts']) && $fonts) {
            $css['fonts'] .= <<<CSS
            .gyges .tp-tab-date,
            .gyges .tp-tab-title,
            .sc_team_short .sc_team_item_title,
            .format-audio .post_featured .post_audio_title,
            .trx_addons_audio_player .audio_caption,
            blockquote > a, blockquote > p > a,
            blockquote > cite, blockquote > p > cite,
            body .mejs-container * {
                {$fonts['p_font-family']}
            }
            .sc_testimonials_item_content,
            .sc_services_light .sc_services_item_title,
            .sc_item_subtitle,
            .sc_price_item_price_value em,
            .sc_skills_pie.sc_skills_compact_off .sc_skills_total,
            .sc_edd_details .downloads_page_tags .downloads_page_data > a, .widget_product_tag_cloud a, .widget_tag_cloud a,
            .widget_calendar caption,
            blockquote p,
            blockquote:before,
            .trx_addons_dropcap,
            h6.elementor-size-medium {
                {$fonts['h1_font-family']}
            }

CSS;
        }

        if (isset($css['colors']) && $colors) {
            $css['colors'] .= <<<CSS
            
            /* Inline colors */
            .trx_addons_accent,
            .trx_addons_accent_big,
            .trx_addons_accent > a,
            .trx_addons_accent > * {
                color: {$colors['text_dark']};
            }
            .trx_addons_accent_hovered {
                color: {$colors['text_hover']};
            }
            .trx_addons_accent_bg {
                background-color: {$colors['text_link']};
                color: {$colors['text_dark']};
            }

            
            /* Tooltip */
            .trx_addons_tooltip {
                color: {$colors['text_dark']};
                border-color: {$colors['text_dark']};
            }
            .trx_addons_tooltip:before {
                background-color: {$colors['text_link2']};
                color: {$colors['inverse_link']};
            }
            .trx_addons_tooltip:after {
                border-top-color: {$colors['text_link2']};
            }
            
            
            /* Dropcaps */
            .trx_addons_dropcap_style_1 {
                background: {$colors['text_hover']};
                color: {$colors['inverse_link']};
            }
            .trx_addons_dropcap_style_2 {
                background: {$colors['text_link']};
                color: {$colors['text_dark']};
            }
            
            
            /* Blockqoute */
            blockquote {
                color: {$colors['inverse_link_08']};
            }
            blockquote > a, blockquote > p > a,
            blockquote > cite, blockquote > p > cite {
                color: {$colors['inverse_link']};
            }
            blockquote > a, blockquote > p > a:hover {
                color: {$colors['inverse_link_08']};
            }
            
            /* Images */
            figure figcaption,
            .wp-caption .wp-caption-text,
            .wp-caption .wp-caption-dd,
            .wp-caption-overlay .wp-caption .wp-caption-text,
            .wp-caption-overlay .wp-caption .wp-caption-dd {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_hover_085']};
            }
            
            
            /* Lists */
            ul[class*="trx_addons_list_custom"] > li:before,
            ul[class*="trx_addons_list"] > li:before{
                color: {$colors['text_hover']};
            }
            ul[class*="trx_addons_list_dot"] > li:before {
                color: {$colors['text_link2']};
            }

            /* Main menu */
            .sc_layouts_menu_nav>li>a {
                color: {$colors['text_dark']} !important;
            }
            .sc_layouts_menu_nav>li>a:hover,
            .sc_layouts_menu_nav>li.sfHover>a,
            .sc_layouts_menu_nav>li.current-menu-item>a,
            .sc_layouts_menu_nav>li.current-menu-parent>a,
            .sc_layouts_menu_nav>li.current-menu-ancestor>a {
                color: {$colors['text_hover']} !important;
            }
            
            /* Dropdown menu */
            .sc_layouts_menu_nav>li ul {
                background-color: {$colors['input_dark']};
                border-bottom-color: {$colors['text_link']} !important;
            }
            header .sc_layouts_menu li > ul.sc_layouts_submenu .wpb_wrapper ul li a,
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a,
            .sc_layouts_menu_nav>li li>a {
                color: {$colors['inverse_link']} !important;
            }
            header .sc_layouts_menu li > ul.sc_layouts_submenu .wpb_wrapper ul li a:hover,
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a:hover,
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li.sfHover>a,
            .sc_layouts_menu_nav>li li>a:hover,
            .sc_layouts_menu_nav>li li.sfHover>a,
            .sc_layouts_menu_nav>li li.current-menu-item>a,
            .sc_layouts_menu_nav>li li.current-menu-parent>a,
            .sc_layouts_menu_nav>li li.current-menu-ancestor>a {
                color: {$colors['text_hover']} !important;
                background-color: {$colors['bg_color_0']};
            }
            
            
            /* Breadcrumbs */
            .sc_layouts_title_caption {
                color: {$colors['text_dark']};
            }
            .sc_layouts_title_breadcrumbs a {
                color: {$colors['text_dark']} !important;
            }
            .breadcrumbs_item.current{
                color: {$colors['text_dark']} !important;
            }
            .sc_layouts_title_breadcrumbs a:hover {
                color: {$colors['text_link']} !important;
            }
            
            /* Slider */
            .sc_slider_controls .slider_controls_wrap > a,
            .slider_container.slider_controls_side .slider_controls_wrap > a,
            .slider_outer_controls_side .slider_controls_wrap > a {
                color: {$colors['text_dark']};
                background-color: {$colors['alter_bg_color']};
            }
            .sc_slider_controls .slider_controls_wrap > a:hover,
            .slider_container.slider_controls_side .slider_controls_wrap > a:hover,
            .slider_outer_controls_side .slider_controls_wrap > a:hover {
                 color: {$colors['inverse_link']};
                background-color: {$colors['text_dark']};
            }
            
            /* Price */
            
            .sc_price .trx_addons_columns_wrap > div:last-child .sc_price_item,
            .sc_price_item {
                color: {$colors['text']};
                background-color: {$colors['bg_color']};
                border-color: {$colors['bd_color']};
            }
            
            /*Elementor price columns*/
            .sc_price>.elementor-container>.elementor-row>.elementor-column>.elementor-column-wrap,
            .sc_price>.elementor-container>.elementor-row>.elementor-column:last-child>.elementor-column-wrap {
                 color: {$colors['text']};
                background-color: {$colors['input_bg_color']};
                border-color: {$colors['bd_color']};
            }
            
            .sc_price_item:hover {
                color: {$colors['text']};
                background-color: {$colors['bg_color']};
                border-color: {$colors['bd_color']};
            }
            .sc_price_item .sc_price_item_icon {
                color: {$colors['text_link']};
            }
            .sc_price_item:hover .sc_price_item_icon {
                color: {$colors['text_hover']};
            }
            .sc_price_item .sc_price_item_label {
                background-color: {$colors['text_link']};
                color: {$colors['inverse_link']};
            }
            .sc_price_item:hover .sc_price_item_label {
                background-color: {$colors['text_link']};
                color: {$colors['inverse_link']};
            }
            .sc_price_item .sc_price_item_subtitle {
                color: {$colors['text_dark']};
            }
            .sc_price_item .sc_price_item_title,
            .sc_price_item .sc_price_item_title a {
                color: {$colors['text_dark']};
            }
            .sc_price_item:hover .sc_price_item_title,
            .sc_price_item:hover .sc_price_item_title a {
                color: {$colors['text_dark']};
            }
            
            .sc_price .elementor-column h2.elementor-heading-title,
            .sc_price span.elementor-heading-title,
            .sc_price_item .sc_price_item_price {
                color: {$colors['text_hover']};
            }
            .trx_addons_woocommerce_search_form_field_label,
            .sc_price_item .sc_price_item_description,
            .sc_price_item .sc_price_item_details {
                color: {$colors['text']};
            }
            .sc_price .elementor-column .elementor-widget-divider,
            .price-header:after {
                background: {$colors['text_hover']};
            }

            .elementor-element .elementor-button-wrapper .elementor-button,
            .sc_price .trx_addons_columns_wrap > div:nth-child(3n+2) .sc_price_item .sc_price_item_link,
            .sc_price .trx_addons_columns_wrap > div:nth-child(3n+1) .sc_price_item .sc_price_item_link {
                color: {$colors['inverse_link']};
            }
            .elementor-element.sc_price .elementor-column .elementor-element .elementor-button-wrapper .elementor-button:hover,
            .sc_price .trx_addons_columns_wrap > div:nth-child(3n+1) .sc_price_item .sc_price_item_link:hover {
                color: {$colors['text_dark']} !important;
            }
            .sc_price .elementor-column:nth-child(2) .elementor-widget-divider,
            .sc_price .trx_addons_columns_wrap > div:nth-child(3n+2) .sc_price_item .price-header:after {
                background: {$colors['text_link2']};
            }
             .sc_price .elementor-column:nth-child(3) .elementor-widget-divider,
            .sc_price .trx_addons_columns_wrap > div:nth-child(3n+3) .sc_price_item .price-header:after {
                background: {$colors['text_link']};
            }
            .sc_price .elementor-column:nth-child(3n+2) h2.elementor-heading-title, .sc_price .elementor-column:nth-child(3n+2) span.elementor-heading-title,
            .sc_price .trx_addons_columns_wrap > div:nth-child(3n+2) .sc_price_item .sc_price_item_price {
                color: {$colors['text_link2']};
            }
            .sc_price .elementor-column:nth-child(3n+3) h2.elementor-heading-title, .sc_price .elementor-column:nth-child(3n+3) span.elementor-heading-title,
            .sc_price .trx_addons_columns_wrap > div:nth-child(3n+3) .sc_price_item .sc_price_item_price {
                color: {$colors['text_dark']};
            }
            .author_info:after,
            .sc_content_bordered:after {
            	background: linear-gradient(to bottom, {$colors['text_link2']} 0%,{$colors['text_link2']} 33.33%,{$colors['text_link']} 33.33%,{$colors['text_link']} 66.66%,{$colors['text_hover']} 66.66%, {$colors['text_hover']} 100%);

            }
            
            /* Layouts */
            .sc_layouts_logo .logo_text {
                color: {$colors['text_dark']};
            }
           
            .trx_addons_scroll_to_top {
                color: {$colors['text_dark']};
            }
            .sc_layouts_row_type_normal .sc_layouts_item a:hover .sc_layouts_item_icon,
            .sc_layouts_item_icon,
            .sc_layouts_item_details_line1 {
                color: {$colors['text_hover']};
            }
            .sc_layouts_row_type_normal .sc_layouts_item a:hover .sc_layouts_item_details_line2 {
                color: {$colors['text_hover']};
            }
            .sc_layouts_row_type_normal .sc_layouts_column .search_style_fullscreen:not(.search_opened) .search_submit {
                background: {$colors['input_dark']};
            }
            .sc_layouts_row_type_normal .sc_layouts_column .search_style_fullscreen:not(.search_opened) .search_submit:hover {
                background: {$colors['text_hover']};
            }
            .sc_layouts_row_type_normal .sc_layouts_column .search_style_fullscreen:not(.search_opened) .search_submit:before {
                color: {$colors['inverse_link']};
            }
             .elementor-element .elementor-counter .elementor-counter-number-wrapper {
                 color: {$colors['text_dark']};
             }
            .sc_skills_pie.sc_skills_compact_off .sc_skills_total {
                color: {$colors['text_dark']};
            }
            .sc_skills_pie.sc_skills_compact_off .sc_skills_item_title {
                color: {$colors['text']};
            }
            .format-video .post_featured.with_thumb .mask,
            .trx_addons_video_player.with_cover .video_mask {
                background: linear-gradient(to top, {$colors['text_dark_07']} 0%, {$colors['bg_color_0']} 50%, {$colors['bg_color_0']} 100%);
            }

            /* Audio */
            .format-audio .post_featured.without_thumb .post_audio {
                background: {$colors['input_bg_color']};
            }
            .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
            .mejs-controls .mejs-time-rail .mejs-time-current {
                background: {$colors['text_hover']};
            }
            .mejs-controls .mejs-time *,
            .mejs-controls .mejs-button {
                background: {$colors['bg_color_0']};
                color: {$colors['text_hover']};
            }
            .mejs-controls .mejs-button:hover {
                background: {$colors['bg_color_0']};
                color: {$colors['text_dark']};
            }
            .trx_addons_audio_player .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total:before, .trx_addons_audio_player .mejs-controls .mejs-time-rail .mejs-time-total:before,
            .mejs-controls .mejs-time-rail .mejs-time-total,
            .mejs-controls .mejs-time-rail .mejs-time-loaded,
            .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
                background: {$colors['bd_color']};
            }
            .without_thumb .mejs-controls .mejs-currenttime,
            .without_thumb .mejs-controls .mejs-duration,
            .trx_addons_audio_player.without_cover .audio_author,
            .format-audio .post_featured .post_audio_author,
            .trx_addons_audio_player .mejs-container .mejs-controls .mejs-time {
                color: {$colors['text']};
            }
            .trx_addons_label_text {
                color: {$colors['text_dark']};
            }
            .sc_content_bordered a {
                color: {$colors['text_hover']};
            }
            .sc_content_bordered a:hover {
                color: {$colors['text_dark']};
            }
            .post_item_single.post_type_post.post_format_audio .mejs-controls .mejs-button:hover {
                color: {$colors['inverse_link']};
            }
            
            .post_item_single .post_content .post_share .socials_wrap .social_item:nth-child(4n+1) .social_icon {
                    color: {$colors['text_hover']};
            }
            .post_item_single .post_content .post_share .socials_wrap .social_item:nth-child(4n+2) .social_icon {
                    color: {$colors['text_link2']};
            }
            .post_item_single .post_content .post_share .socials_wrap .social_item:nth-child(4n+3) .social_icon {
                    color: {$colors['text_link']};
            }
            .post_item_single .post_content .post_share .socials_wrap .social_item:nth-child(4n+4) .social_icon {
                    color: {$colors['text_dark']};
            }
            .post_item_single .post_content .post_share .socials_wrap .social_item:hover .social_icon {
                color: {$colors['text']} !important;
            }
            .comments_list_wrap .comment_info {
                    color: {$colors['text_light']};
            }
            .comment_author {
                color: {$colors['text_hover']};
            }
            .comments_list_wrap .comment_author:after {
                color: {$colors['text_light']};
            }
            .trx_addons_woocommerce_search_form_text,
            .sc_item_subtitle,
             h6.elementor-size-medium {
                color: {$colors['text_hover']};
            }
            .sc_services_light .sc_services_item_title a:hover {
                color: {$colors['text_hover']};
            }
            .single-cpt_services ul[class*="trx_addons_list_dot"]>li:before {
                color: {$colors['text_hover']};
            }
            #rev_slider_3_2_wrapper .gyges .tp-tab {
                background-color: {$colors['input_dark_03']};
            }
            #rev_slider_3_2_wrapper .gyges .tp-tab:hover, #rev_slider_3_2_wrapper .gyges .tp-tab.selected {
               background-color: {$colors['input_dark_09']};
            }
            .sc_team_short .sc_team_item_title a {
                color: {$colors['text']};
            }
            .sc_team_short .sc_team_item_title a:hover {
                color: {$colors['text_dark']};
            }
            .sc_team_short .sc_team_item_subtitle {
                color: {$colors['text_hover']};
            }
            .sc_team_short .sc_team_columns_wrap > div:nth-child(3n+2) .sc_team_item_subtitle {
                color: {$colors['text_link2']};
            }
            .sc_team_short .sc_team_columns_wrap > div:nth-child(3n+3) .sc_team_item_subtitle {
                color: {$colors['text_dark']};
            }
            .sc_team_short .sc_team_item_thumb {
                border-color: {$colors['text_hover']};
            }
            .sc_team_short .sc_team_columns_wrap > div:nth-child(3n+2) .sc_team_item_thumb {
                border-color: {$colors['text_link2']};
            }
            .sc_team_short .sc_team_columns_wrap > div:nth-child(3n+3) .sc_team_item_thumb {
                border-color: {$colors['text_link']};
            }
            .sc_team_short .trx_addons_hover_mask {
                background-color: {$colors['bg_color_07']};
            }
            .scheme_dark .sc_item_subtitle {
                color: {$colors['text_link']};
            }  
                     
            .scheme_alter-dark .sc_testimonials_item_content{
                color:{$colors['bg_color_08']};
            }
            .scheme_dark .sc_testimonials_item_content {
                color: {$colors['bg_color_04']};
            }
            .sc_testimonials_item_author_title {
                color: {$colors['text_dark']};
            }
            .slider_container.slider_controls_top .slider_controls_wrap > a,
            .slider_container.slider_controls_bottom .slider_controls_wrap > a,
            .slider_outer_controls_top .slider_controls_wrap > a,
            .slider_outer_controls_bottom .slider_controls_wrap > a {
                color: {$colors['inverse_dark']};
                background-color: {$colors['text_link']};
                border-color: {$colors['text_link']};
            }
            .slider_container.slider_controls_top .slider_controls_wrap > a:hover,
            .slider_container.slider_controls_bottom .slider_controls_wrap > a:hover,
            .slider_outer_controls_top .slider_controls_wrap > a:hover,
            .slider_outer_controls_bottom .slider_controls_wrap > a:hover {
                color: {$colors['inverse_link']};
                border-color: {$colors['text_hover']};
                background-color: {$colors['text_hover']};
            }
            
            .custom_bg_pagination .slider_outer_controls_bottom .slider_controls_wrap > a{
                color: {$colors['inverse_link']};
                border-color: {$colors['text_hover']};
                background-color: {$colors['text_hover']};
            }
            .custom_bg_pagination .slider_outer_controls_bottom .slider_controls_wrap > a:hover{
                color: {$colors['inverse_link']};
                border-color: {$colors['text_hover3']};
                background-color: {$colors['text_hover3']};
            }
            .sc_content_tbordered:after{
                background: linear-gradient(to right, {$colors['text_hover']} 0%,{$colors['text_hover']} 17%,{$colors['text_dark']} 17%,{$colors['text_dark']} 34%,{$colors['text_link2']} 34%, {$colors['text_link2']} 50.5%, {$colors['text_link']} 50.5%,{$colors['text_link']} 67%,{$colors['text_hover']} 67%,{$colors['text_hover']} 83.5%,{$colors['text_link2']} 83.5%, {$colors['text_link2']} 100%);
            }
            .bullet-bar .tp-bullet:hover, .bullet-bar .tp-bullet.selected {
                background-color: {$colors['bg_color_07']};
            }
            .bullet-bar .tp-bullet {
                background-color: {$colors['bg_color_03']};
            }
            .sc_services_default .sc_services_item {
                background-color: {$colors['bg_color']};
            }
            .sc_services_default .sc_services_item:hover {
                background-color: {$colors['input_bg_color']};
            }
            .sc_services_default .sc_services_columns_wrap > div + div{ 
                border-color: {$colors['input_bg_color']};
            }
            .sc_services_default .sc_services_columns_wrap > div:nth-child(6n+1) .sc_services_item:after {
                background-color: {$colors['text_hover']};
            } 
            .sc_services_default .sc_services_columns_wrap > div:nth-child(6n+2) .sc_services_item:after {
                background-color: {$colors['text_dark']};
            } 
            .sc_services_default .sc_services_columns_wrap > div:nth-child(6n+3) .sc_services_item:after {
                background-color: {$colors['text_link2']};
            } 
            .sc_services_default .sc_services_columns_wrap > div:nth-child(6n+4) .sc_services_item:after {
                background-color: {$colors['text_link']};
            } 
            .sc_services_default .sc_services_columns_wrap > div:nth-child(6n+5) .sc_services_item:after {
                background-color: {$colors['text_hover']};
            } 
            .sc_services_default .sc_services_columns_wrap > div:nth-child(6n+6) .sc_services_item:after {
                background-color: {$colors['text_link2']};
            } 
            .sc_button.sc_button_size_large.sc_button_simple:not(.sc_button_bg_image) {
                color: {$colors['text_dark']};
            }
            .sc_button.sc_button_size_large.sc_button_simple:not(.sc_button_bg_image) {
                color: {$colors['text_dark']};
            }
            .sc_button.sc_button_size_large.sc_button_simple:not(.sc_button_bg_image):hover {
                color: {$colors['text_hover']} !important;
            }
            .scheme_alter-dark .sc_layouts_item_icon,
            .scheme_dark .sc_layouts_item_icon {
                color: {$colors['inverse_link']};
            }
            .scheme_dark .logo_slogan {
                color: {$colors['inverse_link']};
            }
            
            .scheme_alter .scheme_dark .logo_slogan {
                color:  {$colors['text_dark']};
            }

           .menu_mobile .search_mobile .search_field {
                border-color: {$colors['bg_color_04']};
           }
           .team_member_page .team_member_socials .social_item {
            color: {$colors['inverse_link']};
           }
           .team_member_page .team_member_socials .social_item:hover {
            color: {$colors['inverse_link']};
           }
           body.scheme_alter .footer_wrap:after{
             background: linear-gradient(to right, {$colors['text_link']} 0%,{$colors['text_link']} 17%,{$colors['text_hover']} 17%,{$colors['text_hover']} 34%,{$colors['text_link2']} 34%, {$colors['text_link2']} 50.5%, {$colors['text_link']} 50.5%,{$colors['text_link']} 67%,{$colors['text_hover']} 67%,{$colors['text_hover']} 83.5%,{$colors['text_link2']} 83.5%, {$colors['text_link2']} 100%);
           }
           .sc_button_simple.sc_button_with_icon.color_style_dark:not(.sc_button_bg_image):hover{
              color: {$colors['text_link2']}!important;
           }
           .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper .wp-block-search__input,
           .wp-block-search.wp-block-search__button-outside .wp-block-search__inside-wrapper .wp-block-search__input{
                border-color: {$colors['input_bd_color']};
           }


CSS;
        }

        return $css;
    }
}
?>