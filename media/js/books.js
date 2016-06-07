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
    $.post(path_to_ajax, {action: 'get_all_books'}, function(data) {
        data = JSON.parse(data);
        if (data.error === null) {
            if (data.data === false) {
                $('#all_books').html("no books found !!!");
            } else {
                console.log(data.data);
            }
        } else {
            Materialize.toast('<p class="alert-failed">a problem occurred while geting all the books in the server !! Please contact the admin of the site !!<p>', 3000, 'rounded alert-failed');
        }
    });
    $(document).on('click', '#logout', function() {
        $.post(path_to_ajax, {action: 'logout', token: $(this).attr('token')}, function(data, textStatus) {
            if (textStatus === "success") {
                data = JSON.parse(data);
                if (data.error === null) {
                    Materialize.toast('<p class="alert-success">Logout success !!<p>', 500, 'rounded alert-success');
                    setTimeout(function () {
                        window.location = "?page=home";
                    }, 750);
                } else {
                    Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
                }
            } else {
                Materialize.toast('<p class="alert-failed">a problem occurred while getting your data in the server !! Please contact the admin of the site !!<p>', 3000, 'rounded alert-failed');
            }
        });
    });
});