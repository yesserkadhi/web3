<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$alpha_color_content = '';
$alpha_color_blog_archive_mask = '%%CONTENT%%';
$alpha_color_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $alpha_color_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($alpha_color_content = apply_filters('the_content', get_the_content())) != '') {
		if (($alpha_color_pos = strpos($alpha_color_content, $alpha_color_blog_archive_mask)) !== false) {
			$alpha_color_content = preg_replace('/(\<p\>\s*)?'.$alpha_color_blog_archive_mask.'(\s*\<\/p\>)/i', $alpha_color_blog_archive_subst, $alpha_color_content);
		} else
			$alpha_color_content .= $alpha_color_blog_archive_subst;
		$alpha_color_content = explode($alpha_color_blog_archive_mask, $alpha_color_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) alpha_color_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$alpha_color_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$alpha_color_args = alpha_color_query_add_posts_and_cats($alpha_color_args, '', alpha_color_get_theme_option('post_type'), alpha_color_get_theme_option('parent_cat'));
$alpha_color_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($alpha_color_page_number > 1) {
	$alpha_color_args['paged'] = $alpha_color_page_number;
	$alpha_color_args['ignore_sticky_posts'] = true;
}
$alpha_color_ppp = alpha_color_get_theme_option('posts_per_page');
if ((int) $alpha_color_ppp != 0)
	$alpha_color_args['posts_per_page'] = (int) $alpha_color_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($alpha_color_args);


// Add internal query vars in the new query!
if (is_array($alpha_color_content) && count($alpha_color_content) == 2) {
	set_query_var('blog_archive_start', $alpha_color_content[0]);
	set_query_var('blog_archive_end', $alpha_color_content[1]);
}

get_template_part('index');
?>