/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
	var path_to_ajax = "public_api/index.php";
	var all_books;
	var all_customers;
	var results;
	
	results = new RegExp('[\?&]id=([^&#]*)').exec(window.location.href);
    if (results === null || results[1] === null || $.trim(results[1]) === "" || $.isNumeric(results[1]) === false) {
        window.location = "?page=commands";
    }
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
			all_books = '<div class="row"><div class="input-field col s12"><select id="book" class="icons">';
			$.each(data.data, function(index, object) {
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
			all_customers = '<div class="row"><div class="input-field col s12"><select id="customer">';
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
	$(document).on('click', '#validate_edit_command', function(event) {
		event.preventDefault();
		$.post(path_to_ajax, {action: 'edit_order', type: $('#type').val(), id_book: $('#book').val(), id_customer: $('#customer').val()}, function(data) {
			data = JSON.parse(data);
			if (data.error === null) {
				Materialize.toast('<p class="alert-success">Order edited successfullly !!<p>', 3000, 'rounded alert-success');
			} else {
				Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
			}
		});
	});
});