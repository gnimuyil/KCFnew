<?php 
include('dbcon.php');
include('session.php'); 


$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$email=$row['email'];
$query2= mysqli_query($con, "SELECT * FROM CentralDatabase WHERE email='$email'");
$row2= mysqli_fetch_array($query2);
$stamp = $row2['CurrentDate']; 
/* $stamp=$stamp + (365 * 24 * 60 * 60);  */
echo "You have already submitted an application. Please try again on "; 
echo date('d/m/Y', strtotime('+365 day'));

?>