<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( !function_exists( 'alpha_color_woocommerce_get_css' ) ) {
	add_filter( 'alpha_color_filter_get_css', 'alpha_color_woocommerce_get_css', 10, 4 );
	function alpha_color_woocommerce_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

.woocommerce .checkout table.shop_table .product-name .variation,
.woocommerce .shop_table.order_details td.product-name .variation {
	{$fonts['p_font-family']}
}
.woocommerce div.product .woocommerce-variation-price span.price,
.woocommerce ul.products li.product .post_header, .woocommerce-page ul.products li.product .post_header,
.single-product div.product .woocommerce-tabs .wc-tabs li a,
.woocommerce .shop_table th,
.woocommerce span.onsale,
.woocommerce div.product .summary .stock,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong,
.woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta strong,
.woocommerce table.cart td.product-name a, .woocommerce-page table.cart td.product-name a, 
.woocommerce #content table.cart td.product-name a, .woocommerce-page #content table.cart td.product-name a,
.woocommerce .checkout table.shop_table .product-name,
.woocommerce .shop_table.order_details td.product-name,
.woocommerce .order_details li strong,
.woocommerce-MyAccount-navigation,
.woocommerce-MyAccount-content .woocommerce-Address-title a {
	{$fonts['h5_font-family']}
}
#btn-buy,
.woocommerce ul.products li.product .button, .woocommerce div.product form.cart .button,
.woocommerce .woocommerce-message .button,
.woocommerce #review_form #respond p.form-submit input[type="submit"],
.woocommerce-page #review_form #respond p.form-submit input[type="submit"],
.woocommerce table.my_account_orders .order-actions .button,
.woocommerce .button, .woocommerce-page .button,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button
.woocommerce #respond input#submit,
.woocommerce input[type="button"], .woocommerce-page input[type="button"],
.woocommerce input[type="submit"], .woocommerce-page input[type="submit"] {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
.woocommerce ul.products li.product .post_header .post_tags,
.woocommerce div.product .product_meta span > a, .woocommerce div.product .product_meta span > span,
.woocommerce div.product form.cart .reset_variations,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta time, .woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta time {
	{$fonts['info_font-family']}
}

CSS;
		
			
			$rad = alpha_color_get_border_radius();
			$css['fonts'] .= <<<CSS
#btn-buy,
.woocommerce .button, .woocommerce-page .button,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button
.woocommerce #respond input#submit,
.woocommerce input[type="button"], .woocommerce-page input[type="button"],
.woocommerce input[type="submit"], .woocommerce-page input[type="submit"],
.woocommerce .woocommerce-message .button,
.woocommerce ul.products li.product .button,
.woocommerce div.product form.cart .button,
.woocommerce #review_form #respond p.form-submit input[type="submit"],
.woocommerce-page #review_form #respond p.form-submit input[type="submit"],
.woocommerce table.my_account_orders .order-actions .button,
.yith-woocompare-widget a.clear-all,
.single-product div.product .woocommerce-tabs .wc-tabs li a,
.widget.WOOCS_SELECTOR .woocommerce-currency-switcher-form .chosen-container-single .chosen-single {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}
.woocommerce div.product form.cart div.quantity span.q_inc, .woocommerce-page div.product form.cart div.quantity span.q_inc,
.woocommerce .shop_table.cart div.quantity span.q_inc, .woocommerce-page .shop_table.cart div.quantity span.q_inc {
	-webkit-border-radius: 0 {$rad} 0 0;
	    -ms-border-radius: 0 {$rad} 0 0;
			border-radius: 0 {$rad} 0 0;
}
.woocommerce div.product form.cart div.quantity span.q_dec, .woocommerce-page div.product form.cart div.quantity span.q_dec,
.woocommerce .shop_table.cart div.quantity span.q_dec, .woocommerce-page .shop_table.cart div.quantity span.q_dec {
	-webkit-border-radius: 0 0 {$rad} 0;
	    -ms-border-radius: 0 0 {$rad} 0;
			border-radius: 0 0 {$rad} 0;
}
CSS;
		}


		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Page header */
.woocommerce .woocommerce-breadcrumb {
	color: {$colors['text']};
}
.woocommerce .woocommerce-breadcrumb a {
	color: {$colors['text_link']};
}
.woocommerce .woocommerce-breadcrumb a:hover {
	color: {$colors['text_hover']};
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-range{
	background-color: {$colors['text_hover']};
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
	background-color: {$colors['bg_color']};
	border-color: {$colors['text_hover']};
}

/* List and Single product */
.woocommerce .woocommerce-ordering select {
	border-color: {$colors['bd_color']};
}
.woocommerce span.onsale {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button), 
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button),
.sc_layouts_menu li > ul.sc_layouts_submenu .post_header a,
.woocommerce ul.products li.product .post_header a {
	color: {$colors['alter_dark']};
}
.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button):hover, 
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button):hover,
.sc_layouts_menu li > ul.sc_layouts_submenu .post_header a:hover,
.woocommerce ul.products li.product .post_header a:hover {
	color: {$colors['alter_link']};
}
.woocommerce ul.products li.product .post_header .post_tags,
.woocommerce ul.products li.product .post_header .post_tags a {
	color: {$colors['alter_link']};
}
.woocommerce ul.products li.product .post_header .post_tags a:hover {
	color: {$colors['alter_hover']};
}
.sc_layouts_menu li > ul.sc_layouts_submenu .price,
.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,
.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins {
	color: {$colors['text']};
}
.woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del {
	color: {$colors['alter_light']};
}
.woocommerce div.product form.cart .variations td,
.woocommerce div.product form.cart .variations th,
.woocommerce div.product form.cart .variations tr:last-child th,
.woocommerce div.product form.cart .variations td + td,
.woocommerce div.product form.cart .variations th + td,
.woocommerce div.product form.cart .variations,
.woocommerce.widget_shopping_cart ul.cart_list li {
    border-color: {$colors['bd_color']};
}
.woocommerce div.product p.price span.amount, .woocommerce div.product span.price span.amount,
.woocommerce div.product p.price, .woocommerce div.product span.price {
    color: {$colors['text_hover']};
}
.woocommerce span.amount, .woocommerce-page span.amount {
	color: {$colors['text']};
}
.woocommerce table.shop_table td span.amount {
	color: {$colors['text_dark']};
}

