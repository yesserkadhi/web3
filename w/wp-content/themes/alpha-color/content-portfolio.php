<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($alpha_color_columns).' post_format_'.esc_attr($alpha_color_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!alpha_color_is_off($alpha_color_animation) ? ' data-animation="'.esc_attr(alpha_color_get_animation_classes($alpha_color_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$alpha_color_image_hover = alpha_color_get_theme_option('image_hover');
	// Featured image
	alpha_color_show_post_featured(array(
		'thumb_size' => alpha_color_get_thumb_size(strpos(alpha_color_get_theme_option('body_style'), 'full')!==false || $alpha_color_columns < 3 
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $alpha_color_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $alpha_color_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>