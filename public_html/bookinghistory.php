
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, intial-scale=1.0">
		<title>Bus Plan - Booking History</title>

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
			$dbc = mysqli_connect('localhost', 'root', '');

			if (!$dbc) {
				die("Error: " . mysqli_connect_error($dbc));
			}

			mysqli_select_db($dbc, 'busplan');

			if (isset($_SESSION['user_info'])) {

				if ($r = mysqli_query($dbc, $_SESSION['user_info'])) { 

					$row = mysqli_fetch_array($r);

					$user_id = $row['user_id'];
					
					$query = "SELECT * FROM booking INNER JOIN busroute ON booking.route_id = busroute.route_id where booking.user_id = $user_id";
		?>

		<br><br>
		<div style="display:flex; justify-content:center; align-items:center; flex-direction:column">
								  
			<h1>Profile</h1>

			<br><br>

			<div class="tab">
				<a href="userprofile.php"><button class="tablinks" style="width: 30%;height:80px;">Personal Details</button></a>
				<a href="bookinghistory.php"><button class="tablinks" style="width: 30%;height:80px;">Booking History</button></a>
				<a href="editprofile.php"><button class="tablinks" style="width: 30%;height:80px;">&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp; Details</button></a>
			</div>

			<br><br>
			<div class="table-responsive d-flex col-sm-12 col-lg-6 justify-content:center">
			<div id="Booking History" class="tabcontent">
				<h3>Booking History</h3>
				
				<table class="table table-striped" style="width: 100%">
					<thead>
						<tr>
							<th>Booking ID</th>
							<th>Departure</th>
							<th>Destination</th>
							<th>Date</th>
							<th>Departure Time</th>
							<th>Arrival Time</th>
							<th>Seat No</th>
							<th>Booking Time</th>
						</tr>
					</thead>
				<?php
					if ($r = mysqli_query($dbc, $query)) { 
                        while ($row = mysqli_fetch_array($r)) {
							$bookingId = $row['booking_id'];
							$departure = $row['departure'];
							$destination = $row['destination'];
							$date = $row['date'];
							$departureTime = $row['departure_time'];
							$arrivalTime = $row['arrival_time'];
							$bookingTime = $row['booking_time'];
							$seat_no = $row['seat_no'];

							echo '
							<tbody>
								<tr>
									<td>' . $bookingId . '</td>
									<td>' . $departure . '</td>
									<td>' . $destination . '</td>
									<td>' . $date . '</td>
									<td>' . $departureTime . '</td>
									<td>' . $arrivalTime . '</td>
									<td>' . $seat_no . '</td>
									<td>' . $bookingTime . '</td>
									<td>';
							
					if ( $date > date('Y-m-d H:i:s')) {
				echo '

								<a href="bookinghistory.php?cancelBookingId=' . $bookingId . '"><button class="btn btn-primary btn-xs" type="submit">Cancel</button></a>';
								
									if (isset($_GET['cancelBookingId']))	{
										$cancelBookingId = $_GET['cancelBookingId'];
										$del = mysqli_query($dbc,"delete from booking where booking_id = '$cancelBookingId'");
									
								?>
								<script type="text/javascript">
									alert("Cancel Successfull.");
									window.location = "bookinghistory.php";
								</script>
							
								<?php
									}
						
					
						} }
						
						echo '</td>
					</tr>
					<br><br><br>
				  </tbody>
				</table>';
						} } 
						} else {
					
					echo '
					<div class="container"
						<p>Please login before proceed to booking history.<br/><br/></p>
						<p><a href="account.php"><button class="btn btn-primary" type="submit">Login</button></a></p>
					</div>';

						}
					?>
				
			</div>
		</div>
					</div>
		
	</body>
</html>
