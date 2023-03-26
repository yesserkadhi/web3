/**
 * Widget "Themes List"
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.33
 */

(function(){
	"use strict";

	window.TRX_Addons_Widget_Themes = function(params) {
		var widget = this;
		widget.params = params;
		widget.node = document.getElementById(widget.params.uid);
		if (!widget.node) return null;
		widget.node.innerHTML = '<div class="trx_addons_widget_themes">'
									+ '<div class="trx_addons_widget_themes_content">'
									+ '</div>'
									+ '<div class="trx_addons_widget_themes_footer'
										+ ' trx_addons_widget_themes_' + (widget.params['logo'] ? 'with' : 'without') + '_logo'
										+ '">'
										+ (widget.params['logo']
											? '<' + (widget.params['logo'] && widget.params['logo_link'] 
													? 'a href="'+widget.params['logo_link']+'"' 
													: 'span') 
													+ ' class="trx_addons_widget_themes_logo">'
													+ '<img src="'+widget.params['logo']+'" alt="">'
												+ '</' + (widget.params['logo_link'] ? 'a' : 'span') + '>'
											: '')
										+ '<span class="trx_addons_widget_themes_pagination" data-page="'+widget.params['page']+'">'
											+ '<span class="trx_addons_widget_themes_pagination_prev'
												+ (widget.params['page'] == 1 
													? ' trx_addons_widget_themes_pagination_disabled' 
													: '') 
												+ '"></span>' 
											+ '<span class="trx_addons_widget_themes_pagination_next"></span>'
										+ '</span>'
									+ '</div>'
								+ '</div>';
		widget.footer = widget.node.getElementsByClassName('trx_addons_widget_themes_footer')[0];
		widget.logo = widget.footer.getElementsByClassName('trx_addons_widget_themes_logo')[0];
		widget.pagination = widget.footer.getElementsByClassName('trx_addons_widget_themes_pagination')[0];
		widget.pagination_prev = widget.pagination.getElementsByClassName('trx_addons_widget_themes_pagination_prev')[0];
		widget.pagination_next = widget.pagination.getElementsByClassName('trx_addons_widget_themes_pagination_next')[0];
		widget.pagination_prev.addEventListener('click', function(e) {
			if (e.target.className.indexOf('trx_addons_widget_themes_pagination_disabled')!=-1) return;
			widget.params.page--;
			widget.show();
		});
		widget.pagination_next.addEventListener('click', function(e) {
			if (e.target.className.indexOf('trx_addons_widget_themes_pagination_disabled')!=-1) return;
			widget.params.page++;
			widget.show();
		});
		widget.show();
	};
	TRX_Addons_Widget_Themes.prototype.getQueryParams = function() {
		var list = {};
		for (var i in this.params) {
			if (['downloads', 'widget', 'columns', 'logo', 'logo_link', 'affid', 'style'].indexOf(i) == -1 && i.indexOf('hide_') == -1)
				list[i] = this.params[i];
		}
    	return list;
	};
	TRX_Addons_Widget_Themes.prototype.getDownloadsUrl = function() {
    	return this.addParamsToUrl(document.location.protocol + this.params.downloads + '/wp-json/trx_addons/v1/themes/list', this.getQueryParams());
	};
	TRX_Addons_Widget_Themes.prototype.addParamsToUrl = function(loc, prm) {
		var ignore_empty = arguments[2] !== undefined ? arguments[2] : true;
		var q = loc.indexOf('?');
		var attr = {};
		if (q > 0) {
			var qq = loc.substr(q+1).split('&');
			var parts = '';
			for (var i=0; i < qq.length; i++) {
				var parts = qq[i].split('=');
				attr[parts[0]] = parts.length>1 ? parts[1] : ''; 
			}
		}
		for (var p in prm) {
			attr[p] = prm[p];
		}
		loc = (q > 0 ? loc.substr(0, q) : loc) + '?';
		var i = 0;
		for (p in attr) {
			if (ignore_empty && attr[p]=='') continue;
			loc += (i++ > 0 ? '&' : '') + p + '=' + attr[p];
		}
		return loc;
	};
	TRX_Addons_Widget_Themes.prototype.toggleClass = function(obj, cls, flag) {
		var found = false;
		var classes = obj.className.split(' ');
		for (var i=0; i < classes.length; i++) {
			if (classes[i] == cls) {
				found = true;
				if (flag == 0) delete classes[i];
				break;
			}
		}
		if (found && flag==0) {
			obj.className = classes.join(' ');
		} else if (!found && flag==1) {
			classes.push(cls);
			obj.className = classes.join(' ');
		}
	};
	
	// Display themes
	TRX_Addons_Widget_Themes.prototype.show = function(params) {
		if (typeof XMLHttpRequest == 'undefined') {
			console.error("Unsupported platform: Unable to do remote requests because there is no XMLHTTPRequest implementation in your browser");
			return;
		}
		if (typeof params != 'undefined')
			this.params = params;
		var widget = this;
		var r = new XMLHttpRequest;
		r.onreadystatechange = function() {
			if (r.readyState == 4) {
				var response = r.status == 200 
									? JSON.parse(r.responseText) 
									: {error: 'Service temporary unavailable!'};
				if (response.css && widget.node.getElementsByTagName('link').length==0) {
					// Add Themes Widget CSS
					var s = document.createElement('link');
					s.async = true;
					s.type = 'text/css';
					s.rel = 'stylesheet';
					s.property = 'stylesheet';
					s.href = response.css+'?ver='+Math.random();
					widget.node.appendChild(s);
					// Google font
					s = document.createElement('link');
					s.async = true;
					s.type = 'text/css';
					s.rel = 'stylesheet';
					s.property = 'stylesheet';
					s.href = 'https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,700';
					widget.node.appendChild(s);
				}
				var items = widget.node.getElementsByClassName('trx_addons_widget_themes_content')[0];
				var html = '', meta = '', url = '', title_tag = widget.params['style']=='classic' ? 'h6' : 'h5';
				if (response.error)
					html += '<div class="trx_addons_widget_error">'+response.error+'</div>';
				else {
					if (response.list.length > 0) {
						html += widget.params['columns'] > 1 
										? '<div class="trx_addons_widget_themes_columns trx_addons_widget_columns_wrap">' 
										: '';
						for (var i=0; i < response.list.length; i++) {
							meta = (widget.params['hide_price'] ? '' : '<div class="trx_addons_widget_themes_item_price">'
										+ response.list[i].price
									+ '</div>')
									+ (widget.params['hide_meta'] ? '' : '<div class="trx_addons_widget_themes_item_meta">' 
										+ '<span class="trx_addons_widget_themes_item_version">'
											+ '<span>v.</span>'
											+ '<span>' + response.list[i].version + '</span>'
										+ '</span>'
										+ '<span class="trx_addons_widget_themes_item_date">'
											+ '<span>' + response.list[i].date_updated + '</span>'
										+ '</span>'
									+ '</div>');
							url = response.list[i].download_url
									+ (widget.params['affid'] 
										? ((widget.params['affid'].indexOf('?')>0 ? '&' : '?') + widget.params['affid']) 
										: '');
							html += (widget.params['columns'] > 1 
										? '<div class="trx_addons_widget_column-1_'+widget.params['columns']+'">'
										: '')
									+ '<div class="trx_addons_widget_themes_item trx_addons_widget_themes_style_'+widget.params['style']+'">'
										+ (response.list[i].screenshot || response.list[i].featured
											? '<div class="trx_addons_widget_themes_item_featured_wrap'
														+ (widget.params['disable_animation']
																? '' 
																: ' trx_addons_widget_themes_item_featured_with_animation')
														+ '">'
													+ '<div class="trx_addons_widget_themes_item_featured" style="background-image:url('
														+ (!widget.params['disable_animation'] && response.list[i].screenshot 
																? response.list[i].screenshot 
																: response.list[i].featured)
														+ ');">'
													+ '</div>'
													+ (widget.params['style']=='modern' ? meta : '')
													+ '<a href="' + url + '" target="_blank"></a>'
												+ '</div>'
											: '')
										+ '<div class="trx_addons_widget_themes_item_header">'
											+ (widget.params['hide_title'] 
												? '' 
												: '<' + title_tag + ' class="trx_addons_widget_themes_item_title">' 
													+ '<a href="' + url + '" target="_blank">' 
														+ response.list[i].title 
													+ '</a>'
												+ '</' + title_tag + '>')
											+ (widget.params['style']=='classic' ? meta : '')
										+ '</div>'
										+ (response.list[i].content
											? '<div class="trx_addons_widget_themes_item_content">' + response.list[i].content + '</div>'
											: '')
									+ '</div>'
									+ (widget.params['columns'] > 1 
										? '</div>'
										: '');
						}
						html += widget.params['columns'] > 1 ? '</div>' : '';
					} else
						html += '<div class="trx_addons_widget_error">' + widget.params['msg_no_themes'] +'</div>';

					widget.footer.style['display'] = !widget.params['hide_logo'] || !widget.params['hide_pagination'] ? 'block' : 'none';
					// Enable/disable logo
					widget.toggleClass(widget.footer, 'trx_addons_widget_themes_with_logo', !widget.params['hide_logo']);
					widget.toggleClass(widget.footer, 'trx_addons_widget_themes_without_logo', widget.params['hide_logo']);
					widget.logo.style['display'] = !widget.params['hide_logo'] ? 'inline-block' : 'none';
					// Enable/disable pagination
					widget.toggleClass(widget.footer, 'trx_addons_widget_themes_with_pagination', !widget.params['hide_pagination']);
					widget.toggleClass(widget.footer, 'trx_addons_widget_themes_without_pagination', widget.params['hide_pagination']);
					widget.pagination.style['display'] = !widget.params['hide_pagination'] && (response.list.length > 0 || widget.params['page'] > 0) ? 'inline-block' : 'none';
					widget.pagination.setAttribute('data-page', widget.params['page']);
					widget.toggleClass(widget.pagination_prev, 'trx_addons_widget_themes_pagination_disabled', widget.params['page']==1);
					widget.toggleClass(widget.pagination_next, 'trx_addons_widget_themes_pagination_disabled', response.list.length < widget.params['count']);
				}
				if (window.jQuery) {
					var $items = jQuery(items);
					if ($items.html() == '') {
						$items.hide().html(html).fadeIn();
					} else {
						$items.fadeOut(function() {
							$items.html(html);
							$items.fadeIn();
						});
					}
				} else
					items.innerHTML = html;
			}
		};
		r.open("GET", this.getDownloadsUrl(), true);
		r.send();
	};
	
})();