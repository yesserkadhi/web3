<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.10
 */

$alpha_color_footer_scheme =  alpha_color_is_inherit(alpha_color_get_theme_option('footer_scheme')) ? alpha_color_get_theme_option('color_scheme') : alpha_color_get_theme_option('footer_scheme');
?>
<footer class="footer_wrap footer_default scheme_<?php echo esc_attr($alpha_color_footer_scheme); ?>">
	<?php

	// Footer widgets area
	get_template_part( 'templates/footer-widgets' );

	// Logo
	get_template_part( 'templates/footer-logo' );

	// Socials
	get_template_part( 'templates/footer-socials' );

	// Menu
	get_template_part( 'templates/footer-menu' );

	// Copyright area
	get_template_part( 'templates/footer-copyright' );
	
	?>
</footer><!-- /.footer_wrap -->
