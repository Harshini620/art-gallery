<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}?>
<html>
<head>
   <title>orders-placed</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="user_css.css">
</head>
<body style="color:#fff">
<?php include 'user_header.php'; ?>
<section class="order-placed">
<h1 class="heading"> your <span>order details</span></h1>
   <div class="box-container">
      <?php
         $res = mysqli_query($conn, "SELECT * FROM `orders` inner join users on orders.user_id=users.id WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
      ?>
      <div class="box">
         <p> order placed on : <span><?php echo $row['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $row['name']; ?></span> </p>
         <p> number : <span><?php echo $row['number']; ?></span> </p>
         <p> email : <span><?php echo $row['email']; ?></span> </p>
         <p> address : <span><?php echo $row['address']; ?></span> </p>
         <p> payment method : <span><?php echo $row['method']; ?></span> </p>
         <p> your orders : <span><?php echo $row['total_products']; ?></span> </p>
         <p> total price : <span>₹<?php echo $row['total_price']; ?>/-</span> </p>
         <center><br><hr width="100%" color="grey" size="4"></center>
         <p> order status : <span style="color:<?php if($row['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $row['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<h1>no orders placed!</h1>';
      }
      ?>
   </div>
</section>
<script src="js/script.js"></script>
</body>
</html>
