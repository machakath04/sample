<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

$id = $_GET ['ID'];
$sql=" SELECT user.Lname, user.Fname, user.email, details.Province, details.Region, details.City, details.Brgy,
        details.House, details.Postal, orders.order_id, orders.product_name, orders.product_id, orders.date,
        orders.product_price, orders.quantity, orders.reference, orders.image, orders.total, orders.payment FROM user INNER JOIN details ON user.email = details.email
        INNER JOIN orders ON details.email = orders.email WHERE orders.order_id = '$id'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();

?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> RECEIPT </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    .receipt{
        width: 40%;
        border: 1px solid black;
        height: auto;
        padding: 2rem;
        margin-left: 30%;
        margin-right: 30%;
        margin-top: 5%;

    }
    h4{
        color: black;
    }
    .column{
            float: center;
            width: 10%;
            margin-left: 10%;
            

        }
        .row:after{
            content: "";
            display: table;
            clear: both;
            /* width:50% */
            margin-right: 7%;
        }
    </style>

        </head>
<body>

<div class ="receipt" id ="receipt">
<div class="column">
<img style="width:50px;height:50px;"src = "img/logo2.png">  </div>
<div class="row">
<h5> MACHAKATH: HOMEMADE PEANUT BUTTER SHOP </h5> </div>
<h4> Customer Details </h4>
<hr>
<label> Name: <?php echo $row['Fname']." " . $row['Lname'] ?> </label> </br>
<label>Address: <?php echo $row['Region']."  ". $row['Province']. ", " . $row['City']. ", " . $row['Brgy']. " ," . $row['House']. ", " . $row['Postal'] ?>  </br> </br>
<hr>
<h4> Order details </h4>
<hr>
<label> Order Id: <?php echo $row['order_id'] ?> </br>
<label> Product Id: <?php echo $row['product_id'] ?> </br>
<label> Product Name: <?php echo $row['product_name'] ?> </br>
<label> Quantity: <?php echo $row['quantity'] ?> </br>
<label> Total Amount: <?php echo $row['total'] ?> </br>
<label> Payment: <?php echo $row['payment'] ?> </br>
<hr>
<h4> Others </h4>
<hr>
<label>Reference Number: <?php echo $row['reference']?></label> </br>
<label>Additional Charges: </label> </br>
</div>
<button onclick="window.print()"> Print </button>
<!-- <input type="button" value="Print" onclick="printDiv()"> -->

<!-- <script>
        function printDiv() {
            var divContents = document.getElementById("receipt").innerHTML;
            var a = window.open();
            a.document.write('<html>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            divContents.print();
        }
    </script> -->


</body>
</html>