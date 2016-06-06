<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="My_Book_Store" />
    <title>Welcome to My_Book_Store</title>
    <?php include "media.html" ?>
    <script src="media/js/home_page.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel" id="the_menu">
            <h1 class="title">Welcome to My_Book_Store !!</h1>
        </div>
        <div class="row">
            <div id="div_error">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">face</i>
                <input id="user_login" type="text">
                <label for="user_login">Login</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">vpn_key</i>
                <i class="material-icons right" id="display_user_pass">visibility</i>
                <input id="user_pass" type="password">
                <label for="user_pass">Password</label>
            </div>
        </div>
        <div class="row end_button">
            <button class="waves-effect btn-flat" id="connexion">Sign In</button>
        </div>
    </div>
</div>
</body>
</html>