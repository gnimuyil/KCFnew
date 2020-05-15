<?php 
include('dbcon.php');
include('session.php'); 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	/* Exception class. */
	require 'Exception.php';

	/* The main PHPMailer class. */
	require 'PHPMailer.php';

	/* SMTP class, needed if you want to use SMTP. */
	require 'SMTP.php';


$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$email=$row['email'];
/* Getting entry date from CentralDatabase */
$query = mysqli_query($con, "SELECT * FROM CentralDatabase WHERE email='$email'");
$num_row=mysqli_num_rows($query);
if($num_row==0)
{
	  header('location:Error.php');
}  
			
		
 ?>


<!DOCTYPE HTML>
	
<html>
<head>
<style>
	  body {
	  color: #fff;
	  font: 87.5%/1.5em 'Open Sans', sans-serif;
		background:url(img/bg.jpg)no-repeat center center fixed; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;}



	.form-wrapper {
	width:500px;
	height: absolute;
	  position: absolute;
	  top: 50%;
	  left: 46%;
	  margin: -184px 0px 0px -184px;
	  background: rgba(18, 18, 18, 0.95);
	  padding: 15px 25px;
	  border-radius: 5px;
	  box-shadow: 0px 1px 0px rgba(0,0,0,0.6),inset 0px 1px 0px rgba(255,255,255,0.04);
	}

	.form-item {
	width:100%;
	}


	h3{
	  font-size: 25px;
	  font-weight: 640;
	  margin-bottom: 10px;
	  color: #e7e7e7;
	  padding:6px;
	  font-family:'sans-serif','helvetica';
	  text-align: center;
	}

	select {
	box-sizing: border-box;
	  border: 2px solid #ccc;
	  border-radius: 4px;
	  background: rgba(18, 18, 18, 0.95);
	  margin-top:5px;
	  margin-bottom: 15px;
	  font-family: 'Open Sans', sans-serif;
	  font-size: 1.0em;
	  height: 25px;
	  padding: 0 16px;
	  width: 100%;
	  color: #fff;
	}



	.form-item input{
	box-sizing: border-box;
	  border: 2px solid #ccc;
	  border-radius: 4px;
	  background:transparent;
	  color: #fff;
	  margin-top:5px;
	  margin-bottom: 15px;
	  font-family: 'Open Sans', sans-serif;
	  font-size: 1.0em;
	  height: 25px;
	  padding: 0 16px;
	  width: 100%;
	}
		
	.form-radio {
	  display: block;
	  position: relative;
	  margin-bottom: 15px;
	  cursor: pointer;
	  font-size: 1.0em;
	  -webkit-user-select: none;
	  -moz-user-select: none;
	  -ms-user-select: none;
	  user-select: none;
	}

	textarea {
	  width: 100%;
	  height: 120px;
	  padding: 12px 20px;
	  box-sizing: border-box;
	  border: 2px solid #ccc;
	  border-radius: 4px;
	  background: transparent;
	  font-family: 'Open Sans', sans-serif;
	  font-size: 1.0em;
	  color: #fff;
	  resize: none;
	  margin-bottom: 15px;
	}


	.form-item input:focus {
	  outline: none;
	  border:1.4px solid #cfecf0;
	}

	.button-panel {
	  margin-bottom: 20px;
	  padding-top: 10px;
	  width: 100%;
	}

	.submitbtn {
	  background: #00b6df;
	  border: none;
	  color: #fff;
	  cursor: pointer;
	  height: 50px;
	  font-family: 'helvetica','Open Sans', sans-serif;
	  font-size: 1.2em;
	  text-align: center;
	  text-transform: uppercase;
	  transition: background 0.6s linear;
	  width: 100%;
	  margin-top:10px;
	}

	.submitbtn:hover {
	  background: #6eb7cb;
	}

	.form-item input, .button-panel .submitbtn {
	  border-radius: 2px
	}

	.reminder {
	  text-align: center;
	}

	.reminder a {
	  color: #fff;
	  text-decoration: none;
	  transition: color 0.3s;
	}

	.reminder a:hover {
	  color: #cab6bf;
	}
	
	.error {color: #FF0000;}

</style>
</head>
<body>


		
	<form method ="post" enctype="multipart/form-data">
	<div class="form-wrapper">
	<h3>Document Submission</h3>
	<p style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;"><strong>In order to be eligible for the Knox County Foundation Vocational Scholarship, the following documents are required:</strong></span></p>
		<p style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;"><strong>Please make sure that your files are in pdf format under 5 mb</strong></span></p>

	<ul>
			<li style="text-align: left;">
			High School Transcript or GED
			</li>
			<input type="file" name="myfile1"/>
		<hr>
		<br>
			   
			<li style="text-align: left;">
			FAFSA Student Aid Report (SAR) required by your school or for the year in which you are applying for financial aid
            </li>
			<input type="file" name="myfile2"/>
		<hr>
		<br>
				 
            <li style="text-align: left;">
            Financial Aid Package from Educational Institution (if available)
            </li>
			<input type="file" name="myfile3"/>
		<hr>
		<br>
		
	<button name="btn">Submit</button>   
	
		<br>
		<br>
		
</form>
</body>
</html>
		
<?php 
$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$email=$row['email'];

$localhost = "localhost"; #localhost
$dbusername = "lobo1"; #username of phpmyadmin
$dbpassword = "S217115";  #password of phpmyadmin
$dbname = "CommunityScholarship";  #database name
$conn = mysqli_connect($localhost,$dbusername,$dbpassword,$dbname);

if (mysqli_connect_error())		
{
	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	echo "Connect Error";
} 		


if (isset($_POST["btn"]))
{
	
	
	$Tname = $_FILES['myfile1']['name'];
	$Ttype = $_FILES['myfile1']['type'];
	$Tdata = $_FILES['myfile1']['tmp_name'];
	$Tdata = base64_encode(file_get_contents(addslashes($Tdata)));
	$Tsql = "UPDATE  CentralDatabase set Transcript = '$Tdata' where email='$email'";
								
	$Rname = $_FILES['myfile2']['name'];
	$Rtype = $_FILES['myfile2']['type'];
	$Rdata = $_FILES['myfile2']['tmp_name'];
	$Rdata = base64_encode(file_get_contents(addslashes($Rdata)));
	$Rsql = "UPDATE  CentralDatabase set FAFSA = '$Rdata' where email='$email'";
					
	$Fname = $_FILES['myfile3']['name'];
	$Ftype = $_FILES['myfile3']['type'];
	$Fdata = $_FILES['myfile3']['tmp_name'];
	$Fdata = base64_encode(file_get_contents(addslashes($Fdata)));
	$Fsql = "UPDATE  CentralDatabase set Aid = '$Fdata' where email='$email'";
					
	if(substr($Ttype,0,15) == "application/pdf" && substr($Rtype,0,15) == "application/pdf" && (substr($Ftype,0,15) == "application/pdf" || empty($Fname)))
	{
		if (mysqli_query($conn, $Tsql) && mysqli_query($conn, $Rsql) && mysqli_query($conn, $Fsql)) 
		{
			echo "Files uploaded successfully. Click ";
			echo '<a href="home.php">here</a>';
			echo  " to go back to home page.";
			$mail_body = "<b>High School Transcript or GED: </b><br>" . $Tdata . "<br><br><br><b> FAFSA Student Aid Report: </b><br>" . $Rdata . "<br><br><br><b> Financial Aid Package: </b><br>" . $Tdata ." ";
			$mail = new PHPMailer;
			$mail->IsSMTP();        //Sets Mailer to send message using SMTP
			$mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
			$mail->Port = '587';        //Sets the default SMTP server port
			$mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
			$mail->Username = 'Scholarship@knoxcf.org';     //Sets SMTP username
			$mail->Password = 'Kenyon1824';     //Sets SMTP password
			$mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
			$mail->From = 'Scholarship@knoxcf.org';   //Sets the From email address for the message
			$mail->FromName = 'Knox County Foundation';     //Sets the From name of the message
			$mail->AddAddress('Scholarship@knoxcf.org');  //Adds a "To" address   
			$mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
			$mail->IsHTML(true);       //Sets message type to HTML    
			$mail->Subject = 'Submitted Documents of ' . $email .' ';   //Sets the Subject of the message
			$mail->Body = $mail_body;       //An HTML or plain text message body 
			$mail->Send();        //Send an Email. Return true on success or false on error
		} 
		else 
		{
			echo "Files failed to upload. Please make sure that your files are under 5 mb<br />";
		}			
	}
	else
	{
		echo "Please submit all required files and make sure they are in PDF format";
	}
}
?>
	
