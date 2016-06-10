<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="My_Book_Store" />
    <title>Welcome to My_Mini_Tweet</title>
    <?php include "media.html" ?>
    <script src="media/js/edit_book.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel" id="the_menu">
            <h1 class="title">Welcome to My_Book_Store !!</h1>
            <h2 class="title">You can edit your boook here !!</h2>
            <?php include "button.php"; ?>
        </div>
        <div id="edit_book_error"></div>
        <div id="resume_error"></div>
        <div id="edit_book" class="row">
            <form class="col s12" method="POST" enctype="multipart/form-data" id="edit_book_form">
                <input type="hidden" name="action" value="edit_book">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="book_name" type="text" name="book_name" placeholder="Name of The Book">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="author" type="text" name="author" placeholder="Author Of The Book">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="editor" type="text" name="editor" placeholder="Editor Of The Book">
                    </div>
                </div>
                <div class="row">
                    <label>Change the type ?</label>
                    <div class="switch">
                        <label>Off<input type="checkbox" id="checkbox_edit_type"><span class="lever"></span>On</label>
                    </div>
                </div>
                <div id="edit_type"></div>
                <div class="row">
                    <label>Change the kind ?</label>
                    <div class="switch">
                        <label>Off<input type="checkbox" id="checkbox_edit_kind"><span class="lever"></span>On</label>
                    </div>
                </div>
                <div id="edit_kind"></div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="number" name="date" id="date" placeholder="Year of publication" pattern="\d{4}" min="0001" max="9999" title="Only 4 digits">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="resume" name="resume" class="materialize-textarea" placeholder="resume"></textarea>
                        <span id="resume_count"></span>
                    </div>
                </div>
                <div class="row">
                    <label>Change the cover ?</label>
                    <div class="switch">
                        <label>Off<input type="checkbox" id="checkbox_edit_cover"><span class="lever"></span>On</label>
                    </div>
                </div>
                <div id="edit_cover"></div>
                <div class="row">
                    <div class="col s4">
                        <label>Current Cover</label>
                        <img src="" id="cover" class="materialboxed responsive-img">
                    </div>
                </div>
                <div class="row end_button">
                    <button class="waves-effect btn-flat" name="validate_edit_book">Edit The Book</button>
                </div>
            </div>
        </form>
    </div>
</div>
<span id="hidden_type"></span>
<span id="hidden_kind"></span>
</body>
</html>