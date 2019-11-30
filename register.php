<!DOCTYPE html>
<html>
	<head>
		<title>User registration page</title>
		<link rel="stylesheet" type="text/css" href="bootstrap.css">
		<link rel="stylesheet" type="text/css" href="adminPage.css">
	</head>
	<body>
		<nav id="adminNav"></nav>

        <?php
        #connection------------------------------------------------------------------------------
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $db = 'sportsclub';
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
		if(! $conn ) 
		{
           die('Could not connect: ' . mysql_error());
		}
		
        #retreiving values from the form----------------------------------------------------------
        if(isset($_POST['submit'])) 
        {
	        $fname=$lname=$email=$address=$city=$state=$dob='';
	        $phone=$pincode=$sid=0;
	        if ($_SERVER["REQUEST_METHOD"] == "POST") 
	        {
	            $fname=$_POST["fname"];
	            $lname=$_POST["lname"];
	            $dob=$_POST["dob"];
	            $phone=$_POST["phone"];
	            $email=$_POST["email"];
	            $address=$_POST["address"];
	            $city=$_POST["city"];
	            $state=$_POST["state"];
				$pincode=$_POST["pincode"];
				$sid = $_POST["sid"];
			}
			
			// The length we want the unique reference number to be  
			$unique_ref_length = 8;  
  
			// A true/false variable that lets us know if we've  
			// found a unique reference number or not  
			$unique_ref_found = false;  
			
			// Define possible characters.  
			// Notice how characters that may be confused such  
			// as the letter 'O' and the number zero don't exist  
			$possible_chars = "23456789BCDFGHJKMNPQRSTVWXYZ";  
			
			// Until we find a unique reference, keep generating new ones  
			while (!$unique_ref_found) 
			{  
			
				// Start with a blank reference number  
				$unique_ref = "";  
				
				// Set up a counter to keep track of how many characters have   
				// currently been added  
				$i = 0;  

				// Add random characters from $possible_chars to $unique_ref   
				// until $unique_ref_length is reached  
				while ($i < $unique_ref_length) 
				{  
					// Pick a random character from the $possible_chars list  
					$char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
					$unique_ref .= $char;  
					$i++;
				}  
				
				// Our new unique reference number is generated.  
				// Lets check if it exists or not  
				$query1 = "SELECT `id` FROM `user` 
						WHERE `id`='".$unique_ref."'";  
				// $result = mysql_query($query1) or die(mysql_error().' '.$query1);  
				if ($conn->query($query1)==TRUE) 
				{  
				
					// We've found a unique number. Lets set the $unique_ref_found  
					// variable to true and exit the while loop  
					$unique_ref_found = true;  
				
				}  
			
			}  
	        
			#inserting values into the db---------------------------------------------------------------
			$query="insert into user (id,fname,lname,dob,phone,email,address,city,state,pincode,sid) values ('$unique_ref','$fname','$lname','$dob','$phone','$email','$address','$city','$state','$pincode','$sid') ";
	        if($conn->query($query)==TRUE)
	        {
				$msg = "Your user id is : ".$unique_ref;
				$msg = wordwrap($msg,70);
				$subject = "user id";
				$headers = 'From: chandanps497@gmail.com'."\r\n".'Reply-To: chandanps497@gmail.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
				mail($email, $subject,$msg,$headers);
	            header('Location: /sportsClub/regSuccess.html');
	            exit();
	        }
	        else
	        {
	        	 header('Location:/sportsClub/regFails.html');
	        }
		}
        ?>
		<br>
		<!-- FORM --------------------------------------------------------------------------------- -->
		<div class=" text-center">
			<h2>User registration</h2>
			<div class="col-lg-12">
				<div class="offset-lg-2 col-lg-8 ">
					<br>
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="row grid-row">
							<label for="colFormLabelName" class="col-form-label">
								Name :
							</label>
							<div class="col col-xs-7">
								<input  name="fname" type="text" class="form-control" placeholder="First Name" required>
							</div>
							<div class="col col-xs-7">
								<input  name="lname" type="text" class="form-control" placeholder="Last Name" required>
							</div>
						</div>
						<br>
						<div class="row grid-row">
							<label for="colFormLabeldob" class="col-form-label col-form-label-2">
								DOB(DD-MM-YYYY) :
							</label>
							<div class="col-lg-4 col-xs-4 col-sm-4">
								<input  type="date" name="dob" max="31-12-3000" min="01-01-1000" class="form-control" required>
							</div>
						</div>
						<br>
						<div class="row grid-row">
							<label for="colFormLabelSphno" class="col-form-label col-form-label-2">
								Phone Number :
							</label>
							<div class="col-lg-7 col-xs-7">
								<input  type="text" name="phone" class="form-control" placeholder="10-digit Phone Number" required>
							</div>
						</div>
						<br>
						<div class="row grid-row">
							<label for="colFormLabelEmail" class="col-form-label col-form-label-2">
								Email ID :
							</label>
							<div class="col-lg-9 col-xs-6">
								<input  type="email" name="email" class="form-control"  placeholder="johndoe@abc.com" required>
							</div>
						</div>
						<br>
						<div class="row grid-row">
							<label for="colFormLabelAdd" class="col-form-label col-form-label-2">
								Address :
							</label>
							<div class="col-lg-5 col-xs-6">
								<input  type="text" name="address" class="form-control"  placeholder="1234 Main St" required>
							</div>
							<label for="colFormLabelcity" class="col-form-label col-form-label-2">
								City :
							</label>
							<div class="col-lg-4 col-xs-3">
								<input  type="text" name="city" class="form-control"  placeholder="City" required>
							</div>
						</div>
						<br>
						<div class="row grid-row">
							<label for="colFormLabelstate" class="col-form-label col-form-label-2">
								State :
							</label>
							<div class="col-lg-4 col-xs-6">
								<input  type="text" name="state" class="form-control"  placeholder="State" required>
							</div>
							<label for="colFormLabelpin" class="col-form-label col-form-label-2">
								Pincode :
							</label>
							<div class="col-lg-4 col-xs-6">
								<input  type="text" name="pincode" class="form-control"  placeholder="Pin-code" required>
							</div>
						</div>
						<br>
						<div class="row grid-row">
							<label for="colFormLabelpin" class="col-form-label col-form-label-2">
								Sports ID :
							</label>
							<div class="col-lg-4 col-xs-6">
								<input  type="text" name="sid" class="form-control"  placeholder="sports ID" required>
							</div>
						</div>
						<br>
						<center><button  type="submit" name="submit" class="btn btn-success">Submit</button></center>
						<br>
					</form>
				</div>
			</div>
		</div>
		<script src="adminNav.js"></script>
	</body>
</html>