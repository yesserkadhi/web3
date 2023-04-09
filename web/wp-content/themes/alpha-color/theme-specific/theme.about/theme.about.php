<?php
/**
 * Information about this theme
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.30
 */


// Redirect to the 'About Theme' page after switch theme
if (!function_exists('alpha_color_about_after_switch_theme')) {
	add_action('after_switch_theme', 'alpha_color_about_after_switch_theme', 1000);
	function alpha_color_about_after_switch_theme() {
		update_option('alpha_color_about_page', 1);
	}
}
if ( !function_exists('alpha_color_about_after_setup_theme') ) {
	add_action( 'init', 'alpha_color_about_after_setup_theme', 1000 );
	function alpha_color_about_after_setup_theme() {
		if (get_option('alpha_color_about_page') == 1) {
			update_option('alpha_color_about_page', 0);
			wp_safe_redirect(admin_url().'themes.php?page=alpha_color_about');
			exit();
		}
	}
}


// Add 'About Theme' item in the Appearance menu
if (!function_exists('alpha_color_about_add_menu_items')) {
	add_action( 'admin_menu', 'alpha_color_about_add_menu_items' );
	function alpha_color_about_add_menu_items() {
		$theme = wp_get_theme();
		$theme_name = $theme->name . (ALPHA_COLOR_THEME_FREE ? ' ' . esc_html__('Free', 'alpha-color') : '');
		add_theme_page(
			// Translators: Add theme name to the page title
			sprintf(esc_html__('About %s', 'alpha-color'), $theme_name),	//page_title
			// Translators: Add theme name to the menu title
			sprintf(esc_html__('About %s', 'alpha-color'), $theme_name),	//menu_title
			'manage_options',											//capability
			'alpha_color_about',											//menu_slug
			'alpha_color_about_page_builder'								//callback

		);
	}
}


// Load page-specific scripts and styles
if (!function_exists('alpha_color_about_enqueue_scripts')) {
	add_action( 'admin_enqueue_scripts', 'alpha_color_about_enqueue_scripts' );
	function alpha_color_about_enqueue_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id == 'appearance_page_alpha_color_about') {
			// Scripts
			wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
			
			if (function_exists('alpha_color_plugins_installer_enqueue_scripts'))
				alpha_color_plugins_installer_enqueue_scripts();
			
			// Styles
			wp_enqueue_style( 'fontello-icons',  alpha_color_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
			if ( ($fdir = alpha_color_get_file_url('theme-specific/theme.about/theme.about.css')) != '' )
				wp_enqueue_style( 'alpha-color-about',  $fdir, array(), null );
		}
	}
}


