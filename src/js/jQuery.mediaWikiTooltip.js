jQuery.fn.mediaWikiTooltip = function(options) {

	this.each(function() {
		var self = jQuery(this);
		var location = self.prop('href').split('/');
		var endpointBase = location[0]+'/'+location[1]+'/'+location[2];
		var title = location[location.length-1];

		options = jQuery.extend({
			endpoint: '/w/api.php'
		}, options);

		/**
		 * 
		 * @param {Object} page
		 */
		var handlePage = function(page) {
			self.tooltipster({
				content: '<img src='+page.thumbnail.source+' style="float:right"><h5>'+page.title+'</h5><p style="text-align: justify">'+page.extract+' (CC-BY-SA 3.0 - Wikipedia)</p>',
				contentAsHTML: true,
				theme: 'tooltipster-punk',
				maxWidth: 450
			});
		};

		// https://en.wikipedia.org/w/api.php?action=help&modules=query%2Bextracts
		jQuery.ajax({
			type: 'GET',
			async: false,
			dataType: 'jsonp',
			contentType: 'application/json; charset=utf-8',
			url: endpointBase + options.endpoint,
			data: {
				format: 'json',
				action: 'query',
				prop: 'extracts|pageimages',
				titles: title,
				pithumbsize: 200,
				exintro: true,
				exsentences: 3,
				explaintext: true
			},
			success: function (data, textStatus, jqXHR) {
				if (data.query && data.query.pages) {
					for (var key in data.query.pages) {
						handlePage(data.query.pages[key]);					
					}
					var page = data.query.pages;
				} else {
					console.warn('Empty data');
					console.warn(data.warnings);
				}
			},
			error: function (errorMessage) {
				console.warn('Request failed');
			}
		});		
	});
};


jQuery(document).ready(function(){
	jQuery('.wikipedia-tooltip').mediaWikiTooltip();
});