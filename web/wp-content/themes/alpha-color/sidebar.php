<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

if (alpha_color_sidebar_present()) {
	ob_start();
	$alpha_color_sidebar_name = alpha_color_get_theme_option('sidebar_widgets');
	alpha_color_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($alpha_color_sidebar_name) ) {
		dynamic_sidebar($alpha_color_sidebar_name);
	}
	$alpha_color_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($alpha_color_out)) {
		$alpha_color_sidebar_position = alpha_color_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($alpha_color_sidebar_position); ?> widget_area<?php if (!alpha_color_is_inherit(alpha_color_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(alpha_color_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'alpha_color_action_before_sidebar' );
				alpha_color_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $alpha_color_out));
				do_action( 'alpha_color_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>