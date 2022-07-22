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
<link href="style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<style>
	.side a {
	text-decoration: none;
	color: rgb(37, 37, 37);
	font-size: 11.5pt;
	/*-webkit-text-stroke-width: 0.2px;
  	-webkit-text-stroke-color: rgb(170, 169, 169);*/
}

.side ul {
	width: 300px;
	height: 370px;
	padding-left: 50px;
	margin: 5px 0px 0px 0px;
}

.side li {
	display: flex;
	align-items: center;
	width: 200px;
	height: 60px;
	padding: 0px 15px 0px 45px;
	border-radius: 10px;
}

.side li::before {
	content: "";
	position: absolute;
	width: 3px;
	height: 42px;
	left: 25px;
}

.side li:hover {
	/*background-color: #d3d6d8;*/
	background-color: #d2ebfdb4;
	width: 280px;
	transition: .5s;
	
}

.side li:hover::before {
	background-color: #7fc8fd;
	transition: .5s;
}

.logout{
	align-items: center;
	width: 200px;
	height: 60px;
	padding: 0px 15px 0px 80px;
}

</style>
<div class="col-12 d-flex justify-content-end align-items-end position-absolute">
<button class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-menu-button"></i></button>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel"></h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">

  <div class="side">

  <div class="acc-container">

<?php 

	if (!$login) {
		echo '<a href="userlogin.php"><img src="images/person.png" class="account"></a>';
		echo "<br/><br/>";
		echo '<a href="userlogin.php"><button class="btn">Login / Sign Up</button></a>';
	}
	else {
		echo '<a href="userprofile.php"><img src="images/person.png" class="account"></a>';
		echo "<br/><br/>";
		echo $displayname;
	}
?>
</div>
<br/><hr color="#c4c4c4" width="360px">

  					<ul>
					<a href="index.php">
						<li>
							<img src="images/home.png" class="icon">Home
							
						</li>
					</a>
					<a href="aboutus.php">
						<li>
							<img src="images/aboutus.png" style="opacity:60%; margin-right:21px; width:25px; height:25px;">About Us
												
						</li>
					</a>
					<a href="busbooking.php">
						<li>
							<img src="images/busbooking.png" class="icon">Bus Booking
							
						</li>
					</a>
					<a href="bookinghistory.php">
						<li>
							<img src="images/bookinghistory.png" class="icon">Booking History
							
						</li>
					</a>
					<a href="contactus.php">
						<li>
							<img src="images/contactus.png" class="icon">Contact Us
							
						</li>
					</a>
					<a href="faq.php">
						<li>
							<img src="images/faq.png" class="icon">FAQ
							
						</li>
					</a>
				</ul>

				<hr color="#c4c4c4" width="360px">
				<br/>

				<div class="logout">
				<?php
					if ($login) {
						echo '<form action="index.php" method="get">
								<button type="submit" class="btn">Sign Out</button>
								<input type="hidden" name="sign-out" value="true">
								</form>
						';
					}
				?>
				</div>
				</div>
  </div>
</div>