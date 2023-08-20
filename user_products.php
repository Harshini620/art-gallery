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
   <title>products</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="user_css.css">
    <link rel="stylesheet" href="user_css1.css">
</head>
<body style="color:#fff"> 
<?php include 'user_header.php'; ?><br>
<h1 class="heading"> our <span>theme</span>
<section class="product_theme">
   <a href="theme.php?theme=city">city</a>
   <a href="theme.php?theme=flower">flower</a>
   <a href="theme.php?theme=animal">animal</a>
   <a href="theme.php?theme=sea">sea</a>
</section>
<h1 class="heading"> our <span>art style</span>
<section class="product_theme">
   <a href="art_type.php?art_type=pencilsketching">pencil sketching</a>
   <a href="art_type.php?art_type=painting">painting</a>
   <a href="art_type.php?art_type=oilpainting">oil painting</a>
   <a href="art_type.php?art_type=watercoloring">water coloring</a>
</section>
<br>
<section class="products">
    <h1 class="heading"> all <span> artworks</span></h1>
    <h3 class="heading1">---(Artworks)---</h3>
    <div class="box-container">
      <?php  
      $res = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      if(mysqli_num_rows($res) > 0){
         while($row = mysqli_fetch_assoc($res)){
            include 'products.php';
      }
   }else{
      echo '<h1>no artworks added yet!</h1>';
   }
   ?>
</div>
</section>
<script src="js/script.js"></script>
</body>
</html>
