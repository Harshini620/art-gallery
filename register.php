<?php
session_start();
include 'connection.php';
if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $user_type = $_POST['user_type'];
   $date=date('Y-m-d');
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type,placed_on) VALUES('$name', '$email', '$cpass', '$user_type','$date')") or die('query failed');
         echo 'registered successfully!';
         header('location: login.php');
      }
   }
}
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="login.css">
   <title>Art Gallery</title>
</head>
 <body style="background-color: black; color:white;">
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span><i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
   }
}
?>
<form action = ""  method = "POST">      
	<div class="login-box"><center>
		<h1>I am new!</h1>
		<tr>
      		<td align="right"><font size="3"><b>Log in as&nbsp;:&nbsp;</b></font></td>
    	<td>
		<select name="user_type" id="nname" style="width: 13em; height: 2em; font-size: 15px; ">
         <option value="user">user</option>
         <option value="admin">admin</option>
         <option value="artist">artist</option>
      </select>
      	</td>
  		</tr>
  		<div class="textbox">
    		<i class="fas fa-user" style="font-size:18px;"></i><input type="text" placeholder="Enter your name" name="name" required/>
  		</div>
		<div class="textbox">
    		<i class="fa fa-envelope" style="font-size:18px;"></i><input type="email" placeholder="Enter your email-id " name="email" required/>
  		</div>
		<div class="textbox">
    		<i class="fa fa-eye"  style="font-size:18px;"></i><input type="password" name="password" placeholder="enter your password" required/>
  		</div>
		<div class="textbox">
    		<i class="fa fa-eye"  style="font-size:18px;"></i><input type="password" name="cpassword"  placeholder="confirm your password" required/>
  		</div>
      <tr>
         <td colspan="2" align="center"><input type="submit" class="btn" name="submit" value="Create One!"></td>
      </tr>
      <br>
      <tr><h3>Already login <a href="login.php">Login!</a></center></h3></tr>
	</div> 
</form>
</body>
</html>
