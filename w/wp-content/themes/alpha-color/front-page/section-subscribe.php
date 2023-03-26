<div class="front_page_section front_page_section_subscribe<?php
			$alpha_color_scheme = alpha_color_get_theme_option('front_page_subscribe_scheme');
			if (!alpha_color_is_inherit($alpha_color_scheme)) echo ' scheme_'.esc_attr($alpha_color_scheme);
			echo ' front_page_section_paddings_'.esc_attr(alpha_color_get_theme_option('front_page_subscribe_paddings'));
		?>"<?php
		$alpha_color_css = '';
		$alpha_color_bg_image = alpha_color_get_theme_option('front_page_subscribe_bg_image');
		if (!empty($alpha_color_bg_image)) 
			$alpha_color_css .= 'background-image: url('.esc_url(alpha_color_get_attachment_url($alpha_color_bg_image)).');';
		if (!empty($alpha_color_css))
			echo ' style="' . esc_attr($alpha_color_css) . '"';
?>><?php
	// Add anchor
	$alpha_color_anchor_icon = alpha_color_get_theme_option('front_page_subscribe_anchor_icon');	
	$alpha_color_anchor_text = alpha_color_get_theme_option('front_page_subscribe_anchor_text');	
	if ((!empty($alpha_color_anchor_icon) || !empty($alpha_color_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_subscribe"'
										. (!empty($alpha_color_anchor_icon) ? ' icon="'.esc_attr($alpha_color_anchor_icon).'"' : '')
										. (!empty($alpha_color_anchor_text) ? ' title="'.esc_attr($alpha_color_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_subscribe_inner<?php
			if (alpha_color_get_theme_option('front_page_subscribe_fullheight'))
				echo ' alpha_color-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$alpha_color_css = '';
			$alpha_color_bg_mask = alpha_color_get_theme_option('front_page_subscribe_bg_mask');
			$alpha_color_bg_color = alpha_color_get_theme_option('front_page_subscribe_bg_color');
			if (!empty($alpha_color_bg_color) && $alpha_color_bg_mask > 0)
				$alpha_color_css .= 'background-color: '.esc_attr($alpha_color_bg_mask==1
																	? $alpha_color_bg_color
																	: alpha_color_hex2rgba($alpha_color_bg_color, $alpha_color_bg_mask)
																).';';
			if (!empty($alpha_color_css))
				echo ' style="' . esc_attr($alpha_color_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_subscribe_content_wrap content_wrap">
			<?php
			// Caption
			$alpha_color_caption = alpha_color_get_theme_option('front_page_subscribe_caption');
			if (!empty($alpha_color_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_subscribe_caption front_page_block_<?php echo !empty($alpha_color_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses($alpha_color_caption, 'alpha_color_kses_content'); ?></h2><?php
			}
		
			// Description (text)
			$alpha_color_description = alpha_color_get_theme_option('front_page_subscribe_description');
			if (!empty($alpha_color_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_subscribe_description front_page_block_<?php echo !empty($alpha_color_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses(wpautop($alpha_color_description), 'alpha_color_kses_content'); ?></div><?php
			}
			
			// Content
			$alpha_color_sc = alpha_color_get_theme_option('front_page_subscribe_shortcode');
			if (!empty($alpha_color_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_subscribe_output front_page_block_<?php echo !empty($alpha_color_sc) ? 'filled' : 'empty'; ?>"><?php
					alpha_color_show_layout(do_shortcode($alpha_color_sc));
				?></div><?php
			}
			?>
		</div>
	</div>
</div>