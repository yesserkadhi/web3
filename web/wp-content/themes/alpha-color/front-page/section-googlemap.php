<div class="front_page_section front_page_section_googlemap<?php
			$alpha_color_scheme = alpha_color_get_theme_option('front_page_googlemap_scheme');
			if (!alpha_color_is_inherit($alpha_color_scheme)) echo ' scheme_'.esc_attr($alpha_color_scheme);
			echo ' front_page_section_paddings_'.esc_attr(alpha_color_get_theme_option('front_page_googlemap_paddings'));
		?>"<?php
		$alpha_color_css = '';
		$alpha_color_bg_image = alpha_color_get_theme_option('front_page_googlemap_bg_image');
		if (!empty($alpha_color_bg_image)) 
			$alpha_color_css .= 'background-image: url('.esc_url(alpha_color_get_attachment_url($alpha_color_bg_image)).');';
		if (!empty($alpha_color_css))
			echo ' style="' . esc_attr($alpha_color_css) . '"';
?>><?php
	// Add anchor
	$alpha_color_anchor_icon = alpha_color_get_theme_option('front_page_googlemap_anchor_icon');	
	$alpha_color_anchor_text = alpha_color_get_theme_option('front_page_googlemap_anchor_text');	
	if ((!empty($alpha_color_anchor_icon) || !empty($alpha_color_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_googlemap"'
										. (!empty($alpha_color_anchor_icon) ? ' icon="'.esc_attr($alpha_color_anchor_icon).'"' : '')
										. (!empty($alpha_color_anchor_text) ? ' title="'.esc_attr($alpha_color_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_googlemap_inner<?php
			if (alpha_color_get_theme_option('front_page_googlemap_fullheight'))
				echo ' alpha_color-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$alpha_color_css = '';
			$alpha_color_bg_mask = alpha_color_get_theme_option('front_page_googlemap_bg_mask');
			$alpha_color_bg_color = alpha_color_get_theme_option('front_page_googlemap_bg_color');
			if (!empty($alpha_color_bg_color) && $alpha_color_bg_mask > 0)
				$alpha_color_css .= 'background-color: '.esc_attr($alpha_color_bg_mask==1
																	? $alpha_color_bg_color
																	: alpha_color_hex2rgba($alpha_color_bg_color, $alpha_color_bg_mask)
																).';';
			if (!empty($alpha_color_css))
				echo ' style="' . esc_attr($alpha_color_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap<?php
			$alpha_color_layout = alpha_color_get_theme_option('front_page_googlemap_layout');
			if ($alpha_color_layout != 'fullwidth')
				echo ' content_wrap';
		?>">
			<?php
			// Content wrap with title and description
			$alpha_color_caption = alpha_color_get_theme_option('front_page_googlemap_caption');
			$alpha_color_description = alpha_color_get_theme_option('front_page_googlemap_description');
			if (!empty($alpha_color_caption) || !empty($alpha_color_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($alpha_color_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
					// Caption
					if (!empty($alpha_color_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo !empty($alpha_color_caption) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses($alpha_color_caption, 'alpha_color_kses_content');
						?></h2><?php
					}
				
					// Description (text)
					if (!empty($alpha_color_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo !empty($alpha_color_description) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses(wpautop($alpha_color_description), 'alpha_color_kses_content');
						?></div><?php
					}
				if ($alpha_color_layout == 'fullwidth') {
					?></div><?php
				}
			}

			// Content (text)
			$alpha_color_content = alpha_color_get_theme_option('front_page_googlemap_content');
			if (!empty($alpha_color_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($alpha_color_layout == 'columns') {
					?><div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} else if ($alpha_color_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
	
				?><div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo !empty($alpha_color_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses($alpha_color_content, 'alpha_color_kses_content');
				?></div><?php
	
				if ($alpha_color_layout == 'columns') {
					?></div><div class="column-2_3"><?php
				} else if ($alpha_color_layout == 'fullwidth') {
					?></div><?php
				}
			}
			
			// Widgets output
			?><div class="front_page_section_output front_page_section_googlemap_output"><?php 
				if (is_active_sidebar('front_page_googlemap_widgets')) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!alpha_color_exists_trx_addons())
						alpha_color_customizer_need_trx_addons_message();
					else
						alpha_color_customizer_need_widgets_message('front_page_googlemap_caption', 'ThemeREX Addons - Google map');
				}
			?></div><?php

			if ($alpha_color_layout == 'columns' && (!empty($alpha_color_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>