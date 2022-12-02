<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();
 

$id1 = $_SESSION['email'];
 
$sql = "SELECT cart.id, cart.email, cart.product_id, cart.product_name, cart.product_size, cart.product_price, 
        cart.quantity, cart.total, products.picture FROM cart INNER JOIN products ON cart.product_id = products.product_id WHERE email = '$id1'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();

$qry = "SELECT SUM(total) AS 'sum' FROM cart WHERE email = '$id1' ";
$res = $con->query($qry) or die ($con->error);
$rec = $res->fetch_assoc();

if(isset($_POST['checkourt']))
{

  $name = $_POST['name'];
  $price = $_POST['price'];
    $quantity=  $_POST['quantity'];
    $payment = $_POST['payment'];
$prod_id = $_POST['product_id'];
    $tot = $_POST['quantity'] * $_POST['price'] ;

     $reference = $_POST['reference'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./img/payments/". $filename;

  $sql= "INSERT INTO `orders`( `email`, `product_id`,`product_name`,`product_price`, `quantity`, `total`, `payment`, `Status`, `reference`, `image`) VALUES ('$id1', '$prod_id','$name','$price',' $quantity', ' $tot', ' $payment', 'Processing', '$reference', '$filename')";
   $con->query($sql) or die ($con->error);


    echo header("Location: purchases.php");
       // DELETE FROM orders OUTPUT DELETED.*
     }



?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> PURCHASE </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <table>
<?php do{ ?>
        <tr> <td>
    <form action = " " method = "post" >
    <img src="./img/<?php echo $row['picture']; ?>" style="width:120px; float:left">  
    <label style="margin-left:7%"> <?php echo $row['product_id'] ?> </br>
      <label style="margin-left:7%"><?php echo $row['product_name'] ?>  </h4> </br>
      <label style="margin-left:7%"><?php echo $row['product_size'] ?></br> 
      <label style="margin-left:7%"><?php echo $row['quantity'] ?></br> 
    
<input type="hidden" name="product_id" value="<?php echo $row1['product_id']?>">
<input type ="hidden" name = "name" id = "name" style = "width:80%" value="<?php echo $row1['product_name'];?>" readonly>
<input type ="hidden" name = "price" id = "price" style = "width:80%" value="<?php echo $row1['product_price'];?>" readonly>


    </td>
    </tr>
      <?php } while ($row = $tao->fetch_assoc()) ?>
      
    </table>
    <h3 style="float:right;margin-right:30px"> Total Amount : <?php echo $rec['sum']; ?> </h3> </br> 
    <button type="submit" name="checkout"> <b> Check-Out </b> </button> </form>
    
    <div class = "row4">
<label style="margin-left: 20%"> Select Mode of Payment: </label> </br>
<label for="cod">
<input type="radio" style="margin-left: 20%" id="cod" name="payment" style = "width:2%" onclick = "show()" value="COD" > CASH ON DELIVERY  
</label>
<label for="gcash" >
<input type="radio" id="online" name="payment" style = "width:2%"  onclick = "show()"  value="GCASH"> GCASH <br/> </label>

<div id="reference" style="display: none">
<hr>
<div class="column4">    
    <h4 >Gcash Information</h4>
    <h4>Name: Kharell Salvador </h4>
    <h4 >Gcash Number: 0939411662</h4> </div>
       
    <div class="row4">
<label style="margin-left:25%;height:8%">Reference Number: </br><input style="margin-left:25%" type="test" name="reference">
    <input type="file"  name="uploadfile"  style="margin-left:25%; width:30%;height:7%"  value="" /> </div>



    <script type="text/javascript">
    function show() {
        var gcash = document.getElementById("online");
        var reference = document.getElementById("reference");
        reference.style.display = online.checked ? "block" : "none";
    }
    function view() {
      event.preventDefault()                                                                           
    document.getElementById("amount").style.display = "block";
    
  }

</script>
</body>
</html>
