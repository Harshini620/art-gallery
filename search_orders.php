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
    header('location:admin_orders.php');
 }
 if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE order_id = '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
 }
?>
<html>
<head>
   <title>SEARCH orders</title>
   <link rel="stylesheet" href="report.css">
</head>
<body style="background-color: black; color:#fff">
<?php include 'admin_header.php'; ?>
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
            if(isset($_POST['search'])){
              $StartDate=$_POST['startDate']; 
              $newstartdate=strtotime($StartDate);
              $new_sdate=date("Y-m-d",$newstartdate);
              $EndDate=$_POST['endDate'];
              $newenddate=strtotime($EndDate);
              $new_edate=date("Y-m-d",$newenddate);
            ?>
            <h1 class="title1">ART<span> World</span></h1>
            <?php
            if(!empty($_POST['startDate']) and empty($_POST['endDate']))
            {
              echo "<center><h1>Orders From ".$new_sdate."</h1></center>";
            }
            else if(isset($_POST['startDate']) && isset($_POST['endDate']))
            {
              echo "<center><h1>Orders between ".$new_sdate." and ".$new_edate."</h1></center>";
            }
            $result=mysqli_query($conn, "Select * From `orders` Where placed_on Between '$new_sdate' and '$new_edate' or placed_on='$new_sdate' order by placed_on");
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
         ?>
         <br>
         <h1>
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
            <button id="remove" type="submit" name="update_order" class="btn"><i class="fas fa-edit"></i>update<button>
               </form>   
            </td>
            <td id="remove">
               <a id="remove" href="search_orders.php?delete=<?php echo $row['id']; ?>" class="btnn" onclick="return confirm('remove this order?');"> remove</a>
            </td>
         </tr>

         <?php
                    }
            }else{
               echo '<p class="empty">no orders placed yet!</p>';
            };
        }
         ?>
      </tbody>
   </table>
</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src="js/admin_script.js"></script>
</body>
</html>