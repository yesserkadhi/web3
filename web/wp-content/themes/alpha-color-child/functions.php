<?php
/**
 * Child-Theme functions and definitions
 */
 
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

add_action('pre_get_posts', 'search_filter');
function search_filter($query) {
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        $query->set('post_type', 'product');
    }
}

