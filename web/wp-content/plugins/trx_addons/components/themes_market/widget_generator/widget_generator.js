/**
 * Widget generator script
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.36
 */

(function(){
	"use strict";

	var widget_obj = null, widget_content = "\
<div id=\"{{uid}}\"></div>\n\
<script>\n\
	(function() {\n\
		var s = document.createElement('script');\n\
			s.type = 'text/javascript';\n\
			s.async = true;\n\
			s.src = '{{widget}}';\n\
			s.onload = function () {\n\
			new TRX_Addons_Widget_Themes({\n\
				downloads: '{{downloads}}',\n\
				uid: '{{uid}}',\n\
				logo: '{{logo}}',\n\
				logo_link: '{{logo_link}}',\n\
				style: '{{style}}',\n\
				affid: '{{affid}}',\n\
				title: '{{title}}',\n\
				market: [{{market}}],\n\
				category: [{{category}}],\n\
				page: 1,\n\
				count: {{count}},\n\
				columns: {{columns}},\n\
				orderby: '{{orderby}}',\n\
				order: '{{order}}',\n\
				hide_title: '{{hide_title}}',\n\
				hide_price: '{{hide_price}}',\n\
				hide_meta: '{{hide_meta}}',\n\
				hide_logo: '{{hide_logo}}',\n\
				hide_pagination: '{{hide_pagination}}',\n\
				disable_animation: '{{disable_animation}}',\n\
				msg_no_themes: '{{msg_no_themes}}'\n\
			});\n\
		};\n\
		var h = document.getElementsByTagName('script')[0];\n\
		h.parentNode.insertBefore(s, h);\n\
	})();\n\
</script>\
";

	jQuery(document).ready(function() {
		trx_addons_widget_generator_update();
		jQuery('.widget_generator_form input, .widget_generator_form select').on('change', function() {
			trx_addons_widget_generator_update();
		});
	});
	
	// Get new parameters
	function trx_addons_widget_generator_get_values() {
		// Detect current page or 1 (if first run)
		var page = Math.max(1, Number(jQuery('.trx_addons_widget_themes_pagination').data('page')));
		if (isNaN(page)) page = 1;
		// Get data from fields
		var data = {
			widget: TRX_ADDONS_WIDGET_GENERATOR['widget_url'],
			downloads: TRX_ADDONS_WIDGET_GENERATOR['downloads_url'],
			uid: TRX_ADDONS_WIDGET_GENERATOR['uid'],
			logo: TRX_ADDONS_WIDGET_GENERATOR['logo'],
			logo_link: TRX_ADDONS_WIDGET_GENERATOR['logo_link'],
			msg_no_themes: TRX_ADDONS_WIDGET_GENERATOR['msg_no_themes'],
			style: jQuery('select[name="style"]').val(),
			affid: jQuery('input[name="affid"]').val(),
			title: jQuery('input[name="title"]').val(),
			page: 1,	//page
			count: jQuery('input[name="count"]').val(),
			columns: jQuery('input[name="columns"]').val(),
			market: jQuery('select[name="market"]').val(),
			category: jQuery('select[name="category"]').val(),
			orderby: jQuery('select[name="orderby"]').val(),
			order: jQuery('select[name="order"]').val(),
			hide_title: jQuery('input[name="hide_title"]:checked').length,
			hide_price: jQuery('input[name="hide_price"]:checked').length,
			hide_meta: jQuery('input[name="hide_meta"]:checked').length,
			hide_logo: jQuery('input[name="hide_logo"]:checked').length,
			hide_pagination: jQuery('input[name="hide_pagination"]:checked').length,
			disable_animation: jQuery('input[name="disable_animation"]:checked').length
		};
		if (!data.market) data.market = '';
		if (!data.category) data.category = '';
		return data;
	}
	
	// Update preview area with new parameters
	function trx_addons_widget_generator_update() {
		// Get data from fields
		var data = trx_addons_widget_generator_get_values();
		// Update js code in textarea
		var src = widget_content
						.replace(/\{\{widget\}\}/g, data.widget)
						.replace(/\{\{downloads\}\}/g, data.downloads)
						.replace(/\{\{uid\}\}/g, data.uid)
						.replace(/\{\{style\}\}/g, data.style)
						.replace(/\{\{logo\}\}/g, data.logo)
						.replace(/\{\{logo_link\}\}/g, data.logo_link)
						.replace(/\{\{msg_no_themes\}\}/g, data.msg_no_themes)
						.replace(/\{\{affid\}\}/g, data.affid)
						.replace(/\{\{title\}\}/g, data.title)
						.replace(/\{\{market\}\}/g, data.market)
						.replace(/\{\{category\}\}/g, data.category)
						.replace(/\{\{count\}\}/g, data.count)
						.replace(/\{\{columns\}\}/g, data.columns)
						.replace(/\{\{orderby\}\}/g, data.orderby)
						.replace(/\{\{order\}\}/g, data.order)
						.replace(/\{\{hide_title\}\}/g, data.hide_title)
						.replace(/\{\{hide_price\}\}/g, data.hide_price)
						.replace(/\{\{hide_meta\}\}/g, data.hide_meta)
						.replace(/\{\{hide_logo\}\}/g, data.hide_logo)
						.replace(/\{\{hide_pagination\}\}/g, data.hide_pagination)
						.replace(/\{\{disable_animation\}\}/g, data.disable_animation);
		jQuery('.widget_generator_preview_code > textarea').val(src);
		// Refresh preview area
		if (typeof TRX_Addons_Widget_Themes != 'undefined') {
			if (!widget_obj)
				widget_obj = new TRX_Addons_Widget_Themes(data);
			else
				widget_obj.show(data);
		}
	}

})();