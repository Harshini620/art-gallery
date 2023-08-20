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
<header id="remove" class="header">
   <div class="flex">
      <a href="artist_add_products.php" class="logo">Artist<span>Panel</span></a>
      <nav class="navbar">
            <a href="artist_tips.php">Tips</a>
            <a href="artist_add_products.php">Add artworks</a>
            <a href="artist_view_art.php">view artworks</a>
            <a href="artist_payment.php">payment details</a>
            <a href="artist_account_details.php">Bank details</a>
      </nav>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>
      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['artist_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['artist_email']; ?></span></p>
         <a href="artist_profile_update.php" class="up-btn"><i class="fa fa-edit"></i> update profile</a><br>
         <a href="logout.php" class="login-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
      </div>
   </div>
</header>
<style>
.message span{
   font-size: 2rem;
   color:#fff;
}
.up-btn{
    display: inline-block;
    margin-top: 1rem;
    padding:1rem 2rem;
    cursor: pointer;
    color:white;
    width:80%;
    background-color: #f39c12;
    font-size: 1.8rem;
    border-radius: .5rem;
    text-transform: capitalize;
    box-align:center;
    border-radius:5px;
 }
 .login-btn{
    display: inline-block;
    margin-top: 1rem;
    padding:1rem 2rem;
    cursor: pointer;
    color:white;
    width:80%;
    background-color: #d3ad7f;
    font-size: 1.8rem;
    border-radius: .5rem;
    text-transform: capitalize;
    box-align:center;
    border-radius:5px;
 }
 .up-btn:hover,.login-btn:hover{
  letter-spacing: .2rem;
 }
 .header .flex .account-box{
   position: absolute;
   top:120%; right:2rem;
   width: 33rem;
   box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
   border-radius: .5rem;
   padding:2rem;
   text-align: center;
   border-radius: .5rem;
   border:.1rem solid #333;
   background-color: #13131a;
   color:#fff;
   display: none;
   animation:fadeIn .2s linear;
}
</style>
