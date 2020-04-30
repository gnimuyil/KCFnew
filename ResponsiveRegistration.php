<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
width:300px;
height:415px;
  position: absolute;
  top: 50%;
  left: 48%;
  margin: -184px 0px 0px -155px;
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
}



.form-item input{
  border: none;
  background:transparent;
  color: #fff;
  margin-top:11px;
  font-family: 'Open Sans', sans-serif;
  font-size: 1.2em;
  height: 49px;
  padding: 0 16px;
  width: 75%;
  padding-left: 55px;

}
input[type='password']{
	background: transparent url("img/pass.jpg") no-repeat;
	background-position: 10px 50%;
}
input[type='text']{
	background: transparent url("img/user.jpg") no-repeat;
	background-position: 10px 50%;

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

.registerbtn {
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

.registerbtn:hover {
  background: #6eb7cb;
}

.form-item input, .button-panel .registerbtn {
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

<?php
$email = $password = $pswrepeat = "";
$emailErr = $passwordErr = $pswrepeatErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$valid = true;

	if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
	$valid = true;
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "* Invalid email format";
	  $valid = false;
    }
  }

  
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
	$valid = true;
	
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
		$passwordErr = "* Invalid pswd";
		$valid = true;
	}
  }
  
  if (empty($_POST["pswrepeat"])){
	  $pswrepeatErr = "Password is required";
  } else {
	  $pswrepeat = test_input($_POST["pswrepeat"]);
	  $valid = true;
	  
	  if($password != $pswrepeat) {
		  $pswrepeatErr = "* Passwords must match";
		  $valid = false;
	  }
  }
  
  if($valid){ 
       include  'insert.php';
       echo '<META HTTP-EQUIV="Refresh" Content="0; URL=insert.php">'; 
       exit;       
  } 
  
 }
 
 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
  <div class="form-wrapper">
  
  
    <h3>Register</h3>
    <p>Please fill in this form to create an account.</p>
    <hr>

	<div class="form-item">
		<input type="text" name="email" required="required" value="<?php echo $email;?>" placeholder="Email" autofocus required></input>
		<span class="error"> <?php echo $emailErr;?></span>
    </div>
       
    <div class="form-item">
		<input type="password" name="password" required="required" value="<?php echo $password;?>" placeholder="Password" required></input>
		<span class="error"> <?php echo $passwordErr;?></span>
    </div>
	
	<div class="form-item">
		<input type="password" name="pswrepeat" required="required" value="<?php echo $pswrepeat;?>" placeholder="Repeat Password" required></input>
		<span class="error"> <?php echo $pswrepeatErr;?></span>
    </div>
    
    <div class="button-panel">
		<button type="submit" class="registerbtn" value="submit" name="submit">Register</button>
    </div>
	
	

</form>

</body>
</html>
