<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
}
?>

<html>
<head>
   <title>admin panel</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="dashboard.css">
</head>
<body style="background-color:black">
   
<?php include 'admin_header.php'; ?>


<section class="dashboard">
   <h1 class="title">dashboard</h1>
   <div class="box-container">

      <div class="box">
         <?php
            $result = 0;
            $sql = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status != 'completed'") or die('query failed');
            $row = mysqli_num_rows($sql);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>orders pending</p>
      </div>

      <div class="box">
         <?php
            $result = 0;
            $sql = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
            $row = mysqli_num_rows($sql);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>completed orders</p>
      </div>

      <div class="box">
         <?php 
            $res = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            $row = mysqli_num_rows($res);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>order placed</p>
      </div>

      <div class="box">
         <?php 
            $res = mysqli_query($conn, "SELECT * FROM `artist_payment` where status != 'pending' && status !=''") or die('query failed');
            $row = mysqli_num_rows($res);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>artist payment completed</p>
      </div>

      <div class="box">
         <?php 
            $res = mysqli_query($conn, "SELECT * FROM `artist_payment` where status = 'pending' || status =''") or die('query failed');
            $row = mysqli_num_rows($res);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>artist payment pending</p>
      </div>

      <div class="box">
         <?php 
            $res = mysqli_query($conn, "SELECT * FROM `artist_payment`") or die('query failed');
            $row = mysqli_num_rows($res);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>total artist payment</p>
      </div>

      <div class="box">
         <?php 
            $res = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $row = mysqli_num_rows($res);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>artworks uploaded</p>
      </div>

      <div class="box">
         <?php 
            $res = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $row = mysqli_num_rows($res);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>customer</p>
      </div>

      <div class="box">
         <?php 
            $res = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'artist'") or die('query failed');
            $row = mysqli_num_rows($res);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>artist</p>
      </div>

      <div class="box">
         <?php 
            $sql = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $row = mysqli_num_rows($sql);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>admin</p>
      </div>

      <div class="box">
         <?php 
            $sql = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $row = mysqli_num_rows($sql);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>total accounts</p>
      </div>

      <div class="box">
         <?php 
            $sql = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $row = mysqli_num_rows($sql);
         ?>
         <h3><?php echo $row; ?></h3>
         <p>new messages</p>
      </div>

   </div>
</section>
<script src="src.js"></script>
</body>
</html>