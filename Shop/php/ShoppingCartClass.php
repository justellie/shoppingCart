<?php
class ShoppingCart 
{
    private $post,$get;
    function __construct($post,$get) 
    {
        $this->post = $post;
        $this->get = $get;
    }
 
    function getAllProducts($pdo) 
    {
        $tableData = '';
   
            $query  ="SELECT * FROM product";
            $stmt = $pdo->query($query);

            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) 
            {
                
                $tableData .= ' 
                <tr>
                    
                    <td><a href="./rateView.php?product='.$row["id"].'">'.$row["name"].'</a></td>
                    <td>'.$row["price"].'$</td>
                    <td>'.$row["rate"].'/5</td>
                    <td><div class="form-group">
                        <input type="number"  min="0" class="form-control"  name="quantity-'.$row['id'].'" value="0">
                    </div></td>
                </tr>';
        }
        echo $tableData;
    }
    public function buy($pdo) 
    {
        $query  ="SELECT price,name FROM product";//select the price and name column
        $price = $pdo->query($query);// prepare the consult
        $price =$price->fetchAll(PDO::FETCH_ASSOC);//retrive all the prices
        
        $query="SELECT COUNT(*) as max FROM product";//select the count of products
        $max_products = $pdo->query($query);//prepare the consult
        $max_products = $max_products->fetch(PDO::FETCH_ASSOC);//retrive the value

        $query = "SELECT balance FROM user WHERE id =:id ";// select the balance 
        $stmt = $pdo->prepare($query);           
        $stmt->execute(array(
            ':id' => $_SESSION['id'])
        );
        $balance=$stmt->fetch(PDO::FETCH_ASSOC);
        $prevBalance=(float)$balance['balance'];

        $total=0;
        $newBalance=0;
        $acum=0;//total price to pay 

        for ($i=1; $i < $max_products['max']+1; $i++) 
        {     
            if((int) $this->post["quantity-$i"]!=0)//if the product is not 0 the i'll retrive the price and sum to the facture
            {
               $acum+= (float)($price[$i-1]['price']) *  (int)$this->post["quantity-$i"];
               $articles[$i]=array(
                   "name"=>$price[$i-1]['name'],
                   "quantity"=>$this->post["quantity-$i"],
                   "price"=>$price[$i-1]['price']
               );
               

            }
        }
        $total+=$acum+ (float) $this->post["shipping"]*5;//if UPS was select the i'll add 5 else no
        $newBalance=$prevBalance-$total;
        if($newBalance<0)
        {
            echo json_encode(array('error'=>'1', 'message'=>'Insufficient funds'));
        }
        else
        {
            $purchase=array(
                "prev_balance"=>$prevBalance,
                "articles"=>$articles,
                "net price"=>$acum,
                "shipping"=>$this->post["shipping"]*5,
                "total"=>$total,
                "new_balance"=>$newBalance
            );
            
            $_SESSION["purchase"]=json_encode($purchase);
            
            $query = "UPDATE user SET balance = :balance WHERE id = :id";
            $stmt = $pdo->prepare($query);           
            $stmt->execute(array(
                ':id' => $_SESSION['id'],
                ':balance'=>$newBalance)
            );
            echo json_encode(($purchase));
        }
        ;
    }

    public function getRateProducts($pdo) // get the product
    {
        //product
        $query="SELECT * FROM product WHERE id=:product_id";
        $stmt=$pdo->prepare($query); 
        $stmt->execute(array(
            ':product_id' => $_GET['product'])
        );
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        $tableData = '';
           
            $tableData .= ' 
                <tr>
                    <td>'.$product["name"].'</td>
                    <td>'.$product["rate"].'/5</td>
                    <td><div class="form-group">
                    <select class="form-control" name="opinion" id="exampleFormControlSelect1">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                  </td>
                </tr>';

        echo $tableData;
    }
    public function registerOpinon($pdo)
    {
        $product_id = $_GET['product'];
        if(!isset($_SESSION['vote-'.$product_id]))// validate if no vote before in this session
        {
            $opinion = $this->post['opinion'];
            $user_id = $_SESSION['id'];
            //save opinion
            $query  = "INSERT INTO rate (value,user_id,product_id)  
                VALUES(:opinion,:user_id,:product_id)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':opinion' => $opinion,
                ':user_id' => $user_id,
                ':product_id' => $product_id)
            );
            //retrive new avgRate
            $query = "SELECT ROUND(AVG(value),1) as averageRating FROM rate WHERE product_id=:product_id";
            $stmt=$pdo->prepare($query);
            $stmt->execute(array(
                ':product_id'=>$product_id));
            $avgRate=$stmt->fetch(PDO::FETCH_ASSOC);
            
            //update the rate in the product table
            $query = "UPDATE product SET rate = :rate WHERE id = :id";
            $stmt = $pdo->prepare($query);           
            $stmt->execute(array(
                ':id' => $product_id,
                ':rate'=>$avgRate['averageRating'])
            );
            //safe the vote
            $_SESSION['vote-'.$product_id]=1;
            echo json_encode(array('error'=>'0', 'message'=>'Opinon successfully saved'));
        }
        else
        {
            echo json_encode(array('error'=>'1', 'message'=>'You have already voted in this session'));
        }

    }

	    
    

}
?>