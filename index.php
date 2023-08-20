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
    <title>ART GALLERY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="user_css.css">
</head>
<body>
<?php include 'user_header.php'; ?>
<section class="home" id="home">
   <center><video src="images/art-at-home-desktop.mp4" width="90%" id="video" autoplay muted loop></video></center><br>
   <div class="content">
        <h4>the liberation of art- </h4>
        <p>Signed.Limited. Affordable.<p>
    </div>
</section>
<section class="products">
<h1 class="heading"> our <span>Products</span> <a href="#all"><span>&#8594;</a></span></h1>
<div class="box-container">
   <?php  
      $res = mysqli_query($conn, "SELECT * FROM `products` LIMIT 3") or die('query failed');
      if(mysqli_num_rows($res) > 0)
      {
         while($row = mysqli_fetch_assoc($res))
         {
            include 'products.php';
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
</div>
<div class="load-more" style="margin-top: 2rem; text-align:center">
   <a href="user_products.php" class="btnn">Load more</a>
</div>
</section>
<script src="js/script.js"></script>
</body>
</html>
