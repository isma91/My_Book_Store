<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="My_Book_Store" />
    <title>Welcome to My_Mini_Tweet</title>
    <?php include "media.html" ?>
    <script src="media/js/add_book.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel" id="the_menu">
            <h1 class="title">Welcome to My_Book_Store !!</h1>
            <h2 class="title">You can add a boook here !!</h2>
            <?php include "button.php"; ?>
        </div>
        <div id="add_book_error"></div>
        <div id="resume_error"></div>
        <div id="add_book" class="row">
            <form class="col s12" method="POST" enctype="multipart/form-data" id="add_book_form">
                <input type="hidden" name="action" value="add_book">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="book_name" type="text" name="book_name">
                        <label for="book_name">Name Of The Book</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="author" type="text" name="author">
                        <label for="author">Author Of The Book</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="editor" type="text" name="editor">
                        <label for="editor">Editor Of The Book</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select name="type">
                            <option value="apologue">Apologue</option>
                            <option value="comic">Comic</option>
                            <option value="epistolary">Epistolary</option>
                            <option value="manga">Manga</option>
                            <option value="novel" selected="true">Novel</option>
                            <option value="poem">Poem</option>
                            <option value="theater">Theater</option>
                        </select>
                        <label>Type Of Book</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select multiple="true" name="kind[]" id="select_kind">
                            <option value="action">Action</option>
                            <option value="adventure">Adventure</option>
                            <option value="detective">Detective</option>
                            <option value="drama">Drama</option>
                            <option value="erotic">Erotic</option>
                            <option value="fantasy">Fantasy</option>
                            <option value="horror">Horror</option>
                            <option value="humour">Humour</option>
                            <option value="legend">Legend</option>
                            <option value="mystery">Mystery</option>
                            <option value="mythology">Mythology</option>
                            <option value="romance">Romance</option>
                            <option value="science fiction">Science fiction</option>
                            <option value="suspence">Suspence</option>
                            <option value="thriller">Thriller</option>
                            <option value="western">Western</option>
                        </select>
                        <label for="kind" id="label_kind">Kind Of Novel</label>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field">
                      <div class="btn">
                        <span>File</span>
                        <input type="file" accept="image/*" name="cover">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path" type="text" id="file_path">
                    </div>
                </div>
                <div class="row">
                    <label for="date">Year of publication</label>
                    <input type="date" name="date" id="date" class="datepicker">
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="resume" name="resume" class="materialize-textarea"></textarea>
                        <label for="resume" id="label_resume">Resume of </label>
                        <span id="resume_count">0</span>
                    </div>
                </div>
                <div class="row end_button">
                    <button class="waves-effect btn-flat" name="validate_add_book">Add The Book</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>