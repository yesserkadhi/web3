<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.10
 */


// Socials
if ( alpha_color_is_on(alpha_color_get_theme_option('socials_in_footer')) && ($alpha_color_output = alpha_color_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php alpha_color_show_layout($alpha_color_output); ?>
		</div>
	</div>
	<?php
}
?>