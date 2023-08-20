<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_POST['send'])){
   $name =  $_POST['name'];
   $email = $_POST['email'];
   $number = $_POST['number'];
   $msg = $_POST['message'];
    $date=date('Y-m-d');
   $res = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');
   if(mysqli_num_rows($res) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message,placed_on) VALUES('$user_id', '$name', '$email', '$number', '$msg','$date')") or die('query failed');
      $message[] = 'message sent successfully!';
   }
}
?>
<html>
<head>
   <title>message</title>
   <link rel="stylesheet" href="user_css.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php include 'user_header.php'; ?>
<section class="user-contact">
<h1 class="heading"><span> Feedback</span></h1>
   <form action="" method="post">
      <?php
         $res1 = mysqli_query($conn, "SELECT * FROM `users` where id='$user_id'") or die('query failed');
         while($row = mysqli_fetch_assoc($res1)){
      ?>
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box" value="<?php echo $row['name']; ?>" >
      <input type="email" name="email" required placeholder="enter your email" class="box" value="<?php echo $row['email']; ?>">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btnn">
   </form>
<?php } ?>
</section>
<script src="js/script.js"></script>
</body>
</html>
