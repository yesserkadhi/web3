<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

$alpha_color_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$alpha_color_post_format = get_post_format();
$alpha_color_post_format = empty($alpha_color_post_format) ? 'standard' : str_replace('post-format-', '', $alpha_color_post_format);
$alpha_color_animation = alpha_color_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($alpha_color_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($alpha_color_post_format) ); ?>
	<?php echo (!alpha_color_is_off($alpha_color_animation) ? ' data-animation="'.esc_attr(alpha_color_get_animation_classes($alpha_color_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	alpha_color_show_post_featured(array(
		'thumb_size' => alpha_color_get_thumb_size($alpha_color_columns==1 ? 'big' : ($alpha_color_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($alpha_color_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			alpha_color_show_post_meta(apply_filters('alpha_color_filter_post_meta_args', array(), 'sticky', $alpha_color_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>