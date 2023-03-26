<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

$alpha_color_blog_style = explode('_', alpha_color_get_theme_option('blog_style'));
$alpha_color_columns = empty($alpha_color_blog_style[1]) ? 2 : max(2, $alpha_color_blog_style[1]);
$alpha_color_expanded = !alpha_color_sidebar_present() && alpha_color_is_on(alpha_color_get_theme_option('expand_content'));
$alpha_color_post_format = get_post_format();
$alpha_color_post_format = empty($alpha_color_post_format) ? 'standard' : str_replace('post-format-', '', $alpha_color_post_format);
$alpha_color_animation = alpha_color_get_theme_option('blog_animation');
$alpha_color_components = alpha_color_is_inherit(alpha_color_get_theme_option_from_meta('meta_parts')) 
							? 'author,date'
							: alpha_color_array_get_keys_by_value(alpha_color_get_theme_option('meta_parts'));
$alpha_color_counters = alpha_color_is_inherit(alpha_color_get_theme_option_from_meta('counters')) 
							? 'comments'
							: alpha_color_array_get_keys_by_value(alpha_color_get_theme_option('counters'));

?><div class="<?php echo esc_html($alpha_color_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'); ?>-1_<?php echo esc_attr($alpha_color_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($alpha_color_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($alpha_color_columns)
					. ' post_layout_'.esc_attr($alpha_color_blog_style[0]) 
					. ' post_layout_'.esc_attr($alpha_color_blog_style[0]).'_'.esc_attr($alpha_color_columns)
					); ?>
	<?php echo (!alpha_color_is_off($alpha_color_animation) ? ' data-animation="'.esc_attr(alpha_color_get_animation_classes($alpha_color_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	alpha_color_show_post_featured( array( 'thumb_size' => alpha_color_get_thumb_size($alpha_color_blog_style[0] == 'classic'
													? (strpos(alpha_color_get_theme_option('body_style'), 'full')!==false 
															? ( $alpha_color_columns > 2 ? 'big' : 'huge' )
															: (	$alpha_color_columns > 2
																? ($alpha_color_expanded ? 'med' : 'small')
																: ($alpha_color_expanded ? 'big' : 'med')
																)
														)
													: (strpos(alpha_color_get_theme_option('body_style'), 'full')!==false 
															? ( $alpha_color_columns > 2 ? 'masonry-big' : 'full' )
															: (	$alpha_color_columns <= 2 && $alpha_color_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($alpha_color_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('alpha_color_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

			do_action('alpha_color_action_before_post_meta'); 

			// Post meta
			if (!empty($alpha_color_components))
				alpha_color_show_post_meta(apply_filters('alpha_color_filter_post_meta_args', array(
					'components' => $alpha_color_components,
					'counters' => $alpha_color_counters,
					'seo' => false
					), $alpha_color_blog_style[0], $alpha_color_columns)
				);

			do_action('alpha_color_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$alpha_color_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($alpha_color_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($alpha_color_post_format == 'quote') {
				if (($quote = alpha_color_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					alpha_color_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($alpha_color_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($alpha_color_components))
				alpha_color_show_post_meta(apply_filters('alpha_color_filter_post_meta_args', array(
					'components' => $alpha_color_components,
					'counters' => $alpha_color_counters
					), $alpha_color_blog_style[0], $alpha_color_columns)
				);
		}
		// More button
		if ( $alpha_color_show_learn_more ) {
			?><p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'alpha-color'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>