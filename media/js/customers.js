/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var path_to_ajax = "public_api/index.php";
    var all_customers;
    function press_enter (selector, go_function) {
        $(document).on('keyup', selector, function(event) {
            if (event.keyCode === 13) {
                go_function();
            }
        });
    }
    function get_all_customers () {
        $.post(path_to_ajax, {action: 'get_all_customers'}, function(data) {
            data = JSON.parse(data);
            if (data.error === null) {
                if (data.data === false || data.data.length === 0) {
                    $('#all_customers').html("<center><p>no customers found !!!</p></center>");
                } else {
                    all_customers = '<table class="highlight centered responsive-table"><thead><tr><th data-field="lastname">Lastname</th><th data-field="firstname">Firstname</th><th data-field="adresse">Adresse</th><th data-field="city">City</th><th data-field="email">Email</th><th data-field="order">Number Order</th><th data-field="edit">Edit</th><th data-field="remove">Remove</th></tr></thead><tbody>';
                    $.each(data.data, function(index, object) {
                        all_customers = all_customers + '<tr><td>' + object.firstname + '</td><td>' + object.lastname + '</td><td>' + object.adresse + '</td><td>' + object.city + '</td><td>' + object.email + '</td><td>' + object.order + '</td><td><a class="waves-effect btn-flat" href="?page=edit_customer&id=' + object.id + '">Edit</a></td><td><button class="waves-effect btn-flat remove_customer" id="' + object.id + '">Remove</button></td></tr>';
                    });
                    all_customers = all_customers + '</tbody></table>';
                    $('#all_customers').html(all_customers);
                }
            } else {
                Materialize.toast('<p class="alert-failed">a problem occurred while geting all the books in the server !! Please contact the admin of the site !!<p>', 3000, 'rounded alert-failed');
            }
        });
    }
    get_all_customers();
    $(document).on('click', '.remove_customer', function(event) {
        event.preventDefault();
        $.post(path_to_ajax, {action: 'remove_customer', id: $(this).attr('id')}, function(data) {
            data = JSON.parse(data);
            if (data.error === null) {
                Materialize.toast('<p class="alert-success">Customer removed successfully !!<p>', 3000, 'rounded alert-success');
                get_all_customers();
            } else {
                Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
            }
        });
    });
});