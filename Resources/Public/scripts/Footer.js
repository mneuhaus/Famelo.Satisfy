// @codekit-prepend "../components/bootstrap/js/bootstrap-dropdown.js"
// @codekit-prepend "../components/bootstrap/js/bootstrap-tooltip.js"
// @codekit-prepend "../components/bootstrap/js/bootstrap-popover.js"
// @codekit-prepend "../components/famelo/components/scripts/off-canvas.js"
// @codekit-prepend "../components/bootstrap-datepicker/js/bootstrap-datepicker.js"
// @codekit-prepend "../components/bootstrap-datepicker/js/locales/bootstrap-datepicker.de.js"
// @codekit-prepend "../components/flexie/flexie.min.js"
// @codekit-prepend "../components/prettycheckable/prettyCheckable.js"
// @codekit-prepend "../components/jquery.validation/jquery.validate.js"
// @codekit-prepend "../components/jquery.validation/localization/messages_de.js"

// https://raw.github.com/DmitryBaranovskiy/raphael/300aa589f5a0ba7fce667cd62c7cdda0bd5ad904/raphael-min.js
// codekit-prepend "components/morris.js/morris.min.js"
// codekit-prepend "components/raty/js/jquery.raty.js"
// codekit-prepend "components/peity/jquery.peity.min.js"

$(document).ready(function(){
	// $('[data-rating]').each(function(){
	// 	var e = $(this);
	// 	var input = $('#' + e.attr('data-rating'));
	// 	$(e).raty({
	// 		starOn  : '../../../_Resources/Static/Packages/Famelo.ADU/components/raty/img/star-on-big.png',
	// 		starOff : '../../../_Resources/Static/Packages/Famelo.ADU/components/raty/img/star-off-big.png',
	// 		width: 140,
	// 		score: function() {
 //    			return input.attr("value");
 //  			},
 //  			click: function(score, evt) {
 //    			input.attr("value", score);
 //  			}
	// 	});
	// });

	// $('[data-graph]').each(function(){
	// 	var e = $(this);
	// 	e.find("table").hide();
	// 	var data = [];
	// 	e.find("tr").each(function(){
	// 		var row = $(this);
	// 		if (row.find('[data-type]').length > 0) {
	// 			var tmp = {};
	// 			row.find('[data-type]').each(function(){
	// 				var item = $(this);
	// 				if (/^\d+$/.test(item.text())){
	// 					tmp[item.attr("data-type")] = parseInt(item.text());
	// 				} else {
	// 					tmp[item.attr("data-type")] = item.text();
	// 				}
	// 			})
	// 			data.push(tmp);
	// 		}
	// 	});

	// 	if (e.attr("data-graph") == 'donut') {
	// 		Morris.Donut({
	// 			element: e.attr("id"),
	// 			data: data,
	// 			formatter: function (x) { return x + "%"}
	// 		});
	// 	}

	// 	if (e.attr("data-graph") == 'line') {
	// 		Morris.Line({
	// 			element: e.attr("id"),
	// 			data: data,
	// 			xkey: 'y',
	// 			ykeys: ['a'],
	// 			labels: ['Durschnitt'],
	// 			parseTime: false
	// 		});
	// 	}
	// });

	// $("span.pie").peity("pie");
	// $("span.line").peity("line");
	// $("span.bar").peity("bar");

	$("[data-canvas-toggle]").click(function(){
		$(".off-canvas").toggleClass("off-canvas-active");
		return false;
	});

	$("[role='main']").click(function(){
		$(".off-canvas").removeClass("off-canvas-active");
	});

	$("[data-element='prettyCheckable'], .prettyCheckable").prettyCheckable();

	$(".happiness [data-element='prettyCheckable']").each(function(){
		var e = $(this);
		if (typeof(e.attr("data-marker")) !== "undefined") {
			e.next("a").text(e.attr("data-marker"));
		}
	});

	$(".happiness [data-element='prettyCheckable']").change(function(){
		var radio = $(this);
		var value = parseInt(radio.val());
		if (radio.attr('checked') != 'checked') {
			return;
		}
		if (value > 1) {
			radio.parents("td").find('.form-horizontal').show();
		} else {
			radio.parents("td").find('.form-horizontal').hide();
		}
	}).change();

	$('[rel="popover"]').popover({ html: true });
	$(".validate").validate({
		errorContainer: $("#warning"),
	});

	$('.dropdown-toggle').dropdown();

	$('[data-date-format]').datepicker({
		language: 'de',
		format: 'dd.mm.yyyy'
	});
});