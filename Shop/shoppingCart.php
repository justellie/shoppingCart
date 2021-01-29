<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    header("Location:loginView.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shopping Car</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="./shoppingCart.php">Shopping Cart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['name'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="./logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <body>
    

        <div class="container">
            <h3>Welcome back! <?php echo $_SESSION['name'] ?> </h3>
            <!-- alert success and danger message--->
            <span class="message-message"></span>
            <form id="purchaseForm">
            <table class="table table-striped">
                <thead >
                    <tr>
                        <th style="width:30%">Product</th>
                        <th style="width:30%">Price</th>
                        <th style="width:20%">Rate</th>
                        <th style="width:20%">Quantity</th>
                    </tr>
                </thead>
                    <tbody id="productData">
                    </tbody>
                </form>
            </table>

            <p>Shipping </p>
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio1" name="shipping" value='0' class="custom-control-input">
                    <label class="custom-control-label" for="customRadio1">Pick up (USD 0)</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio2" name="shipping" value='1' class="custom-control-input">
                    <label class="custom-control-label" for="customRadio2"> UPS (USD 5)</label>
                </div>
            <div class="form-group p-3">
                <input type="submit" class="btn btn-primary mb-2" name="btnSubmit" value="Pay">
            </div>
        </div>
<script type="module">
    import ShoppingCart from './js/classes/ShoppingCartViewController.js';
    var page=new ShoppingCart();
$( document ).ready(function() {
    page.getAllData();
});
$("#purchaseForm").on("submit",function(e){page.buy(e,$(this).serialize());});

</script>

    </body>
</html>