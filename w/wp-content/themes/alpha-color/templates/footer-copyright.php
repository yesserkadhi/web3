<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0.10
 */

// Copyright area
$alpha_color_footer_scheme =  alpha_color_is_inherit(alpha_color_get_theme_option('footer_scheme')) ? alpha_color_get_theme_option('color_scheme') : alpha_color_get_theme_option('footer_scheme');
$alpha_color_copyright_scheme = alpha_color_is_inherit(alpha_color_get_theme_option('copyright_scheme')) ? $alpha_color_footer_scheme : alpha_color_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($alpha_color_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$alpha_color_copyright = alpha_color_prepare_macros(alpha_color_get_theme_option('copyright'));
				if (!empty($alpha_color_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $alpha_color_copyright, $alpha_color_matches)) {
						$alpha_color_copyright = str_replace($alpha_color_matches[1], date_i18n(str_replace(array('{', '}'), '', $alpha_color_matches[1])), $alpha_color_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($alpha_color_copyright));
				}
			?></div>
		</div>
	</div>
</div>
