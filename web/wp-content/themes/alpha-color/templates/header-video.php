<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.14
 */
$alpha_color_header_video = alpha_color_get_header_video();
$alpha_color_embed_video = '';
if (!empty($alpha_color_header_video) && !alpha_color_is_from_uploads($alpha_color_header_video)) {
	if (alpha_color_is_youtube_url($alpha_color_header_video) && preg_match('/[=\/]([^=\/]*)$/', $alpha_color_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$alpha_color_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($alpha_color_header_video) . '[/embed]' ));
			$alpha_color_embed_video = alpha_color_make_video_autoplay($alpha_color_embed_video);
		} else {
			$alpha_color_header_video = str_replace('/watch?v=', '/embed/', $alpha_color_header_video);
			$alpha_color_header_video = alpha_color_add_to_url($alpha_color_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$alpha_color_embed_video = '<iframe src="' . esc_url($alpha_color_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php alpha_color_show_layout($alpha_color_embed_video); ?></div><?php
	}
}
?>