<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="My_Book_Store" />
    <title>Welcome to My_Mini_Tweet</title>
    <?php include "media.html" ?>
    <script src="media/js/books.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel" id="the_menu">
            <h1 class="title">Welcome to My_Book_Store !!</h1>
            <h2 class="title">Here is the list of all books !!</h2>
            <div class="row end_button">
                <button class="waves-effect btn-flat" id="logout" token='<?php echo $_SESSION["token"] ?>'>Logout</button>
                <a class="waves-effect btn-flat" href="?page=add_book">Ajouter Livre</a>
                <a class="waves-effect btn-flat" href="?page=add_customer">Ajouter Client</a>
                <a class="waves-effect btn-flat" href="?page=add_command">Ajouter Commande</a>
            </div>
        </div>
        <div id="all_books">
        <!--<div class="row">
                <div class="col s3">
                  <div class="card">
                    <div class="card-image">
                        <img class="materialboxed" data-caption="Frank Thilliez - Rever" src="https://images-na.ssl-images-amazon.com/images/I/51dLjnKP8XL.jpg">
                        <span class="card-title">Card Title</span>
                    </div>
                    <div class="card-content">
                      <p>I am a very simple card. I am good at containing small bits of information.
                          I am convenient because I require little markup to use effectively.</p>
                      </div>
                      <div class="card-action">
                          <a href="#">This is a link</a>
                      </div>
                  </div>
              </div>-->
          </div>
      </div>
  </div>
</body>
</html>