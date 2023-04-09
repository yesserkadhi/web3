<?php
/**
 * The style "default" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_blogger');

if ($args['slider']) {
	?><div class="slider-slide swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$post_link = get_permalink();
$post_title = get_the_title();

global $product;

?><div <?php post_class( 'sc_blogger_item post_format_'.esc_attr($post_format) ); ?>><?php

	// Featured image
	trx_addons_get_template_part('templates/tpl.featured.php',
									'trx_addons_args_featured',
									apply_filters('trx_addons_filter_args_featured', array(
														'class' => 'sc_blogger_item_featured',
														'hover' => 'zoomin',
														'thumb_size' => apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size((int)$args['columns'] > 2 ? 'medium' : 'big'), 'blogger-default')
														), 'blogger-default')
								);

	// Post content
	?><div class="sc_blogger_item_content entry-content">


    <div class="post_data">
        <div class="post_data_inner">
            <div class="post_header entry-header">
                <h2 class="woocommerce-loop-product__title">
                    <a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
                </h2>
            </div><!-- /.post_header -->
            <div class="price_wrap">
					<span class="price">
						<?php

                        if($product->is_type('variable')){
                            echo esc_html__('Starting at','alpha-color') . ' ' . get_woocommerce_currency_symbol() . $product->get_variation_price('min');
                        } else{
                            echo wp_kses( $product->get_price_html(), 'alpha_color_kses_content' );
                        }

                        ?>
					</span>
            </div><!-- /.price_wrap -->
            <?php echo wp_kses( wc_get_rating_html( $product->get_average_rating() ), 'alpha_color_kses_content' ); ?>
        </div><!-- /.post_data_inner -->
    </div><!-- /.post_data -->

		
	</div><!-- .entry-content --><?php
	
?></div><!-- .sc_blogger_item --><?php

if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
?>