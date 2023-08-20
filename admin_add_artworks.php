<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
}
if(isset($_POST['add_artwork']))
{
   $name =  $_POST['name'];
   $artist_name =  $_POST['artist_name'];
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $type = $_POST['type'];
   $theme =$_POST['theme'];
   $len = $_POST['len'];
   $bre = $_POST['bre'];
   $des = $_POST['des'];
   $date = date("y-m-d");
   $res1 = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($res1) > 0)
   {
      $message[] = 'Product name already added';
   }
   else 
   {
   $query=mysqli_query($conn,"SELECT * FROM `products` INNER JOIN users ON products.user_id=users.id where user_id='$admin_id'") or die('query failed...');
   if(mysqli_num_rows($query) > 0)
   {
       $res = mysqli_query($conn, "INSERT INTO `products`(user_id, name, artist_name, art_type, price, image, theme,length,breadth, description, placed_on) VALUES('$admin_id','$name', '$artist_name', '$type', '$price', '$image', '$theme', '$len', '$bre', '$des', '$date')");
       if($res)
       {
           $message[] = 'one artwork added successfully!';
       }else{
           $message[] = 'artwork added unsuccessfully!';
       }
   }
   }
}
?>
<html>
<head>
   <title>add artwork</title>
</head>
<body style="background-color: black">

<?php include 'admin_header.php'; ?>

<section class="add-products">
   <h1 class="title">artworks</h1>
   <form action="admin_add_artworks.php" method="post" enctype="multipart/form-data">
      <h3>add artworks</h3>
      <input type="text" name="name" class="box" placeholder="enter art name" required>
      <input type="text" name="artist_name" class="box" placeholder="enter artist name" required>
        <select name="type" class="box" required>
            <option value="" selected disabled>select art type</option>
            <option value="watercoloring">watercoloring</option>
            <option value="painting">painting</option>
            <option value="pencilsketching">pencil sketching</option>
            <option value="oilpainting">oil painting</option>
        </select>
        <select name="theme" class="box" required>
            <option value="" selected disabled>select art theme</option>
            <option value="flower">flower</option>
            <option value="city">city</option>
            <option value="animal">animal</option>
            <option value="sea">sea</option>
        </select>
      <input type="number" min="0" name="len" class="box" placeholder="enter length" required>
      <input type="number" min="0" name="bre" class="box" placeholder="enter breadth" required>
      <input type="number" min="0" name="price" class="box" placeholder="enter price" required>
      <input type="file" name="image" class="box" required>
      <input type="text" name="des" class="box" placeholder="enter description" required>
      <input type="submit" value="add artwork" name="add_artwork" class="btn">
   </form>
</section>
<script src="src.js"></script>
</body>
</html>
