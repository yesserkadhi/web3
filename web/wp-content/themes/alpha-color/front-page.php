<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.31
 */

get_header();

// If front-page is a static page
if (get_option('show_on_front') == 'page') {

	// If Front Page Builder is enabled - display sections
	if (alpha_color_is_on(alpha_color_get_theme_option('front_page_enabled'))) {

		if ( have_posts() ) the_post();

		$alpha_color_sections = alpha_color_array_get_keys_by_value(alpha_color_get_theme_option('front_page_sections'), 1, false);
		if (is_array($alpha_color_sections)) {
			foreach ($alpha_color_sections as $alpha_color_section) {
				get_template_part("front-page/section", $alpha_color_section);
			}
		}
	
	// Else if this page is blog archive
	} else if (is_page_template('blog.php')) {
		get_template_part('blog');

	// Else - display native page content
	} else {
		get_template_part('page');
	}

// Else get index template to show posts
} else {
	get_template_part('index');
}

get_footer();
?>