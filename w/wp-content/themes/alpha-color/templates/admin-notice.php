<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.1
 */
 
$alpha_color_theme_obj = wp_get_theme();
?>
<div class="update-nag" id="alpha_color_admin_notice">
	<h3 class="alpha_color_notice_title"><?php
		// Translators: Add theme name and version to the 'Welcome' message
		echo esc_html(sprintf(esc_html__('Welcome to %1$s v.%2$s', 'alpha-color'),
				$alpha_color_theme_obj->name . (ALPHA_COLOR_THEME_FREE ? ' ' . esc_html__('Free', 'alpha-color') : ''),
				$alpha_color_theme_obj->version
				));
	?></h3>
	<?php
	if (!alpha_color_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'alpha-color')); ?></p><?php
	}
	?><p>
		<a href="<?php echo esc_url(admin_url().'themes.php?page=alpha_color_about'); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> <?php
			// Translators: Add theme name
			echo esc_html(sprintf(esc_html__('About %s', 'alpha-color'), $alpha_color_theme_obj->name));
		?></a>
		<?php
		if (alpha_color_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'alpha-color'); ?></a>
			<?php
		}
		if (function_exists('alpha_color_exists_trx_addons') && alpha_color_exists_trx_addons() && class_exists('trx_addons_demo_data_importer')) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'alpha-color'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'alpha-color'); ?></a>
		<span> <?php esc_html_e('or', 'alpha-color'); ?> </span>
        <a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Options', 'alpha-color'); ?></a>
        <a href="#" class="button alpha_color_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'alpha-color'); ?></a>
	</p>
</div>