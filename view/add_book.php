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
            <div class="row end_button">
                <button class="waves-effect btn-flat" id="logout" token='<?php echo $_SESSION["token"] ?>'>Logout</button>
                <a class="waves-effect btn-flat" href="?page=add_book">Ajouter Livre</a>
                <a class="waves-effect btn-flat" href="?page=add_customer">Ajouter Client</a>
                <a class="waves-effect btn-flat" href="?page=add_command">Ajouter Commande</a>
            </div>
        </div>
        <div id="add_book">
        add a book
          </div>
      </div>
  </div>
</body>
</html>