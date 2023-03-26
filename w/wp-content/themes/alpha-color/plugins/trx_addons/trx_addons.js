/* global jQuery:false */
/* global ALPHA_COLOR_STORAGE:false */
/* global TRX_ADDONS_STORAGE:false */

(function() {
	"use strict";
	
	jQuery(document).on('action.add_googlemap_styles', alpha_color_trx_addons_add_googlemap_styles);
	jQuery(document).on('action.init_shortcodes', alpha_color_trx_addons_init);
	jQuery(document).on('action.init_hidden_elements', alpha_color_trx_addons_init);
	
	// Add theme specific styles to the Google map
	function alpha_color_trx_addons_add_googlemap_styles(e) {
		if (typeof TRX_ADDONS_STORAGE == 'undefined') return;
		TRX_ADDONS_STORAGE['googlemap_styles']['dark'] = [
            {
                "featureType": "administrative",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "simplified"
                    },
                    {
                        "color": "#ff4181"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#1e303d"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#e84c3c"
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#1e303d"
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "color": "#f0c514"
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#1e303d"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#1e303d"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#94a5a6"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#182731"
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#e77e24"
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#0e171d"
                    }
                ]
            }
        ];
	}
	
	
	function alpha_color_trx_addons_init(e, container) {
		if (arguments.length < 2) var container = jQuery('body');
		if (container===undefined || container.length === undefined || container.length == 0) return;
		container.find('.sc_countdown_item canvas:not(.inited)').addClass('inited').attr('data-color', ALPHA_COLOR_STORAGE['alter_link_color']);
	}

})();