<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="My_Book_Store" />
    <title>Welcome to My_Mini_Tweet</title>
    <?php include "media.html" ?>
    <script src="media/js/edit_user.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel" id="the_menu">
            <h1 class="title">Welcome to My_Book_Store !!</h1>
            <h2 class="title">You can edit your account here !!</h2>
            <?php include "button.php"; ?>
        </div>
        <div id="edit_login_error"></div>
        <div id="edit_password_error"></div>
        <div id="edit_login">
            <div class="row">
                <div class="input-field col s12">
                    <input id="old_login" type="text" name="old_login">
                    <label for="old_login">Old Login</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="new_login" type="text" name="new_login">
                    <label for="new_login">New Login</label>
                </div>
            </div>
            <div class="row end_button">
                <button class="waves-effect btn-flat" id="validate_edit_login">Edit Login</button>
            </div>
        </div>
        <div id="edit_password">
            <div class="row">
                <div class="input-field col s12">
                    <input id="old_password" type="password" name="old_password">
                    <label for="old_password">Old Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="new_password" type="password" name="new_password">
                    <label for="new_password">New Password</label>
                </div>
            </div>
            <div class="row end_button">
                <button class="waves-effect btn-flat" id="validate_edit_password">Edit Password</button>
            </div>
        </div>
    </div>
</body>
</html>