<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

alpha_color_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	alpha_color_show_layout(get_query_var('blog_archive_start'));

	$alpha_color_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$alpha_color_sticky_out = alpha_color_get_theme_option('sticky_style')=='columns' 
							&& is_array($alpha_color_stickies) && count($alpha_color_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$alpha_color_cat = alpha_color_get_theme_option('parent_cat');
	$alpha_color_post_type = alpha_color_get_theme_option('post_type');
	$alpha_color_taxonomy = alpha_color_get_post_type_taxonomy($alpha_color_post_type);
	$alpha_color_show_filters = alpha_color_get_theme_option('show_filters');
	$alpha_color_tabs = array();
	if (!alpha_color_is_off($alpha_color_show_filters)) {
		$alpha_color_args = array(
			'type'			=> $alpha_color_post_type,
			'child_of'		=> $alpha_color_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $alpha_color_taxonomy,
			'pad_counts'	=> false
		);
		$alpha_color_portfolio_list = get_terms($alpha_color_args);
		if (is_array($alpha_color_portfolio_list) && count($alpha_color_portfolio_list) > 0) {
			$alpha_color_tabs[$alpha_color_cat] = esc_html__('All', 'alpha-color');
			foreach ($alpha_color_portfolio_list as $alpha_color_term) {
				if (isset($alpha_color_term->term_id)) $alpha_color_tabs[$alpha_color_term->term_id] = $alpha_color_term->name;
			}
		}
	}
	if (count($alpha_color_tabs) > 0) {
		$alpha_color_portfolio_filters_ajax = true;
		$alpha_color_portfolio_filters_active = $alpha_color_cat;
		$alpha_color_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters alpha_color_tabs alpha_color_tabs_ajax">
			<ul class="portfolio_titles alpha_color_tabs_titles">
				<?php
				foreach ($alpha_color_tabs as $alpha_color_id=>$alpha_color_title) {
					?><li><a href="<?php echo esc_url(alpha_color_get_hash_link(sprintf('#%s_%s_content', $alpha_color_portfolio_filters_id, $alpha_color_id))); ?>" data-tab="<?php echo esc_attr($alpha_color_id); ?>"><?php echo esc_html($alpha_color_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$alpha_color_ppp = alpha_color_get_theme_option('posts_per_page');
			if (alpha_color_is_inherit($alpha_color_ppp)) $alpha_color_ppp = '';
			foreach ($alpha_color_tabs as $alpha_color_id=>$alpha_color_title) {
				$alpha_color_portfolio_need_content = $alpha_color_id==$alpha_color_portfolio_filters_active || !$alpha_color_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $alpha_color_portfolio_filters_id, $alpha_color_id)); ?>"
					class="portfolio_content alpha_color_tabs_content"
					data-blog-template="<?php echo esc_attr(alpha_color_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(alpha_color_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($alpha_color_ppp); ?>"
					data-post-type="<?php echo esc_attr($alpha_color_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($alpha_color_taxonomy); ?>"
					data-cat="<?php echo esc_attr($alpha_color_id); ?>"
					data-parent-cat="<?php echo esc_attr($alpha_color_cat); ?>"
					data-need-content="<?php echo (false===$alpha_color_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($alpha_color_portfolio_need_content) 
						alpha_color_show_portfolio_posts(array(
							'cat' => $alpha_color_id,
							'parent_cat' => $alpha_color_cat,
							'taxonomy' => $alpha_color_taxonomy,
							'post_type' => $alpha_color_post_type,
							'page' => 1,
							'sticky' => $alpha_color_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		alpha_color_show_portfolio_posts(array(
			'cat' => $alpha_color_cat,
			'parent_cat' => $alpha_color_cat,
			'taxonomy' => $alpha_color_taxonomy,
			'post_type' => $alpha_color_post_type,
			'page' => 1,
			'sticky' => $alpha_color_sticky_out
			)
		);
	}

	alpha_color_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>