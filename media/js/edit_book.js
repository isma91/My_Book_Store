/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var path_to_ajax = "public_api/index.php";
    var results;
    var current_type;
    var current_kind;
    var edit_book_error;
    results = new RegExp('[\?&]id=([^&#]*)').exec(window.location.href);
    if (results === null || results[1] === null || $.trim(results[1]) === "" || $.isNumeric(results[1]) === false) {
        window.location = "?page=books";
    }
    $.post(path_to_ajax, {action: 'get_book', id: results[1]}, function(data) {
        data = JSON.parse(data);
        if (data.data === false) {
            window.location = "?page=books";
        } else if (data.error === null) {
            $('#book_name').val(data.data.name);
            $('#author').val(data.data.author);
            $('#editor').val(data.data.editor);
            $('#date').val(data.data.year);
            $('#resume').val(data.data.resume);
            $('#resume_count').html(data.data.resume.length);
            $('#cover').attr('src', 'media/cover/' + data.data.cover);
            $('#type option[value="' + data.data.type + '"]').attr('selected', "true");
            $('.materialboxed').materialbox();
            $('#hidden_type').html(data.data.type);
            $('#hidden_kind').html(data.data.kind);
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
    $(document).on('change', '#checkbox_edit_cover', function(event) {
        event.preventDefault();
        if ($(this).is(':checked') === true) {
            $('#edit_cover').html('<div class="row"><div class="file-field input-field"><div class="btn"><span>File</span><input type="file" accept="image/*" name="cover"></div><div class="file-path-wrapper"><input class="file-path" type="text" id="file_path"></div></div>');
        } else {
            $('#edit_cover').html('');
        }
    });
    $(document).on('change', '#checkbox_edit_type', function(event) {
        event.preventDefault();
        if ($(this).is(':checked') === true) {
            current_type = $('#hidden_type').html();
            $('#edit_type').html('<div class="row"><div class="input-field col s12"><select name="type" id="type"><option value="apologue">Apologue</option><option value="comic">Comic</option><option value="epistolary">Epistolary</option><option value="manga">Manga</option><option value="novel">Novel</option><option value="poem">Poem</option><option value="theater">Theater</option></select><label>Type Of Book</label></div></div>');
            $('#type option[value=' + current_type + ']').attr('selected', 'true');
            $('select').material_select();
        } else {
            $('#edit_type').html('');
        }
    });
    $(document).on('change', '#checkbox_edit_kind', function(event) {
        event.preventDefault();
        if ($(this).is(':checked') === true) {
            current_kind = $('#hidden_kind').html().split(";");
            $('#edit_kind').html('<div class="row"><div class="input-field col s12"><select multiple="true" name="kind[]" id="select_kind"><option value="action">Action</option><option value="adventure">Adventure</option><option value="detective">Detective</option><option value="drama">Drama</option><option value="erotic">Erotic</option><option value="fantasy">Fantasy</option><option value="horror">Horror</option><option value="humour">Humour</option><option value="legend">Legend</option><option value="mystery">Mystery</option><option value="mythology">Mythology</option><option value="romance">Romance</option><option value="science fiction">Science fiction</option><option value="suspence">Suspence</option><option value="thriller">Thriller</option><option value="western">Western</option></select><label for="kind" id="label_kind">Kind Of Book</label></div></div>');
            $.each(current_kind, function(index, kind) {
                $('#select_kind option[value="' + kind + '"]').attr('selected', 'true');
            });
            $('select').material_select();
        } else {
            $('#edit_kind').html('');
        }
    });
    $(document).on('keyup', '#resume', function(event) {
        event.preventDefault();
        $('#resume_count').html($.trim($(this).val()).length);
        if ($.trim($(this).val()).length > 600) {
            change_to_invalide('#resume');
            $('#resume_error').html('<p>Resume too much long !!(max 600 characters)</p>');
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
    $(document).on('submit', '#edit_book_form', function(event) {
        event.preventDefault();
        edit_book_error = "";
        change_to_valide("#book_name");
        change_to_valide("#author");
        change_to_valide("#editor");
        change_to_valide("#date");
        change_to_valide("#resume");
        book_name = $.trim($('#book_name').val());
        author = $.trim($('#author').val());
        editor = $.trim($('#editor').val());
        date = $.trim($('#date').val());
        resume = $.trim($('#resume').val());
        $('#edit_book_error').html('');
        if ($('#checkbox_edit_kind').is(':checked') === true) {
            id_hidded_select = $('#select_kind').prev("ul").attr('id');
            change_to_valide("[data-activates=" + id_hidded_select + "]");
            if ($('#' + id_hidded_select + " li.active").length === 0) {
                edit_book_error = edit_book_error + "<p>No Kind selected !!</p>";
                change_to_invalide("[data-activates=" + id_hidded_select + "]");
            }
        }
        if ($('#checkbox_edit_cover').is(':checked') === true) {
            change_to_valide("#file_path");
            file_path = $.trim($('#file_path').val());
            if (file_path === "") {
                edit_book_error = edit_book_error + "<p>No Cover selected !!</p>";
                change_to_invalide("#file_path");
            }
        }
        if (book_name === "") {
            edit_book_error = edit_book_error + "<p>Name of the book empty !!</p>";
            change_to_invalide("#book_name");
        }
        if (author === "") {
            edit_book_error = edit_book_error + "<p>Author empty !!</p>";
            change_to_invalide("#author");
        }
        if (editor === "") {
            edit_book_error = edit_book_error + "<p>Editor empty !!</p>";
            change_to_invalide("#editor");
        }
        if (date === "") {
            edit_book_error = edit_book_error + "<p>No Date selected !!</p>";
            change_to_invalide("#date");
        }
        if (resume === "") {
            edit_book_error = edit_book_error + "<p>Empty Resume !!</p>";
            change_to_invalide("#resume");
            $('#resume_count').css('color', '#FF0000');
        }
        if (edit_book_error === "" && $('#resume_error').html() === "") {
            formData = new FormData($(this)[0]);
            $.ajax({
                url: path_to_ajax,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.error === null) {
                        Materialize.toast('<p class="alert-success">Book edited successfully !!<p>', 3000, 'rounded alert-success');
                    } else {
                        Materialize.toast('<p class="alert-failed">' + data.error + '<p>', 3000, 'rounded alert-failed');
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        } else {
            $('#edit_book_error').html(edit_book_error);
        }
        return false;
    });
});