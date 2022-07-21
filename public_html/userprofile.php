<?php 
		$login = false;

		//connect database
		$dbc = mysqli_connect('localhost', 'root', '');

		if (!$dbc) {
			die("Error: " . mysqli_connect_error($dbc));
		}

		mysqli_select_db($dbc, 'busplan');
			
		if (isset($_GET['sign-out'])) {
			session_start();
			session_destroy();
		}

		else {
			session_start();
			if (isset($_SESSION['user_info'])) {

				$login = true;

				//run thequery
				if ($r = mysqli_query($dbc, $_SESSION['user_info'])) { 
					//retrieve the record
					$row = mysqli_fetch_array($r);

					$displayname = $row['first_name'] . $row['last_name'];
				}
			}
		}
		mysqli_close($dbc);
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Tom Bus - User Profile</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
	
</head>
	
	<body>
		<?php include "sidebar.php"; ?>

		<?php
			$dbc = mysqli_connect("localhost",'root','','busplan');

			if(!$dbc) {
				die("Unable to connect" . mysqli_error($connection));
			}
		?>

		<br><br><br>
		<div style="display:flex; justify-content:center; align-items:center; flex-direction:column">
								  
			<h1>Profile</h1>

			<br><br><br>

			<div class="tab">
				<a href="userprofile.php"><button class="tablinks" style="width: 30%;height:80px;">Personal Details</button></a>
				<a href="bookinghistory.php"><button class="tablinks" style="width: 30%;height:80px;">Booking History</button></a>
				<a href="editprofile.php"><button class="tablinks" style="width: 30%;height:80px;">&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp; Details</button></a>
			</div>
			
			<br><br><br><br>

			<div id="Personal Details" class="tabcontent">
				<h3>Details</h3>
				<br>
				<?php
					$sql = "SELECT user_id, first_name, last_name , phone_no, email FROM user";
					$result = mysqli_query($dbc, $sql);
					
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
							$id = $row['user_id'];
							$first_name = $row['first_name'];
							$last_name = $row['last_name'];
							$phone_no = $row['phone_no'];
							$email = $row['email'];
						}
					} else {
						echo "0 results";
					}
				?>

				<table class="table table-striped" style="width: 50%">
					<tbody>
						<tr>
							<td><b>FirstName:</b> </td>
							<td><?php echo ucfirst($first_name); ?></td>
						</tr>
						<tr>
							<td><b>Lastname: </b></td>
							<td><?php echo ucfirst($last_name); ?></td>
						</tr>
						<tr>
							<td><b>Phone No: </b></td>
							<td><?php echo $phone_no; ?></td>
						</tr>
						<tr>
							<td><b>Email: </b></td>
							<td><?php echo $email; ?></td>
						</tr>
				  </tbody>
				</table>

			</div>
			
			<div style="margin: 40px;">
			<form action="" method="post">
				<input type="submit" class="btn btn-primary" style="color:black" name="delete" value="Delete Account">
				<?php
					if(isset($_POST['delete']))	{
						$del = mysqli_query($dbc,"delete from user where user_id = '$id'");
				?>	
				
				<script type="text/javascript">
					alert("Delete Successfull.");
					window.location = "index.php";
				</script>
				
				<?php
						if($del) {
							session_destroy();
							mysqli_close($dbc); 
							exit;	
						}
						else {
							echo "Error deleting account"; 
						}
					}
				?>
			</form>
			</div>
		</div>


	</body>
</html>