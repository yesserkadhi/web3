<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.06
 */

$alpha_color_header_css = $alpha_color_header_image = '';
$alpha_color_header_video = alpha_color_get_header_video();
if (true || empty($alpha_color_header_video)) {
	$alpha_color_header_image = get_header_image();
	if (alpha_color_trx_addons_featured_image_override()) $alpha_color_header_image = alpha_color_get_current_mode_image($alpha_color_header_image);
}

$alpha_color_header_id = str_replace('header-custom-', '', alpha_color_get_theme_option("header_style"));
if ((int) $alpha_color_header_id == 0) {
	$alpha_color_header_id = alpha_color_get_post_id(array(
												'name' => $alpha_color_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$alpha_color_header_id = apply_filters('alpha_color_filter_get_translated_layout', $alpha_color_header_id);
}
$alpha_color_header_meta = get_post_meta($alpha_color_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($alpha_color_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($alpha_color_header_id)));
				echo !empty($alpha_color_header_image) || !empty($alpha_color_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($alpha_color_header_video!='') 
					echo ' with_bg_video';
				if ($alpha_color_header_image!='') 
					echo ' '.esc_attr(alpha_color_add_inline_css_class('background-image: url('.esc_url($alpha_color_header_image).');'));
				if (!empty($alpha_color_header_meta['margin']) != '') 
					echo ' '.esc_attr(alpha_color_add_inline_css_class('margin-bottom: '.esc_attr(alpha_color_prepare_css_value($alpha_color_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (alpha_color_is_on(alpha_color_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight alpha_color-full-height';
				?> scheme_<?php echo esc_attr(alpha_color_is_inherit(alpha_color_get_theme_option('header_scheme')) 
												? alpha_color_get_theme_option('color_scheme') 
												: alpha_color_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($alpha_color_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('alpha_color_action_show_layout', $alpha_color_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>