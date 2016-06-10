/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var path_to_ajax = "public_api/index.php";
    var results;
    results = new RegExp('[\?&]id=([^&#]*)').exec(window.location.href);
    if (results === null || results[1] === null || $.trim(results[1]) === "" || $.isNumeric(results[1]) === false) {
        window.location = "?page=customers";
    }
    $.post(path_to_ajax, {action: 'get_customer', id: results[1]}, function(data) {
        data = JSON.parse(data);
        if (data.data === false) {
            window.location = "?page=customers";
        } else if (data.error === null) {
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
});