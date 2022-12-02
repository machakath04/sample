<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){
 

include_once("connections/connection.php");

connection();

$con = connection();



$sql = "SELECT * FROM orders";
$orders = $con->query($sql) or die ($con->error);
$row1 = $orders->fetch_assoc();


?>

<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> ORDERS </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

          <style>
             table {
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
                
            }

            th {
                padding: 8px;
                background-color: #E1C16E;
                color: black;
                text-align: center;
            }
            td {
                text-align: center;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:nth-child(odd) {
                background-color: #f5e2e2;
            }
            h1{
  color: black;
 
}
.cart-all{
    background-color:#dfbe90a2 ; 
    /* background-color:#dfbe90a2 ; */
border-radius:3px;
height: auto;
padding: 2rem;
margin-left: 3%;
margin-right: 5%;
margin-top: 5%;
width: 90%;
box-shadow: 5px 8px 8px 5px;
}
            </style>
</head>
<body id = "dashboard"> </br></br>
<!-- <a href = "orders.php"> ORDERS </a> -->
    <div class = "cart-all">
        <h1> LIST OF ORDERS </h1> </br></br>
       
<table>
     
<tr>
        
        <th> Order ID </th>
            <th> Date and Time </th>
            <th> Email Adress</th>
            <th> Product Name </th>
            <th> Quantity  </th>
            <th> Status</th>
            <th> Details </th>
           
            
   </tr>
   
   <tr>
   <?php do{ ?>
   <td> <?php echo $row1['order_id'] ?>  </td>
   <td> <?php echo $row1['date'] ?>  </td>
   <td>  <?php echo $row1['email'] ?> </td>
   <td>  <?php echo $row1['product_name'] ?> </td>
   <td>  <?php echo $row1['quantity'] ?> </td>
   <td>  <?php echo $row1['Status'] ?> </td>
   <td> <a href = "order_details.php?ID=<?php echo $row1['order_id'];?>">View </a>
   
   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>
</table>
</div>

<?php } else{
   echo header("Location:admin.php");
} ?>

</body>
</html>       