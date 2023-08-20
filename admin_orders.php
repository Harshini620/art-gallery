<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}
if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE order_id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE order_id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}
?>

<html>
<head>
   <title>orders</title>
</head>
<style>
   input[type="date"]::-webkit-calendar-picker-indicator{
      filter:invert(1);
   }
</style>
<body style="background-color: black">
<?php include 'admin_header.php'; ?>
<section id="remove" class="orders">
   <h1 class="title">placed orders</h1>
   <center>
   <form action="search_orders.php" method="post">
      <label>Date From <input type="date" name="startDate">&nbsp;</label>
      <label>To <input type="date" name = "endDate"><br><br></label>
      <p><input type="submit" name="search" class="btn" value="search orders"></p><br><br><br>
   </form>
</center> 
</section>
<section class="user-table">
   <table>
      <thead>
         <th>user id</th>
         <th>placed on</th>
         <th>name</th>
         <th>email</th>
         <th>address</th>
         <th>total products</th>
         <th>total price</th>
         <th>payment method</th>
         <th>status</th>
         <th id="remove">action</th>
      </thead>
      <tbody>
         <?php
            $result = mysqli_query($conn, "SELECT * FROM `orders` INNER JOIN users ON orders.user_id=users.id");
            if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_assoc($result)){
         ?>
         <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['placed_on']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['total_products']; ?></td>
            <td><?php echo $row['total_price']; ?></td>
            <td><?php echo $row['method']; ?></td>
            <td>
            <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $row['payment_status']; ?></option>
               <option value="ArtWorld has accepted your order">ArtWorld has accepted your order</option>
               <option value="your item has been shipped">your item has been shipped</option>
               <option value="your order is arriving soon">your order is arriving soon</option>
               <option value="your order has almost reached">your order has almost reached</option>
               <option value="Your order from ArtWorld was delivered">Your order from ArtWorld was delivered</option>
               <option value="completed">completed</option>
            </select>
            <button type="submit" name="update_order" class="btn"><i class="fas fa-edit"></i>update<button>
               </form>   
            </td>
            <td id="remove">
               <a href="admin_orders.php?delete=<?php echo $row['id']; ?>" class="btnn" onclick="return confirm('remove this order?');"> remove</a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo '<p class="empty">no orders placed yet!</p>';
            };
         ?>
      </tbody>
   </table>
</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src="src.js"></script>
</body>
</html>
