/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
	var user_login;
	var user_pass;
	function press_enter (selector, go_function) {
		$(document).on('keyup', selector, function(event) {
			if (event.keyCode === 13) {
				go_function();
			}
		});
	}
	function connexion () {
		user_login = $.trim($("#user_login").val());
		user_pass = $("#user_pass").val();
		console.log(user_login);
		console.log(user_pass);
	}
	$(document).on('mousedown', "#display_user_pass", function() {
		$("#user_pass").prop("type", "text");
	});
	$(document).on('mouseup', "#display_user_pass", function() {
		$("#user_pass").prop("type", "password");
	});
	$(document).on('click', '#connexion', function(event) {
		event.preventDefault();
		connexion();
	});
	press_enter("#user_login", connexion);
	press_enter("#user_pass", connexion);
});