<!DOCTYPE>
<html lang="en>
<head>
    <title>Side Bar</title>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
</head>

</head>

<body>
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

        <div class="side-bar">
			<button class="menu-btn">
				<img src="images/menu.png" class="menu">
			</button>

			<div class="side-bar-content">
				
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
				<br/>
				<hr color="#c4c4c4" width="270px">
				
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

				<hr color="#c4c4c4" width="270px">
				<br/>

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
			
			<div class="to-top">
				<a href="#top">
					<img src="images/to-top.png" width="30px" height="30px">
				</a>
			</div>
		</div>