<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
}
if(isset($_POST['update_artwork']))
{
   $id = $_POST['id'];
   $name = $_POST['name'];
   $artist_name = $_POST['artist_name'];
   $type = $_POST['type'];
   $theme = $_POST['theme'];
   $len = $_POST['len'];
   $bre = $_POST['bre'];
   $des = $_POST['des'];
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   mysqli_query($conn, "UPDATE `products` SET artist_name='$artist_name', art_type='$type',theme='$theme',length='$len',breadth='$bre',description='$des' WHERE id = '$id'") or die('query failed');
   if(!empty($image)){
       mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$id'") or die('query failed');
    }  
   header('location:admin_view_art.php');
}
if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_view_art.php');
}
?>
<html>
<head>
   <title>view artwork</title>
</head>
<style>
   input[type="date"]::-webkit-calendar-picker-indicator{
      filter:invert(1);
   }
</style>
<body style="background-color: black">

<?php 
    include 'admin_header.php'; 
?>

<center> 
<section id="remove" class="orders">
   <h1 class="title">Search Artworks</h1>
   <form action="search_artworks.php" method="post">
      <label>Date From <input type="date" name="startDate">&nbsp;</label>
      <label>To <input type="date" name = "endDate"><br><br></label>
      <input type="submit" name="search" class="btn" value="search artworks"><br><br><br>
   </form>
</center> 

<section class="user-table">
<h1 class="title">all artworks </h1><br>
   <table>
      <thead>
         <th>image</th>
         <th>art name</th>
         <th>artist name</th>
         <th>price</th>
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
            $result = mysqli_query($conn, "SELECT * FROM `products` order by name");
            if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_assoc($result)){
         ?>

         <tr>
            <td><img src="images/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['artist_name']; ?></td>
            <td>₹<?php echo $row['price']; ?>/-</td>
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
            };    
            }else{
               echo '<p class="empty">no products added yet!</p>';
            };
         ?>
      </tbody>
   </table>
</section>

<section class="edit-product-form">
  <div id="wrapper">
    <div class="scrollbar" id="style-1">
        <div class="force-overflow">
   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $res = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
   ?>
   <form action="admin_view_art.php" method="post" enctype="multipart/form-data">
      
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
      <img src="images/<?php echo $row['image']; ?>" alt="">
      <input type="text" name="name" value="<?php echo $row['name']; ?>" class="box" required placeholder="enter product name">
      <input type="text" name="artist_name" value="<?php echo $row['artist_name']; ?>" class="box" required placeholder="enter artist name">
     
      <select name="type" class="box" required>
            <option><?php echo $row['art_type']; ?></option>
               <option value="watercoloring">watercoloring</option>
               <option value="painting">painting</option>
               <option value="pencilsketching">pencil sketching</option>
               <option value="oilpainting">oil painting</option>
               <option value="doodle">doodle</option>
         </select>
         <select name="theme" class="box" required>
            <option><?php echo $row['theme']; ?></option>
               <option value="flower">flower</option>
               <option value="city">city</option>
               <option value="animal">animal</option>
               <option value="landscape">landscape</option>
               <option value="doodle">doodle</option>
         </select>
      <input type="number" name="len" value="<?php echo $row['length']; ?>" min="0" class="box" required placeholder="enter product length">
      <input type="number" name="bre" value="<?php echo $row['breadth']; ?>" min="0" class="box" required placeholder="enter product breadth">
      <input type="text" name="des" value="<?php echo $row['description']; ?>" class="box">
      <input type="number" name="price" value="<?php echo $row['price']; ?>" min="0" class="box" required placeholder="enter product price">
      <input type="file" class="box" name="image" accept="image/jpg, image/jpeg, image/png">
      <button type="submit" name="update_artwork" class="btn"><i class="fas fa-edit"></i> update</button>
      <button type="reset" class="delete-btn"><a href="admin_view_art.php"><i class="fa fa-times"></i>cancel</a></button>
   </form>
</div></div></div>
   <?php
         }
        }
      }else{
        echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
     }
   ?>
</section>
<center><button onclick="window.print()" class="btnn">print report</button></center>
<script src="src.js"></script>
</body>
</html>

