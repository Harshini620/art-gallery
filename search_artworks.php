<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
}
?>
<html>
<head>
   <title>SEARCH ARTWORKS</title>
   <link rel="stylesheet" href="report.css">
</head>
<body style="background-color: black; color:#fff">
<?php include 'admin_header.php'; ?>
<section class="user-table">
<h1 class="title">all artworks </h1><br>
   <table>
      <thead>
         <th>image</th>
         <th>art name</th>
         <th>price</th>
         <th>artist name</th>
         <th>art type</th>
         <th>theme</th>
         <th>length</th>
         <th>breadth</th>
         <th>description</th>
         <th>placed on</th>
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
            <?php
            if(!empty($_POST['startDate']) and empty($_POST['endDate']))
            {
              echo "<center><h1>Artworks added from ".$new_sdate."</h1></center>";
            }
            else if(isset($_POST['startDate']) && isset($_POST['endDate']))
            {
              echo "<center><h1>Artworks added between ".$new_sdate." and ".$new_edate."</h1></center>";
            }
            $result=mysqli_query($conn, "Select * From `products` Where placed_on Between '$new_sdate' and '$new_edate' or placed_on='$new_sdate' order by placed_on");
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
         ?>
         
         <tr>
            <td><img src="images/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>₹<?php echo $row['price']; ?>/-</td>
            <td><?php echo $row['artist_name']; ?></td>
            <td><?php echo $row['art_type']; ?></td>
            <td><?php echo $row['theme']; ?></td>
            <td><?php echo $row['length']; ?></td>
            <td><?php echo $row['breadth']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['placed_on']; ?></td>
            <td id="remove">
               <a id="remove" href="admin_view_art.php?update=<?php echo $row['id']; ?>" class="option-btn"><i class="fas fa-edit"></i>update</a><br>
               <a id="remove" href="admin_view_art.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('delete this artwork?');"><i class="fas fa-trash"></i> delete</a>
            </td>
         </tr>
         <?php
            }
          }
         else{
               echo '<p class="empty">no products added yet!</p>';
            }
          }
         ?>
      </tbody>
   </table>
</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src="js/admin_script.js"></script>
</body>
</html>