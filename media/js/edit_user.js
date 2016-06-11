/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var path_to_ajax = "public_api/index.php";
    var edit_login_error;
    var edit_password_error;
    function press_enter (selector, go_function) {
        $(document).on('keyup', selector, function(event) {
            if (event.keyCode === 13) {
                go_function();
            }
        });
    }
    function change_to_invalide (selector) {
        $(selector).css('border-bottom', '1px solid #FF0000');
    }
    function change_to_valide (selector) {
        $(selector).css('border-bottom', '1px solid #9e9e9e');
    }
    function edit_login () {
        edit_login_error = "";
        $('#edit_login_error').html('');
        change_to_valide('#old_login');
        change_to_valide('#new_login');
        old_login = $.trim($('#old_login').val());
        new_login = $.trim($('#new_login').val());
        if (old_login === "") {
            edit_login_error = edit_login_error + "<p>Old Login empty !!</p>";
            change_to_invalide("#old_login");
        }
        if (new_login === "") {
            edit_login_error = edit_login_error + "<p>New Login empty !!</p>";
            change_to_invalide("#new_login");
        }
        if (edit_login_error === "") {
            $.post(path_to_ajax, {action: 'edit_login', old_login: old_login, new_login: new_login}, function(data) {
                data = JSON.parse(data);
                if (data.error === null) {
                    Materialize.toast('<p class="alert-success">Login edited successfully !!<p>', 3000, 'rounded alert-success');
                } else {
                    Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
                }
            });
        } else {
            $('#edit_login_error').html(edit_login_error);
        }
    }
    function edit_password () {
        edit_password_error = "";
        $('#edit_password_error').html('');
        change_to_valide('#old_password');
        change_to_valide('#new_password');
        old_password = $.trim($('#old_password').val());
        new_password = $.trim($('#new_password').val());
        if (old_password === "") {
            edit_password_error = edit_password_error + "<p>Old Password empty !!</p>";
            change_to_invalide("#old_password");
        }
        if (new_password === "") {
            edit_password_error = edit_password_error + "<p>New Password empty !!</p>";
            change_to_invalide("#new_password");
        } else if (new_password.length < 5) {
            edit_password_error = edit_password_error + "<p>New Password must be at least 5 characters !!</p>";
            change_to_invalide("#new_password");
        }
        if (edit_password_error === "") {
            $.post(path_to_ajax, {action: 'edit_password', old_password: old_password, new_password: new_password}, function(data) {
                data = JSON.parse(data);
                if (data.error === null) {
                    Materialize.toast('<p class="alert-success">Password edited successfully !!<p>', 3000, 'rounded alert-success');
                } else {
                    Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
                }
            });
        } else {
            $('#edit_password_error').html(edit_password_error);
        }
    }
    $(document).on('click', '#validate_edit_login', function(event) {
        event.preventDefault();
        edit_login();
    });
    $(document).on('click', '#validate_edit_password', function(event) {
        event.preventDefault();
        edit_password();
    });
    press_enter("#old_login", edit_login);
    press_enter("#new_login", edit_login);
    press_enter("#old_password", edit_password);
    press_enter("#new_password", edit_password);
});