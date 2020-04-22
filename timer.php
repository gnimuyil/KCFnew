<?php 
include('dbcon.php');
include('session.php'); 


$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$email=$row['email'];
/* Getting entry date from CentralDatabase */
$query2= mysqli_query($con, "SELECT * FROM CentralDatabase WHERE email='$email'");
$row2= mysqli_fetch_array($query2);
$stamp = $row2['CurrentDate']; 
echo "You have already submitted an application. Please try again in "; 
/* Preparing timestamps for finding difference */
$today = date('Y-m-d h:i:s', time());
$end = date ('Y-m-d h:i:s', strtotime ($stamp ."+365 days")); 
/* Finding difference and outputting difference */
$ts1 = strtotime($today); 
$ts2 = strtotime($end);      
$seconds_diff = $ts2 - $ts1;                            
$time = round(($seconds_diff/(3600*24)));
echo $time;
echo " days.";
?>