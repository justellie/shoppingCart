<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sign up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src='./js/index.js' type="module"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-top:50px">
<h1 style="text-align:center;">Sign up</h1><br>
  <div class="row">
    <div class="col-md-4"></div>
      <div class="col-md-4">

        <!-- alert success and danger message--->
        <span class="message-message"></span>
        
        <form id="signupForm">
          <div class="form-group">
             <input type="text" class="form-control" name="name" placeholder="Full Name" required="">
          </div>
          <div class="form-group">
             <input type="email" class="form-control" name="email" placeholder="Email" required="">
          </div>
          <div class="form-group">
             <input type="password" class="form-control" name="password" placeholder="Password" required="">
             <input type="hidden" id="registerId" name="register" value="1">
            </div>
          <p>If you have account <a href="loginView.php">Login</a></p>
          <input type="submit" class="btn btn-primary btn btn-block" value="Sign Up">  
        </form>
      </div>
    </div>
  </div>
</body>

<script type="module">
    import Auth from './js/index.js';
    var page=new Auth();
    $("#signupForm").on("submit",function(e){page.register(e,$(this).serialize());});
</script>
</html>

