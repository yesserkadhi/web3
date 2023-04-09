<?php
/**
 * Premium tab YITH WooCommerce Request A Quote.
 *
 * @class   YITH_Request_Quote
 * @package YITH WooCommerce Request A Quote
 * @since   1.0.0
 * @author  YITH
 */

?><style>
	.landing {
		margin-right: 15px;
		border: 1px solid #d8d8d8;
		border-top: 0;
	}

	.section {
		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
		background: #fafafa;
	}

	.section h1 {
		text-align: center;
		text-transform: uppercase;
		color: #445674;
		font-size: 35px;
		font-weight: 700;
		line-height: normal;
		display: inline-block;
		width: 100%;
		margin: 50px 0 0;
	}

	.section .section-title h2 {
		vertical-align: middle;
		padding: 0;
		line-height: normal;
		font-size: 24px;
		font-weight: 600;
		color: #445674;
		text-transform: none;
		background: none;
		border: none;
		text-align: left;
	}

	.section p {
		margin: 15px 0;
		font-size: 15px;
		line-height: 28px;
		font-weight: 300;
		text-align: left;
	}

	.section ul li {
		margin-bottom: 4px;
	}

	.section.section-cta {
		background: #fff;
	}

	.cta-container,
	.landing-container {
		display: flex;
		max-width: 1200px;
		margin-left: auto;
		margin-right: auto;
		padding: 30px 0;
		align-items: center;
	}

	.landing-container-wide {
		flex-direction: column;
	}

	.cta-container {
		display: block;
		max-width: 860px;
	}

	.landing-container:after {
		display: block;
		clear: both;
		content: '';
	}

	.landing-container .col-1,
	.landing-container .col-2 {
		float: left;
		box-sizing: border-box;
		padding: 0 15px;
	}

	.landing-container .col-1 {
		width: 58.33333333%;
	}

	.landing-container .col-2 {
		width: 41.66666667%;
	}

	.landing-container .col-1 img,
	.landing-container .col-2 img,
	.landing-container .col-wide img {
		max-width: 100%;
	}

	.premium-cta {
		color: #4b4b4b;
		border-radius: 10px;
		padding: 30px 25px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		width: 100%;
		box-sizing: border-box;
	}

	.premium-cta:after {
		content: '';
		display: block;
		clear: both;
	}

	.premium-cta p {
		margin: 10px 0;
		line-height: 1.5em;
		display: inline-block;
		text-align: left;
	}

	.premium-cta a.button {
		border-radius: 25px;
		float: right;
		background: #e09004;
		box-shadow: none;
		outline: none;
		color: #fff;
		position: relative;
		padding: 10px 50px 8px;
		text-align: center;
		text-transform: uppercase;
		font-weight: 600;
		font-size: 20px;
		line-height: 25px;
		border: none;
	}

	.premium-cta a.button:hover,
	.premium-cta a.button:active,
	.wp-core-ui .yith-plugin-ui .premium-cta a.button:focus {
		color: #fff;
		background: #d28704;
		box-shadow: none;
		outline: none;
	}

	.premium-cta .highlight {
		text-transform: uppercase;
		background: none;
		font-weight: 500;
	}

    .label {
        padding: .3em .9em .4em;
        font-weight: 600;
        display: inline;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25em;
        margin-bottom:20px;
    }

    .label.new {
        background-color: #bb6c15
    }

    .label-wrapper{
        margin-bottom:15px;
    }
	@media (max-width: 768px) {
		.landing-container {
			display: block;
			padding: 50px 0 30px;
		}

		.landing-container .col-1,
		.landing-container .col-2 {
			float: none;
			width: 100%;
		}

		.premium-cta {
			display: block;
			text-align: center;
		}

		.premium-cta p {
			text-align: center;
			display: block;
			margin-bottom: 30px;
		}

		.premium-cta a.button {
			float: none;
			display: inline-block;
		}
	}

	@media (max-width: 480px) {
		.wrap {
			margin-right: 0;
		}

		.section {
			margin: 0;
		}

		.landing-container .col-1,
		.landing-container .col-2 {
			width: 100%;
			padding: 0 15px;
		}

		.section-odd .col-1 {
			float: left;
			margin-right: -100%;
		}

		.section-odd .col-2 {
			float: right;
			margin-top: 65%;
		}
	}

	@media (max-width: 320px) {
		.premium-cta a.button {
			padding: 9px 20px 9px 70px;
		}

		.section .section-title img {
			display: none;
		}
	}
