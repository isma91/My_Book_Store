/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var path_to_ajax = "public_api/index.php";
    var formData;
    var book_name;
    var author;
    var editor;
    var date;
    var file_path;
    var add_book_error;
    var id_hidded_select;
    var kind = [];
    var resume;
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
    $('select').material_select();
    function change_to_invalide (selector) {
        $(selector).css('border-bottom', '1px solid #FF0000');
    }
    function change_to_valide (selector) {
        $(selector).css('border-bottom', '1px solid #9e9e9e');
    }
    $(document).on('keyup', '#book_name', function(event) {
        event.preventDefault();
        $("#label_resume").html("Resume of " + $.trim($(this).val()));
    });
    $(document).on('keyup', '#resume', function(event) {
        event.preventDefault();
        $('#resume_count').html($.trim($(this).val()).length);
        if ($.trim($(this).val()).length > 140) {
            change_to_invalide('#resume');
            $('#resume_error').html('<p>Resume too much long !!(max 140 characters)</p>');
            $('#resume_count').css('color', '#FF0000');
        } else if ($.trim($(this).val()).length === 0) {
            change_to_invalide('#resume');
            $('#resume_error').html('<p>Empty Resume !!</p>');
            $('#resume_count').css('color', '#FF0000');
        } else {
            change_to_valide('#resume');
            $('#resume_error').html('');
            $('#resume_count').css('color', '#000000');
        }
    });
    $(document).on('change', 'select[name=type]', function(event) {
        event.preventDefault();
        if ($(this).val() === "manga") {
            $('#select_kind').html('<option value="kodomo">Kodomo (For Young Child)</option><option value="shojo">Shojo (For Teenage Girl)</option><option value="shonen">Shonen (For Teen Boy)</option><option value="josei">Josei (For Young Women and Adult)</option><option value="seinen">Seinen (For Young Man and Adult)</option><option value="redisu">Redisu (For Adult Woman)</option><option value="seijin">Seijin (For Adult Man)</option>');
        } else {
            $('#select_kind').html('<option value="action">Action</option><option value="adventure">Adventure</option><option value="detective">Detective</option><option value="drama">Drama</option><option value="erotic">Erotic</option><option value="fantasy">Fantasy</option><option value="horror">Horror</option><option value="humour">Humour</option><option value="legend">Legend</option><option value="mystery">Mystery</option><option value="mythology">Mythology</option><option value="romance">Romance</option><option value="science fiction">Science Fiction</option><option value="western">Western</option>');
        }
        $('select').material_select();
        $('#label_kind').html('Kind Of ' + $(this).val().charAt(0).toUpperCase() + $(this).val().slice(1));
    });
    $(document).on('submit', '#add_book_form', function(event) {
        event.preventDefault();
        add_book_error = "";
        kind = [];
        id_hidded_select = $('#select_kind').prev("ul").attr('id');
        add_book_error = "";
        change_to_valide("#book_name");
        change_to_valide("#author");
        change_to_valide("#editor");
        change_to_valide("#file_path");
        change_to_valide("#date");
        change_to_valide("[data-activates=" + id_hidded_select + "]");
        change_to_valide("#resume");
        book_name = $.trim($('#book_name').val());
        author = $.trim($('#author').val());
        editor = $.trim($('#editor').val());
        file_path = $.trim($('#file_path').val());
        date = $.trim($('#date').val());
        resume = $.trim($('#resume').val());
        $('#add_book_error').html('');
        if (book_name === "") {
            add_book_error = add_book_error + "<p>Name of the book empty !!</p>";
            change_to_invalide("#book_name");
        }
        if (author === "") {
            add_book_error = add_book_error + "<p>Author empty !!</p>";
            change_to_invalide("#author");
        }
        if (editor === "") {
            add_book_error = add_book_error + "<p>Editor empty !!</p>";
            change_to_invalide("#editor");
        }
        if (file_path === "") {
            add_book_error = add_book_error + "<p>No Cover selected !!</p>";
            change_to_invalide("#file_path");
        }
        if (date === "") {
            add_book_error = add_book_error + "<p>No Date selected !!</p>";
            change_to_invalide("#date");
        }
        if ($('#' + id_hidded_select + " li.active").length === 0) {
            add_book_error = add_book_error + "<p>No Kind selected !!</p>";
            change_to_invalide("[data-activates=" + id_hidded_select + "]");
        }
        if (resume === "") {
            add_book_error = add_book_error + "<p>Empty Resume !!</p>";
            change_to_invalide("#resume");
            $('#resume_count').css('color', '#FF0000');
        }
        if (add_book_error === "" && $('#resume_error').html() === "") {
            formData = new FormData($(this)[0]);
            $.ajax({
                url: path_to_ajax,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.error === null) {
                        Materialize.toast('<p class="alert-success">Book added successfully !!<p>', 3000, 'rounded alert-success');
                    } else {
                        Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        } else {
            $('#add_book_error').html(add_book_error);
        }
        return false;
    });
});