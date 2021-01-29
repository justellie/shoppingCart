<?php
  session_start();
  if (isset($_SESSION['id'])) {
      header("Location:shoppingCart.php");
  }
?>
<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login using jQuery AJAX in PHP Mysql</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-top:50px">
<h1 style="text-align: center;">Login</h1><br>
  <div class="row">
     <div class="col-md-4"></div>
      <div class="col-md-4" style="margin-top:20px">

        <!-- alert success and danger message--->
        <div class="alert alert-danger alert-dismissible show-message" role="alert" style="display: none;">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <span class="ajax-message"></span>
        </div>
        
        <form id="loginForm">
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="email" required="">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="">
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control"  name="login" value="1">
          </div>
          <p>Are you new user? <a href="register.php">Sign Up</a></p>
          <input type="submit" class="btn btn-primary btn btn-block" name="btnSubmit" value="Login">
        </form>
      </div>
    </div>
  </div>
</body>
<script type="module">
    import Auth from './js/index.js';
    var page=new Auth();
    $("#loginForm").on("submit",function(e){page.login(e,$(this).serialize());});
</script>
</html>