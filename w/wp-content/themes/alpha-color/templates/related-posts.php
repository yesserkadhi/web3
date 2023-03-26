<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

$alpha_color_link = get_permalink();
$alpha_color_post_format = get_post_format();
$alpha_color_post_format = empty($alpha_color_post_format) ? 'standard' : str_replace('post-format-', '', $alpha_color_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($alpha_color_post_format) ); ?>><?php
	alpha_color_show_post_featured(array(
		'thumb_size' => alpha_color_get_thumb_size( (int) alpha_color_get_theme_option('related_posts') == 1 ? 'huge' : 'big' ),
		'show_no_image' => false,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">'.wp_kses(alpha_color_get_post_categories(''), 'alpha_color_kses_content').'</div>'
							. '<h6 class="post_title entry-title"><a href="'.esc_url($alpha_color_link).'">'.esc_html(get_the_title()).'</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="'.esc_url($alpha_color_link).'">'.wp_kses_data(alpha_color_get_date()).'</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>