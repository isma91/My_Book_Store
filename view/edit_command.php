<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="My_Book_Store" />
    <title>Welcome to My_Mini_Tweet</title>
    <?php include "media.html" ?>
    <script src="media/js/edit_command.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel" id="the_menu">
            <h1 class="title">Welcome to My_Book_Store !!</h1>
            <h2 class="title">You can edit your command here !!</h2>
            <?php include "button.php"; ?>
        </div>
        <div id="edit_command">
            <div class="row">
                <div class="input-field col s12">
                <input type="hidden" id="id_order" name="id" value="<?php echo $_GET['id']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select id="type">
                        <option value="purchase">Purchase</option>
                        <option value="borrowing">Borrowing</option>
                    </select>
                    <label>Type Of Order</label>
                </div>
            </div>
            <div id="all_books"></div>
            <div id="all_customers"></div>
            <div class="row end_button">
                <button class="waves-effect btn-flat" id="validate_edit_command">Edit Order</button>
            </div>
        </div>
    </div>
    <span id="hidden_type"></span>
    <span id="hidden_book"></span>
    <span id="hidden_customer"></span>
</body>
</html>