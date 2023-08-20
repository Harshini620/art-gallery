<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}
include 'add_to_cart.php';
?>
<html>
<head>
   <title>art type</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="user_css.css">
</head>
<body>
<?php include 'user_header.php'; ?>
<section class="products">
<h1 class="heading"><span><?php echo $_GET['art_type'];?></span> art <a href="#all"><span>&#8594;</a></span></h1>
<div class="box-container">
   <?php  
      $art_type = $_GET['art_type'];
      $res = mysqli_query($conn, "SELECT * FROM `products` where art_type= '$art_type'") or die('query failed');
      if(mysqli_num_rows($res) > 0)
      {
         while($row = mysqli_fetch_assoc($res))
         {
            include 'products.php';
         }
      }else{
         echo '<p class="empty">no artwork added yet!</p>';
      }
   ?>
</div>
</section>
<script src="js/script.js"></script>
</body>
</html>