(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	/*
		try {
			$('.lgx_app_item_link').tooltipster();
		} catch(e) {
			//console.log('not start');
		}
	*/

	jQuery(document).ready(function ($) {

		//console.log('I am loaded!');

	

		if ( $('.lgx_lsw_preloader').length ) {
			$('body').find('.lgx_parallax_app').each(function () {
				var lgx_lsw_preloader_item = $(this).children('.lgx_lsw_preloader');
				$(document).ready(function() {
					//alert('yes');
					$(lgx_lsw_preloader_item).animate({ opacity: 0 }, 600).remove();
				})
			})
		}
	})//DOM

})( jQuery );
