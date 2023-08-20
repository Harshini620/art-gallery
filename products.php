<form action="" method="post" class="box">
<div class="image"><img src="images/<?php echo $row['image']; ?>" alt=""></div>
   <div class="name"><?php echo $row['name']; ?></div>
   <h2>₹<?php echo $row['price']; ?>/-</h2>
   <p>Artist Name: <span><?php echo $row['artist_name']; ?></span></p>
   <p>Art Type: <span><?php echo $row['art_type']; ?></span></p>
   <p>Theme  : <span><?php echo $row['theme']; ?></span></p>
   <p>Length: <span><?php echo $row['length']; ?></span></p>
   <p>Breadth: <span><?php echo $row['breadth']; ?></span></p>
   <p>Description: <span><?php echo $row['description']; ?></span></p>
   <p>Quantity: <input type="number" min="1" name="quantity" value="1" class="qty"></p>
   <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
   <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
   <input type="hidden" name="artist_name" value="<?php echo $row['artist_name']; ?>">
   <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
   <input type="hidden" name="arttype" value="<?php echo $row['art_type']; ?>">
   <input type="hidden" name="theme" value="<?php echo $row['theme']; ?>">
   <input type="hidden" name="des" value="<?php echo $row['description']; ?>">
   <input type="hidden" name="len" value="<?php echo $row['length']; ?>">
   <input type="hidden" name="bre" value="<?php echo $row['breadth']; ?>">
   <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
   <input type="submit" value="Add to cart" name="add_to_cart" class="btnn"><br><br>
</form>