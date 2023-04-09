<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

$alpha_color_blog_style = explode('_', alpha_color_get_theme_option('blog_style'));
$alpha_color_columns = empty($alpha_color_blog_style[1]) ? 2 : max(2, $alpha_color_blog_style[1]);
$alpha_color_post_format = get_post_format();
$alpha_color_post_format = empty($alpha_color_post_format) ? 'standard' : str_replace('post-format-', '', $alpha_color_post_format);
$alpha_color_animation = alpha_color_get_theme_option('blog_animation');
$alpha_color_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($alpha_color_columns).' post_format_'.esc_attr($alpha_color_post_format) ); ?>
	<?php echo (!alpha_color_is_off($alpha_color_animation) ? ' data-animation="'.esc_attr(alpha_color_get_animation_classes($alpha_color_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($alpha_color_image[1]) && !empty($alpha_color_image[2])) echo intval($alpha_color_image[1]) .'x' . intval($alpha_color_image[2]); ?>"
	data-src="<?php if (!empty($alpha_color_image[0])) echo esc_url($alpha_color_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$alpha_color_image_hover = 'icon';
	if (in_array($alpha_color_image_hover, array('icons', 'zoom'))) $alpha_color_image_hover = 'dots';
	$alpha_color_components = alpha_color_is_inherit(alpha_color_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: alpha_color_array_get_keys_by_value(alpha_color_get_theme_option('meta_parts'));
	$alpha_color_counters = alpha_color_is_inherit(alpha_color_get_theme_option_from_meta('counters')) 
								? 'comments'
								: alpha_color_array_get_keys_by_value(alpha_color_get_theme_option('counters'));
	alpha_color_show_post_featured(array(
		'hover' => $alpha_color_image_hover,
		'thumb_size' => alpha_color_get_thumb_size( strpos(alpha_color_get_theme_option('body_style'), 'full')!==false || $alpha_color_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($alpha_color_components)
										? alpha_color_show_post_meta(apply_filters('alpha_color_filter_post_meta_args', array(
											'components' => $alpha_color_components,
											'counters' => $alpha_color_counters,
											'seo' => false,
											'echo' => false
											), $alpha_color_blog_style[0], $alpha_color_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'alpha-color') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>