aside.woocommerce del,
.woocommerce del, .woocommerce del > span.amount, 
.woocommerce-page del, .woocommerce-page del > span.amount {
	color: {$colors['text_light']} !important;
}
.woocommerce.widget_shopping_cart .total .amount, .woocommerce .widget_shopping_cart .total .amount, .woocommerce-page.widget_shopping_cart .total .amount, .woocommerce-page .widget_shopping_cart .total .amount {
	color: {$colors['text_hover']};
}
.woocommerce .price del:before {
	background-color: {$colors['text_light']};
}
.woocommerce div.product form.cart div.quantity span, .woocommerce-page div.product form.cart div.quantity span,
.woocommerce .shop_table.cart div.quantity span, .woocommerce-page .shop_table.cart div.quantity span {
	color: {$colors['text_dark']};
	background-color: {$colors['input_bg_color']};
}
.woocommerce div.product form.cart div.quantity span:hover, .woocommerce-page div.product form.cart div.quantity span:hover,
.woocommerce .shop_table.cart div.quantity span:hover, .woocommerce-page .shop_table.cart div.quantity span:hover {
	color: {$colors['text_hover']};
	background-color: {$colors['input_bg_color']};
}
.woocommerce div.product form.cart div.quantity input[type="number"], .woocommerce-page div.product form.cart div.quantity input[type="number"],
.woocommerce .shop_table.cart input[type="number"], .woocommerce-page .shop_table.cart div.quantity input[type="number"] {
    background-color: {$colors['input_bg_color']};
}

.woocommerce div.product .product_meta span > a,
.woocommerce div.product .product_meta span > span {
	color: {$colors['text']};
}
.woocommerce div.product .product_meta a:hover {
	color: {$colors['text_hover']};
}

.woocommerce div.product div.images .flex-viewport,
.woocommerce div.product div.images img {
	border-color: {$colors['bd_color']};
}
.woocommerce div.product div.images a:hover img {
	border-color: {$colors['text_link']};
}
.single-product div.product .trx-stretch-width .woocommerce-tabs {
    border-color: {$colors['input_bg_color']};
}
.single-product div.product .trx-stretch-width .woocommerce-tabs .wc-tabs {
    background-color: {$colors['input_bg_color']};
}
.woocommerce div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel {
	border-color: {$colors['bd_color']};
}
.single-product div.product .woocommerce-tabs .wc-tabs li a {
	color: {$colors['text_dark']};
	background-color: {$colors['input_bg_color']};
}
.single-product div.product .woocommerce-tabs .wc-tabs li.active a {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}
.single-product div.product .trx-stretch-width .woocommerce-tabs .wc-tabs li:before {
    background-color: {$colors['bd_color']};
}
.single-product div.product .woocommerce-tabs .wc-tabs li:not(.active) a:hover {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}
.single-product div.product .woocommerce-tabs .panel {
	color: {$colors['text']};
}
.woocommerce table.shop_attributes tr:nth-child(2n+1) > * {
	background-color: {$colors['alter_bg_color_04']};
}
.woocommerce table.shop_attributes tr:nth-child(2n) > *,
.woocommerce table.shop_attributes tr.alt > * {
	background-color: {$colors['alter_bg_color_02']};
}
.woocommerce table.shop_attributes th {
	color: {$colors['text_dark']};
}


