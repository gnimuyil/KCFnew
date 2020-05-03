
session_start();
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form-wrapper"> 
    <center><h3> </h3></center>
<?php
$host = "localhost";
$dbUsername = "baitan1";
$dbPassword = "S216242";
$dbname = "CommunityScholarship";
//create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

if (isset($_GET['token'])) 
{
    $token = $_GET['token'];
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    
	if (mysqli_num_rows($result) > 0) 
	{
        $user = mysqli_fetch_assoc($result);
        $query = "UPDATE users SET verified=1 WHERE token='$token'";

        if (mysqli_query($conn, $query)) 
		{
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = true;
            $_SESSION['message'] = "Your email address has been verified successfully";
            $_SESSION['type'] = 'alert-success';
            echo "Your have been verified. Click "; 
			echo '<a href="https://cslab.kenyon.edu/class/ssd/li2/">here</a>';
			echo  " to log in.";
			
			
			exit(0);
        }
    } 
	else 
	{
        echo "User not found!";
    }
} 
else 
{
    echo "No token provided!";
}
</div>

</body>
</html>
