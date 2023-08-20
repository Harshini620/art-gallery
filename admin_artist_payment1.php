<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
}
if(isset($_POST['update'])){
   $id = $_POST['id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `artist_payment` SET status = '$update_payment' WHERE id = '$id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE order_id = '$delete_id'") or die('query failed');
   header('location:admin_artist_payment.php');
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
<center> 
<section id="remove" class="orders">
   <h1 class="title">Search payment details</h1>
   <form action="search_payment.php" method="post">
      <label>Date From <input type="date" name="startDate">&nbsp;</label>
      <label>To <input type="date" name = "endDate"><br><br></label>
      <input type="submit" name="search" class="btn" value="search artworks"><br><br><br>
   </form>
</center> 
</section>
<h1 class="title"><span>artist payment</h1>
<section class="user-table">
   <table>
      <thead>
         <th>id</th>
         <th>user id</th>
         <th>name</th>
         <th>price</th>
         <th>final price</th>
         <th>placed on</th>
         <th>status</th>
         <th id="remove">actions</th>
      </thead>
      <tbody>
         <?php
            $res = mysqli_query($conn, "SELECT a.id,a.user_id,p.name,p.price,a.final_price,a.placed_on,a.status FROM artist_payment a INNER JOIN products p ON a.p_id=p.id") or die('query failed');
            if(mysqli_num_rows($res) > 0){
               while($row = mysqli_fetch_assoc($res)){
         ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['final_price']; ?></td>
            <td><?php echo $row['placed_on']; ?></td>
            <td>
            <form action="admin_artist_payment.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $row['status']; ?></option>
               <option value="₹<?php echo $row['final_price']?> is credited">credited</option>
               <option value="pending">pending</option>
            </select>
            <button id="remove" type="submit" name="update" class="btn"><i class="fas fa-edit"></i>update<button>
               </form>   
            </td>
            <td id="remove">
               <a id="remove" href="admin_artist_payment.php?delete=<?php echo $row['id']; ?>" class="btnn" onclick="return confirm('remove this order?');"> remove</a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo '<p class="empty">no payment yet!</p>';
            };
         ?>
      </tbody>
   </table>
</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src="src.js"></script>
</body>
</html>