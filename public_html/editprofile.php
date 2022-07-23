
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Bus Plan - User Profile</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
	
	<body>
		<?php include "sidebar.php"; ?>

		<?php
			$dbc = mysqli_connect("localhost",'root','','busplan');

			if(!$dbc) {
				die("Unable to connect" . mysqli_error($connection));
			}
			
			
				if (isset($_SESSION['user_info'])) {
					$login = true;
					mysqli_select_db($dbc, 'busplan');
				}
		?>

		<br><br>
		<div style="display:flex; justify-content:center; align-items:center; flex-direction:column">
								  
			<h1>Profile</h1>

			<br>

			<div class="tab">
				<a href="userprofile.php"><button class="tablinks" style="width: 30%;height:60px;">Personal Details</button></a>
				<a href="bookinghistory.php"><button class="tablinks" style="width: 30%;height:60px;">Booking History</button></a>
				<a href="editprofile.php"><button class="tablinks" style="width: 30%;height:60px;">&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp; Details</button></a>
			</div>

			<br><br>

			<div id="Edit Details" class="tabcontent">
				<h2>Edit Details</h2>
				<br>
				<?php
					$okay = true;

					$sql = "SELECT user_id, first_name, last_name , phone_no, email FROM user";
					$result = mysqli_query($dbc, $sql);
					
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
							$id = $row['user_id'];
							$user_firstname = $row['first_name'];
							$user_lastname = $row['last_name'];
							$user_phoneno = $row['phone_no'];
							$user_email = $row['email'];
						}
					} else {
						echo "0 results";
					}
					
					if (isset($_POST['update'])) {
						$firstname = $_POST['user_firstname'];
						$lastname = $_POST['user_lastname'];
						$phonenumber = $_POST['user_phoneno'];
						$email = $_POST['user_email'];

						if (empty($_POST['oldPw']) && empty($_POST['newPw'])) {
							if (empty($firstname)) {
								echo "First Name is required<br/>";
								$okay = false;
							}
							else if (ctype_alpha(str_replace(' ', '', $firstname)) == false) {
								echo "Only letters and spaces are allowed in First Name field.<br/>";
								$okay = false;
							}
							if (empty($lastname)) {
								echo "Last Name is required<br/>";
								$okay = false;
							}
							else if (ctype_alpha(str_replace(' ', '', $lastname)) == false) {
								echo "Only letters and spaces are allowed in Last Name field.<br/>";
								$okay = false;
							}
							if (empty($phonenumber)) {
								echo "Phone Number is required.<br/>";
								$okay = false;				
							}
							else if (!is_numeric($phonenumber)) {
								echo "Only digits are allowed.<br/>";
								$okay = false;
							}
							else if (strlen($phonenumber)==11 && substr($phonenumber, 0, 3)!="601") {
								echo "Phone number is invalid.<br/>";
								$okay = false;
							}
							else if (strlen($phonenumber)==12 && substr($phonenumber, 0, 4)!="6011") {
								echo "Phone number is invalid.<br/>";
								$okay = false;
							}
							else if (strlen($phonenumber)!=11 && strlen($phonenumber)!=12) {
								echo "Length of phone number is invalid.<br/>";
								$okay = false;
							}
							if (empty($email)) {
								echo "Email is required.<br/>";	
								$okay = false;			
							}
							else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
								echo "Invalid E-mail address.<br/>";
								$okay = false;
							}
							if ($okay) {
								$query = "UPDATE user SET first_name = '$firstname',
								last_name = '$lastname',
								phone_no = $phonenumber,
								email = '$email'
								WHERE user_id = '$id'";

								if (!mysqli_query($dbc, $query)) {
									echo 'Error: '.mysqli_error($dbc);
								}
								else {
								?>
									<script type="text/javascript">
										alert("Your user profile has been update successfully.");
										window.location = "userprofile.php";
									</script>
								<?php 
								}
							}
							
						}
						else {
							$oldPw = $_POST['oldPw'];
							$newPw = $_POST['newPw'];

							//password validation
							$number = preg_match('@[0-9]@', $newPw);
							$upperCase = preg_match('@[A-Z]@', $newPw);
							$lowerCase = preg_match('@[a-z]@', $newPw);
							$specialChars = preg_match('@[^\w]@', $newPw);
							
							$okay = true;

							$query = "SELECT * FROM user WHERE email='$user_email' AND password=MD5('$oldPw')";
							if ($r = mysqli_query($dbc, $query)) {
								$row = mysqli_fetch_array($r);

								if (isset($row)) {

									if (empty($firstname)) {
										echo "First Name is required.<br/>";
										$okay = false;
									}
									else if (ctype_alpha(str_replace(' ', '', $firstname)) == false) {
										echo "Only letters and spaces are allowed in First Name field.<br/>";
										$okay = false;
									}
									if (empty($lastname)) {
										echo "Last Name is required.<br/>";
										$okay = false;
									}
									else if (ctype_alpha(str_replace(' ', '', $lastname)) == false) {
										echo "Only letters and spaces are allowed in Last Name field.<br/>";
										$okay = false;
									}
									if (empty($phonenumber)) {
										echo "Phone Number is required.<br/>";
										$okay = false;				
									}
									else if (!is_numeric($phonenumber)) {
										echo "Only digits are allowed.<br/>";
										$okay = false;
									}
									else if (strlen($phonenumber)==11 && substr($phonenumber, 0, 3)!="601") {
										echo "Phone number is invalid.<br/>";
										$okay = false;
									}
									else if (strlen($phonenumber)==12 && substr($phonenumber, 0, 4)!="6011") {
										echo "Phone number is invalid.<br/>";
										$okay = false;
									}
									else if (strlen($phonenumber)!=11 && strlen($phonenumber)!=12) {
										echo "Length of phone number is invalid.<br/>";
										$okay = false;
									}
									if (empty($email)) {
										echo "Email is required.<br/>";	
										$okay = false;			
									}
									else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
										echo "Invalid E-mail address.<br/>";
										$okay = false;
									}
									if (empty($oldPw) || empty($newPw)) {
										echo "Old and New Password is required.<br/>";
										$okay = false;				
									}
									else if (strlen($newPw) < 8 || !$number || !$upperCase || !$lowerCase || !$specialChars) {
										echo "* Password must be at least 8 characters in length and must containat least one number, one upper case letter, one lower case letter and one special character.";
										$okay = false;
									}
									if ($okay) {

										$first_name = $_POST['first_name'];
										$lastname = $_POST['last_name'];
										$phone = $_POST['phone_no'];
										$email = $_POST['email'];
										$pw = $row['password'];
						
										$curl = curl_init();
										
										$postfields = array(
											"first_name" => $first_name,
											"last_name" => $last_name,
											"phone_no" => $phone_no,
											"email" => $email,
											"password" => $password,
											"user_id" =>$user_id,
										);
								  
										$postfields = json_encode($postfields);
										curl_setopt_array($curl, array(
										CURLOPT_URL => 'http://localhost/BusPlan/api/customer/update.php',
										CURLOPT_RETURNTRANSFER => true,
										CURLOPT_ENCODING => '',
										CURLOPT_MAXREDIRS => 10,
										CURLOPT_TIMEOUT => 0,
										CURLOPT_FOLLOWLOCATION => true,
										CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										CURLOPT_CUSTOMREQUEST => 'POST',
										CURLOPT_POSTFIELDS =>$postfields,
										CURLOPT_HTTPHEADER => array(
											'Content-Type: text/plain'
										),
										));
				
										$response = curl_exec($curl);
										$response = json_decode($response);
										$response;
										curl_close($curl);
				
										if ($response->error) {
											echo $response->message;
										} 
										else {
											$msg = "Your profile has been updated successfully!";
										}
									}
								}
								else {
									echo "The password that you've entered is incorrect. Please try again. <br/>";
								}	
							}
							else {
								echo 'Error: '.mysqli_error($dbc);
							}
						}
					}
					?>
				
				<form action="editprofile.php" method="post">

					<div class="form-group">
						<label for="firstname">Firstname</label>
						<input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
					</div>

					<div class="form-group">
						<label for="lastname">Lastname</label>
						<input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
					</div>
					  
					<div class="form-group">
						<label for="phoneno">PhoneNo</label>
						<input value="<?php echo $user_phoneno; ?>" type="text" class="form-control" name="user_phoneno">
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input value="<?php echo $user_email ?>" type="email" class="form-control" name="user_email">
					</div>

						<?php
							if (isset($_POST['changePw'])) {
								echo '
								<div class="form-group">
									<label for="oldPw">Old Password</label>
									<input type="password" class="form-control" name="oldPw">
								</div>

								<div class="form-group">
									<label for="newPw">New Password</label>
									<input type="password" class="form-control" name="newPw" id="newPw">
								</div>
								
								<div class="form-group">
									<input type="checkbox" onclick="myFunction()">&nbsp;&nbsp;Show Password
								</div>
								';
							}
							else {
								echo '
								<div class="form-group">
									<label for="password">Password</label>&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="submit" class="btn btn-primary" style="color:black" name="changePw" value="Change">
								</div> ';
							}
						?>

					<br/><br/>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" style="color:black" name="update" value="Update">
					</div>
				</form>


			</div>

		</div>
			<hr>
		
		<script>

		function myFunction() {
			var x = document.getElementById("newPw");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
		
		</script>
	</body>
</html>
<?php include 'Footer.php'; ?>