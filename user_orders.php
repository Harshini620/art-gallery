<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_POST['order_btn'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('Y-m-d');
   $final_total = 0;
   $cart_artworks[] = '';
   $result1 = mysqli_query($conn, "SELECT * FROM `cart` INNER JOIN products ON products.id=cart.p_id WHERE cart.user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($result1) > 0){
      while($row1 = mysqli_fetch_assoc($result1)){
         $cart_artworks[] = $row1['name'].' ('.$row1['quantity'].') ';
         $total = ($row1['price'] * $row1['quantity']);
         $final_total += $total;
      }
   }
   $total_products = implode(', ',$cart_artworks);
   $result2 = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' AND name='$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$final_total'") or die('query failed...');
   if($final_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($result2) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id,name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$final_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
}
?>
<html>
<head>
   <title>user-order</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="user_css.css">
</head>
<body>
<?php include 'user_header.php'; ?>
<section class="display-order">
   <?php  
      $final_price = 0;
      $result3 = mysqli_query($conn, "SELECT * FROM `cart` INNER JOIN products ON products.id=cart.p_id WHERE cart.user_id='$user_id'") or die('query failed');
      if(mysqli_num_rows($result3) > 0){
         while($row3 = mysqli_fetch_assoc($result3)){
            $total_price = ($row3['price'] * $row3['quantity']);
            $final_price += $total_price;
   ?>
   <p> <?php echo $row3['name']; ?> <span>(<?php echo '₹'.$row3['price'].'/-'.'  '. $row3['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <br><center>
   <br><hr width="50%" color="grey" size="3"></center>
   <div class="grand-total"> grand total : <span>₹<?php echo $final_price; ?>/-</span> </div>
</section>
<section class="user-orders">
   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Flat/House No :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no/house no.">
         </div>
         <div class="inputBox">
            <span>Street Name :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <select name="city">
               <option value="tirunelveli">tirunelveli</option>
               <option value="tuticorin">tuticorin</option>
               <option value="tiruchendhur">tiruchendhur</option>
            </select>
         </div>
         <div class="inputBox">
            <span>state :</span>
            <select name="state">
               <option value="tamilnadu">tamilnadu</option>
            </select>
         </div>
         <div class="inputBox">
            <span>country :</span>
            <select name="country">
               <option value="india">india</option>
            </select>
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <center><input type="submit" value="order now" class="btn" name="order_btn"></center>
   </form>
</section>
<script src="js/script.js"></script>
</body>
</html>
