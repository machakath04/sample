<?php

    session_start();

if(isset($_SESSION['access']) && $_SESSION['access'] == "admin")
{
 

include_once("connections/connection.php");
connection();
$con = connection();

    $id = $_GET['ID']; 
 
$sql="SELECT orders.order_id, orders.date, orders.email, orders.date, orders.product_id, orders.product_name, 
orders.product_price,orders.quantity, orders.total, orders.payment,orders.Status, user.Fname, user.Lname, details.Province, 
details.Region, details.City, details.Brgy, details.Postal, details.House FROM ((orders INNER JOIN details ON orders.email = details.email) INNER JOIN user ON user.email = details.email) WHERE orders.order_id = '$id'";

// $sql = "SELECT * FROM orders WHERE order_id = '$id'";
$orders = $con->query($sql) or die ($con->error);
$row1 = $orders->fetch_assoc();

if(isset($_POST['update']))
{

    $status=  $_POST['Status'];


    // $sql = "UPDATE orders SET order_id = '$id2', product_id = '$prod_id', product_name = '$name', product_price  = '$price', 
    //             quantity = '$quan', total ='$total', payment = '$payment' , Status = '$status'  WHERE order_id = '$id'";
    $sql = "UPDATE orders SET Status = '$status'  WHERE order_id = '$id'";
     $con->query($sql) or die ($con->error);

     if(isset($_POST['Status']))
{
    if($status == 'Delivered')
 {
    $email = $_POST ['email'];
    $id2=  $_POST['id'];
    $prod_id=  $_POST['prod_id'];
    $name=  $_POST['prod_name'];
    $quan=  $_POST['quantity'];
    $total=  $_POST['amount'];
    $payment=  $_POST['payment'];
    $date = $_POST['date'];
    // $status= "Delivered";


$sql = "INSERT INTO `completed_orders`(`date_ordered`, `order_id`, `email`, `product_id`, `product_name`, `quantity`, `total`,  `payment`, `status`) VALUES ('$date',$id2,'$email','$prod_id', '$name ', ' $quan', '$total', ' $payment', 'Delivered' )";
$con->query($sql) or die ($con->error);

$query = "DELETE FROM orders WHERE order_id = '$id'";
$con->query($query) or die ($con->error);


   // DELETE FROM orders OUTPUT DELETED.*
}}
echo header("Location: orders.php");
 }
 
 if(isset($_POST['receipt']))
 { 
    echo header("Location: order_receipt.php?ID=".$id);
 }
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> ORDERS </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
         
         <style>
           
            h1{
  color: black;
  
border-radius: 20px;
}
.details-container{
    background-color:#dfbe90a2 ; 
    border-radius:3px;
    height: auto;
    padding: 2rem;
    margin-left: 20%;
    margin-right: 20%;
    margin-top: 5%;
    width: 60%;
    box-shadow:8px 5px 5px 8px;
    }
    button{
            width: 30%;
            height: 50px;
            
            background-color: brown;
            font-size: 15px;
            /* letter-spacing: 20px; */
            border-radius: 10px ;
            color: white;
            margin-top: 5%;
    }
    select{
        font-size:15px;
            width: 30%;
            height: 50px;
            border-radius: 10px;
            border: 1px solid black;
            
            float:left;
            /* color: black; */
            background-color:#E1C16E ;
        
        }
        button[name="deliver"]{
            float: right;
            margin-right: 10%;
        }
        #dashboard{
  /* background-color:#8C7663; */
  background-color:#f2edd7ff;
 
}
            </style>
</head>
<body id="dashboard">
<div class="details-container">
<form method = "post" action = " " >
<h1> ORDER DETAILS </h1>
<h4 style="color:black"> Date and Time: <?php echo $row1['date'];?> </h4></br>
<input type= "hidden" name = "date"  value=" <?php echo $row1['date'];?>">
<div class = "column">
<label> Order ID: <?php echo $id;?></label></br>
<input type= "hidden" name = "id"  value="<?php echo $id;?>"readonly>
<label> Email Address: <?php echo $row1['email'];?></label></br>
<input type= "hidden" name = "email"  value="<?php echo $row1['email'];?>"readonly>
<label> Full Name: <?php echo $row1['Fname']. "  ".$row1['Lname']?></label>
<input type= "hidden" name = "name" id = "name"value="<?php echo $row1['Fname']. "  ".$row1['Lname']?>" readonly></br>
<label> Address: <?php echo $row1['Region']. " , ".$row1['Province']. " , ".$row1['Postal']. ", ".$row1['City']. " , ".$row1['Brgy']?> </label>
<input type= "hidden" name = "address" id = "address" value="<?php echo $row1['Region']. " , ".$row1['Province']. " , ".$row1['Postal']. ", ".$row1['City']. " , ".$row1['Brgy']?> " readonly></br>

<label> Product ID: <?php echo $row1['product_id']; ?></br></label>
<input type= "hidden" name = "prod_id"  value="<?php echo $row1['product_id']; ?>"readonly>
<label> Product Name: <?php echo $row1['product_name']; ?></br> </label>
<input type= "hidden" name = "prod_name" style = "font-size:13px"  value="<?php echo $row1['product_name']; ?>"readonly>

</div>
<div class = "row">

<label> Price: <?php echo $row1['product_price']; ?></label>
<input type= "hidden" name = "price"  value="<?php echo $row1['product_price']; ?>"readonly></br>
<label> Quantity: <?php echo $row1['quantity']; ?> </br></label>
<input type= "hidden" name = "quantity"  value="<?php echo $row1['quantity']; ?>"readonly>
<label> Total Amount: <?php echo $row1['total']; ?></br></label>
<input type= "hidden" name = "amount"  value="<?php echo $row1['total']; ?>"readonly>
<label>Mode of Payment: <?php echo $row1['payment']; ?></br></label>
<input type= "hidden" name = "payment"  value="<?php echo $row1['payment']; ?>"readonly>
<label> Status: <?php echo $row1['Status']?></label></br></br> </br>

</div></br>
<label style="margin-left:350px"> Status: </label></br>
<select style="margin-left:270px" name="Status" id="Status" > <option value="Processing">Processing</option>
<option value="To be Delivered">To be Delivered</option> <option value="Delivered"> Delivered</option> </select></br></br></br>

<button type="submit"  name= "update">Save </button>
<button type="submit"  name= "receipt" style="margin-left:35%"> Generate Receipt </button>
</div>
</form>

<?php } else{
   echo header("Location:admin.php");
} ?>

</body>
</html>

