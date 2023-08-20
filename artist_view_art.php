<?php
include 'connection.php';
session_start();
$artist_id = $_SESSION['artist_id'];
if(!isset($artist_id)){
   header('location:login.php');
};
if(isset($_POST['update_artwork']))
{
   $id = $_POST['id'];
   $name = $_POST['name'];
   $type = $_POST['type'];
   $theme = $_POST['theme'];
   $len = $_POST['len'];
   $bre = $_POST['bre'];
   $des = $_POST['des'];
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   mysqli_query($conn, "UPDATE `products` SET  art_type='$type',theme='$theme',length='$len',breadth='$bre',description='$des' WHERE id = '$id'") or die('query failed');
   if(!empty($image)){
       mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$id'") or die('query failed');
    }  
   header('location:artist_view_art.php');
}
if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];

   mysqli_query($conn, "DELETE products, artist_payment FROM products INNER JOIN artist_payment ON products.name =artist_payment.name WHERE products.id='$delete_id'") or die('query failed');
   header('location:artist_view_art.php');
}
?>
<html>
<head>
   <title>adding artist artwork</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin_css.css">
   <link rel="stylesheet" href="report.css">
</head>
<body style="background-color: black">

<?php 
    include 'artist_header.php'; 
?>

<section class="user-table">
<h1 class="title"> artworks </h1><br>
   <table>
      <thead>
         <th>image</th>
         <th>art name</th>
         <th>price</th>
         <th>art type</th>
         <th>theme</th>
         <th>length</th>
         <th>breadth</th>
         <th>description</th>
         <th id="remove">action</th>
      </thead>
      <tbody>
         <?php
            $res = mysqli_query($conn, "SELECT * FROM `products` where user_id='$artist_id'  order by name");
            if(mysqli_num_rows($res) > 0){
               while($row = mysqli_fetch_assoc($res)){
         ?>

         <tr>
            <td><img src="images/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>₹<?php echo $row['price']; ?>/-</td>
            <td><?php echo $row['art_type']; ?></td>
            <td><?php echo $row['theme']; ?></td>
            <td><?php echo $row['length']; ?></td>
            <td><?php echo $row['breadth']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td id="remove">
               <a id="remove" href="artist_view_art.php?update=<?php echo $row['id']; ?>" class="option-btn"><i class="fas fa-edit"></i>update</a><br>
               <a id="remove" href="artist_view_art.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('delete this artwork?');"><i class="fas fa-trash"></i> delete</a>
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
   <form action="artist_view_art.php" method="post" enctype="multipart/form-data">
      
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
      <img src="images/<?php echo $row['image']; ?>" alt="">
      <input type="text" name="name" value="<?php echo $row['name']; ?>" class="box" required placeholder="enter product name">
     
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
      <button type="reset" class="delete-btn"><a href="artist_view_art.php"><i class="fa fa-times"></i>cancel</a></button>
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