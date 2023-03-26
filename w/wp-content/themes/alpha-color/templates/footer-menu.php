<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.10
 */

// Footer menu
$alpha_color_menu_footer = alpha_color_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($alpha_color_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php alpha_color_show_layout($alpha_color_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>