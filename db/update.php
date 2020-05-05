<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$emailError = null;
		$mobileError = null;
		$LastError = null;
		$StreetAd1Error = null;
		$StreetAd2Error = null;
		$CityError = null;
		$StateError = null;
		$ZipError = null;
		// keep track post values
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$Last = $_POST['Last'];
		$StreetAd1 = $_POST['StreetAd1'];
		$StreetAd2 = $_POST['StreetAd2'];
		$City = $_POST['City'];
		$State = $_POST['State'];
		$Zip = $_POST['Zip'];
		
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		if (empty($mobile)) {
			$mobileError = 'Please enter Mobile Number';
			$valid = false;
		}
						
		if (empty($Last)) {
			$LastError = 'Please enter last name';
			$valid = false;
		}
						
		if (empty($StreetAd1)) {
			$StreetAd1Error = 'Please enter street address 1';
			$valid = false;
		}
				
		if (empty($StreetAd2)) {
			$StreetAd2Error = 'Please enter street address 2';
			$valid = false;
		}
				
		if (empty($City)) {
			$CityError = 'Please enter city';
			$valid = false;
		}
				
		if (empty($State)) {
			$StateError = 'Please enter state';
			$valid = false;
		}
				
		if (empty($Zip)) {
			$ZipError = 'Please enter zip code';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE CentralDatabase  set First = ?, Last = ?, email = ?, Phone =?, City=?, 
			State=?, Zip=?, StreetAd1=?, StreetAd2=? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$Last, $email,$mobile, $City, $State, $Zip, $StreetAd1, $StreetAd2, $id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM CentralDatabase where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['name'];
		$email = $data['email'];
		$mobile = $data['mobile'];
		$Last = $data['Last'];
		$StreetAd1=$data['StreetAd1'];
		$StreetAd2=$data['StreetAd2'];
		$City=$data['City'];
		$State=$data['State'];
		$Zip=$datap['Zip'];
		Database::disconnect();
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
		    			<h3>Update an application contact information</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">First Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="First Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					      		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($LastError)?'error':'';?>">
					    <label class="control-label">Last Name</label>
					    <div class="controls">
					      	<input name="Last" type="text"  placeholder="Last name" value="<?php echo !empty($Last)?$Last:'';?>">
					      	<?php if (!empty($LastError)): ?>
					      		<span class="help-inline"><?php echo $LastError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
					    <label class="control-label">Phone Number</label>
					    <div class="controls">
					      	<input name="mobile" type="text"  placeholder="Phone Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
					      	<?php if (!empty($mobileError)): ?>
					      		<span class="help-inline"><?php echo $mobileError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					      		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($StreetAd1Error)?'error':'';?>">
					    <label class="control-label">Street Address 1</label>
					    <div class="controls">
					      	<input name="StreetAd1" type="text"  placeholder="Street Address 1" value="<?php echo !empty($StreetAd1)?$StreetAd1:'';?>">
					      	<?php if (!empty($StreetAd1Error)): ?>
					      		<span class="help-inline"><?php echo $StreetAd1Error;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  
					  
					      		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($StreetAd1Error)?'error':'';?>">
					    <label class="control-label">Street Address 2 </label>
					    <div class="controls">
					      	<input name="StreetAd2" type="text"  placeholder="Street Address 2" value="<?php echo !empty($StreetAd2)?$StreetAd2:'';?>">
					      	<?php if (!empty($StreetAd2Error)): ?>
					      		<span class="help-inline"><?php echo $StreetAd2Error;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					 					  
					      		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($CityError)?'error':'';?>">
					    <label class="control-label">City </label>
					    <div class="controls">
					      	<input name="City" type="text"  placeholder="City" value="<?php echo !empty($City)?$City:'';?>">
					      	<?php if (!empty($CityError)): ?>
					      		<span class="help-inline"><?php echo $CityError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  
					      		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($StateError)?'error':'';?>">
					    <label class="control-label">State </label>
					    <div class="controls">
					      	<input name="State" type="text"  placeholder="State" value="<?php echo !empty($State)?$State:'';?>">
					      	<?php if (!empty($StateError)): ?>
					      		<span class="help-inline"><?php echo $StateError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  
					      		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($ZipError)?'error':'';?>">
					    <label class="control-label">Zip </label>
					    <div class="controls">
					      	<input name="Zip" type="text"  placeholder="Zip" value="<?php echo !empty($Zip)?$Zip:'';?>">
					      	<?php if (!empty($ZipError)): ?>
					      		<span class="help-inline"><?php echo $ZipError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>					  
					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
