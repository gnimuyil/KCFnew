<?php session_start(); ?>
<?php include('dbcon.php'); ?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>Login Here</h3>
	
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Email" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Password" required></input>
    </div>
    
	<br>
    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
    </div>
  </form>
  <?php
	if (isset($_POST['login']))
		{
			$username = mysqli_real_escape_string($con, $_POST['user']);
			$password = mysqli_real_escape_string($con, $_POST['pass']);
			
			$query 		= mysqli_query($con, "SELECT * FROM users WHERE email='$username'");
			$row		= mysqli_fetch_array($query);
			if(password_verify($password, $row['password']))
			{$num_row 	= mysqli_num_rows($query);}
			
			if ($num_row > 0 & $row['Reviewer']==1)
				{			
					$_SESSION['user_id']=$row['user_id'];
					header('location:index.php');
				}
			else 
				{
					if($row['Reviewer']==0)
					echo "You are not authorized";
					
					else
					echo 'Invalid Username and Password Combination';
				}
		}
  ?>
  <br>
  
  <div class="reminder">
    <p>Not a member? <a href="ResponsiveRegistration.php">Sign up now</a></p>
		  </div>

  
</div>

</body>
</html>