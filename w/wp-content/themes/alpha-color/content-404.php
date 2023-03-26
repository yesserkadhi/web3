<article <?php post_class( 'post_item_single post_item_404' ); ?>>
	<div class="post_content">
		<h1 class="page_title"><?php esc_html_e( '404', 'alpha-color' ); ?></h1>
		<div class="page_info">
			<h1 class="page_subtitle"><?php esc_html_e('Oops...', 'alpha-color'); ?></h1>
			<p class="page_description"><?php echo wp_kses(__("We're sorry, but <br>something went wrong.", 'alpha-color'), 'alpha_color_kses_content'); ?></p>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="go_home theme_button"><?php esc_html_e('Homepage', 'alpha-color'); ?></a>
		</div>
	</div>
</article>
