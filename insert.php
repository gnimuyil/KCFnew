<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form-wrapper"> 
    <center><h3> </h3></center>
<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	/* Exception class. */
	require 'Exception.php';

	/* The main PHPMailer class. */
	require 'PHPMailer.php';

	/* SMTP class, needed if you want to use SMTP. */
	require 'SMTP.php';

$password = $_POST['password'];
$email = $_POST['email'];
$token = bin2hex(random_bytes(50));
$pswrepeat = $_POST['pswrepeat'];

if (!empty($password) || !empty($email) || !empty($pswrepeat)) 
{
 $host = "localhost";
 $dbUsername = "baitan1";
 $dbPassword = "S216242";
 $dbname = "CommunityScholarship";
 //create connection
 $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
 $password=password_hash($password, PASSWORD_DEFAULT);
 if (mysqli_connect_error()) 
 {
  die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
 } 
 else 
 {
  $SELECT = "SELECT email From users Where email = ? Limit 1";
  $INSERT = "INSERT Into users (password, email, token, verified, Reviewer) values(?, ?, ?, 0, 0)";
  //Prepare statement
  $stmt = $conn->prepare($SELECT);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->bind_result($email);
  $stmt->store_result();
  $rnum = $stmt->num_rows;
  if ($rnum==0) 
  {
	  
   
   $mail_body = "
   <p>Hello!</p>
   <p>Thank you for registration. <p>
   <p>Please follow this link to activate your account - https://cslab.kenyon.edu/class/ssd/baitan1/NewFolder/KCFnew/varifyEmail.php?token=" .$token. "<p>
   <p>Best regards,<br />Knox County Foundation</p>
   ";
   
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
   $mail->AddAddress($email);  //Adds a "To" address   
   $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
   $mail->IsHTML(true);       //Sets message type to HTML    
   $mail->Subject = 'Email Verification';   //Sets the Subject of the message
   $mail->Body = $mail_body;       //An HTML or plain text message body
   if($mail->Send())        //Send an Email. Return true on success or false on error
   {
    echo "Registration complete. Please check the email you registered with to verify your account";
	$stmt->close();
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("sss", $password, $email, $token);
    $stmt->execute();
	die();
   }
   else
   {
	echo "Email could not be sent. Please register again using a valid email address";
   }


 
  } 
  else 
  {
   echo "Someone already registered using this email. <br>";
   echo "\n\n Click "; 
	echo '<a href="ResponsiveRegistration.php">here</a>';
	echo  " to register again using a different email.";
  }
  $stmt->close();
  $conn->close();
 }
} 
?>
</div>

</body>
</html>
