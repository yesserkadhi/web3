<?php

// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'alpha_color_gutenberg_get_css' ) ) {
	add_filter( 'alpha_color_filter_get_css', 'alpha_color_gutenberg_get_css', 10, 4 );
	function alpha_color_gutenberg_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$fonts['p_font-family'] = str_replace(';', ' !important;', $fonts['p_font-family']);
			$css['fonts']           .= <<<CSS
			
.editor-styles-wrapper p,
.editor-block-list__block {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}

.editor-post-title__block .editor-post-title__input {
	{$fonts['h1_font-family']}
	{$fonts['h1_font-size']}
	{$fonts['h1_font-weight']}
	{$fonts['h1_font-style']}
	{$fonts['h1_line-height']}
	{$fonts['h1_text-decoration']}
	{$fonts['h1_text-transform']}
	{$fonts['h1_letter-spacing']}
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.style-bg:before,
.style-bg-top:before,
.style-bg-left:before  {
	background-color: {$colors['alter_bg_color']};
}

/* Theme-specific colors */
.has-bg-color-color {		color: {$colors['bg_color']}; }
.has-bd-color-color {		color: {$colors['bd_color']}; }
.has-text-dark-color {		color: {$colors['text_dark']}; }
.has-text-link-color {		color: {$colors['text_link']}; }
.has-text-hover-color {		color: {$colors['text_hover']}; }
.has-text-link-2-color {	color: {$colors['text_link2']}; }
.has-text-hover-2-color {	color: {$colors['text_hover2']}; }
.has-text-link-3-color {	color: {$colors['text_link3']}; }
.has-text-hover-3-color {	color: {$colors['text_hover3']}; }

.has-bg-color-background-color {		background-color: {$colors['bg_color']};}
.has-bd-color-background-color {		background-color: {$colors['bd_color']}; }
.has-text-background-color {			background-color: {$colors['text']}; }
.has-text-light-background-color {		background-color: {$colors['text_light']}; }
.has-text-dark-background-color {		background-color: {$colors['text_dark']}; }
.has-text-link-background-color {		background-color: {$colors['text_link']}; }
.has-text-hover-background-color {		background-color: {$colors['text_hover']}; }
.has-text-link-2-background-color {		background-color: {$colors['text_link2']}; }
.has-text-hover-2-background-color {	background-color: {$colors['text_hover2']}; }
.has-text-link-3-background-color {		background-color: {$colors['text_link3']}; }
.has-text-hover-3-background-color {	background-color: {$colors['text_hover3']}; }

.editor-post-title__block .editor-post-title__input {
	color: {$colors['text_dark']};
}

/* Gutenberg Blockqoute */
blockquote.wp-block-quote {
	color: {$colors['text_dark']};
	background: {$colors['bg_color_0']};
}
.wp-block-pullquote blockquote {
	color: {$colors['text_dark']};
	background: {$colors['bg_color_0']};
}

blockquote.wp-block-quote a, blockquote.wp-block-quote p a,
blockquote.wp-block-quote cite, blockquote.wp-block-quote p cite,
.wp-block-quote .wp-block-quote__citation,
 .wp-block-pullquote .wp-block-pullquote__citation {
	color: {$colors['text_dark']};
}
blockquote.wp-block-quote > a, blockquote.wp-block-quote > p > a:hover {
	color: {$colors['text_link']};
}
blockquote.wp-block-quote:before {
	color: {$colors['text_link']};
}

.wp-block-table th {
	color: {$colors['extra_dark']};
	background-color: {$colors['extra_bg_color']};
}
.wp-block-table.is-style-stripes > tbody > tr:nth-child(2n+1) > td {
	background-color: {$colors['alter_bg_color_04']};
}
.wp-block-table > tbody > tr:nth-child(2n) > td {
	background-color: {$colors['alter_bg_color_04']};
}
.wp-block-table.is-style-stripes > tbody > tr:nth-child(2n) > td {
	background-color: {$colors['alter_bg_color_02']};
}



CSS;
		}

		return $css;
	}
}

