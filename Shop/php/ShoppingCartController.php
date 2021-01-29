<?php
	// include database connectivity file

	include_once('pdo.php');
    require_once("ShoppingCartClass.php");
    session_start();
    $register=new ShoppingCart($_POST,$_GET);
    if (isset($_GET['action']) ) 
    {   
        if ($_GET['action']== "get_data") 
        {
            $register->getAllProducts($pdo);
        }
        if ($_GET['action']== "get_rate") 
        {
            $register->getRateProducts($pdo);
        }
    }
    else
    {

            if (isset($_POST["shipping"]))
            {
                $register->buy($pdo);
            }
            if (isset($_POST["opinion"]))
            {
                $register->registerOpinon($pdo);
            }
            
        }


?>