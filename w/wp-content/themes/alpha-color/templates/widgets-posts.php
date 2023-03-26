<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

$alpha_color_post_id    = get_the_ID();
$alpha_color_post_date  = alpha_color_get_date();
$alpha_color_post_title = get_the_title();
$alpha_color_post_link  = get_permalink();
$alpha_color_post_author_id   = get_the_author_meta('ID');
$alpha_color_post_author_name = get_the_author_meta('display_name');
$alpha_color_post_author_url  = get_author_posts_url($alpha_color_post_author_id, '');

$alpha_color_args = get_query_var('alpha_color_args_widgets_posts');
$alpha_color_show_date = isset($alpha_color_args['show_date']) ? (int) $alpha_color_args['show_date'] : 1;
$alpha_color_show_image = isset($alpha_color_args['show_image']) ? (int) $alpha_color_args['show_image'] : 1;
$alpha_color_show_author = isset($alpha_color_args['show_author']) ? (int) $alpha_color_args['show_author'] : 1;
$alpha_color_show_counters = isset($alpha_color_args['show_counters']) ? (int) $alpha_color_args['show_counters'] : 1;
$alpha_color_show_categories = isset($alpha_color_args['show_categories']) ? (int) $alpha_color_args['show_categories'] : 1;

$alpha_color_output = alpha_color_storage_get('alpha_color_output_widgets_posts');

$alpha_color_post_counters_output = '';
if ( $alpha_color_show_counters ) {
	$alpha_color_post_counters_output = '<span class="post_info_item post_info_counters">'
								. alpha_color_get_post_counters('comments')
							. '</span>';
}


$alpha_color_output .= '<article class="post_item with_thumb">';

if ($alpha_color_show_image) {
	$alpha_color_post_thumb = get_the_post_thumbnail($alpha_color_post_id, alpha_color_get_thumb_size('tiny'), array(
		'alt' => the_title_attribute( array( 'echo' => false ) )
	));
	if ($alpha_color_post_thumb) $alpha_color_output .= '<div class="post_thumb">' . ($alpha_color_post_link ? '<a href="' . esc_url($alpha_color_post_link) . '">' : '') . ($alpha_color_post_thumb) . ($alpha_color_post_link ? '</a>' : '') . '</div>';
}

$alpha_color_output .= '<div class="post_content">'
			. ($alpha_color_show_categories 
					? '<div class="post_categories">'
						. alpha_color_get_post_categories()
						. $alpha_color_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($alpha_color_post_link ? '<a href="' . esc_url($alpha_color_post_link) . '">' : '') . ($alpha_color_post_title) . ($alpha_color_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('alpha_color_filter_get_post_info', 
								'<div class="post_info">'
									. ($alpha_color_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($alpha_color_post_link ? '<a href="' . esc_url($alpha_color_post_link) . '" class="post_info_date">' : '') 
											. esc_html($alpha_color_post_date) 
											. ($alpha_color_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($alpha_color_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'alpha-color') . ' ' 
											. ($alpha_color_post_link ? '<a href="' . esc_url($alpha_color_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($alpha_color_post_author_name) 
											. ($alpha_color_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$alpha_color_show_categories && $alpha_color_post_counters_output
										? $alpha_color_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
alpha_color_storage_set('alpha_color_output_widgets_posts', $alpha_color_output);
?>