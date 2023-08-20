<?php
include 'connection.php';
session_start();
$artist_id = $_SESSION['artist_id'];
if(!isset($artist_id)){
   header('location:login.php');
}?>
<html>
<head>
   <title>tips for artist</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin_css.css">
</head>
<style>
.products .box-container{
    max-width: 1200px;
    margin:0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, 110rem);
    align-items: flex-start;
    gap:1.5rem;
    justify-content: center;
    background-color: black;
 } 
 .products .box-container .box{
    border:.1rem solid rgba(255,255,255,.3);
    padding:1.2rem 1.4rem;
    justify-content: center;
    background-color: #13131a;
 }  
 .products .box-container .box p{
    font-size: 1.5rem;
}
.products .box-container .box p span{
    color:#d3ad7f;
    font-size: 2rem;
}
u{
    text-decoration: underline;
    color:blue;
}
</style>
<body  style="background-color: black; color:#fff">
<?php include 'artist_header.php'; ?>
<section class="products">
<div class="box-container">
<h1 class="title"> <span>tips for </span>artist</h1>
<div class="box">
<p> Once you register with us by filling the basic information, click on 'ADD ARTWORK'. Upload all your artworks one by one, with filling up the necessary information. </p>
<p> We add our commission ₹100 for every artwork you uploaded. </p>
<br>
<p><span>Tips to Upload images:</span></p>
<p><span>•</span> Ensure that you click good quality images as images of poor quality might affect the purchasing decision of the buyer.</p>
<p><span>•</span> Please only upload original paintings that are exclusively yours.</p>
<p><span>•</span> If you still have any questions please contact us <u>harsh@gmail.com.</u></p>
<br>
<p><span>Tips before you courier paintings:</span></p>
<p><span>•</span> Roll the painting & put into the box.</p>
<p><span>•</span> Pack the box with water proof material & courier on following address.</p>
<br><br>
<center>
<p><span>&nbsp; <i class="fa-solid fa-house" style="color:#d3ad7f"></i> Address : </span>&nbsp;101,Art Gallery,<br>&nbsp; Raj Nagar, Palayamkottai, Tirunelveli.</p></center>
</div>
</div>
</section>
<script src="src.js"></script>
</body>
</html>