<?php
class Auth 
{
// AGREGAR MAIL A COMO DE LUGAR 
    private $post;
    function __construct($post) 
    {
        $this->post = $post;
    }
    function makeRegister($pdo) 
    {
        if (isset($this->post['name'])) 
        {
		
	        $fullname = $this->post['name'];
	        $email = $this->post['email'];
	        $password = hash('md5',$this->post['password']);
	        $query  = "INSERT INTO user (name,password,email,balance )  
                VALUES(:fullname,:password,:email,:balance)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':fullname' => $fullname,
                ':password' => $password,
                ':email' => $email,
                ':balance'=>100)
            );
            if ($stmt) 
            {
                echo json_encode(array('error'=>'0', 'message'=>'Registration successfully Login'));
            }
           else
           {
               echo json_encode(array('error'=>'1', 'message'=>'Registration Failed try again'));
           }

	    }
    }
    function login($pdo)
    {
        if (isset($this->post['email'])) 
        {

	        $email = $this->post['email'];
	        $password = hash('md5',$this->post['password']);
        
            $query = "SELECT * FROM user WHERE email =:email && password =:password";
            
            $stmt = $pdo->prepare($query);
        
           
            $stmt->execute(array(
                ':password' => $password,
                ':email' => $email)
            );
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            if(isset($row['name']))
            {
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                echo 1;
            }
            else
            {
                echo 0;
            }
        }
    }
}
?>