
var search = instantsearch({
	appId: window.appId,
	apiKey: window.apiKey,
	indexName: 'apps',
	urlSync: true
});

search.addWidget(
	instantsearch.widgets.searchBox({
		container: '#q'
	})
);

search.addWidget(
	instantsearch.widgets.stats({
		container: '#stats'
	})
);

var hitTemplate =
	'<div class="hit media">' +
		'<div class="media-left">' +
			'<div class="media-object" style="background-image: url(\'{{image}}\');"></div>' +
			'<div class="mask"></div>' +
		'</div>' +

		'<div class="media-body">' +
			'<h4 class="media-heading">' +
				'{{{_highlightResult.name.value}}}' +
			'</h4>' +
			'{{#rankText}}<p class="rank_badge">{{{rankText}}}</p>{{/rankText}}' +
			'<p class="category">Category: <b>{{category}}</b></p>' +

			'<a class="itunes-link" href="{{link}}" target="_blank"></a>' +
		'</div>' +
	'</div>';

var noResultsTemplate =
	'<div class="text-center">No results found matching <strong>{{query}}</strong>.</div>';

search.addWidget(
	instantsearch.widgets.hits({
		container: '#hits',
		hitsPerPage: 15,
		templates: {
			empty: noResultsTemplate,
			item: hitTemplate
		},
		transformData: function(hit) {
			if(hit.rank <= 3)
			{
				hit.rankText = '<i><b>No. '+hit.rank+'</b> app in '+hit.category+' category on iTunes!</i>';
			}

			if(!hit.image)
			{
				hit.image = 'img/no-img.jpg';
			}

			return hit;
		}
	})
);

search.addWidget(
	instantsearch.widgets.pagination({
		container: '#pagination',
		cssClasses: {
			root: 'pagination',
			active: 'active'
		}
	})
);

search.addWidget(
	instantsearch.widgets.refinementList({
		container: '#categories',
		attributeName: 'category',
		operator: 'or',
		cssClasses: {
			list: 'nav nav-list',
			count: 'badge pull-right',
			active: 'active'
		}
	})
);

search.addWidget(
	instantsearch.widgets.sortBySelector({
		container: '#sort-by-container',
		indices: [
			{name: 'apps', label: 'Most relevant'},
			{name: 'apps_rank_asc', label: 'Highest rated'}
		]
	})
);

search.addWidget(
	instantsearch.widgets.numericSelector({
		container: '#best-apps',
		attributeName: 'rank',
		operator: '<=',
		options: [
			{label: 'All apps', value: 500},
			{label: 'Best apps', value: 3}
		]
	})
);

search.start();