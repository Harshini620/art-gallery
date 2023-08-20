<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_POST['update_cart'])){
   $id = $_POST['id'];
   $quan = $_POST['quan'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$quan' WHERE c_id = '$id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE c_id = '$delete_id'") or die('query failed');
   header('location:user_cart.php');
}
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:user_cart.php');
}
?>
<html>
<head>
   <title>cart</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="user_css.css">
</head>
<body style="background-color: black">
<?php include 'user_header.php'; ?>
<h1 class="heading"> your <span>cart</span></h1>
<section class="user-table">
   <table>
      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>
      <tbody>
      <?php
         $grand_total = 0;
         $res = mysqli_query($conn, "SELECT * FROM `cart` INNER JOIN products ON cart.p_id=products.id where cart.user_id='$user_id'") or die('query failed');
         if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){   
      ?>
      <tr>
         <td><img src="images/<?php echo $row['image']; ?>" height="100" alt=""></td>
         <td><?php echo $row['name']; ?></td>
         <td>₹<?php echo $row['price']; ?>/-</td>
         <td>      
         <form action="" method="post">
            <input type="hidden" name="id"  value="<?php echo $row['c_id']; ?>" >
            <input type="number" name="quan" min="1"  value="<?php echo $row['quantity']; ?>" >
            <input type="submit" value="update" name="update_cart" class="remove-btn">
         </form>   
         </td>
         <td>₹<?php echo $sub_total = ($row['quantity'] * $row['price']); ?>/-</td>
         <td><a href="user_cart.php?delete=<?php echo $row['c_id']; ?>" onclick="return confirm('remove item from cart?')" class="remove-btn"> <i class="fas fa-trash"></i> remove</a></td>
      </tr>
      <?php
         $grand_total += $sub_total;  
         }
      }
      ?>
      <tr class="table-bottom">
         <td><a href="user_products.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
         <td colspan="3">grand total</td>
         <td>₹<?php echo $grand_total; ?>/-</td>
         <td><a href="user_cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="remove-btn"> <i class="fas fa-trash"></i> delete all </a></td>
      </tr>
      </tbody>
   </table>
   <center><a href="user_orders.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout&#8594;</a>
</section>
</div>
<script src="js/script.js"></script>
</body>
</html>