<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `a_bankaccount` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_artist_bank.php');
}
?>
<html>
<head>
   <title>admin artist bank details</title>
</head>
<body style="background-color: black">
<?php include 'admin_header.php'; ?>
<section class="user-table">
<h1 class="title"> artist bank accounts details </h1><br>
   <table>
      <thead>
         <th>id</th>
         <th>user id</th>
         <th>account no</th>
         <th>bank name</th>
         <th>IFSC Code</th>
         <th>account name</th>
         <th>placed on</th>
         <th id="remove">action</th>
      </thead>
      <tbody>
         <?php
            $result = mysqli_query($conn, "SELECT * FROM `a_bankaccount`");
            if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_assoc($result)){
         ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['a_no']; ?></td>
            <td><?php echo $row['b_name']; ?></td>
            <td><?php echo $row['ifsc']; ?></td>
            <td><?php echo $row['a_name']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td id="remove">
            <a href="admin_artist_bank.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('delete this bank account?');" class="delete-btn" id="remove"><i class="fas fa-trash"></i> remove user</a>
         </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no artist bank account found!</div>";
            };
         ?>
      </tbody>
   </table>
</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src="src.js"></script>
</body>
</html>
