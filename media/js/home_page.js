/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var user_login;
    var user_pass;
    var error_connexion;
    var path_to_ajax = "public_api/index.php";
    function press_enter (selector, go_function) {
        $(document).on('keyup', selector, function(event) {
            if (event.keyCode === 13) {
                go_function();
            }
        });
    }
    function connexion () {
        error_connexion = 0;
        user_login = $.trim($("#user_login").val());
        user_pass = $("#user_pass").val();
        if (user_login === "") {
            Materialize.toast('<p class="alert-failed">Login empty !! !!<p>', 3000, 'rounded alert-failed');
            error_connexion = error_connexion + 1;
        }
        if (user_pass === "") {
            Materialize.toast('<p class="alert-failed">Pass empty !! !!<p>', 3000, 'rounded alert-failed');
            error_connexion = error_connexion + 1;
        }
        if (error_connexion === 0) {
            $.post(path_to_ajax, {action: 'connexion', login: user_login, pass: user_pass}, function(data) {
                data = JSON.parse(data);
                if (data.error === null) {
                    Materialize.toast('<p class="alert-success">Login success !!<p>', 1500, 'rounded alert-success');
                    setTimeout(function () {
                        window.location = "?page=books";
                    }, 1000);
                } else {
                    Materialize.toast('<p class="alert-failed">a problem occurred while sending your data in the server !! Please contact the admin of the site !!<p>', 3000, 'rounded alert-failed');
                }
            });
        }
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