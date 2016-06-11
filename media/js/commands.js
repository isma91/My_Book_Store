/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var path_to_ajax = "public_api/index.php";
    var all_orders;
    function press_enter (selector, go_function) {
        $(document).on('keyup', selector, function(event) {
            if (event.keyCode === 13) {
                go_function();
            }
        });
    }
    function get_all_orders () {
        $.post(path_to_ajax, {action: 'get_all_orders'}, function(data) {
            data = JSON.parse(data);
            if (data.error === null) {
                if (data.data === false || data.data.length === 0) {
                    $('#all_orders').html("<center><p>no command found !!!</p></center>");
                } else {
                    all_orders = '<table class="highlight centered responsive-table"><thead><tr><th data-field="type">Type</th><th data-field="lastname">Lastname</th><th data-field="firstname">Firstname</th><th data-field="book_name">Book name</th><th data-field="edit">Edit</th><th data-field="remove">Remove</th></tr></thead><tbody>';
                    $.each(data.data, function(index, object) {
                        all_orders = all_orders + '<tr><td>' + object.type + '</td><td>' + object.lastname + '</td><td>' + object.firstname + '</td><td>' + object.book_name + '</td><td><a class="waves-effect btn-flat" href="?page=edit_command&id=' + object.id + '">Edit</a></td><td><button class="waves-effect btn-flat remove_command" id="' + object.id + '">Remove</button></td></tr>';
                    });
                    all_orders = all_orders + '</tbody></table>';
                    $('#all_orders').html(all_orders);
                }
            } else {
                Materialize.toast('<p class="alert-failed">a problem occurred while geting all the commands in the server !! Please contact the admin of the site !!<p>', 3000, 'rounded alert-failed');
            }
        });
    }
    get_all_orders();
    $(document).on('click', '.remove_command', function(event) {
        event.preventDefault();
        $.post(path_to_ajax, {action: 'remove_order', id: $(this).attr('id')}, function(data) {
            data = JSON.parse(data);
            if (data.error === null) {
                Materialize.toast('<p class="alert-success">Command removed successfully !!<p>', 3000, 'rounded alert-success');
                get_all_orders();
            } else {
                Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
            }
        });
    });
});