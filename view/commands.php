<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="My_Book_Store" />
  <title>Welcome to My_Mini_Tweet</title>
  <?php include "media.html" ?>
  <script src="media/js/commands.js"></script>
</head>
<body>
  <div class="container" id="the_body">
    <div class="row mui-panel" id="the_menu">
      <h1 class="title">Welcome to My_Book_Store !!</h1>
      <h2 class="title">Here is the list of all orders !!</h2>
      <?php include "button.php"; ?>
    </div>
    <div class="row" id="all_orders"></div>
  </div>
</body>
</html>