<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>';
   }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="admin_css.css">
<link rel="stylesheet" href="css.css">
<link rel="stylesheet" href="admin_css1.css">
<link rel="stylesheet" href="report.css">
<header class="header">
   <div class="flex">
      <a href="admin_products.php" class="logo">Admin<span>Panel</span></a>
      <nav class="navbar">
         <a href="dashboard.php">dashboard</a>
         <a href="admin_view_art.php">artworks</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_artist.php">artist</a>
         <a href="admin_artist_payment.php">payment</a>
         <a href="admin_artist_bank.php">bank details</a>
         <a href="admin_contacts.php">messages</a>
      </nav>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="admin_search.php" class="fas fa-search"></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>
      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
      </div>
   </div>
</header>
<style>
   .message span{
   font-size: 2rem;
   color:#fff;
}
</style>
