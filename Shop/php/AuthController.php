<?php
	// include database connectivity file

	include_once('pdo.php');
    require_once("AuthClass.php");
    $register=new Auth($_POST);
    if (isset($_POST['register'])) 
    {
        $register->makeRegister($pdo);
    }
    else
    {
        session_start();
        $register->login($pdo);
    }
    
    

?>