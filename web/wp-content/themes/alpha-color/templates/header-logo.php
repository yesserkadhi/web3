<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

$alpha_color_args = get_query_var('alpha_color_logo_args');
// Site logo
$alpha_color_logo_type   = isset($alpha_color_args['type']) ? $alpha_color_args['type'] : '';
$alpha_color_logo_image  = alpha_color_get_logo_image($alpha_color_logo_type);
$alpha_color_logo_text   = alpha_color_is_on(alpha_color_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$alpha_color_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($alpha_color_logo_image) || !empty($alpha_color_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php

		if (!empty($alpha_color_logo_image['logo'])) {
			if (empty($alpha_color_logo_type) && function_exists('the_custom_logo') && is_numeric( $alpha_color_logo_image['logo'] ) && (int) $alpha_color_logo_image['logo'] > 0) {
				the_custom_logo();
			} else {
				$alpha_color_attr = alpha_color_getimagesize($alpha_color_logo_image['logo']);
				echo '<img src="'.esc_url($alpha_color_logo_image['logo']).'" '.(!empty($alpha_color_attr[3]) ? ' '.wp_kses_data($alpha_color_attr[3]) : '').'>';
			}
		} else {
			alpha_color_show_layout(alpha_color_prepare_macros($alpha_color_logo_text), '<span class="logo_text">', '</span>');
			alpha_color_show_layout(alpha_color_prepare_macros($alpha_color_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>