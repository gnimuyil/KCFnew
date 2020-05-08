<?php 
include('dbcon.php');
include('session.php'); 


$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$email=$row['email'];
$query 		= mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
$row1		= mysqli_fetch_array($query);
if($row1['Reviewer']==0)
{
    header("location: indexreview.php");
    exit();
}
?>

<?php 
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM CentralDatabase where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
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
		    			<h3>Applicant information</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['First'];?>
						    </label>
					    </div>
					  </div>
					 <div class="control-group">
					    <label class="control-label">Last</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Last'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['email'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Mobile Number</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Phone'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Street Address 1</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Streetad1'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Street Address 2</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Streetad2'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">City</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['City'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">State</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['State'];?>
						    </label>
					    </div>
					  </div>
					  					  					 <div class="control-group">
					    <label class="control-label">Zip</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Zip'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Date of birth</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Birthdate'];?>
						    </label>
					    </div>
					  </div>
					  					  					 <div class="control-group">
					    <label class="control-label">Gender</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Gender'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Last 4 digits of SSN</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Last4SSN'];?>
						    </label>
					    </div>
					  </div>
					  					  					 <div class="control-group">
					    <label class="control-label">Payment plans</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['PayPlan'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Goals</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Goals'];?>
						    </label>
					    </div>
					  </div>
					  					  					 <div class="control-group">
					    <label class="control-label">Financial circumstances</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['FinCircumstances'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Extra information</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['ExtraInfo'];?>
						    </label>
					    </div>
					  </div>
					  					  					 <div class="control-group">
					    <label class="control-label">Goal school</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['GoalSchool'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Admission Status</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['AdminStatus'];?>
						    </label>
					    </div>
					  </div>
					  					  					 <div class="control-group">
					    <label class="control-label">Anticipated program</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['AnticipProg'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Cost of the program</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['ProgCost'];?>
						    </label>
					    </div>
					  </div>
					  					  					 <div class="control-group">
					    <label class="control-label">Start Date</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['StartDate'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Date of first payment</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['FirstPayDate'];?>
						    </label>
					    </div>
					  </div>
					  
					  					  					 <div class="control-group">
					    <label class="control-label">Previous Education Type</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['PrevEdType'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Previous Education Name of Institution</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['PrevEdName'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Previous Degree Attained</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['PrevEdDegreeAtt'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Previous Education graduation date</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['PrevEdGradDate'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Previous Education Type 2</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['PrevEdType2'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Previous Education Name of Institution 2</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['PrevEdName2'];?>
						    </label>
					    </div>
					  </div>

					  					 <div class="control-group">
					    <label class="control-label">Previous Degree Attained 2</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['PrevEdDegreeAtt2'];?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Previous Education Graduation Date 2</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['PrevEdGradDate2'];?>
						    </label>
					    </div>
					  </div>


	
					  					 <div class="control-group">
					    <label class="control-label">Transcript</label>
					    <div class="controls">
					      	<label class="checkbox">
<?php
							   	echo '<a class="btn btn-link" href="Transcript.php?id='.$data['id'].'">View</a>';
?>
						    </label>
					    </div>
					  </div>

					  					 <div class="control-group">
					    <label class="control-label">FAFSA</label>
					    <div class="controls">
					      	<label class="checkbox">
<?php
							   	echo '<a class="btn btn-link"" href="FAFSA.php?id='.$data['id'].'">View</a>';
?>
					  
						    </label>
					    </div>
					  </div>
					  
					  					  					 <div class="control-group">
					    <label class="control-label">Financial Aid Form</label>
					    <div class="controls">
					      	<label class="checkbox">
<?php
							   	echo '<a class="btn btn-link"" href="Aid.php?id='.$data['id'].'">View</a>';
?>
						    </label>
					    </div>
					  </div>
					  					 <div class="control-group">
					    <label class="control-label">Was this application edited?</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php if($data['Edited']==1)
									echo "yes";
								else 
									echo "no"
								?>
								
						    </label>
					    </div>
					  </div>

					  
					    <div class="form-actions">
						  <a class="btn" href="index.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