</style>
<div class="landing">
	<div class="section section-cta section-odd">
		<div class="landing-container">
			<div class="premium-cta">
				<p>
					<?php
					// translators: placeholder html tags.
					echo wp_kses_post( sprintf( __( 'Upgrade to %1$spremium version%2$s of %1$sYITH Request a Quote for WooCommerce%2$s to benefit from all features!', 'yith-woocommerce-request-a-quote' ), '<span class="highlight">', '</span>' ) );
					?>
				</p>
				<a href="<?php echo esc_url( $this->get_premium_landing_uri() ); ?>" target="_blank"
					class="premium-cta-button button btn">
					<?php esc_html_e( 'UPGRADE', 'yith-woocommerce-request-a-quote' ); ?>
				</a>
			</div>
		</div>
	</div>
	<div class="one section section-even clear">
		<h1><?php esc_html_e( 'Premium Features', 'yith-woocommerce-request-a-quote' ); ?></h1>
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/002.jpg" alt="Feature 01"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Choose WHERE to show the “Add to quote” button', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'You can choose to activate the “Add to quote button” on all your product pages or on specific products, categories or tags only. You can use the built-in exclusion list to set where to show or, the other way round, where to hide the quote button and show it only on product pages or also in the WooCommerce shortcodes (like the Shop page etc.). If you want to, you can activate (or deactivate) the quote option only on out-of-stock products: the plugin is so versatile and it offers almost unlimited configuration options.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>

			</div>
		</div>
	</div>
	<div class="two section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Choose WHO will see the “Add to quote” button', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Choose whether to show the “Add to quote” button to all your users or hide it to guest users (those who haven’t registered yet or who haven’t logged in). You can also enable the quote request option only for certain user roles of your choice.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/003.jpg" alt="feature 02"/>
			</div>
		</div>
	</div>
	<div class="three section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/004.jpg" alt="Feature 03"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2>
					<?php
					esc_html_e(
						'
Customize the button colors and texts',
						'yith-woocommerce-request-a-quote'
					);
					?>
					</h2>
				</div>
				<p>
					<?php esc_html_e( 'Choose whether to show a text link or a proper button and set up every detail related to the style, like the text, the position, or the colors, to make sure it totally suits your shop layout.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="four section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Hide the product price and the “Add to cart” buttons', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Hide the price from all your products together with the Cart button if you want to enable the quote request option on the entire shop and make sure your users contact you to know about the product price. Just two clicks to transform your e-commerce store into a product catalog!', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/005.jpg" alt="Feature 04"/>
			</div>
		</div>
	</div>
	<div class="five section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/006.jpg" alt="Feature 05"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Let users monitor their list of products through the built-in widgets', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Use the widget in the header or sidebar so your users can always keep an eye on them and quickly access their list of products.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="six section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Customize the quote request page', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Set up the layout for your quote request page (show the form on the right or the bottom) and choose which details to show in the list of products. Use the shortcode on a page that you can customize as you wish, for example, with a custom image in the header or with some additional text content.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/007.jpg" alt="Feature 06"/>
			</div>
		</div>
	</div>
	<div class="seven section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/008.jpg" alt="Feature 07"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Use and customize the built-in form', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'The plugin includes a default form where you can add or remove fields, you can sort them and customize the texts. You can also enable the auto-complete option, that will automatically fill the form with their saved details, if the user is logged in, and with the optional reCaptcha as well. But the most interesting thing is that the information added by the user will automatically be linked to WooCommerce fields and embedded in the quote and in the related order.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="eight section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Use a form created with Gravity Forms or Contact Form 7', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php
					esc_html_e(
						'
If you don’t want to use the default form, the plugin however supports Gravity Forms and Contact Form 7.',
						'yith-woocommerce-request-a-quote'
					);
					?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/009.jpg" alt="Feature 08"/>
			</div>
		</div>
	</div>
	<div class="nine section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/022.jpg" alt="Feature 09"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Monitor quote requests from the table available in the plugin and download them as a CSV file', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Thanks to the table included in the plugin version 3.1, you can track all quote requests and their different status. From the same page, you will also be able to filter requests by status, customer, or date and download information as a CSV file.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="nine section section-odd clear">
		<div class="landing-container">
			<div class="col-1">
				<div class="section-title">
					<h2><?php esc_html_e( 'Create a quote manually and send it to the customer who will not have to fill out the form', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'A customer contacts you by phone or comes to your office and asks for a price estimate? With this plugin, you can create a quote manually and send it to your customer, sparing them so the trouble and time of doing that on their own.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>

			</div>
			<div class="col-2">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/010.jpg" alt="Feature 09"/>
			</div>
		</div>
	</div>
	<div class="ten section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/011.jpg" alt="Feature 10"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Enable the automatic quote option to send out the default product prices', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'The plugin allows you to create tailor-made quotes. But you can also enable automatic quotes so whenever a customer sends a request, the quote is automatically sent out showing the default prices of your products (the prices you set in your shop and that are hidden by the option “Hide prices”). You can enable this option with just one click and the plugin will do all the work for you.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>

		</div>
	</div>
	<div class="eleven section section-odd clear">
		<div class="landing-container">

			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Choose whether to enable the automatic generation of orders with the status “New quote request” for all requests submitted', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'The major strength of this plugin is the management of quote requests: you can choose whether to manage them manually or, what we really recommend, to enable the automatic generation of the order. In this way, all quote requests will be saved in the Orders panel with a custom status “New quote request”. You will be able to send your quote right from the Orders page and, if the customer accepts the quote and pays, the order status will automatically update. Clear, simple and quick.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/012.jpg" alt="Feature 11"/>
			</div>
		</div>
	</div>
	<div class="section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/013.jpg" alt="Feature 12"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Generate, send and monitor your quotes right from the admin panel', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'From the backend you can fully monitor and manage the entire quotation process: quote requests are saved in the Orders list and to send the quote you just have to open the order, set up some options and click on the button to send it. It’s just a matter of a few seconds and a few clicks.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="eleven section section-odd clear">
		<div class="landing-container">

			<div class="col-2">
				<div class="section-title">
					<h2>
					<?php
					esc_html_e(
						'
Edit the product prices and add shipping fees, extra costs or coupon codes to the quote',
						'yith-woocommerce-request-a-quote'
					);
					?>
					</h2>
				</div>
				<p>
					<?php esc_html_e( 'Before sending the quote, you can edit the product prices (by lowering them a bit to offer a discount), add shipping fees or some extra cost and apply a discount code to the quote (for example a 10% off for a customer who regularly buys from you or who is making the first order).', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/014.jpg" alt="Feature 13"/>
			</div>
		</div>
	</div>
	<div class="section section-even clear">
		<div class="landing-container">

			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/015.jpg" alt="Feature 14"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Leverage the urgency principle and set up a deadline for the quote', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Create a tailor-made offer that your user cannot reject and leverage the scarcity and urgency principles by setting an expiration date for the quote. If the discounted price is only available for a limited time, the customer will be more likely to accept it and finalize the purchase as soon as possible so as to not miss out on it.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="eleven section section-odd clear">
		<div class="landing-container">

			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Generate a PDF version of the quote that will be both attached to the email and available for download in My Account area', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Enable the generation of a PDF copy of the quote and choose to attach it to the quote email and if making it available for download in My Account area.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/016.jpg" alt="Feature 15"/>
			</div>
		</div>
	</div>

	<div class="section section-even clear">
		<div class="landing-container">

			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/0023.webp" alt="Feature 16"/>
			</div>
			<div class="col-2">
				<div class="section-title">
                    <div class="label-wrapper"><span class="label new">New</span></div>
					<h2><?php esc_html_e( 'Use the advanced Gutenberg builder to customize the Quote PDF', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Choose between 9 different layouts and customize the PDF Quote through the new advanced Gutenberg editor. You can add text blocks, images and customize the colors to create beautiful custom quotes to send to your customers.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="eleven section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Allow customers to monitor their quote requests right from My Account page', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php
					esc_html_e(
						'
Thanks to the “Quotes” section in My Account page, users will be able to monitor the status of their quote requests, download the PDF version of the quote (if enabled) and view the details of every quote request.',
						'yith-woocommerce-request-a-quote'
					);
					?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/020.jpg" alt="Feature 17"/>
			</div>
		</div>
	</div>


	<div class="section section-even clear">
		<div class="landing-container">

			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/017.jpg" alt="Feature 18"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Enable the option to “Accept | Reject” the quote', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Let your customers accept or reject the quote offer by simply clicking on the link in the email or in the PDF quote.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="eleven section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'If the quote is accepted, redirect the user right to the checkout page', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Once the quote is accepted, the customer will be redirected to the checkout page to finalize the purchase at the agreed price.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/018.jpg" alt="Feature 19"/>
			</div>
		</div>
	</div>
	<div class="section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/021.jpg" alt="Feature 20"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Enable the “Ask for a quote” button on the checkout page', 'yith-woocommerce-request-a-quote' ); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Enable this option to convert your customer’s cart into a quote request.', 'yith-woocommerce-request-a-quote' ); ?>
				</p>
			</div>
		</div>
	</div>
    <div class="eleven section section-odd clear">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <div class="label-wrapper"><span class="label new">New</span></div>
                    <h2><?php esc_html_e( 'Let customers convert their cart into a quote request', 'yith-woocommerce-request-a-quote' ); ?></h2>
                </div>
                <p>
					<?php esc_html_e( 'Show an “Ask for a quote” button on the cart page to allow customers to convert their cart content into a quote request. The button will open a modal window with the same form shown on the request a quote page.', 'yith-woocommerce-request-a-quote' ); ?>
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/024.jpeg" alt="Feature 21"/>
            </div>
        </div>
    </div>
    <div class="section section-even clear">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL ); ?>/images/025.jpeg" alt="Feature 22"/>
            </div>
            <div class="col-2">
                <div class="section-title">
                    <div class="label-wrapper"><span class="label new">New</span></div>
                    <h2><?php esc_html_e( 'Send follow-up emails to remind customers about the quote', 'yith-woocommerce-request-a-quote' ); ?></h2>
                </div>
                <p>
					<?php esc_html_e( 'The plugin includes two different follow-up emails: one can be sent to customers X days after the quote creation, and the other one X days before the quote expiration. With these emails, you can recover pending quotes, and remind your customers about your proposals.', 'yith-woocommerce-request-a-quote' ); ?>
                </p>
            </div>
        </div>
    </div>
	<div class="section section-cta section-odd">
		<div class="landing-container">
			<div class="premium-cta">
				<p>
					<?php
					// translators: placeholder html tags.
					echo sprintf( esc_html( __( 'Upgrade to %1$spremium version%2$s of %1$sYITH Request a Quote for WooCommerce%2$s to benefit from all features!', 'yith-woocommerce-request-a-quote' ) ), '<span class="highlight">', '</span>' );
					?>
				</p>
				<a href="<?php echo esc_url( $this->get_premium_landing_uri() ); ?>" target="_blank"
					class="premium-cta-button button btn">
					<?php esc_html_e( 'UPGRADE', 'yith-woocommerce-request-a-quote' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
