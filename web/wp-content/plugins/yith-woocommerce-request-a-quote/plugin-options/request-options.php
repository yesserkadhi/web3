<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @package YITH WooCommerce Request a quote
 * @since   3.0.0
 * @author  YITH
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) || ! defined( 'YITH_YWRAQ_VERSION' ) ) {
	exit;
}

return array(

	'request' => array(
		'page_settings'             => array(
			'name' => esc_html__( '"Request quote" page options', 'yith-woocommerce-request-a-quote' ),
			'type' => 'title',
			'id'   => 'ywraq_page_settings',
		),
		'page_id'                   => array(
			'name'     => esc_html__( '"Request a quote" page', 'yith-woocommerce-request-a-quote' ),
			'desc'     => sprintf(
				'%s<br/>%s<br/>%s',
				esc_html__( 'Choose from this list the page on which users will see the list of products added to the quote and send the request.', 'yith-woocommerce-request-a-quote' ),
				esc_html__( 'Please note: if you choose a page different from the default one (request quote) you need to insert', 'yith-woocommerce-request-a-quote' ),
				esc_html__( 'in the page the following shortcode: [yith_ywraq_request_quote] ', 'yith-woocommerce-request-a-quote' )
			),

			'id'       => 'ywraq_page_id',
			'type'     => 'single_select_page',
			'class'    => 'wc-enhanced-select',
			'css'      => 'min-width:300px',
			'desc_tip' => false,
		),

		'html_create_page'          => array(
			'type'             => 'yith-field',
			'yith-type'        => 'html',
			'yith-display-row' => false,
			'html'             => sprintf(
				'<div class="ywraq-create-page">%s <a href="%s">%s</a></div>',
				esc_html_x( 'or', 'part of the string (or Create a page) inside admin panel', 'yith-woocommerce-request-a-quote' ),
				esc_url( admin_url( 'post-new.php?post_type=page' ) ),
				esc_html__( 'Create a page', 'yith-woocommerce-request-a-quote' )
			),
		),

		'page_list_layout_template' => array(
			'name'      => esc_html__( 'Page Layout', 'yith-woocommerce-request-a-quote' ),
			'desc'      => esc_html__( 'Choose the layout for "Request a quote" page.', 'yith-woocommerce-request-a-quote' ),
			'id'        => 'ywraq_page_list_layout_template',
			'type'      => 'yith-field',
			'yith-type' => 'radio',
			'options'   => array(
				'wide'     => esc_html__( 'Product list on left side, form on right side', 'yith-woocommerce-request-a-quote' ),
				'vertical' => esc_html__( 'Product list above, form below', 'yith-woocommerce-request-a-quote' ),
			),
			'default'   => 'vertical',
		),
		'show_update_list'          => array(
			'name'      => esc_html__( 'Show "Update List" button', 'yith-woocommerce-request-a-quote' ),
			'desc'      => esc_html__( 'Enable to show the "Update list" button.', 'yith-woocommerce-request-a-quote' ),
			'id'        => 'ywraq_show_update_list',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
			'default'   => 'yes',
		),
		'update_list_label'         => array(
			'name'      => esc_html__( '"Update List" label', 'yith-woocommerce-request-a-quote' ),
			'desc'      => esc_html__( 'Enter the button\'s label.', 'yith-woocommerce-request-a-quote' ),
			'id'        => 'ywraq_update_list_label',
			'type'      => 'yith-field',
			'yith-type' => 'text',
			'deps'      => array(
				'id'    => 'ywraq_show_update_list',
				'value' => 'yes',
			),
			'default'   => esc_html__( 'Update List', 'yith-woocommerce-request-a-quote' ),
		),
		'add_privacy_checkbox'      => array(
			'name'      => __( 'Add Privacy Policy', 'yith-woocommerce-request-a-quote' ),
			'desc'      => __( 'Enable to show a privacy policy checkbox in the form.', 'yith-woocommerce-request-a-quote' ),
			'id'        => 'ywraq_add_privacy_checkbox',
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
			'default'   => 'no',
		),
		'privacy_label'             => array(
			'name'      => __( 'Request a quote Privacy Policy Label', 'yith-woocommerce-request-a-quote' ),
			'desc'      => __( 'You can use the shortcode [terms] and [privacy_policy] (from WooCommerce 3.4.0)' ),
			'id'        => 'ywraq_privacy_label',
			'type'      => 'yith-field',
			'yith-type' => 'text',
			'default'   => __( 'I have read and agree to the website terms and conditions.', 'yith-woocommerce-request-a-quote' ),
			'deps'      => array(
				'id'    => 'ywraq_add_privacy_checkbox',
				'value' => 'yes',
				'type'  => 'hide',
			),
		),
		'privacy_description'       => array(
			'name'      => __( 'Request a quote Privacy Policy', 'yith-woocommerce-request-a-quote' ),
			'desc'      => __( 'You can use the shortcode [terms] and [privacy_policy] (from WooCommerce 3.4.0)' ),
			'id'        => 'ywraq_privacy_description',
			'type'      => 'yith-field',
			'yith-type' => 'textarea',
			'default'   => __( 'Your personal data will be used to process your request, support your experience throughout this website, and for other purposes described in our  [privacy_policy].', 'yith-woocommerce-request-a-quote' ),
			'deps'      => array(
				'id'    => 'ywraq_add_privacy_checkbox',
				'value' => 'yes',
				'type'  => 'hide',
			),
		),
		'page_settings_end'         => array(
			'type' => 'sectionend',
			'id'   => 'ywraq_page_settings_end',
		),

	),
);
