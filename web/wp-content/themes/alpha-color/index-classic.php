<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

alpha_color_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	alpha_color_show_layout(get_query_var('blog_archive_start'));

	$alpha_color_classes = 'posts_container '
						. (substr(alpha_color_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap columns_padding_bottom' : 'masonry_wrap');
	$alpha_color_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$alpha_color_sticky_out = alpha_color_get_theme_option('sticky_style')=='columns' 
							&& is_array($alpha_color_stickies) && count($alpha_color_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($alpha_color_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$alpha_color_sticky_out) {
		if (alpha_color_get_theme_option('first_post_large') && !is_paged() && !in_array(alpha_color_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($alpha_color_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($alpha_color_sticky_out && !is_sticky()) {
			$alpha_color_sticky_out = false;
			?></div><div class="<?php echo esc_attr($alpha_color_classes); ?>"><?php
		}
		get_template_part( 'content', $alpha_color_sticky_out && is_sticky() ? 'sticky' : 'classic' );
	}
	
	?></div><?php

	alpha_color_show_pagination();

	alpha_color_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>