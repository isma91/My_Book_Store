/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
	var path_to_ajax = "public_api/index.php";
	var all_books;
	var all_customers;
	function press_enter (selector, go_function) {
		$(document).on('keyup', selector, function(event) {
			if (event.keyCode === 13) {
				go_function();
			}
		});
	}
	$('select').material_select();
	$.post(path_to_ajax, {action: 'get_all_books'}, function(data) {
		data = JSON.parse(data);
		if (data.error === null) {
			all_books = '<div class="row"><div class="input-field col s12"><select class="icons">';
			$.each(data.data, function(index, object) {
				console.log(object);
				all_books = all_books + '<option value="' + object.id + '" data-icon="media/cover/' + object.cover + '" class="left circle">' + object.name + '</option>';
			});
			all_books = all_books + '</select><label>Book</label></div></div>';
			$('#all_books').html(all_books);
			$('select').material_select();
		} else {
			Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
		}
	});
	$.post(path_to_ajax, {action: 'get_all_customers'}, function(data) {
		data = JSON.parse(data);
		if (data.error === null) {
			all_customers = '<div class="row"><div class="input-field col s12"><select name="customer">';
			$.each(data.data, function(index, object) {
				all_customers = all_customers + '<option value="' + object.id + '">' + object.lastname + ' ' + object.firstname + '</option>';
			});
			all_customers = all_customers + '</select><label>Customer</label></div></div>';
			$('#all_customers').html(all_customers);
			$('select').material_select();
		} else {
			Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
		}
	});
});