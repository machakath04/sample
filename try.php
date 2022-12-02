<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

$id = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email = '$id'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();


// $id = $_GET ['ID'];

$sql = "SELECT * FROM products";
$tao = $con->query($sql) or die ($con->error);
$row1 = $tao->fetch_assoc();


?>

<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900">
        <title> Shop </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
          <style>
* {
  box-sizing: border-box;
  max-width: 100%
}
.column{
            margin-left: 00%;
              width: 33.33%;
            text-align: justify;
           padding:9px;
            /* width: 50%; */
            max-width: 100%
        }
section{
    display: block;
    text-align: left;
    background-color: #814918 ;
    text-indent: 5%;
}
.aa{
    /* display: block;
  box-sizing: border-box; */
  background-color: #E1C16E ;
  /* background-color: brown; */
  padding: 9px;
  width: 70%;
  height: 370px;
  max-width: 100%;
  /* margin-left: 10%; */
  border-radius: 10px;
  background-size: 100% 100%;
 
}
h3{
  color: white;
  border: 1px solid brown;
  background-color: #814918;
 
  
}
h1{
  color: white;
  border: 1px solid brown;
  background-color: #814918;
  width: 50%;
margin-left: 25%;
/* border-radius: 20px; */
}
section a {
  color: white;
  padding: 1rem;
  text-align: justify;
  
}
/* .shop-container{
            background-color:#dfbe90a2 ;
            border-radius:20px;
            height: auto;
            padding: 3rem;
            margin-left: 15%;
            margin-right: 15%;
            margin-top: 5%;
            width: 70%;
            text-align: center;
        }
        */
        a:hover{
 margin-top:  -10px;
box-shadow:5px 8px 8px 5px;
            }
.aa:hover{
  
box-shadow:10px 8px 8px 10px;
            
}
body{
    background-color:#dfbe90a2 ; 
}

</style>
</head>
<body >
    <div class="hyperlinks">
    <a href = "purchases.php"> Orders </a>
    <a href = "cart.php"> Cart </a>  
    <a href = "logout.php"> Log-Out </a>
    </div>

<!-- <div class= "shop-container"> -->
<h1>OUR PRODUCTS</h1> </br> </br>


<?php do{ ?>

  <div class="column">
      <div class = "aa" onclick = "location.href = 'product_description.php?Id=<?php echo $row1['product_id'];?>'" style = "cursor: pointer;"></br>
            
              <img src="./img/<?php echo $row1['picture']; ?>" style="width:40%;margin-left:30%"> </br>
             

             <h3> </br> <?php echo $row1['product_name'] ?> </br> </br></h3>
          <h2> <?php echo $row1['product_price'] ?></h2></div>  </br> 



</br> </div>
<?php } while ($row1 = $tao->fetch_assoc()) ?>

</br> </br>
<!-- </div> -->

<hr>
<section></br>
<a href = "about.php"> About </a> </br><hr>
<a href = "./agreement/terms.php"> Terms and Agreement </a> </br> </br>
</section>
<script>
viewportElement.setAttribute( 'content', 'initial-scale=' + ratio );
</script>
</body>
</html>