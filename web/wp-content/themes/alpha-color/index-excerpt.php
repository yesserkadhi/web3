<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

alpha_color_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	alpha_color_show_layout(get_query_var('blog_archive_start'));

	?><div class="posts_container"><?php
	
	$alpha_color_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$alpha_color_sticky_out = alpha_color_get_theme_option('sticky_style')=='columns' 
							&& is_array($alpha_color_stickies) && count($alpha_color_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($alpha_color_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($alpha_color_sticky_out && !is_sticky()) {
			$alpha_color_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $alpha_color_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($alpha_color_sticky_out) {
		$alpha_color_sticky_out = false;
		?></div><?php
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