/* Related Products */
.single-product .related {
	border-color: {$colors['bd_color']};
}

/* Rating */
.star-rating span,
.star-rating:before {
	color: {$colors['text_link']};
}


/* Shop mode selector */
.alpha_color_shop_mode_buttons a {
	color: {$colors['input_bg_color']};
}
.alpha_color_shop_mode_buttons a:hover {
	color: {$colors['text_hover']};
}
.shop_mode_thumbs .alpha_color_shop_mode_buttons a.woocommerce_thumbs,
.shop_mode_list .alpha_color_shop_mode_buttons a.woocommerce_list {
	color: {$colors['text_hover']};
}


/* Messages */
.woocommerce .woocommerce-message,
.woocommerce .woocommerce-info {
	background-color: {$colors['alter_bg_color']};
	border-top-color: {$colors['alter_dark']};
}
.woocommerce .woocommerce-error {
	background-color: {$colors['alter_bg_color']};
	border-top-color: {$colors['alter_link']};
}
.woocommerce .woocommerce-message:before,
.woocommerce .woocommerce-info:before {
	color: {$colors['alter_dark']};
}
.woocommerce .woocommerce-error:before {
	color: {$colors['alter_link']};
}


/* Cart */
.woocommerce table.shop_table td {
	border-color: {$colors['alter_bd_color']} !important;
	background-color: {$colors['bg_color']};
}
.woocommerce table.shop_table th {
	border-color: {$colors['alter_bd_color_02']} !important;
}
.woocommerce table.shop_table tfoot th, .woocommerce-page table.shop_table tfoot th {
	color: {$colors['text_dark']};
	border-color: transparent !important;
	background-color: transparent;
}
.woocommerce .quantity input.qty, .woocommerce #content .quantity input.qty, .woocommerce-page .quantity input.qty, .woocommerce-page #content .quantity input.qty {
	color: {$colors['input_dark']};
}
.woocommerce .cart-collaterals .cart_totals table select,
.woocommerce-page .cart-collaterals .cart_totals table select {
	color: {$colors['input_text']};
	background-color: {$colors['input_bg_color']};
}
.woocommerce .cart-collaterals .cart_totals table select:focus, .woocommerce-page .cart-collaterals .cart_totals table select:focus {
	color: {$colors['input_dark']};
	background-color: {$colors['input_bg_hover']};
}
.woocommerce .cart-collaterals .shipping_calculator .shipping-calculator-button:after,
.woocommerce-page .cart-collaterals .shipping_calculator .shipping-calculator-button:after {
	color: {$colors['text_dark']};
}
.woocommerce table.shop_table .cart-subtotal .amount, .woocommerce-page table.shop_table .cart-subtotal .amount,
.woocommerce table.shop_table .shipping td, .woocommerce-page table.shop_table .shipping td {
	color: {$colors['text_dark']};
}
.woocommerce table.cart td+td a, .woocommerce #content table.cart td+td a, .woocommerce-page table.cart td+td a, .woocommerce-page #content table.cart td+td a,
.woocommerce table.cart td+td span, .woocommerce #content table.cart td+td span, .woocommerce-page table.cart td+td span, .woocommerce-page #content table.cart td+td span {
	color: {$colors['text_dark']};
}
.woocommerce table.cart td+td a:hover, .woocommerce #content table.cart td+td a:hover, .woocommerce-page table.cart td+td a:hover, .woocommerce-page #content table.cart td+td a:hover {
	color: {$colors['text_link']};
}
#add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text {
	border-color: {$colors['input_bd_color']};
}


/* Checkout */
#add_payment_method #payment ul.payment_methods, .woocommerce-cart #payment ul.payment_methods, .woocommerce-checkout #payment ul.payment_methods {
	border-color:{$colors['bd_color']};
}
#add_payment_method #payment div.payment_box, .woocommerce-cart #payment div.payment_box, .woocommerce-checkout #payment div.payment_box {
	color:{$colors['input_dark']};
	background-color:{$colors['input_bg_hover']};
}
#add_payment_method #payment div.payment_box:before, .woocommerce-cart #payment div.payment_box:before, .woocommerce-checkout #payment div.payment_box:before {
	border-color: transparent transparent {$colors['input_bg_hover']};
}
.woocommerce .order_details li strong, .woocommerce-page .order_details li strong {
	color: {$colors['text_dark']};
}
.woocommerce .order_details.woocommerce-thankyou-order-details {
	color:{$colors['alter_text']};
	background-color:{$colors['alter_bg_color']};
}
.woocommerce .order_details.woocommerce-thankyou-order-details strong {
	color:{$colors['alter_dark']};
}

