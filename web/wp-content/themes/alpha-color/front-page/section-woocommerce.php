<div class="front_page_section front_page_section_woocommerce<?php
			$alpha_color_scheme = alpha_color_get_theme_option('front_page_woocommerce_scheme');
			if (!alpha_color_is_inherit($alpha_color_scheme)) echo ' scheme_'.esc_attr($alpha_color_scheme);
			echo ' front_page_section_paddings_'.esc_attr(alpha_color_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$alpha_color_css = '';
		$alpha_color_bg_image = alpha_color_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($alpha_color_bg_image)) 
			$alpha_color_css .= 'background-image: url('.esc_url(alpha_color_get_attachment_url($alpha_color_bg_image)).');';
		if (!empty($alpha_color_css))
			echo ' style="' . esc_attr($alpha_color_css) . '"';
?>><?php
	// Add anchor
	$alpha_color_anchor_icon = alpha_color_get_theme_option('front_page_woocommerce_anchor_icon');	
	$alpha_color_anchor_text = alpha_color_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($alpha_color_anchor_icon) || !empty($alpha_color_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($alpha_color_anchor_icon) ? ' icon="'.esc_attr($alpha_color_anchor_icon).'"' : '')
										. (!empty($alpha_color_anchor_text) ? ' title="'.esc_attr($alpha_color_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (alpha_color_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' alpha_color-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$alpha_color_css = '';
			$alpha_color_bg_mask = alpha_color_get_theme_option('front_page_woocommerce_bg_mask');
			$alpha_color_bg_color = alpha_color_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($alpha_color_bg_color) && $alpha_color_bg_mask > 0)
				$alpha_color_css .= 'background-color: '.esc_attr($alpha_color_bg_mask==1
																	? $alpha_color_bg_color
																	: alpha_color_hex2rgba($alpha_color_bg_color, $alpha_color_bg_mask)
																).';';
			if (!empty($alpha_color_css))
				echo ' style="' . esc_attr($alpha_color_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$alpha_color_caption = alpha_color_get_theme_option('front_page_woocommerce_caption');
			$alpha_color_description = alpha_color_get_theme_option('front_page_woocommerce_description');
			if (!empty($alpha_color_caption) || !empty($alpha_color_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($alpha_color_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($alpha_color_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses($alpha_color_caption, 'alpha_color_kses_content');
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($alpha_color_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($alpha_color_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses(wpautop($alpha_color_description), 'alpha_color_kses_content');
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$alpha_color_woocommerce_sc = alpha_color_get_theme_option('front_page_woocommerce_products');
				if ($alpha_color_woocommerce_sc == 'products') {
					$alpha_color_woocommerce_sc_ids = alpha_color_get_theme_option('front_page_woocommerce_products_per_page');
					$alpha_color_woocommerce_sc_per_page = count(explode(',', $alpha_color_woocommerce_sc_ids));
				} else {
					$alpha_color_woocommerce_sc_per_page = max(1, (int) alpha_color_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$alpha_color_woocommerce_sc_columns = max(1, min($alpha_color_woocommerce_sc_per_page, (int) alpha_color_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$alpha_color_woocommerce_sc}"
									. ($alpha_color_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($alpha_color_woocommerce_sc_ids).'"' 
											: '')
									. ($alpha_color_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(alpha_color_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($alpha_color_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(alpha_color_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(alpha_color_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($alpha_color_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($alpha_color_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>