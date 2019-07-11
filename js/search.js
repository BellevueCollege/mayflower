/**
 * Search Script Used when Custom Search Settings are Configured
 */

 // Make sure variables are being passed in
if ( typeof limit_searchform_scope !== 'undefined' ||
	 typeof search_api_key         !== 'undefined' ||
	 typeof filter_value           !== 'undefined' ||
	 typeof search_field_id        !== 'undefined' ||
	 typeof custom_search_url      !== 'undefined' ||
	 typeof search_url_default     !== 'undefined' ) {
	
	(function ($) {
		// Double check this should run
		if ( limit_searchform_scope ) {

			// If the custom search URL is not set, use site URL based filters
			if ( '' === custom_search_url ) {

				// Swiftype Autofill (script in Globals)
				$( '#' + search_field_id ).swiftype({ 
					"engineKey" : search_api_key,
					"filters" : {
						"page": {
							"site_home_url" : [filter_value]
						}
						
					},
					resultLimit: 5,
					typingDelay: 600,
					renderFunction: function(document_type, item, idx) {
						return '<p class="title" data-url="'+ item['url'] +'">' + Swiftype.htmlEscape(item['title']) + '</p>';
					}
				});
				
				
			} else { // Otherwise, use custom API key to pull from custom search engine
				$( '#' + search_field_id ).swiftype({ 
					"engineKey" : search_api_key,
					resultLimit: 5,
					typingDelay: 600,
					renderFunction: function(document_type, item, idx) {
						return '<p class="title" data-url="'+ item['url'] +'">' + Swiftype.htmlEscape(item['title']) + '</p>';
					}
				});
			}

			// Build search history dropdown, from Globals
			$('#bc-search-container-lite').searchHistory({
				field: '#college-search-field-custom',
				localStorageKey: 'searchHistory' + '_' + btoa( search_api_key + filter_value ),
				searchURL: (custom_search_url !== '' ? custom_search_url : search_url_default),
				searchPerams: (function() {
					if ( '' == custom_search_url ) {
						return {
							site: [
								filter_value
							]
						};
					}
					return {};
				}())
			});
		
			/* Generate search URL in dropdown */
			$('#college-search-site-link').click( function( event ) {

				// Default action is to simply go to search page, if no JS
				event.preventDefault();

				// Submit
				$('#bc-search').submit();
			});

			$('#college-search-all-link').click( function( event ) {
				/* Default action is to simply go to search page, if no JS */
				event.preventDefault();

				// Remove filters and reset action URL
				$('.college-search-filter').remove();
				$('#bc-search').attr('action', search_url_default);

				// Build a second instance of the search history object, to so history appears on main
				$('#bc-search-container-lite').searchHistory({
					field: '#college-search-field-custom'
				});

				// Submit
				$('#bc-search').submit();
			});
				
		}
	})(jQuery);
}
