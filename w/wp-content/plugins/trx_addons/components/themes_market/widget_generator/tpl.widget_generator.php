<?php
/**
 * The template to display the Widget Generator
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.34
 */

/*
Template Name: Widget Generator
*/

get_header();

// Get template page's content
$trx_addons_page_content = '';
$trx_addons_content_mask = '%%CONTENT%%';
$trx_addons_content_subst = sprintf('<div class="widget_generator_data">%s</div>', $trx_addons_content_mask);
if ( have_posts() ) { the_post(); 
	if (($trx_addons_page_content = apply_filters('the_content', get_the_content())) != '') {
		if (($trx_addons_pos = strpos($trx_addons_page_content, $trx_addons_content_mask)) !== false) {
			$trx_addons_page_content = preg_replace('/(\<p\>\s*)?'.$trx_addons_content_mask.'(\s*\<\/p\>)/i', $trx_addons_content_subst, $trx_addons_page_content);
		} else
			$trx_addons_page_content .= $trx_addons_content_subst;
		$trx_addons_page_content = explode($trx_addons_content_mask, $trx_addons_page_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) trx_addons_add_inline_css(strip_tags($vc_custom_css));
	}
}

?>
<article id="trx_addons_widget_generator" <?php post_class( 'widget_generator_page itemscope' ); trx_addons_seo_snippets('', 'Article'); ?>>

	<?php
	do_action('trx_addons_action_before_article', 'widget_generator_page');
	trx_addons_show_layout($trx_addons_page_content[0]);
	?>
		
	<section class="widget_generator_page_content entry-content"<?php trx_addons_seo_snippets('articleBody'); ?>>
		<div class="<?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?>"><?php
			// Form
			$trx_addons_args = array(
				'style' => 'accent'	//trx_addons_get_option('input_hover')
			);
			?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, 3)); ?>">
				<h4 class="widget_generator_form_title"><?php esc_html_e('Widget parameters:', 'trx_addons'); ?></h4>
				<form name="widget_generator_form" class="widget_generator_form sc_form_form sc_form_custom <?php
					if ($trx_addons_args['style'] != 'default') echo 'sc_input_hover_'.esc_attr($trx_addons_args['style']);
				?>"><?php
					// Title
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => true,
														'field_name'  => 'title',
														'field_type'  => 'text',
														'field_value' => '',
														'field_req'   => false,
														'field_icon'  => 'trx_addons_icon-wpforms',
														'field_title' => __('Title', 'trx_addons'),
														'field_placeholder' => __('Title', 'trx_addons')
														))
										);

					// Style
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'style',
																'field_type'  => 'select2',
																'field_value' => 'modern',
																'field_title' => __('Style', 'trx_addons'),
																'field_options'  => array(
																					'modern' => __('Modern', 'trx_addons'),
																					'classic' => __('Classic', 'trx_addons')
																					)
																))
												);

					// Affiliate ID
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => true,
														'field_name'  => 'affid',
														'field_type'  => 'text',
														'field_value' => '',
														'field_req'   => false,
														'field_icon'  => 'trx_addons_icon-user-alt',
														'field_title' => __('Affiliate link', 'trx_addons'),
														'field_placeholder' => __('Affiliate link', 'trx_addons'),
														'field_tooltip' => __('Parameter added to the URL containing your affiliate ID for the selected marketplace. For example: ref=johnwalker', 'trx_addons'),
														))
										);

					// Market
					$list = trx_addons_get_list_terms(false, TRX_ADDONS_EDD_TAXONOMY_MARKET);
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'market',
																'field_type'  => 'select2',
																'field_multiple' => true,
																'field_value' => 0,
																'field_req'   => false,
																'field_title' => __('Marketplace', 'trx_addons'),
																'field_options'  => $list,
																))
												);

					// Category
					$list = trx_addons_get_list_terms(false, TRX_ADDONS_EDD_TAXONOMY_CATEGORY);
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'category',
																'field_type'  => 'select2',
																'field_multiple' => true,
																'field_value' => 0,
																'field_req'   => false,
																'field_title' => __('Category', 'trx_addons'),
																'field_options'  => $list
																))
												);

					// Count
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'count',
																'field_type'  => 'slider',
																'field_min'   => 1,
																'field_max'   => 25,
																'field_value' => 4,
																'field_title' => __('Count', 'trx_addons')
																))
												);

					// Columns
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'columns',
																'field_type'  => 'slider',
																'field_min'   => 1,
																'field_max'   => 5,
																'field_value' => 2,
																'field_title' => __('Columns', 'trx_addons')
																))
												);

					// Orderby
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'orderby',
																'field_type'  => 'select2',
																'field_value' => 'date',
																'field_title' => __('Order by', 'trx_addons'),
																'field_options'  => array(
																					'date' => __('Date', 'trx_addons'),
																					'update' => __('Update', 'trx_addons'),
																					'title' => __('Title', 'trx_addons'),
																					'random' => __('Random', 'trx_addons')
																					)
																))
												);

					// Order
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'order',
																'field_type'  => 'select2',
																'field_value' => 'desc',
																'field_title' => __('Order', 'trx_addons'),
																'field_options'  => array(
																					'asc' => __('Ascending', 'trx_addons'),
																					'desc' => __('Descending', 'trx_addons')
																					)
																))
												);
				
					// Hide title
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'hide_title',
																'field_type'  => 'checkbox',
																'field_value' => 0,
																'field_title' => __('Hide:', 'trx_addons'),
																'field_placeholder' => __('Hide title', 'trx_addons'),
																))
												);
				
					// Hide price
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'hide_price',
																'field_type'  => 'checkbox',
																'field_value' => 0,
																'field_title' => ' ',
																'field_placeholder' => __('Hide price', 'trx_addons'),
																))
												);
				
					// Hide meta
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'hide_meta',
																'field_type'  => 'checkbox',
																'field_value' => 0,
																'field_title' => ' ',
																'field_placeholder' => __('Hide date and version', 'trx_addons'),
																))
												);
				
					// Hide logo
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'hide_logo',
																'field_type'  => 'checkbox',
																'field_value' => 0,
																'field_title' => ' ',
																'field_placeholder' => __('Hide logo', 'trx_addons'),
																))
												);
				
					// Hide pagination
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'hide_pagination',
																'field_type'  => 'checkbox',
																'field_value' => 0,
																'field_title' => ' ',
																'field_placeholder' => __('Hide pagination', 'trx_addons'),
																))
												);
				
					// Disable animation
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
													'trx_addons_args_sc_form_field',
													array_merge($trx_addons_args, array(
																'labels'      => true,
																'field_name'  => 'disable_animation',
																'field_type'  => 'checkbox',
																'field_value' => 0,
																'field_title' => ' ',
																'field_placeholder' => __('Disable animation', 'trx_addons'),
																))
												);
					
				?></form>
			</div><?php

			// Preview
			?><div class="<?php echo esc_attr(trx_addons_get_column_class(2, 3)); ?>">
				<div class="widget_generator_preview"><?php
					
					// Devices selector
					?><div class="widget_generator_preview_devices"><?php
						// Desktop
						?><span class="widget_generator_preview_devices_desktop trx_addons_icon-desktop"></span><?php
						// Laptop
						?><span class="widget_generator_preview_devices_laptop trx_addons_icon-laptop"></span><?php
						// Tablet
						?><span class="widget_generator_preview_devices_tablet trx_addons_icon-tablet"></span><?php
						// Mobile
						?><span class="widget_generator_preview_devices_mobile trx_addons_icon-mobile"></span><?php
					?></div><?php
					
					// Widgets list
					?><div id="<?php echo esc_attr($GLOBALS['TRX_ADDONS_STORAGE']['widget_generator_uid']); ?>" class="widget_generator_preview_widgets"></div><?php
					
					// Textarea with widget's code
					?><div class="widget_generator_preview_code">
						<h4><?php esc_html_e('Insert code below on your homepage', 'trx_addons'); ?></h4>
						<textarea rows="10" cols="100" readonly></textarea>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	trx_addons_show_layout($trx_addons_page_content[1]);
	do_action('trx_addons_action_after_article', 'widget_generator_page');
	?>

</article>

<?php get_footer(); ?>