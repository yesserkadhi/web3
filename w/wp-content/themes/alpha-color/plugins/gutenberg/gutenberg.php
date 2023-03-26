<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'alpha_color_gutenberg_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'alpha_color_gutenberg_theme_setup9', 9 );
	function alpha_color_gutenberg_theme_setup9() {

		// Add editor styles to backend
		add_theme_support( 'editor-styles' );
		if (alpha_color_exists_gutenberg()) {
			add_action( 'wp_enqueue_scripts', 'alpha_color_gutenberg_frontend_scripts', 1100 );
			if ( ! alpha_color_get_theme_setting( 'gutenberg_add_context' ) ) {
				$styles = array(
					alpha_color_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ),
					alpha_color_get_file_url( 'plugins/gutenberg/gutenberg.css' ),
				);
				add_editor_style( $styles );
			}
		} else {
			add_editor_style( alpha_color_get_file_url('css/editor-style.css') );
		}


		add_filter( 'alpha_color_filter_merge_styles', 'alpha_color_gutenberg_merge_styles' );
		add_action( 'enqueue_block_editor_assets', 'alpha_color_gutenberg_editor_scripts' );
		add_filter( 'alpha_color_filter_localize_script_admin',	'alpha_color_gutenberg_localize_script');
		add_action( 'after_setup_theme', 'alpha_color_gutenberg_add_editor_colors' );
	}
}

// Check if Gutenberg is installed and activated
if ( ! function_exists( 'alpha_color_exists_gutenberg' ) ) {
	function alpha_color_exists_gutenberg() {
		return function_exists( 'register_block_type' );
	}
}

// Return true if Gutenberg exists and current mode is preview
if ( ! function_exists( 'alpha_color_gutenberg_is_preview' ) ) {
	function alpha_color_gutenberg_is_preview() {
		return false;
	}
}

// Enqueue custom styles
if ( !function_exists( 'alpha_color_gutenberg_frontend_scripts' ) ) {
	function alpha_color_gutenberg_frontend_scripts() {
		if (alpha_color_is_on(alpha_color_get_theme_option('debug_mode')) && alpha_color_get_file_dir('plugins/gutenberg/gutenberg.css')!='')
			wp_enqueue_style( 'alpha-color-gutenberg',  alpha_color_get_file_url('plugins/gutenberg/gutenberg.css'), array(), null );
	}
}

// Merge custom styles
if ( ! function_exists( 'alpha_color_gutenberg_merge_styles' ) ) {
	function alpha_color_gutenberg_merge_styles( $list ) {
		if ( alpha_color_exists_gutenberg() ) {
			$list[] = 'plugins/gutenberg/gutenberg.css';
		}
		return $list;
	}
}



// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'alpha_color_gutenberg_editor_scripts' ) ) {
	function alpha_color_gutenberg_editor_scripts() {

		alpha_color_admin_scripts();
		alpha_color_admin_localize_scripts();

		wp_enqueue_style( 'alpha-color-gutenberg', alpha_color_get_file_url( 'plugins/gutenberg/gutenberg.css' ), array(), null );

		// Editor scripts
		wp_enqueue_script( 'alpha-color-gutenberg-preview', alpha_color_get_file_url( 'plugins/gutenberg/gutenberg-preview.js' ), array( 'jquery' ), null, true );

	}
}

// Add plugin's specific variables to the scripts
if ( ! function_exists( 'alpha_color_gutenberg_localize_script' ) ) {
	function alpha_color_gutenberg_localize_script( $arr ) {
		$arr['color_scheme']  = alpha_color_get_theme_option( 'color_scheme' );
		return $arr;
	}
}

// Save CSS with custom colors and fonts to the gutenberg-editor-style.css
if ( ! function_exists( 'alpha_color_gutenberg_save_css' ) ) {
	add_action( 'alpha_color_action_options_save', 'alpha_color_gutenberg_save_css', 21 );
	add_action( 'trx_addons_action_save_options', 'alpha_color_gutenberg_save_css', 21 );
	function alpha_color_gutenberg_save_css() {
		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'alpha-color' )
			. "\n----------------------------------------------------------------------- */\n";

		// Get main styles
		$css = alpha_color_fgc( alpha_color_get_file_dir( 'style.css' ) );

		// Append theme-vars styles
		$css .= alpha_color_customizer_get_css(
			array(
				'colors' => alpha_color_get_theme_setting( 'separate_schemes' ) ? false : null,
			)
		);

		// Append color schemes
		if ( alpha_color_get_theme_setting( 'separate_schemes' ) ) {
			$schemes = alpha_color_get_sorted_schemes();
			if ( is_array( $schemes ) ) {
				foreach ( $schemes as $scheme => $data ) {
					$css .= alpha_color_customizer_get_css(
						array(
							'fonts'  => false,
							'colors' => $data['colors'],
							'scheme' => $scheme,
						)
					);
				}
			}
		}

		// Add context class to each selector
		if ( alpha_color_get_theme_setting( 'gutenberg_add_context' ) && function_exists( 'trx_addons_css_add_context' ) ) {
			$css = trx_addons_css_add_context(
				$css,
				array(
					'context' => '.edit-post-visual-editor ',
					'context_self' => array( 'html', 'body', '.edit-post-visual-editor' )
				)
			);
		} else {
			$css = apply_filters( 'alpha_color_filter_prepare_css', $css );
		}

		// Save styles to the file
		alpha_color_fpc( alpha_color_get_file_dir( 'plugins/gutenberg/gutenberg-preview.css' ), $msg . $css );




	}
}

// Add theme-specific colors to the Gutenberg color picker
if ( ! function_exists( 'alpha_color_gutenberg_add_editor_colors' ) ) {
	function alpha_color_gutenberg_add_editor_colors() {
		$scheme = alpha_color_get_scheme_colors();
		$groups = alpha_color_storage_get( 'scheme_color_groups' );
		$names  = alpha_color_storage_get( 'scheme_color_names' );
		$colors = array();
		foreach( $groups as $g => $group ) {
			foreach( $names as $n => $name ) {
				$c = 'main' == $g ? $n : $g . '_' . str_replace( 'text_', '', $n );
				if ( isset( $scheme[ $c ] ) ) {
					$colors[] = array(
						'name'  => ( 'main' == $g ? '' : $group['title'] . ' ' ) . $name['title'],
						'slug'  => $c,
						'color' => $scheme[ $c ]
					);
				}
			}
			// Add only one group of colors
			// Delete next condition (or add false && to them) to add all groups
			if ( 'main' == $g ) {
				break;
			}
		}
		add_theme_support( 'editor-color-palette', $colors );
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( alpha_color_exists_gutenberg() ) {
	require_once ALPHA_COLOR_THEME_DIR . 'plugins/gutenberg/gutenberg.styles.php';
}