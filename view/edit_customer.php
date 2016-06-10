<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="My_Book_Store" />
    <title>Welcome to My_Mini_Tweet</title>
    <?php include "media.html" ?>
    <script src="media/js/edit_customer.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel" id="the_menu">
            <h1 class="title">Welcome to My_Book_Store !!</h1>
            <h2 class="title">You can edit your customer here !!</h2>
            <?php include "button.php"; ?>
        </div>
        <div id="edit_customer_error"></div>
        <div id="edit_customer">
        <div class="row">
            <div class="input-field col s12">
                <input type="hidden" id="id_customer" name="id" value="<?php echo $_GET['id']; ?>">
            </div>
        </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="first_name" type="text" name="first_name" placeholder="Firstname">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="last_name" type="text" name="last_name" placeholder="Lastname">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="adresse" type="text" name="adresse" placeholder="Adresse">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="city" type="text" name="city" placeholder="City">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="row end_button">
                <button class="waves-effect btn-flat" id="validate_edit_customer">Edit The Customer</button>
            </div>
        </div>
    </div>
</body>
</html>