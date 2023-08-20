<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message"><span>'.$message.'</span><i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
   }
}
?>
<header class="header">
    <h1 style="font-family: 'Lobster', cursive; color: white;"> Art World</h1>
    <nav class="navbar">
        <a href="index.php">Home</a> 
        <a href="user_products.php">Products</a>
        <a href="user_artist.php">Artist</a>
        <a href="user_orders_placed.php">Orders</a>
		<a href="user_contacts.php">Contact us</a>      
    </nav>
    <div class="icons">
            <a href="user_search.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $res = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $row = mysqli_num_rows($res); 
            ?>
            <a href="user_cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $row; ?>)</span></a>
         </div>
         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="profile_update.php" class="update-btn"><i class="fa fa-edit"></i> update profile</a><br>
            <a href="logout.php" class="logout-btn"><i class="fa fa-sign-out"></i> logout</a><br><br>
            <p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>
         </div>
</header>