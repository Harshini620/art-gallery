<?php
include 'connection.php';
session_start();
$artist_id = $_SESSION['artist_id'];
if(!isset($artist_id)){
   header('location:login.php');
}
include 'artist_header.php'; ?>
<html>
<head>
   <title>payment for artist</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin_css.css">
   <link rel="stylesheet" href="artist_report.css">
</head>
<body  style="background-color: black; color:#fff">
<section class="artist">
<h1 class="title"><span>your </span>artwork payment</h1>
   <div class="box-container">
   <?php
        $res = mysqli_query($conn, "SELECT p.image,p.name,p.price,a.final_price,a.status FROM artist_payment a INNER JOIN products p ON a.name=p.name where a.user_id='$artist_id'");
        if(mysqli_num_rows($res)>0){
         while($row = mysqli_fetch_assoc($res)){             
    ?>
      <div class="box">
          <div class="image"><img src="images/<?php echo $row['image']; ?>" alt=""></div>
          <div class="name"><?php echo $row['name']; ?></div>
          <p>Your art price : <span>₹<?php echo $row['price'] ?>/-</span></p>
          <p>Our commission : <span>₹100/-</span></p>
          <p>-------------------------------------</p>
          <p>Total price : <span>₹<?php echo $row['final_price'] ?>/-</span></p> 
          <p> Status : <span><?php echo $row['status'] ?></span> </p>         
      </div>
      <?php
       }
      }
      ?>
   </div><br>
</section>
<center><button onclick="window.print()" class="btnn" id="remove">print report</button></center>
<script src="src.js"></script>
</body>
</html>