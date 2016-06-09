<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="My_Book_Store" />
    <title>Welcome to My_Mini_Tweet</title>
    <?php include "media.html" ?>
    <script src="media/js/add_customer.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel" id="the_menu">
            <h1 class="title">Welcome to My_Book_Store !!</h1>
            <h2 class="title">You can add a customer here !!</h2>
            <?php include "button.php"; ?>
        </div>
        <div id="add_customer_error"></div>
        <div id="add_customer">
            <div class="row">
                <div class="input-field col s12">
                    <input id="first_name" type="text" name="first_name">
                    <label for="first_name">Firstname</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="last_name" type="text" name="last_name">
                    <label for="last_name">Lastname</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="adresse" type="text" name="adresse">
                    <label for="adresse">Adresse</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="city" type="text" name="city">
                    <label for="city">City</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row end_button">
                <button class="waves-effect btn-flat" id="validate_add_customer">Add The Customer</button>
            </div>
        </div>
    </div>
</body>
</html>