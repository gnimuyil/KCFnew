<?php 
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
			

	$Tname = $_FILES['myfile1']['name'];
	$Ttype = $_FILES['myfile1']['type'];
	$Tdata = $_FILES['myfile1']['tmp_name'];
	$Tdata = base64_encode(file_get_contents(addslashes($Tdata)));
	$Tsql = "INSERT Into UploadFile (name, type, data) values('$Tname','$Ttype','$Tdata')";
								
	$Rname = $_FILES['myfile2']['name'];
	$Rtype = $_FILES['myfile2']['type'];
	$Rdata = $_FILES['myfile2']['tmp_name'];
	$Rdata = base64_encode(file_get_contents(addslashes($Rdata)));
	$Rsql = "INSERT Into UploadFile (name, type, data) values('$Rname','$Rtype','$Rdata')";
					
	$Fname = $_FILES['myfile3']['name'];
	$Ftype = $_FILES['myfile3']['type'];
	$Fdata = $_FILES['myfile3']['tmp_name'];
	$Fdata = base64_encode(file_get_contents(addslashes($Fdata)));
	$Fsql = "INSERT Into UploadFile (name, type, data) values('$Fname','$Ftype','$Fdata')";
					
	if(substr($Ttype,0,15) == "application/pdf" && substr($Rtype,0,15) == "application/pdf")
	{
		if (mysqli_query($conn, $Tsql) && mysqli_query($conn, $Rsql) && mysqli_query($conn, $Fsql)) 
		{
			echo "File uploaded successfully. Click ";
			echo '<a href="https://cslab.kenyon.edu/class/ssd/li2/home.php">here</a>';
			echo  " to go back to home page.";
		} 
		else 
		{
			echo "File failed to upload.<br />";
		}			
	}
	else
	{
		echo "Please submit all required files and make sure they are in PDF format";
	}

?>
	