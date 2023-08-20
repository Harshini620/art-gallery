<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
};
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}
?>
<html>
<head>
   <title>messages</title>
</head>
<body style="background-color: black">
<?php include 'admin_header.php'; ?>
<section class="user-table">
<h1 class="title"> message </h1><br>
   <table>
      <thead>
         <th>id</th>
         <th>user id</th>
         <th>username</th>
         <th>email id</th>
         <th>number</th>
         <th>message</th>
         <th>placed_on</th>
         <th id="remove">action</th>
      </thead>
      <tbody>
         <?php
            $result = mysqli_query($conn, "SELECT m.id,m.user_id,u.name,u.email,m.number,m.message,m.placed_on FROM message m INNER JOIN users u ON m.user_id=u.id");
            if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_assoc($result)){
         ?>

         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['number']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td><?php echo $row['placed_on']; ?></td>
            <td id="remove">
            <a href="admin_contacts.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn" name="delete" id="remove"><i class="fas fa-trash"></i> remove</a>
         </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no message found!</div>";
            };
         ?>
      </tbody>
   </table>
</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src="src.js"></script>
</body>
</html>
