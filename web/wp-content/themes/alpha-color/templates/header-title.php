<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

// Page (category, tag, archive, author) title

if ( alpha_color_need_page_title() ) {
	alpha_color_sc_layouts_showed('title', true);
	alpha_color_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								alpha_color_show_post_meta(apply_filters('alpha_color_filter_post_meta_args', array(
									'components' => 'categories,date,counters,edit',
									'counters' => 'views,comments,likes',
									'seo' => true
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$alpha_color_blog_title = alpha_color_get_blog_title();
							$alpha_color_blog_title_text = $alpha_color_blog_title_class = $alpha_color_blog_title_link = $alpha_color_blog_title_link_text = '';
							if (is_array($alpha_color_blog_title)) {
								$alpha_color_blog_title_text = $alpha_color_blog_title['text'];
								$alpha_color_blog_title_class = !empty($alpha_color_blog_title['class']) ? ' '.$alpha_color_blog_title['class'] : '';
								$alpha_color_blog_title_link = !empty($alpha_color_blog_title['link']) ? $alpha_color_blog_title['link'] : '';
								$alpha_color_blog_title_link_text = !empty($alpha_color_blog_title['link_text']) ? $alpha_color_blog_title['link_text'] : '';
							} else
								$alpha_color_blog_title_text = $alpha_color_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($alpha_color_blog_title_class); ?>"><?php
								$alpha_color_top_icon = alpha_color_get_category_icon();
								if (!empty($alpha_color_top_icon)) {
									$alpha_color_attr = alpha_color_getimagesize($alpha_color_top_icon);
									?><img src="<?php echo esc_url($alpha_color_top_icon); ?>"  <?php if (!empty($alpha_color_attr[3])) alpha_color_show_layout($alpha_color_attr[3]);?>><?php
								}
								echo wp_kses_post($alpha_color_blog_title_text, 'alpha_color_kses_content');
							?></h1>
							<?php
							if (!empty($alpha_color_blog_title_link) && !empty($alpha_color_blog_title_link_text)) {
								?><a href="<?php echo esc_url($alpha_color_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($alpha_color_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'alpha_color_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>