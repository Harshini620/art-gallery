<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `artist_payment` WHERE id = '$delete_id'") or die('query failed');
   header('location:search_payment.php');
}
?>
<html>
<head>
   <title>SEARCH PAYMENTS</title>
   <link rel="stylesheet" href="report.css">
</head>
<body style="background-color: black; color:#fff; ">
<?php include 'admin_header.php'; ?>
<section class="user-table">
<h1 class="title">all artist payment </h1><br>
   <table>
      <thead>
         <th>id</th>
         <th>user id</th>
         <th>name</th>
         <th>final price</th>
         <th>placed on</th>
         <th>status</th>
         <th id="remove">actions</th>
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
            <?php
            if(!empty($_POST['startDate']) and empty($_POST['endDate']))
            {
              echo "<center><h1>Artworks added from ".$new_sdate."</h1></center>";
            }
            else if(isset($_POST['startDate']) && isset($_POST['endDate']))
            {
              echo "<center><h1>Artworks added between ".$new_sdate." and ".$new_edate."</h1></center>";
            }
            $result=mysqli_query($conn, "Select id,user_id,name,final_price,status,placed_on From `artist_payment` Where placed_on Between '$new_sdate' and '$new_edate' or placed_on='$new_sdate' order by placed_on");
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
         ?>

         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
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
            }
            }    
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