/* My Account */
.woocommerce-account .woocommerce-MyAccount-navigation,
.woocommerce-MyAccount-navigation ul li,
.woocommerce-MyAccount-navigation li+li {
	border-color: {$colors['bd_color']};
}
.woocommerce-MyAccount-navigation li.is-active a {
	color: {$colors['text_link']};
}
.woocommerce-MyAccount-content .my_account_orders .button {
	color: {$colors['text_link']};
}
.woocommerce-MyAccount-content .my_account_orders .button:hover {
	color: {$colors['text_hover']};
}

/* Widgets */
.widget_product_search form:after {
	color: {$colors['input_light']};
}
.widget_product_search form:hover:after {
	color: {$colors['input_dark']};
}
.widget_shopping_cart .total {
	color: {$colors['text_dark']};
	border-color: {$colors['bd_color']};
}
.woocommerce ul.cart_list li dl,
.woocommerce-page ul.cart_list li dl,
.woocommerce ul.product_list_widget li dl,
.woocommerce-page ul.product_list_widget li dl {
	border-color: {$colors['bd_color']};
}
.widget_layered_nav ul li.chosen a {
	color: {$colors['text_dark']};
}
.widget_price_filter .price_slider_wrapper .ui-widget-content { 
	background: {$colors['text_light']};
}
.widget_price_filter .price_label span {
	color: {$colors['text']};
}
.woocommerce .shop_mode_list ul.products li.product .price, .woocommerce-page .shop_mode_list ul.products li.product .price {
    color: {$colors['text_hover']};
}


/* Third-party plugins
---------------------------------------------- */
.yith_magnifier_zoom_wrap .yith_magnifier_zoom_magnifier {
	border-color: {$colors['bd_color']};
}

.yith-woocompare-widget a.clear-all {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}
.yith-woocompare-widget a.clear-all:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['alter_hover']};
}

.widget.WOOCS_SELECTOR .woocommerce-currency-switcher-form .chosen-container-single .chosen-single {
	color: {$colors['input_text']};
	background: {$colors['input_bg_color']};
}
.widget.WOOCS_SELECTOR .woocommerce-currency-switcher-form .chosen-container-single .chosen-single:hover {
	color: {$colors['input_dark']};
	background: {$colors['input_bg_hover']};
}
.widget.WOOCS_SELECTOR .woocommerce-currency-switcher-form .chosen-container .chosen-drop {
	color: {$colors['input_dark']};
	background: {$colors['input_bg_hover']};
	border-color: {$colors['input_bd_hover']};
}
.widget.WOOCS_SELECTOR .woocommerce-currency-switcher-form .chosen-container .chosen-results li {
	color: {$colors['input_dark']};
}
.widget.WOOCS_SELECTOR .woocommerce-currency-switcher-form .chosen-container .chosen-results li:hover,
.widget.WOOCS_SELECTOR .woocommerce-currency-switcher-form .chosen-container .chosen-results li.highlighted,
.widget.WOOCS_SELECTOR .woocommerce-currency-switcher-form .chosen-container .chosen-results li.result-selected {
	color: {$colors['alter_link']} !important;
}
.woocommerce ul.products li.product .post_data:before {
    background: linear-gradient(to right, {$colors['text_link2']} 0%,{$colors['text_link2']} 33.33%,{$colors['text_link']} 33.33%,{$colors['text_link']} 66.66%,{$colors['text_hover']} 66.66%, {$colors['text_hover']} 100%);
}


/* WooCommerce Search widget */
.trx_addons_woocommerce_search_type_inline .trx_addons_woocommerce_search_form_field input[type="text"],
.trx_addons_woocommerce_search_type_inline .trx_addons_woocommerce_search_form_field .trx_addons_woocommerce_search_form_field_label {
	border-color: {$colors['text_dark']};
	color: {$colors['text_dark']};
}
.trx_addons_woocommerce_search_type_inline .trx_addons_woocommerce_search_form_field input[type="text"]:focus,
.trx_addons_woocommerce_search_type_inline .trx_addons_woocommerce_search_form_field .trx_addons_woocommerce_search_form_field_label:hover {
	border-color: {$colors['text_hover']};
	color: {$colors['text_hover']};
}
.trx_addons_woocommerce_search_type_inline .trx_addons_woocommerce_search_form_field_list {
	color: {$colors['alter_text']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color']};
}
.trx_addons_woocommerce_search_type_inline .trx_addons_woocommerce_search_form_field_list li:hover {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_hover']};
}

.trx_addons_woocommerce_search_type_inline  .trx_addons_woocommerce_search_form_text{
    color: {$colors['text']};
}



CSS;
		}
		
		return $css;
	}
}
?>