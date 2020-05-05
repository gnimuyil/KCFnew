<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form-wrapper"> 
    <center><h3> </h3></center>
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

 ?>

<?php
$Gender = $_POST['Gender'];
$email=$row['email'];
$Phone = $_POST['Phone'];
$First = $_POST['First'];
$Last = $_POST['Last'];
$Streetad1 = $_POST['Streetad1'];
$Streetad2 = $_POST['Streetad2'];
$City = $_POST['City'];
$State = $_POST['State'];
$Zip = $_POST['Zip'];
$Birthdate = $_POST['Birthdate'];
$Last4SSN = $_POST['Last4SSN'];
$PayPlan = $_POST['PayPlan'];
$Goals = $_POST['Goals'];
$FinCircumstances = $_POST['FinCircumstances'];
$ExtraInfo = $_POST['ExtraInfo'];
$GoalSchool = $_POST['GoalSchool'];
$AdminStatus = $_POST['AdminStatus'];
$AnticipProg = $_POST['AnticipProg'];
$ProgCost = $_POST['ProgCost'];
$StartDate = $_POST['StartDate'];
$FirstPayDate = $_POST['FirstPayDate'];
$CurrentDate = $_POST['CurrentDate'];
$PrevEdType = $_POST['PrevEdType'];
$PrevEdType2 = $_POST['PrevEdType2'];
$PrevEdName = $_POST['PrevEdName'];
$PrevEdName2 = $_POST['PrevEdName2'];
$PrevEdDegreeAtt = $_POST['PrevEdDegreeAtt'];
$PrevEdDegreeAtt2 = $_POST['PrevEdDegreeAtt2'];
$PrevEdGradDate = $_POST['PrevEdGradDate'];
$PrevEdGradDate2 = $_POST['PrevEdGradDate2'];
$ApplicantSignature = $_POST['ApplicantSignature'];
$ParentGuardianSignature = $_POST['ParentGuardianSignature'];

 
if (!empty($email) || !empty($Phone)||
    !empty($First)|| !empty($Last)|| !empty($Streetad1)|| !empty($Streetad2)|| !empty($City)|| !empty($State)|| !empty($Zip)
   || !empty($Birthdate)|| !empty($Last4SSN)|| !empty($PayPlan)|| !empty($Goals)|| !empty($FinCircumstances)|| !empty($ExtraInfo)|| !empty($GoalSchool)
   || !empty($AdminStatus)|| !empty($AnticipProg)|| !empty($ProgCost)|| !empty($StartDate)|| !empty($FirstPayDate)|| !empty($CurrentDate) || !empty($PrevEdType) || !empty($PrevEdName)
   || !empty($PrevEdDegreeAtt) || !empty($PrevEdGradDate) || !empty($ApplicantSignature)) {
 $host = "localhost";
    $dbUsername = "lobo1";
    $dbPassword = "S217115";
    $dbname = "CommunityScholarship";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	 echo "Connect Error";
    } else {
     $SELECT = "SELECT email From CentralDatabase Where email = ? Limit 1";
     $INSERT = "INSERT Into CentralDatabase (First, Last, Streetad1, Streetad2, City, State, Zip, Phone, email, Birthdate, Gender, Last4SSN, 
	 PayPlan, Goals, FinCircumstances, ExtraInfo, GoalSchool, AdminStatus, AnticipProg,
     ProgCost, StartDate, FirstPayDate, CurrentDate, PrevEdType, PrevEdName, PrevEdDegreeAtt, PrevEdGradDate, ApplicantSignature, ParentGuardianSignature, PrevEdType2, PrevEdName2, PrevEdDegreeAtt2, PrevEdGradDate2) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
	 	 if ($rnum!=0)
	 {
		 $link = mysqli_connect("localhost", "baitan1", "S216242", "CommunityScholarship"); 
  
			if($link === false){ 
		die("ERROR: Could not connect. " . mysqli_connect_error()); 
		} 
			$sql = "DELETE FROM CentralDatabase WHERE email='$email'"; 
			if(mysqli_query($link, $sql)){ 
			}  
			else{ 
				echo "ERROR: Could not able to execute $sql. "  
                . mysqli_error($link); 
						} 
				mysqli_close($link); 
	 }
	 $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
	 $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssssiisssisssssssisssssssssssss", $First, $Last, $Streetad1, $Streetad2, $City, $State, $Zip, $Phone, $email, $Birthdate, $Gender, $Last4SSN, 
	  $PayPlan, $Goals, $FinCircumstances, $ExtraInfo, $GoalSchool, $AdminStatus, $AnticipProg,
      $ProgCost, $StartDate, $FirstPayDate, $CurrentDate, $PrevEdType, $PrevEdName, $PrevEdDegreeAtt, $PrevEdGradDate, $ApplicantSignature, $ParentGuardianSignature, $PrevEdType2, $PrevEdName2, $PrevEdDegreeAtt2, $PrevEdGradDate2);
      $stmt->execute();
      echo "You applicaiton has been submitted!.";
     
	 
	  $mail_body = '
  <h3 align="center">Copy of your Submitted Aplication</h3>
  <table border="1" width="100%" cellpadding="5" cellspacing="5">
   <tr>
    <td width="30%">First Name</td>
    <td width="70%">'.$First.'</td>
   </tr>
   <tr>
    <td width="30%">Last Nmae</td>
    <td width="70%">'.$Last.'</td>
   </tr>
   <tr>
    <td width="30%">Street Address</td>
    <td width="70%">'.$Streetad1.'</td>
   </tr>
   <tr>
    <td width="30%">Street Address line 2</td>
    <td width="70%">'.$Streetad2.'</td>
   </tr>
   <tr>
    <td width="30%">City</td>
    <td width="70%">'.$City.'</td>
   </tr>
   <tr>
    <td width="30%">State/Province</td>
    <td width="70%">'.$State.'</td>
   </tr>
   <tr>
    <td width="30%">Postal/Zip code</td>
    <td width="70%">'.$Zip.'</td>
   </tr>
   <tr>
    <td width="30%">Phone</td>
    <td width="70%">'.$Phone.'</td>
   </tr>
   <tr>
    <td width="30%">Date of Birth</td>
    <td width="70%">'.$Birthdate.'</td>
   </tr>
   <tr>
    <td width="30%">Gender</td>
    <td width="70%">'.$Gender.'</td>
   </tr>
   <tr>
    <td width="30%">Education Type</td>
    <td width="70%">'.$PrevEdType.'</td>
   </tr>
   <tr>
    <td width="30%">Name of Institution</td>
    <td width="70%">'.$PrevEdName.'</td>
   </tr>
    <tr>
    <td width="30%">Degree Attained</td>
    <td width="70%">'.$PrevEdDegreeAtt.'</td>
   </tr>
   <tr>
    <td width="30%">Completion/Grad Date</td>
    <td width="70%">'.$PrevEdGradDate.'</td>
   </tr>
   <tr>
    <td width="30%">Education Type</td>
    <td width="70%">'.$PrevEdType2.'</td>
   </tr>
   <tr>
    <td width="30%">Name of Institution</td>
    <td width="70%">'.$PrevEdName2.'</td>
   </tr>
    <tr>
    <td width="30%">Degree Attained</td>
    <td width="70%">'.$PrevEdDegreeAtt2.'</td>
   </tr>
   <tr>
    <td width="30%">Completion/Grad Date</td>
    <td width="70%">'.$PrevEdGradDate2.'</td>
   </tr>
   <tr> 
    <td width="30%">College/School</td>
    <td width="70%">'.$GoalSchool.'</td>
   </tr>
   <tr> 
    <td width="30%">Admission Status</td>
    <td width="70%">'.$AdminStatus.'</td>
   </tr>
   <tr> 
    <td width="30%">Anticipated Program</td>
    <td width="70%">'.$AnticipProg.'</td>
   </tr>
   <tr> 
    <td width="30%">Cost of Program</td>
    <td width="70%">'.$ProgCost.'</td>
   </tr>
   <tr> 
    <td width="30%">Anticipated Start Date</td>
    <td width="70%">'.$StartDate.'</td>
   </tr>
   <tr> 
    <td width="30%">First Payment Due Date</td>
    <td width="70%">'.$FirstPayDate.'</td>
   </tr>
   <tr>
    <td width="30%">How do you plan to pay for your education?</td>
    <td width="70%">'.$PayPlan.'</td>
   </tr>
   <tr>
    <td width="30%">What are your goals in the next 5-10 years? What do you hope to do upon completion of your program?</td>
    <td width="70%">'.$Goals.'</td>
   </tr>
   <tr>
    <td width="30%">Please explain any financial circumstances that were not addressed on the FAFSA. Why do you need this scholarship and how would receiving it impact the achievement of your goals?</td>
    <td width="70%">'.$FinCircumstances.'</td>
   </tr>
   <tr>
    <td width="30%">Is there any additional information you consider supportive of your application for scholarship assistance from the Knox County Foundation?</td>
    <td width="70%">'.$ExtraInfo.'</td>
   </tr>
  </table>
 ';
 
 $mail = new PHPMailer;
	$mail->IsSMTP();        //Sets Mailer to send message using SMTP
   $mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
   $mail->Port = '587';        //Sets the default SMTP server port
   $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
   $mail->Username = 'fatchickenforwork@gmail.com';     //Sets SMTP username
   $mail->Password = '1a2b3c4d@@';     //Sets SMTP password
   $mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
   $mail->From = 'fatchickenforwork@gmail.com';   //Sets the From email address for the message
   $mail->FromName = 'The great LIVIBAK organization';     //Sets the From name of the message
   $mail->AddAddress($email);  //Adds a "To" address   
   $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
   $mail->IsHTML(true);       //Sets message type to HTML    
   $mail->Subject = 'Copy of your KCF Vacational Scholarship Application';   //Sets the Subject of the message
   $mail->Body = $mail_body;       //An HTML or plain text message body
		if($mail->Send())        //Send an Email. Return true on success or false on error
		{
			echo " Please check your email for a copy of your application";
			
		}
		else
		{
			echo " However, an email with a copy of your application could not be sent.";
		}
	  } 
	 
	 
	  else {
      echo "Someone already registered using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
</div>

</body>
</html>
