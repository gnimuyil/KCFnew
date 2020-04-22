<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$FirstError = null;
		$emailError = null;
		$PhoneError = null;
		
		// keep track post values
		$First = $_POST['First'];
		$email = $_POST['email'];
		$Phone = $_POST['Phone'];
		
		// validate input
		$valid = true;
		if (empty($First)) {
			$FirstError = 'Please enter First';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		if (empty($Phone)) {
			$PhoneError = 'Please enter Phone Number';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO CentralDatabase (First, email, Phone) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($First,$email,$Phone));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a Customer</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($FirstError)?'error':'';?>">
					    <label class="control-label">First</label>
					    <div class="controls">
					      	<input First="First" type="text"  placeholder="First" value="<?php echo !empty($First)?$First:'';?>">
					      	<?php if (!empty($FirstError)): ?>
					      		<span class="help-inline"><?php echo $FirstError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<input First="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($PhoneError)?'error':'';?>">
					    <label class="control-label">Phone Number</label>
					    <div class="controls">
					      	<input First="Phone" type="text"  placeholder="Phone Number" value="<?php echo !empty($Phone)?$Phone:'';?>">
					      	<?php if (!empty($PhoneError)): ?>
					      		<span class="help-inline"><?php echo $PhoneError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>