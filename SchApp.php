<!DOCTYPE HTML>
<?php 
include('dbcon.php');
include('session.php'); 


$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$email=$row['email'];
/* Getting entry date from CentralDatabase */
$query1 = mysqli_query($con, "SELECT * FROM CentralDatabase WHERE email='$email'");
$row1 = mysqli_fetch_array($query1);
if($row1['CurrentDate'] > 0)
{
$stamp1=$row1['CurrentDate']; 
/* Preparing timestamps for finding difference */
$today1 = date('Y-m-d h:i:s', time());
$end1 = date ('Y-m-d h:i:s', strtotime ($stamp1 ."+365 days")); 
/* Finding difference and storing in $time1 */
$ts11 = strtotime($today1); 
$ts22 = strtotime($end1);      
$seconds_diff1 = $ts22 - $ts11;                            
$time1 = round(($seconds_diff1/(3600*24)));
if($time1>0)
{
	    header('location:timer.php');
} 
}
?>

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

<?php
$email=$row['email'];
$Phone = $Zip = $Last4SSN = $First = $Last = $Streetad1 = $Streetad2 = $Gender = $City = $State = $Birthdate = $PayPlan = $Goals = $FinCircumstances = $ExtraInfo = $GoalSchool = $AdminStatus = $AnticipProg = $ProgCost = $StartDate = $FirstPayDate = $CurrentDate = $PrevEdType = $PrevEdType2 = $PrevEdName = $PrevEdName2 = $PrevEdDegreeAtt = $PrevEdDegreeAtt2 = $PrevEdGradDate = $PrevEdGradDate2 = $ApplicantSignature = $ParentGuardianSignature = "";
$PhoneErr = $ZipErr = $Last4SSNErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$valid = true;
	
		 if(!preg_match('/^[0-9]{10}$/', $_POST['Phone']))
		{
			$PhoneErr = "Please use the valid format: XXXXXXXXXX";
			$valid = false;
		}
		else {
	  $Phone = test_input($_POST["Phone"]);
	  $valid=true;
	  }
    

  
 
