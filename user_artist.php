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
<body> 
<?php include 'user_header.php'; ?><br>
<h1 class="heading"> our <span>Artist</span>
<section class="artist">
  <?php
    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type='artist'");
    if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
  ?>
   <a href="artist.php?artist_name=<?php echo $row['name'];?>"><?php echo $row['name'];?></a>
   <?php
    }
   } 
   ?>
</section>
<script src="js/script.js"></script>
</body>
</html>