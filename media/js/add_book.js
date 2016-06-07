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
		selectYears: 4000
	});
	$('select').material_select();
	$(document).on('change', 'select[name=type]', function(event) {
		event.preventDefault();
		if ($(this).val() === "manga") {
			$('#select_kind').html('<option value="kodomo">Kodomo (For Young Child)</option><option value="shojo">Shojo (For Teenage Girl)</option><option value="shonen">Shonen (For Teen Boy)</option><option value="josei">Josei (For Young Women and Adult)</option><option value="seinen">Seinen (For Young Man and Adult)</option><option value="redisu">Redisu (For Adult Woman)</option><option value="seijin">Seijin (For Adult Man)</option>');
			$("#select_kind").removeAttr('multiple');
		} else {
			$('#select_kind').html('<option value="action">Action</option><option value="adventure">Adventure</option><option value="detective">Detective</option><option value="drama">Drama</option><option value="erotic">Erotic</option><option value="fantasy">Fantasy</option><option value="horror">Horror</option><option value="humour">Humour</option><option value="legend">Legend</option><option value="mystery">Mystery</option><option value="mythology">Mythology</option><option value="romance">Romance</option><option value="science fiction">Science Fiction</option><option value="western">Western</option>');
			$("#select_kind").attr('multiple', 'true');
		}
		$('select').material_select();
		$('#label_kind').html('Kind Of ' + $(this).val().charAt(0).toUpperCase() + $(this).val().slice(1));
	});
	$(document).on('submit', '#add_book_form', function(event) {
		//event.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url: path_to_ajax,
			type: 'POST',
			data: formData,
			async: false,
			success: function (data) {
				data = JSON.parse(data);
				console.log(data)
			},
			cache: false,
			contentType: false,
			processData: false
		});
		return false;
	});
});