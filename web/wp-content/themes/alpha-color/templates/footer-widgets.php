<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.10
 */

// Footer sidebar
$alpha_color_footer_name = alpha_color_get_theme_option('footer_widgets');
$alpha_color_footer_present = !alpha_color_is_off($alpha_color_footer_name) && is_active_sidebar($alpha_color_footer_name);
if ($alpha_color_footer_present) { 
	alpha_color_storage_set('current_sidebar', 'footer');
	$alpha_color_footer_wide = alpha_color_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($alpha_color_footer_name) ) {
		dynamic_sidebar($alpha_color_footer_name);
	}
	$alpha_color_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($alpha_color_out)) {
		$alpha_color_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $alpha_color_out);
		$alpha_color_need_columns = true;
		if ($alpha_color_need_columns) {
			$alpha_color_columns = max(0, (int) alpha_color_get_theme_option('footer_columns'));
			if ($alpha_color_columns == 0) $alpha_color_columns = min(4, max(1, substr_count($alpha_color_out, '<aside ')));
			if ($alpha_color_columns > 1)
				$alpha_color_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($alpha_color_columns).' widget ', $alpha_color_out);
			else
				$alpha_color_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($alpha_color_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$alpha_color_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($alpha_color_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'alpha_color_action_before_sidebar' );
				alpha_color_show_layout($alpha_color_out);
				do_action( 'alpha_color_action_after_sidebar' );
				if ($alpha_color_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$alpha_color_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>