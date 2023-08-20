<?php
if(isset($_POST['add_to_cart'])){
   $id = $_POST['id'];
   $price = $_POST['price'];
   $quan = $_POST['quantity'];
   $image = $_POST['image'];
   $res = mysqli_query($conn, "SELECT * FROM `cart` WHERE p_id = '$id' and user_id='$user_id'") or die('query failed');
   if(mysqli_num_rows($res) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(p_id, user_id, price, quantity, image) VALUES('$id', '$user_id', '$price', '$quan', '$image')") or die('query failed');
      $message[] = 'added to cart!';
   }
}
?>