// @codekit-prepend "../Components/bootstrap/js/dropdown.js"
// @codekit-prepend "../Components/bootstrap/js/tooltip.js"
// @codekit-prepend "../Components/bootstrap/js/popover.js"
// @codekit-prepend "../Components/famelo/components/scripts/off-canvas.js"
// @codekit-prepend "../Components/prettycheckable/prettyCheckable.js"
// @codekit-prepend "../Components/jquery.validation/lib/jquery.metadata.js"
// @codekit-prepend "../Components/jquery.validation/jquery.validate.js"
// @codekit-prepend "../Components/jquery.validation/localization/messages_de.js"

// https://raw.github.com/DmitryBaranovskiy/raphael/300aa589f5a0ba7fce667cd62c7cdda0bd5ad904/raphael-min.js
// codekit-prepend "Components/morris.js/morris.min.js"
// codekit-prepend "Components/raty/js/jquery.raty.js"
// codekit-prepend "Components/peity/jquery.peity.min.js"

$(document).ready(function(){
	$(".off-canvas-toggle").click(function(e){
		e.preventDefault();
		$(".off-canvas").toggleClass("active");
	});

	$(".off-canvas-main").click(function(){
		$(".off-canvas").removeClass("active");
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

	$('[rel="popover"]').popover({ html: true, placement: 'left' });
	$("form.validate, .validate form").validate({
		errorContainer: $("#warning"),
	});

	$('.dropdown-toggle').dropdown();
});