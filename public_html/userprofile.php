<?php include "sidebar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Tom Bus - User Profile</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	
</head>
	
	<body>

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
<?php include 'Footer.php'; ?>