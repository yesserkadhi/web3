<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.10
 */

$alpha_color_footer_scheme =  alpha_color_is_inherit(alpha_color_get_theme_option('footer_scheme')) ? alpha_color_get_theme_option('color_scheme') : alpha_color_get_theme_option('footer_scheme');
$alpha_color_footer_id = str_replace('footer-custom-', '', alpha_color_get_theme_option("footer_style"));
if ((int) $alpha_color_footer_id == 0) {
	$alpha_color_footer_id = alpha_color_get_post_id(array(
												'name' => $alpha_color_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$alpha_color_footer_id = apply_filters('alpha_color_filter_get_translated_layout', $alpha_color_footer_id);
}
$alpha_color_footer_meta = get_post_meta($alpha_color_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($alpha_color_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($alpha_color_footer_id))); 
						if (!empty($alpha_color_footer_meta['margin']) != '') 
							echo ' '.esc_attr(alpha_color_add_inline_css_class('margin-top: '.alpha_color_prepare_css_value($alpha_color_footer_meta['margin']).';'));
						?> scheme_<?php echo esc_attr($alpha_color_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('alpha_color_action_show_layout', $alpha_color_footer_id);
	?>
</footer><!-- /.footer_wrap -->
