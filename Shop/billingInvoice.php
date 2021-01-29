<?php
  session_start();
  if (!isset($_SESSION['purchase'])) {
    header("Location:shoppingCart.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <title>Document</title>
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
</head>
<body>
<div class="container-fluid mt-100 mb-100">
    <div id="ui-view">
        <div>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <h6 class="mb-3">From:</h6>
                            <div><strong>Happy Market</strong></div>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-3">To:</h6>
                            <div><strong><?php echo htmlentities($_SESSION['name'])?></strong></div>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="left">Item</th>
                                    <th class="center">UNIT</th>
                                    <th class="right">COST</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $help=json_decode($_SESSION['purchase'], true);
                                foreach ($help['articles'] as $article) {
                                    echo'<tr>';
                                    echo '<td class="left">'.htmlentities(ucfirst($article['name'])).'</td>';
                                    echo '<td class="center">'.$article['quantity'].'</td>';
                                    echo '<td class="right">'.ucfirst($article['price']).' $</td>';
                                    echo'</tr>';
                                }
                            ?>           
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>

                                <?php 
                                $help=json_decode($_SESSION['purchase'], true);
                                    echo'<tr>';
                                    echo '<td class="left"><strong>Previous Balance</strong></td>';
                                    echo '<td class="center">'.$help['prev_balance'].'</td>';
                                    echo'</tr>';

                                    echo'<tr>';
                                    echo '<td class="left"><strong>Subtotal</strong></td>';
                                    echo '<td class="center">'.$help['net price'].'</td>';
                                    echo'</tr>';

                                    echo'<tr>';
                                    echo '<td class="left"><strong>Shipping</strong></td>';
                                    echo '<td class="center">'.$help['shipping'].'</td>';
                                    echo'</tr>';

                                    echo'<tr>';
                                    echo '<td class="left"><strong>Total</strong></td>';
                                    echo '<td class="center">'.$help['total'].'</td>';
                                    echo'</tr>';

                                    echo'<tr>';
                                    echo '<td class="left"><strong>New Balance</strong></td>';
                                    echo '<td class="center">'.$help['new_balance'].'</td>';
                                    echo'</tr>';
                            ?>  

                                </tbody>
                            </table>
                            <div class="pull-right"> <a class="btn btn-sm btn-success" href="./shoppingCart.php" data-abc="true"><i class="fa fa-paper-plane mr-1"></i> New order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>