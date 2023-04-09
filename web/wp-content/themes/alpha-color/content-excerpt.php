<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

$alpha_color_post_format = get_post_format();
$alpha_color_post_format = empty($alpha_color_post_format) ? 'standard' : str_replace('post-format-', '', $alpha_color_post_format);
$alpha_color_animation = alpha_color_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($alpha_color_post_format) ); ?>
	<?php echo (!alpha_color_is_off($alpha_color_animation) ? ' data-animation="'.esc_attr(alpha_color_get_animation_classes($alpha_color_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

    // Title and post meta
    if (get_the_title() != '') {
        ?>
        <div class="post_header entry-header">
            <?php
            do_action('alpha_color_action_before_post_title');

            // Post title
            the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

            do_action('alpha_color_action_before_post_meta');

            ?>
        </div><!-- .post_header --><?php
    }

	// Featured image
	alpha_color_show_post_featured(array( 'thumb_size' => alpha_color_get_thumb_size( strpos(alpha_color_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));


	
	// Post content
	?><div class="post_content entry-content"><?php
		if (alpha_color_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'alpha-color' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'alpha-color' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$alpha_color_show_learn_more = !in_array($alpha_color_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
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
            ?></div><div class="post-bottom"><?php

            // Post meta
            $alpha_color_components = alpha_color_is_inherit(alpha_color_get_theme_option_from_meta('meta_parts'))
                ? 'author,date,counters'
                : alpha_color_array_get_keys_by_value(alpha_color_get_theme_option('meta_parts'));
            $alpha_color_counters = alpha_color_is_inherit(alpha_color_get_theme_option_from_meta('counters'))
                ? 'comments'
                : alpha_color_array_get_keys_by_value(alpha_color_get_theme_option('counters'));

            if (!empty($alpha_color_components))
                alpha_color_show_post_meta(apply_filters('alpha_color_filter_post_meta_args', array(
                        'components' => $alpha_color_components,
                        'counters' => $alpha_color_counters,
                        'seo' => false
                    ), 'excerpt', 1)
                );

            // More button
            if ( $alpha_color_show_learn_more ) {
                ?><a class="sc_button sc_button_simple" href="<?php the_permalink(); ?>"><?php esc_html_e('Continue Reading', 'alpha-color'); ?></a><?php
            }

		}
	?></div></div><!-- .entry-content -->
</article>