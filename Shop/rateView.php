<?php
session_start();
if (!isset($_SESSION['id']) && !isset($_SESSION['product'])) {
    header("Location:shoppingCart.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Application in PHP using AJAX - Sharetutorials</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src='./js/index.js' type="module"></script>
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
        <h3>Welcome <?php echo $_SESSION['name'] ?> </h3>
        <!-- alert success and danger message--->
        <span class="message-message"></span>
        <form id="opinionForm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:30%">Product</th>
                        <th style="width:30%">Average Rating</th>
                        <th style="width:20%">Add opinion</th>
                    </tr>
                </thead>
                <tbody id="productData">
                </tbody>
        </form>
        </table>
        <div class="form-group p-3">
            <input type="submit" class="btn btn-primary mb-2" name="btnSubmit" value="Save">
        </div>
    </div>
    <script type="module">
        import ShoppingCart from './js/classes/ShoppingCartViewController.js';
        var page = new ShoppingCart();

        $(document).ready(function(e, product) {
            let searchParams = new URLSearchParams(window.location.search);
            product = searchParams.get('product');
            page.getAllRate(e, product);
        });
        let searchParams = new URLSearchParams(window.location.search);
        let product = searchParams.get('product');
        $("#opinionForm").on("submit", function(e) {
            page.registerOpinon(e, $(this).serialize(), product);
        });
    </script>

</body>

</html>