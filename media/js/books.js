/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var path_to_ajax = "public_api/index.php";
    var all_books;
    var all_kind;
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
            if (data.data === false || data.data.length === 0) {
                $('#all_books').html("<center><p>no books found !!!</p></center>");
            } else {
                all_books = "";
                all_kind = "";
                $.each(data.data, function(index, object) {
                    $.each(object.kind.split(';'), function(i, kind) {
                        all_kind = all_kind + '<li class="kind">' + kind + '</li>';
                    });
                    all_books = all_books + '<div class="col s4"><div class="card" id="' + object.id + '"><div class="card-image"><img class="materialboxed" data-caption="' + object.name + '" src="media/cover/' + object.cover + '"><span class="card-title">' + object.name + '</span></div><div class="card-content"><p>' + object.resume + '</p><div><div class="card-action"><p class="type">Type : <span>' + object.type + '</span></p><p class="author">Author :  <span>' + object.author + '</span></p><p class="editor">Editor : <span>' + object.editor + '</span></p><p class="year">Year : <span>' + object.year + '</span></p><a class="dropdown-button btn" href="#" data-activates="all_kind_' + object.id + '">Genre :</a><ul id="all_kind_' + object.id + '" class="dropdown-content all_kind">' + all_kind + '</ul><a class="waves-effect btn-flat" href="?page=edit_book&id=' + object.id + '">Edit</a><button class="waves-effect btn-flat" id="remoe_book" id="' + object.id + '">Remove</button></div></div></div></div></div>';
                    all_kind = "";
                });
                $('#all_books').html(all_books);
                $('.dropdown-button').dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    constrain_width: false,
                    hover: true,
                    gutter: 0,
                    belowOrigin: false,
                    alignment: 'left'
                });
                $('.materialboxed').materialbox();
            }
        } else {
            Materialize.toast('<p class="alert-failed">a problem occurred while geting all the books in the server !! Please contact the admin of the site !!<p>', 3000, 'rounded alert-failed');
        }
    });
});