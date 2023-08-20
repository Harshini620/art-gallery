<?php
include 'connection.php';
session_start();
$artist_id = $_SESSION['artist_id'];
if(!isset($artist_id)){
   header('location:login.php');
}
include 'artist_header.php'; ?>
<html>
<head>
   <title>artist_account_details</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin_css.css">
   <link rel="stylesheet" href="artist_report.css">
</head>
<body  style="background-color: black; color:#fff">
<section class="bank">
<h1 class="title"><span>fill your </span>account details</h1>
<style>
     .bank form{
   background-color: #13131a;
   border-radius: .5rem;
   padding:2rem;
   box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
   border:.1rem solid #949292;
   max-width: 50rem;
   font-size:1.8rem;
   margin:0 auto;
}
.bank form .box{
   width: 100%;
   background-color: #13131a;
   border-radius: .5rem;
   margin:1rem 0;
   padding:1.2rem 1.4rem;
   color: #fff;
   font-size: 1.8rem;
   border:.1rem solid #949292;
}
</style>
<form action="artist_account_details.php" method="POST">
		Account Number:<input type="number" max="9999999999" name="a_no" required class="box">
		<br>
		Banks:
		<select name="b_name" class="box">
			<option disabled selected>Select Your Bank</option>
			<option value="SBI">State Bank Of India</option>
			<option value="ICICI">ICICI Bank</option>
			<option value="Canara">Canara Bank</option>
	   </select>
		<br>
		IFSC Code:
		<input type="number" name="ifsc" max="99999999999" required class="box">
		<br>
		Account Name:
		<input type="text" name="a_name" required class="box">
		<br><br>
		<input type="submit" value="Submit" name="submit" class="btn">
	</form>
<?php
if(isset($_POST['submit']))
{
   $a_no = $_POST['a_no'];
   $b_name = $_POST['b_name'];
   $ifsc = $_POST['ifsc'];
   $a_name = $_POST['a_name'];
   $date=date('Y-m-d');
   $artist_id=$_SESSION['artist_id'];
   $sql1 = mysqli_query($conn, "SELECT a_name FROM a_bankaccount WHERE a_name = '$a_name'") or die('query failed');
    if(mysqli_num_rows($sql1) > 0)
    {
        echo "<h2><center>your bank details already added!</center></h1>";
    }
    else{
   $sql = "INSERT INTO a_bankaccount values ('','$artist_id','$a_no','$b_name','$ifsc','$a_name', '$date')";  
   $result = mysqli_query($conn, $sql);  
   if($result)
   {
       echo "<h2><i> <center>Inserted successfully!</i> </center></h1>";  
   }  
   else
   {  
       echo "<h2><i> <center>Inserted failed!</i> </center></h1>";
   }     
}
}
?>
<script src="src.js"></script>