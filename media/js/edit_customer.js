/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var path_to_ajax = "public_api/index.php";
    var results;
    var edit_customer_error;
    results = new RegExp('[\?&]id=([^&#]*)').exec(window.location.href);
    if (results === null || results[1] === null || $.trim(results[1]) === "" || $.isNumeric(results[1]) === false) {
        window.location = "?page=customers";
    }
    $.post(path_to_ajax, {action: 'get_customer', id: results[1]}, function(data) {
        data = JSON.parse(data);
        if (data.data === false) {
            window.location = "?page=customers";
        } else if (data.error === null) {
            $('#last_name').val(data.data.lastname);
            $('#first_name').val(data.data.firstname);
            $('#adresse').val(data.data.adresse);
            $('#city').val(data.data.city);
            $('#email').val(data.data.email);
        } else {
            Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
        }
    });
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
    function edit_customer () {
        edit_customer_error = "";
        $('#edit_customer_error').html('');
        change_to_valide('#first_name');
        change_to_valide('#last_name');
        change_to_valide('#adresse');
        change_to_valide('#email');
        change_to_valide('#city');
        lastname = $.trim($('#last_name').val());
        firstname = $.trim($('#first_name').val());
        adresse = $.trim($('#adresse').val());
        city = $.trim($('#city').val());
        email = $.trim($('#email').val());
        if (firstname === "") {
            edit_customer_error = edit_customer_error + "<p>Firstname empty !!</p>";
            change_to_invalide("#first_name");
        }
        if (lastname === "") {
            edit_customer_error = edit_customer_error + "<p>Lastname empty !!</p>";
            change_to_invalide("#last_name");
        }
        if (adresse === "") {
            edit_customer_error = edit_customer_error + "<p>Adresse empty !!</p>";
            change_to_invalide("#adresse");
        }
        if (city === "") {
            edit_customer_error = edit_customer_error + "<p>City empty !!</p>";
            change_to_invalide("#city");
        }
        if (email !== "") {
            if (email.split('@').length === 2) {
                if (email.split('@')[0] !== "" && email.split('@')[1] !== "") {
                    if (email.split('@')[1].split(".").length > 1) {
                    } else {
                        edit_customer_error = edit_customer_error + '<p>Invalid Email !!</p>';
                        change_to_invalide("#email");
                    }
                } else {
                    edit_customer_error = edit_customer_error + '<p>Invalid Email !!</p>';
                    change_to_invalide("#email");
                }
            } else {
                edit_customer_error = edit_customer_error + '<p>Invalid Email !!</p>';
                change_to_invalide("#email");
            }
        } else {
            edit_customer_error = edit_customer_error + "<p>Email empty !!</p>";
            change_to_invalide('#email');
        }
        if (edit_customer_error === "") {
            $.post(path_to_ajax, {action: 'edit_customer', id: $('#id_customer').val(), firstname: firstname, lastname: lastname, adresse: adresse, city: city, email: email}, function(data) {
                data = JSON.parse(data);
                if (data.error === null) {
                    Materialize.toast('<p class="alert-success">Customer edited successfully !!<p>', 3000, 'rounded alert-success');
                } else {
                    Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
                }
            });
        } else {
            $('#edit_customer_error').html(edit_customer_error);
        }
    }
    $(document).on('click', '#validate_edit_customer', function(event) {
        event.preventDefault();
        edit_customer();
    });
    press_enter('#last_name', edit_customer);
    press_enter('#first_name', edit_customer);
    press_enter('#adresse', edit_customer);
    press_enter('#city', edit_customer);
    press_enter('#email', edit_customer);
});