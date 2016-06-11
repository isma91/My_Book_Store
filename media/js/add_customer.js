/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var path_to_ajax = "public_api/index.php";
    var firstname;
    var lastname;
    var adresse;
    var email;
    var birthdate;
    var city;
    var add_customer_error;
    function press_enter (selector, go_function) {
        $(document).on('keyup', selector, function(event) {
            if (event.keyCode === 13) {
                go_function();
            }
        });
    }
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 200
    });
    function change_to_invalide (selector) {
        $(selector).css('border-bottom', '1px solid #FF0000');
    }
    function change_to_valide (selector) {
        $(selector).css('border-bottom', '1px solid #9e9e9e');
    }
    function add_customer () {
        change_to_valide('#first_name');
        change_to_valide('#last_name');
        change_to_valide('#adresse');
        change_to_valide('#email');
        change_to_valide('#city');
        add_customer_error = "";
        $('#add_customer_error').html('');
        firstname = $.trim($('#first_name').val());
        lastname = $.trim($('#last_name').val());
        adresse = $.trim($('#adresse').val());
        email = $.trim($('#email').val());
        birthdate = $.trim($('#date').val());
        city = $.trim($('#city').val());
        if (firstname === "") {
            add_customer_error = add_customer_error + "<p>Firstname empty !!</p>";
            change_to_invalide('#first_name');
        }
        if (lastname === "") {
            add_customer_error = add_customer_error + "<p>Lastname empty !!</p>";
            change_to_invalide('#last_name');
        }
        if (adresse === "") {
            add_customer_error = add_customer_error + "<p>Adresse empty !!</p>";
            change_to_invalide('#adresse');
        }
        if (email !== "") {
            if (email.split('@').length === 2) {
                if (email.split('@')[0] !== "" && email.split('@')[1] !== "") {
                    if (email.split('@')[1].split(".").length > 1) {
                    } else {
                        add_customer_error = add_customer_error + '<p>Invalid Email !!</p>';
                        change_to_invalide("#email");
                    }
                } else {
                    add_customer_error = add_customer_error + '<p>Invalid Email !!</p>';
                    change_to_invalide("#email");
                }
            } else {
                add_customer_error = add_customer_error + '<p>Invalid Email !!</p>';
                change_to_invalide("#email");
            }
        } else {
            add_customer_error = add_customer_error + "<p>Email empty !!</p>";
            change_to_invalide('#email');
        }
        if (city === "") {
            add_customer_error = add_customer_error + "<p>City empty !!</p>";
            change_to_invalide('#city');
        }
        if (add_customer_error === "") {
            $.post(path_to_ajax, {action: 'add_customer', firstname: firstname, lastname: lastname, adresse: adresse, city: city, email: email}, function(data) {
                data = JSON.parse(data);
                if (data.error === null) {
                    Materialize.toast('<p class="alert-success">Customer added successfully !!<p>', 3000, 'rounded alert-success');
                } else {
                    Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
                }
            });
        } else {
            $('#add_customer_error').html(add_customer_error);
        }
    }
    $(document).on('click', '#validate_add_customer', function(event) {
        event.preventDefault();
        add_customer();
    });
    press_enter('#first_name', add_customer);
    press_enter('#last_name', add_customer);
    press_enter('#adresse', add_customer);
    press_enter('#email', add_customer);
    press_enter('#city', add_customer);
});