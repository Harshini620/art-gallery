<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}
?>
<html>
<head>
   <title>users</title>
</head>
<body style="background-color: black">
<?php include 'admin_header.php'; ?>
<section class="user-table">
<h1 class="title"> user accounts </h1><br>
   <table>
      <thead>
         <th>user id</th>
         <th>user name</th>
         <th>user email id</th>
         <th>user type</th>
         <th>placed_on</th>
         <th id="remove">action</th>
      </thead>
      <tbody>
         <?php
            $result = mysqli_query($conn, "SELECT * FROM `users` where user_type='user'");
            if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_assoc($result)){
         ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['user_type']; ?></td>
            <td><?php echo $row['placed_on']; ?></td>
            <td id="remove">
            <a href="admin_users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn" id="remove"><i class="fas fa-trash"></i> remove user</a>
         </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no user found!</div>";
            };
         ?>
      </tbody>
   </table>
</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src="src.js"></script>
</body>
</html>
