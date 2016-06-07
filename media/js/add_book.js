/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
	var path_to_ajax = "public_api/index.php";
	function press_enter (selector, go_function) {
		$(document).on('keyup', selector, function(event) {
			if (event.keyCode === 13) {
				go_function();
			}
		});
	}
	$('.datepicker').pickadate({
		selectMonths: true,
		selectYears: 115
	});
	$('select').material_select();
});