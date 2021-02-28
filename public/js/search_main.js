$(document).ready(function($) {
	var engine1 = new Bloodhound({
		remote: {
			url: '/search/name?value=%QUERY%',
			wildcard: '%QUERY%'
		},
		datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
		queryTokenizer: Bloodhound.tokenizers.whitespace
	});

	$(".search-inputt").typeahead({
		hint: true,
		highlight: true,
		minLength: 1
	}, [
	{
		source: engine1.ttAdapter(),
		name: 'book-name',
		display: function(data) {
			return data.name;
		},
		templates: {
			empty: [
			'<div class="list-group-item">No Books found ! Try another name book !.</div>'
			],
			header: [
			'<div class="list-group search-results-dropdown">Books</div>'
			],
			suggestion: function (data) {
				return '<a href="/book/' + data.id + '" class="list-group-item">'+ data.name+'</a>';
			}
		}
	}]);
});