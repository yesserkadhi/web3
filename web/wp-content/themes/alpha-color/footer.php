<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

						// Widgets area inside page content
						alpha_color_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					alpha_color_create_widgets_area('widgets_below_page');

					$alpha_color_body_style = alpha_color_get_theme_option('body_style');
					if ($alpha_color_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$alpha_color_footer_type = alpha_color_get_theme_option("footer_type");
			if ($alpha_color_footer_type == 'custom' && !alpha_color_is_layouts_available())
				$alpha_color_footer_type = 'default';
			get_template_part( "templates/footer-{$alpha_color_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (alpha_color_is_on(alpha_color_get_theme_option('debug_mode')) && alpha_color_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(alpha_color_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>