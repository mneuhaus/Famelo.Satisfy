$(document).ready(function(){
	$('[data-rating]').each(function(){
		var e = $(this);
		var input = $('#' + e.attr('data-rating'));
		$(e).raty({
			starOn  : '../../../_Resources/Static/Packages/Famelo.ADU/components/raty/img/star-on.png',
			starOff : '../../../_Resources/Static/Packages/Famelo.ADU/components/raty/img/star-off.png',
			score: function() {
    			return input.attr("value");
  			},
  			click: function(score, evt) {
    			input.attr("value", score);
  			}
		});
	});

	$('[data-graph="donut"]').each(function(){
		var e = $(this);
		e.find("table").hide();
		var data = [];
		e.find("tr").each(function(){
			var row = $(this);
			if (row.find('[data-type="value"]').length > 0) {
				data.push({
					label: row.find('[data-type="label"]',
					label: row.find('[data-type="value"]'
				});
			}
		});
		Morris.Donut({
		  element: e.attr("id"),
		  data: data,
		  formatter: function (x) { return x + "%"}
		});
	});
});