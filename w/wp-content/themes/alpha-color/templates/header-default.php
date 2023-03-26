<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */


$alpha_color_header_css = $alpha_color_header_image = '';
$alpha_color_header_video = alpha_color_get_header_video();
if (true || empty($alpha_color_header_video)) {
	$alpha_color_header_image = get_header_image();
	if (alpha_color_trx_addons_featured_image_override()) $alpha_color_header_image = alpha_color_get_current_mode_image($alpha_color_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($alpha_color_header_image) || !empty($alpha_color_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($alpha_color_header_video!='') echo ' with_bg_video';
					if ($alpha_color_header_image!='') echo ' '.esc_attr(alpha_color_add_inline_css_class('background-image: url('.esc_url($alpha_color_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (alpha_color_is_on(alpha_color_get_theme_option('header_fullheight'))) echo ' header_fullheight alpha_color-full-height';
					?> scheme_<?php echo esc_attr(alpha_color_is_inherit(alpha_color_get_theme_option('header_scheme')) 
													? alpha_color_get_theme_option('color_scheme') 
													: alpha_color_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($alpha_color_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (alpha_color_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );



?></header>