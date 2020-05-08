<?php 
include('dbcon.php');
include('session.php'); 


$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);

 ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form-wrapper"> 
<br>
<br>
<br>
<br>

    <center><h4>Please fill out the application form before submitting files.<h4> </center>
	 <div class="reminder">
	      <p><a href="home.php">Go back to home page</a></p>
  </div>
</div>

</body>
</html>