if(!preg_match('/^[0-9]{5}$/', $_POST['Zip']))
		{
			$ZipErr = "Please enter a 5 digit Zip code";
			$valid = false;
		}
		else {
	  $Zip = test_input($_POST["Zip"]);
	  $valid=true;
	  }

 if(!preg_match('/^[0-9]{4}$/', $_POST['Last4SSN']))
	{
		$Last4SSNErr = "Please enter a 4 digit number";
		$valid = false;
	}
	else {
	  $Last4SSN = test_input($_POST["Last4SSN"]);
	  $valid=true;
	}
    
	$First = test_input($_POST["First"]);
	$Last = test_input($_POST["Last"]);
	$Streetad1 = test_input($_POST["Streetad1"]);
	$Streetad2 = test_input($_POST["Streetad2"]);
	$City = test_input($_POST["City"]);
	$State = test_input($_POST["State"]);
	$Gender = $_REQUEST["Gender"];
	$Birthdate = test_input($_POST["Birthdate"]);
	$PayPlan = $_REQUEST["PayPlan"];
	$Goals = $_REQUEST["Goals"];
	$FinCircumstances = $_REQUEST["FinCircumstances"];
	$ExtraInfo = $_REQUEST["ExtraInfo"];
	$GoalSchool = test_input($_POST["GoalSchool"]);
	$AdminStatus = $_REQUEST["AdminStatus"];
	$AnticipProg = test_input($_POST["AnticipProg"]);
	$ProgCost = test_input($_POST["ProgCost"]);
	$StartDate = test_input($_POST["StartDate"]);
	$FirstPayDate = test_input($_POST["FirstPayDate"]);
	$CurrentDate = test_input($_POST["CurrentDate"]);
	$PrevEdType = $_POST["PrevEdType"];
	$PrevEdType2 = $_POST["PrevEdType2"];
	$PrevEdName = test_input($_POST["PrevEdName"]);
	$PrevEdName2 = test_input($_POST["PrevEdName2"]);
	$PrevEdDegreeAtt = $_REQUEST["PrevEdDegreeAtt"];
	$PrevEdDegreeAtt2 = $_REQUEST["PrevEdDegreeAtt2"];
	$PrevEdGradDate = test_input($_POST["PrevEdGradDate"]);
	$PrevEdGradDate2 = test_input($_POST["PrevEdGradDate2"]);
	$ApplicantSignature = test_input($_POST["ApplicantSignature"]);
	$ParentGuardianSignature = test_input($_POST["ParentGuardianSignature"]);
	
 
  if($valid){ 
       include  'insertTest.php';
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


 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" autocomplete="on">
	<div class="form-wrapper">
		
		<h3>Knox County Vocational Scholarship Application</h3>
		<div id="text_61" class="form-html" data-component="text">
            <p style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">Knox County Foundation Vocational Scholarships are available to residents of Knox County who are attending, or will attend, an occupational training program of two-years or less at an accredited vocational school, technical school, community college, or junior college.</span></p>
            <p style="text-align: left;"><br /><span style="font-family: arial, helvetica, sans-serif;">To be eligible, applicants must:</span></p>
            <ul>
              <li style="text-align: left;">
                Be a Knox County Resident
              </li>
              <li style="text-align: left;">
                Submit a high school transcript or GED
              </li>
              <li style="text-align: left;">
                Complete and submit a copy of the Student Aid Report (SAR) of the Free Application for Federal Student Aid (FAFSA)
              </li>
              <li style="text-align: left;">
                Complete (and sign) the Vocational Scholarship Application in full
                <br />
                <br />
              </li>
            </ul>
            <p> </p>
            <p style="text-align: center;"><strong>COMPLETED APPLICATIONS ARE DUE BY 4:00 PM ON:<br /></strong></p>
            <p style="text-align: center;">MARCH 15: For Summer/Fall Consideration<br />JULY 15: For Fall/Winter Consideration<br />OCTOBER 15: For Winter/Spring Consideration</p>
            <p style="text-align: center;">For questions, please contact Lisa Lloyd, Program Director, <br />at 740-392-3270 or Lisa@knoxcf.org <br /> <br /> * denotes required</p>
          </div>
 
		<hr>
		<h3>Section 1: Applicant Information</h3>
		<br>
		<div class="form-item">
			<label for="First">* First name:</label>
			<input type="text" name="First" required="required" value="<?php echo $First;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="Last">* Last name:</label>
			<input type="text" name="Last" required="required" value="<?php echo $Last;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="Streetad1">* Street Address:</label>
			<input type="text" name="Streetad1" required="required" value="<?php echo $Streetad1;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="Streetad2">  Street Address Line 2:</label>
			<input type="text" name="Streetad2" value="<?php echo $Streetad2;?>" autofocus></input>
		</div>
		
		<div class="form-item">
			<label for="City">* City:</label>
			<input type="text" name="City" required="required" value="<?php echo $City;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="State">* State/ Province:</label>
			<input type="text" name="State" required="required" value="<?php echo $State;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="Zip">* Postal/ Zip Code:</label>
			<input type="number" name="Zip" required="required" value="<?php echo $Zip;?>" autofocus required></input>
			<span class="error"> <?php echo $ZipErr;?></span>
		</div>
		
		<div class="form-item">
			<label for="Phone">* Phone:</label>
			<input type="number" name="Phone" required="required" placeholder="XXXXXXXXXX" value="<?php echo $Phone;?>" autofocus required></input>
			<span class="error"> <?php echo $PhoneErr;?></span>
		</div>
		
		<div class="form-item">
			<label for="Birthdate">* Date of Birth:</label>
			<input type="date" name="Birthdate" placeholder="yyyy-mm-dd" pattern="\d{4}-\d{1,2}-\d{1,2}" required="required" value="<?php echo $Birthdate;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="Gender">  Gender (Optional):</label>
			<select name="Gender" autofocus>
				<option selected value=<?php echo $Gender;?>><?php echo $Gender;?></option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
		</div>
		
		<div class="form-item">
			<label for="Last4SSN">* Last 4 Digits of SSN:</label>
			<input type="number" name="Last4SSN" required="required" value="<?php echo $Last4SSN;?>" autofocus required></input>
			<span class="error"> <?php echo $Last4SSNErr;?></span>
		</div>
		
		<br>
		<hr>
		
		<h3>Section 2: Previous Education</h3>
		<br>
		
		<div class="form-item">
			<label for="PrevEdType">* Education Type:</label>
			<select name="PrevEdType" required="required" autofocus required>
				<option selected value=<?php echo $PrevEdType;?>><?php echo $PrevEdType;?></option>
				<option value="High School">High School</option>
				<option value="Associate">Associate</option>
				<option value="Bachelors">Bachelors</option>
				<option value="Masters">Masters</option>
				<option value="Other">Other</option>
			</select>
		</div>
		
		<div class="form-item">
			<label for="PrevEdName">* Name of Institution:</label>
			<input type="text" name="PrevEdName" required="required" value="<?php echo $PrevEdName;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="PrevEdDegreeAtt">* Degree Attained:</label>
			<input type="text" name="PrevEdDegreeAtt" required="required" value="<?php echo $PrevEdDegreeAtt;?>" autofocus required></input>
		</div>
		<div class="form-item">
			<label for="PrevEdGradDate">* Completion/ Grad Date:</label>
			<input type="date" name="PrevEdGradDate" placeholder="yyyy-mm-dd" pattern="\d{4}-\d{1,2}-\d{1,2}" required="required" value="<?php echo $PrevEdGradDate;?>" autofocus required></input>
		</div>
		
		<br>
		<br> 
		<p style="text-align: center;"><strong>Additional Education (Optional)<br /></strong></p>
		
		<div class="form-item">
			<label for="PrevEdType2">  Education Type:</label>
			<select name="PrevEdType2" autofocus>
				<option selected value=<?php echo $PrevEdType2;?>><?php echo $PrevEdType2;?></option>
				<option value="High School">High School</option>
				<option value="Associate">Associate</option>
				<option value="Bachelors">Bachelors</option>
				<option value="Masters">Masters</option>
				<option value="Other">Other</option>
			</select>
		</div>
		
		<div class="form-item">
			<label for="PrevEdName2">  Name of Institution:</label>
			<input type="text" name="PrevEdName2" value="<?php echo $PrevEdName2;?>" autofocus></input>
		</div>
		
		<div class="form-item">
			<label for="PrevEdDegreeAtt2">  Degree Attained:</label>
			<input type="text" name="PrevEdDegreeAtt2" value="<?php echo $PrevEdDegreeAtt2;?>" autofocus></input>
		</div>
		<div class="form-item">
			<label for="PrevEdGradDate2">  Completion/ Grad Date:</label>
			<input type="date" name="PrevEdGradDate2" placeholder="yyyy-mm-dd" pattern="\d{4}-\d{1,2}-\d{1,2}" value="<?php echo $PrevEdGradDate2;?>" autofocus ></input>
		</div>
		
		<br>
		<hr>
		
		<h3>Section 3: Current Educational Goal</h3>
		<br>
		<div class="form-item">
			<label for="GoalSchool">* College/ School:</label>
			<input type="text" name="GoalSchool" required="required" value="<?php echo $GoalSchool;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
		<label for="AdminStatus">* Admission Status:</label>
			<select name="AdminStatus" required="required" autofocus required>
				<option selected value=<?php echo $AdminStatus;?>><?php echo $AdminStatus;?></option>
				<option value="Applied">Applied</option>
				<option value="Accepted">Accepted</option>
				<option value="Wait List">Wait List</option>
				<option value="Plan to Apply">Plan to Apply</option>
				<option value="Currently Attending">Currently Attending</option>
			</select>
		</div>
			
		<div class="form-item">
			<label for="AnticipProg">* Anticipated Program:</label>
			<input type="text" name="AnticipProg" required="required" value="<?php echo $AnticipProg;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="ProgCost">* Cost of Program (may attach cost breakdown if provided):</label>
			<input type="number" name="ProgCost" required="required" value="<?php echo $ProgCost;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="StartDate">* Anticipated Start Date:</label>
			<input type="date" name="StartDate" placeholder="yyyy-mm-dd" pattern="\d{4}-\d{1,2}-\d{1,2}" value="<?php echo $StartDate;?>" required="required" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="FirstPayDate">* First Payment Due Date:</label>
			<input type="date" name="FirstPayDate" placeholder="yyyy-mm-dd" pattern="\d{4}-\d{1,2}-\d{1,2}" required="required" value="<?php echo $FirstPayDate;?>" autofocus required></input>
		</div>
	
	 <br>
		 <hr>
		 
		
		<h3>Section 4: Personal Goals</h3>
		<br>
		<div class="form-item">
			<label for="PayPlan">* How do you plan to pay for your education? (List grants, savings, loans, working, etc.):</label>
			<textarea id="PayPlan" name="PayPlan" required="required" value="<?php echo $PayPlan;?>" autofocus required><?php echo $PayPlan;?></textarea>
		</div>
		
		<div class="form-item">
			<label for="Goals">* What are your goals in the next 5-10 years? What do you hope to do upon completion of your program? (For example, where do you hope to live and work?): </label>
			<textarea id="Goals" name="Goals" required="required" value="<?php echo $Goals;?>" autofocus required><?php echo $Goals;?></textarea>
		</div>
		
		<div class="form-item">
			<label for="FinCircumstances">* Please explain any financial circumstances that were not addressed on the FAFSA. Why do you need this scholarship and how would receiving it impact the achievement of your goals? </label>
			<textarea id="FinCircumstances" name="FinCircumstances" required="required" value="<?php echo $FinCircumstances;?>" autofocus required><?php echo $FinCircumstances;?></textarea>
		</div>
		
		<div class="form-item">
			<label for="ExtraInfo">Is there any additional information you consider supportive of your application for scholarship assistance from the Knox County Foundation?</label>
			<textarea id="ExtraInfo" name="ExtraInfo" value="<?php echo $ExtraInfo;?>" autofocus><?php echo $ExtraInfo;?></textarea>
		</div>
		
		<hr>
		<p style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;"><strong>Please attach the following documents AFTER submitting your application:</strong></span></p>
		<ul>
              <li style="text-align: left;">
                High School Transcript or GED
              </li>
              <li style="text-align: left;">
                FAFSA Student Aid Report (SAR) required by your school or for the year in which you are applying for financial aid
              </li>
              <li style="text-align: left;">
                Financial Aid Package from Educational Institution (if available)
              </li>
            </ul>
			
			<br>
			
		<p style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">I certify all information provided is true, complete, and accurate. I understand that information such as educational records, which includes name, social security number, student ID number, address, job placement and retention records
may be needed to verify eligibility for this scholarship and to coordinate with other agencies/institutions. In accordance with the Family Educational Rights and Privacy Act of 1974 (FERPA), the undersigned student hereby permits the
disclosure of the aforementioned information by educational institutions to the Knox County Foundation for review by
the Knox County Foundation staff and Scholarship Selection Committee. I furthermore release to Knox County Foundation the right to use my name, school, program taken, and other information contained in this application for Foundation publications, reports and/or press releases. If awarded a scholarship, I allow Knox County Foundation to verify
both my enrollment and completion of orientation (if applicable) before funds are distributed to my accredited school.
I will also allow my accredited school to disclose my completion, licensure, and workforce placement information to
the Knox County Foundation. </span></p>


		<div class="form-item">
		<label for="Agreement">* Do you agree to the terms and conditions?</label>
			<select name="Agreement" required="required" autofocus required>
				<option selected value=<?php echo $Agreement;?>><?php echo $Agreement;?></option>
				<option value="Yes">Yes</option>
			</select>
		</div>
		
		<div class="form-item">
			<label for="ApplicantSignature">* Digital Applicant Signature:</label>
			<input type="text" name="ApplicantSignature" required="required" value="<?php echo $ApplicantSignature;?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			<label for="ParentGuardianSignature">Digital Parent/Guardian Signature (if under 18):</label>
			<input type="text" name="ParentGuardianSignature" value="<?php echo $ParentGuardianSignature;?>" autofocus ></input>
		</div>
		
		<div class="button-panel">
		<button type="submit" class="submitbtn">Submit</button>
    </div>
 </form>
</body>
</html>
