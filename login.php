<?php
include 'connection.php';
session_start();
if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $res = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   if(mysqli_num_rows($res) > 0){
      $row = mysqli_fetch_assoc($res);
      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:dashboard.php');
      }elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:index.php');
      }
      elseif($row['user_type'] == 'artist'){
         $_SESSION['artist_name'] = $row['name'];
         $_SESSION['artist_email'] = $row['email'];
         $_SESSION['artist_id'] = $row['id'];
         header('location:artist_tips.php');
      }
   }else{
      $message[] = 'incorrect email or password!';
   }
}
?>
<html>
<head>
   <title>login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
<title>Art Gallery</title>
</head>
<style>
::-ms-reveal{
  filter:invert(100%);
}
</style>
<body style="background-color: black;  color:white;">
<?php
if(isset($message)){
   foreach($message as $message){
    echo '<div class="message"><span>'.$message.'</span><i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
   }
}
?>
<form action="" method="post">
    <div class="login-box"><center>
    <h2 align="center">Log in</h2><br>
    <div class="textbox">
        <i class="fas fa-user fa-2x"></i><input type="email" placeholder="Enter username" name="email" required />
    </div>
    <div class="textbox">
        <i class="fas fa-lock fa-2x"></i><input type="password" placeholder="Enter password" name="password" required/>
    </div>
    <br>
    <tr>
        <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Submit" /></td>
    </tr>
    <tr>
       <h4>don't have an account? <a href="register.php">Create one!</a></center><h4>
    </tr>
    </div>
</form>
</body>
</html>