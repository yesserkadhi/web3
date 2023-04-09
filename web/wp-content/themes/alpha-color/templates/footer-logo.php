<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.10
 */

// Logo
if (alpha_color_is_on(alpha_color_get_theme_option('logo_in_footer'))) {
	$alpha_color_logo_image = '';
	if (alpha_color_is_on(alpha_color_get_theme_option('logo_retina_enabled')) && alpha_color_get_retina_multiplier(2) > 1)
		$alpha_color_logo_image = alpha_color_get_theme_option( 'logo_footer_retina' );
	if (empty($alpha_color_logo_image)) 
		$alpha_color_logo_image = alpha_color_get_theme_option( 'logo_footer' );
	$alpha_color_logo_text   = get_bloginfo( 'name' );
	if (!empty($alpha_color_logo_image) || !empty($alpha_color_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($alpha_color_logo_image)) {
					$alpha_color_attr = alpha_color_getimagesize($alpha_color_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($alpha_color_logo_image).'" class="logo_footer_image" '.(!empty($alpha_color_attr[3]) ? ' ' . wp_kses_data($alpha_color_attr[3]) : '').'></a>' ;
				} else if (!empty($alpha_color_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($alpha_color_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>