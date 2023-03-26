<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

// Header sidebar
$alpha_color_header_name = alpha_color_get_theme_option('header_widgets');
$alpha_color_header_present = !alpha_color_is_off($alpha_color_header_name) && is_active_sidebar($alpha_color_header_name);
if ($alpha_color_header_present) { 
	alpha_color_storage_set('current_sidebar', 'header');
	$alpha_color_header_wide = alpha_color_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($alpha_color_header_name) ) {
		dynamic_sidebar($alpha_color_header_name);
	}
	$alpha_color_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($alpha_color_widgets_output)) {
		$alpha_color_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $alpha_color_widgets_output);
		$alpha_color_need_columns = strpos($alpha_color_widgets_output, 'columns_wrap')===false;
		if ($alpha_color_need_columns) {
			$alpha_color_columns = max(0, (int) alpha_color_get_theme_option('header_columns'));
			if ($alpha_color_columns == 0) $alpha_color_columns = min(6, max(1, substr_count($alpha_color_widgets_output, '<aside ')));
			if ($alpha_color_columns > 1)
				$alpha_color_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($alpha_color_columns).' widget ', $alpha_color_widgets_output);
			else
				$alpha_color_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($alpha_color_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$alpha_color_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($alpha_color_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'alpha_color_action_before_sidebar' );
				alpha_color_show_layout($alpha_color_widgets_output);
				do_action( 'alpha_color_action_after_sidebar' );
				if ($alpha_color_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$alpha_color_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>