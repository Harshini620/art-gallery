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
   <title>search page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin_css.css">
   <link rel="stylesheet" href="admin_css1.css">
</head>
<body style="color:#fff; background-color: black;"> 

<?php include 'admin_header.php'; ?>

<section id="remove" class="search-form">
<h1 class="title"><span>SEARCH ARTS</span></h1>
   <form action="" method="post">
      <input type="text" name="search" placeholder="search artworks..." class="box">
      <input type="submit" name="submit" value="search" class="search-btn">
   </form>
</section>

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
      </thead>
      <tbody>
         <?php
      if(isset($_POST['submit'])){
         $search_art = $_POST['search'];
         $res = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_art}%' OR art_type LIKE '%{$search_art}%' OR theme LIKE '%{$search_art}%' OR artist_name LIKE '%{$search_art}%'") or die('query failed');
         if(mysqli_num_rows($res) > 0){
         while($row = mysqli_fetch_assoc($res)){
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
         </tr>

     <?php 
      }
   }else{
      echo '<h1>no artworks found!</h1>';
   }
}
?>
</div>
</section>

<script src="src.js"></script>
<center><button onclick="window.print()" class="btnn">print report</button></center>
</body>
</html>