// Build 'About Theme' page
if (!function_exists('alpha_color_about_page_builder')) {
	function alpha_color_about_page_builder() {
		$theme = wp_get_theme();
		?>
		<div class="alpha_color_about">
			<div class="alpha_color_about_header">
				<div class="alpha_color_about_logo"><?php
					$logo = alpha_color_get_file_url('theme-specific/theme.about/logo.jpg');
					if (empty($logo)) $logo = alpha_color_get_file_url('screenshot.jpg');
					if (!empty($logo)) {
						?><img src="<?php echo esc_url($logo); ?>"><?php
					}
				?></div>
				
				<?php if (ALPHA_COLOR_THEME_FREE) { ?>
					<a href="<?php echo esc_url(alpha_color_storage_get('theme_download_url')); ?>"
										   target="_blank"
										   class="alpha_color_about_pro_link button button-primary"><?php
											esc_html_e('Get PRO version', 'alpha-color');
										?></a>
				<?php } ?>
				<h1 class="alpha_color_about_title"><?php
					// Translators: Add theme name and version to the 'Welcome' message
					echo esc_html(sprintf(esc_html__('Welcome to %1$s %2$s v.%3$s', 'alpha-color'),
								$theme->name,
								ALPHA_COLOR_THEME_FREE ? esc_html__('Free', 'alpha-color') : '',
								$theme->version
								));
				?></h1>
				<div class="alpha_color_about_description">
					<?php
					if (ALPHA_COLOR_THEME_FREE) {
						?><p><?php
							// Translators: Add the download url and the theme name to the message
							echo wp_kses_data(sprintf(__('Now you are using Free version of <a href="%1$s">%2$s Pro Theme</a>.', 'alpha-color'),
														esc_url(alpha_color_storage_get('theme_download_url')),
														$theme->name
														)
												);
							// Translators: Add the theme name and supported plugins list to the message
							echo '<br>' . wp_kses_data(sprintf(__('This version is SEO- and Retina-ready. It also has a built-in support for parallax and slider with swipe gestures. %1$s Free is compatible with many popular plugins, such as %2$s', 'alpha-color'),
														$theme->name,
														alpha_color_about_get_supported_plugins()
														)
												);
						?></p>
						<p><?php
							// Translators: Add the download url to the message
							echo wp_kses_data(sprintf(__('We hope you have a great acquaintance with our themes. If you are looking for a fully functional website, you can get the <a href="%s">Pro Version here</a>', 'alpha-color'),
														esc_url(alpha_color_storage_get('theme_download_url'))
														)
												);
						?></p><?php
					} else {
						?><p><?php
							// Translators: Add the theme name to the message
							echo wp_kses_data(sprintf(__('%s is a Premium WordPress theme. It has a built-in support for parallax, slider with swipe gestures, and is SEO- and Retina-ready', 'alpha-color'),
														$theme->name
														)
												);
						?></p>
						<p><?php
							// Translators: Add supported plugins list to the message
							echo wp_kses_data(sprintf(__('The Premium Theme is compatible with many popular plugins, such as %s', 'alpha-color'),
														alpha_color_about_get_supported_plugins()
														)
												);
						?></p><?php
					}
					?>
				</div>
			</div>
			<div id="alpha_color_about_tabs" class="alpha_color_tabs alpha_color_about_tabs">
				<ul>
					<li><a href="#alpha_color_about_section_start"><?php esc_html_e('Getting started', 'alpha-color'); ?></a></li>
					<li><a href="#alpha_color_about_section_actions"><?php esc_html_e('Recommended actions', 'alpha-color'); ?></a></li>
					<?php if (ALPHA_COLOR_THEME_FREE) { ?>
						<li><a href="#alpha_color_about_section_pro"><?php esc_html_e('Free vs PRO', 'alpha-color'); ?></a></li>
					<?php } ?>
				</ul>
				<div id="alpha_color_about_section_start" class="alpha_color_tabs_section alpha_color_about_section"><?php
				
					// Install required plugins
					if (!ALPHA_COLOR_THEME_FREE_WP && !alpha_color_exists_trx_addons()) {
						?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
							<h2 class="alpha_color_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'alpha-color'); ?>
							</h2>
							<div class="alpha_color_about_block_description"><?php
								esc_html_e('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'alpha-color');
							?></div>
							<?php alpha_color_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
						<h2 class="alpha_color_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'alpha-color'); ?>
						</h2>
						<div class="alpha_color_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'alpha-color'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="alpha_color_about_block_link button button-primary"><?php
							esc_html_e('Install plugins', 'alpha-color');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
						<h2 class="alpha_color_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'alpha-color'); ?>
						</h2>
						<div class="alpha_color_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'alpha-color');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   class="alpha_color_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'alpha-color');
						?></a>
						<?php esc_html_e('or', 'alpha-color'); ?>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
						   class="alpha_color_about_block_link button"><?php
							esc_html_e('Theme Options', 'alpha-color');
						?></a>
					</div></div><?php
					
					// Documentation
					?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
						<h2 class="alpha_color_about_block_title">
							<i class="dashicons dashicons-book"></i>
							<?php esc_html_e('Read full documentation', 'alpha-color');	?>
						</h2>
						<div class="alpha_color_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('Need more details? Please check our full online documentation for detailed information on how to use %s.', 'alpha-color'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(alpha_color_storage_get('theme_doc_url')); ?>"
						   target="_blank"
						   class="alpha_color_about_block_link button button-primary"><?php
							esc_html_e('Documentation', 'alpha-color');
						?></a>
					</div></div><?php
					
					// Video tutorials
					?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
						<h2 class="alpha_color_about_block_title">
							<i class="dashicons dashicons-video-alt2"></i>
							<?php esc_html_e('Video tutorials', 'alpha-color');	?>
						</h2>
						<div class="alpha_color_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('No time for reading documentation? Check out our video tutorials and learn how to customize %s in detail.', 'alpha-color'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(alpha_color_storage_get('theme_video_url')); ?>"
						   target="_blank"
						   class="alpha_color_about_block_link button button-primary"><?php
							esc_html_e('Watch videos', 'alpha-color');
						?></a>
					</div></div><?php
					
					// Support
					if (!ALPHA_COLOR_THEME_FREE) {
						?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
							<h2 class="alpha_color_about_block_title">
								<i class="dashicons dashicons-sos"></i>
								<?php esc_html_e('Support', 'alpha-color'); ?>
							</h2>
							<div class="alpha_color_about_block_description"><?php
								// Translators: Add the theme name to the message
								echo esc_html(sprintf(esc_html__('We want to make sure you have the best experience using %s and that is why we gathered here all the necessary informations for you.', 'alpha-color'), $theme->name));
							?></div>
							<a href="<?php echo esc_url(alpha_color_storage_get('theme_support_url')); ?>"
							   target="_blank"
							   class="alpha_color_about_block_link button button-primary"><?php
								esc_html_e('Support', 'alpha-color');
							?></a>
						</div></div><?php
					}
					
					// Online Demo
					?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
						<h2 class="alpha_color_about_block_title">
							<i class="dashicons dashicons-images-alt2"></i>
							<?php esc_html_e('On-line demo', 'alpha-color'); ?>
						</h2>
						<div class="alpha_color_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('Visit the Demo Version of %s to check out all the features it has', 'alpha-color'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(alpha_color_storage_get('theme_demo_url')); ?>"
						   target="_blank"
						   class="alpha_color_about_block_link button button-primary"><?php
							esc_html_e('View demo', 'alpha-color');
						?></a>
					</div></div>
					
				</div>



				<div id="alpha_color_about_section_actions" class="alpha_color_tabs_section alpha_color_about_section"><?php
				
					// Install required plugins
					if (!ALPHA_COLOR_THEME_FREE_WP && !alpha_color_exists_trx_addons()) {
						?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
							<h2 class="alpha_color_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'alpha-color'); ?>
							</h2>
							<div class="alpha_color_about_block_description"><?php
								esc_html_e('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'alpha-color');
							?></div>
							<?php alpha_color_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
						<h2 class="alpha_color_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'alpha-color'); ?>
						</h2>
						<div class="alpha_color_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(esc_html__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'alpha-color'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="alpha_color_about_block_link button button button-primary"><?php
							esc_html_e('Install plugins', 'alpha-color');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="alpha_color_about_block"><div class="alpha_color_about_block_inner">
						<h2 class="alpha_color_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'alpha-color'); ?>
						</h2>
						<div class="alpha_color_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'alpha-color');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   target="_blank"
						   class="alpha_color_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'alpha-color');
						?></a>
						<?php esc_html_e('or', 'alpha-color'); ?>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
						   class="alpha_color_about_block_link button"><?php
							esc_html_e('Theme Options', 'alpha-color');
						?></a>
					</div></div>
					
				</div>



				<?php if (ALPHA_COLOR_THEME_FREE) { ?>
					<div id="alpha_color_about_section_pro" class="alpha_color_tabs_section alpha_color_about_section">
						<table class="alpha_color_about_table" cellpadding="0" cellspacing="0" border="0">
							<thead>
								<tr>
									<td class="alpha_color_about_table_info">&nbsp;</td>
									<td class="alpha_color_about_table_check"><?php
										// Translators: Show theme name with suffix 'Free'
										echo esc_html(sprintf(esc_html__('%s Free', 'alpha-color'), $theme->name));
									?></td>
									<td class="alpha_color_about_table_check"><?php
										// Translators: Show theme name with suffix 'PRO'
										echo esc_html(sprintf(esc_html__('%s PRO', 'alpha-color'), $theme->name));
									?></td>
								</tr>
							</thead>
							<tbody>
	
	
								<?php
								// Responsive layouts
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Mobile friendly', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('Responsive layout. Looks great on any device.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Built-in slider
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Built-in posts slider', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('Allows you to add beautiful slides using the built-in shortcode/widget "Slider" with swipe gestures support.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Revolution slider
								if (alpha_color_storage_isset('required_plugins', 'revslider')) {
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Revolution Slider Compatibility', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('Our built-in shortcode/widget "Slider" is able to work not only with posts, but also with slides created  in "Revolution Slider".', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// SiteOrigin Panels
								if (alpha_color_storage_isset('required_plugins', 'siteorigin-panels')) {
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Free PageBuilder', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('Full integration with a nice free page builder "SiteOrigin Panels".', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Additional widgets pack', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('A number of useful widgets to create beautiful homepages and other sections of your website with SiteOrigin Panels.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// WPBakery Page Builder
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('WPBakery Page Builder', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('Full integration with a very popular page builder "WPBakery Page Builder". A number of useful shortcodes and widgets to create beautiful homepages and other sections of your website.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Additional shortcodes pack', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('A number of useful shortcodes to create beautiful homepages and other sections of your website with WPBakery Page Builder.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Layouts builder
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Headers and Footers builder', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('Powerful visual builder of headers and footers! No manual code editing - use all the advantages of drag-and-drop technology.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// WooCommerce
								if (alpha_color_storage_isset('required_plugins', 'woocommerce')) {
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('WooCommerce Compatibility', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('Ready for e-commerce. You can build an online store with this theme.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// Easy Digital Downloads
								if (alpha_color_storage_isset('required_plugins', 'easy-digital-downloads')) {
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Easy Digital Downloads Compatibility', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('Ready for digital e-commerce. You can build an online digital store with this theme.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// Other plugins
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Many other popular plugins compatibility', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('PRO version is compatible (was tested and has built-in support) with many popular plugins.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Support
								?>
								<tr>
									<td class="alpha_color_about_table_info">
										<h2 class="alpha_color_about_table_info_title">
											<?php esc_html_e('Support', 'alpha-color'); ?>
										</h2>
										<div class="alpha_color_about_table_info_description"><?php
											esc_html_e('Our premium support is going to take care of any problems, in case there will be any of course.', 'alpha-color');
										?></div>
									</td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="alpha_color_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Get PRO version
								?>
								<tr>
									<td class="alpha_color_about_table_info">&nbsp;</td>
									<td class="alpha_color_about_table_check" colspan="2">
										<a href="<?php echo esc_url(alpha_color_storage_get('theme_download_url')); ?>"
										   target="_blank"
										   class="alpha_color_about_block_link alpha_color_about_pro_link button button-primary"><?php
											esc_html_e('Get PRO version', 'alpha-color');
										?></a>
									</td>
								</tr>
	
							</tbody>
						</table>
					</div>
				<?php } ?>
				
			</div>
		</div>
		<?php
	}
}


// Utils
//------------------------------------

// Return supported plugin's names
if (!function_exists('alpha_color_about_get_supported_plugins')) {
	function alpha_color_about_get_supported_plugins() {
		return '"' . join('", "', array_values(alpha_color_storage_get('required_plugins'))) . '"';
	}
}

require_once ALPHA_COLOR_THEME_DIR . 'includes/plugins.installer/plugins.installer.php';
?>