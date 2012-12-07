$(document).ready(function(){
	$('[data-rating]').each(function(){
		var e = $(this);
		var input = $('#' + e.attr('data-rating'));
		$(e).raty({
			starOn  : '../../../_Resources/Static/Packages/Famelo.ADU/components/raty/img/star-on-big.png',
			starOff : '../../../_Resources/Static/Packages/Famelo.ADU/components/raty/img/star-off-big.png',
			width: 140,
			score: function() {
    			return input.attr("value");
  			},
  			click: function(score, evt) {
    			input.attr("value", score);
  			}
		});
	});

	$('[data-graph]').each(function(){
		var e = $(this);
		e.find("table").hide();
		var data = [];
		e.find("tr").each(function(){
			var row = $(this);
			if (row.find('[data-type]').length > 0) {
				var tmp = {};
				row.find('[data-type]').each(function(){
					var item = $(this);
					if (/^\d+$/.test(item.text())){
						tmp[item.attr("data-type")] = parseInt(item.text());
					} else {
						tmp[item.attr("data-type")] = item.text();
					}
				})
				data.push(tmp);
			}
		});

		if (e.attr("data-graph") == 'donut') {
			Morris.Donut({
				element: e.attr("id"),
				data: data,
				formatter: function (x) { return x + "%"}
			});
		}

		if (e.attr("data-graph") == 'line') {
			Morris.Line({
				element: e.attr("id"),
				data: data,
				xkey: 'y',
				ykeys: ['a'],
				labels: ['Durschnitt'],
				parseTime: false
			});
		}
	});

	$("span.pie").peity("pie");
	$("span.line").peity("line");
	$("span.bar").peity("bar");

	$("[data-element='prettyCheckable'], .prettyCheckable").prettyCheckable();

	$(".happiness [data-element='prettyCheckable']").change(function(){
		var radio = $(this);
		var value = parseInt(radio.val());
		if (value > 1) {
			radio.parents("td").find('.form-horizontal').show();
		} else {
			radio.parents("td").find('.form-horizontal').hide();
		}
	});

	$('[rel="popover"]').popover({ html: true });
});