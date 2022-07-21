<?php
		$err = "";

		//connect the database
        $dbc = mysqli_connect('localhost', 'root', '');

        if (!$dbc) {
			die("Error: " . mysqli_connect_error($dbc));
		}

		mysqli_select_db($dbc, 'busplan');

		if (isset($_POST['submitted'])) {

			if (empty($_POST['departure']) || empty($_POST['destination']) || empty($_POST['onwardDate'])) {
				$err = "All the fields are required.";
				echo $err;
        	}
			
			else {
				$departure = $_POST['departure'];
				$destination = $_POST['destination'];
				$onwardDate = $_POST['onwardDate'];
				
				$url = "Location: search_result.php?departure=" . $departure . "&destination=" . $destination . "&onwardDate=" . $onwardDate . "&returnDate=" . "";
				header("$url");
			}
		}
        
        mysqli_close($dbc);
    
    ?>

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

<html>
<head>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Bus Plan - Bus Booking</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">

	<style type="text/css">
		*{margin:0;}
		
	/* Background */
	
	body{
		background: url(background.jpg);
	}
	
	/* Tab Header */

	.tab-header {
		width: 310px;
		height: 40px;
	}

	.tab1, .tab2, .tab3 {
		width: 100px;
		height: 40px;
		background-color: lightblue;
	}

	/* Tab Content */

	.tabContent1{
		width: 1200px;
		height: 100px;
		padding-left:500px;
		margin-left:150px;
		text-align: -webkit-center;
		justify-content: space-around;
		align-items: center;
		}

	.tabContent1, .tabContent2, .tabContent3 {
		width: 1200px;
		height: 100px;
    	text-align: -webkit-center;
		justify-content: space-around;
		align-items: center;
	}

	.tabContent1 {
		display: block;
	}

	.tabContent2, .tabContent3 {
		display: none;
	}

	input{
		margin-top: 20px;
	}

	.input-box{
		width: 200px;
		height: 30px;
		display: inline-block;
	}

	 /* Button */
	.searchBus {
		width: 120px;
		height: 40px;;
		color: white;
		border: none;
		font-size: 12px;
		font-weight: 500;
		border-radius: 5px;
		letter-spacing: 1px;
		background: linear-gradient(135deg, #9ad3fb, #615ea6);
		cursor: pointer;
		display: block;
	}

	.searchBus:hover {
		background: linear-gradient(135deg, #4b7a99, #3c3a78);
	}

	span {
		position: absolute; 
	}

	/* Bus Route*/
	table {
  		border: 1px solid black;
  		border-collapse: collapse;
		margin-left: auto; 
  		margin-right: auto;
		justify-content: center;
		align: center;
	}

	th, td {
		padding: 30px;
	}

	/* Card Hover */
	.location_title h1{
		text-align: center;
    }

	.destination-wrapper{
		display: flex;
		width: 100%;
		justify-content: space-evenly;
	}

	.destination-wrapper2{
		display: flex;
		width: 100%;
		justify-content: space-evenly;
	}

	.location{
		width: 100%;
		height: 43%;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.location2{
		width: 100%;
		height: 43%;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.destination-card img {
		border-radius: 20px;
	}

	.destination-card {
		width: 400px;
		height: 230px;
		padding: 2rem 1rem;
		background: #fff;
		position: relative;
		display: flex;
		align-items: flex-end;
		box-shadow: 0px 7px 10px rgba(0,0,0,0.5);
		transition: 0.5s ease-in-out;
		border-radius: 20px;
	}

	.destination-card:hover{
		transform: translateY(20px);
	}

	.destination-card:before{
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		display: block;
		width: 100%;
		height: 100%;
		background: linear-gradient(to bottom, #59000000, black);
		z-index: 2;
		transition: 0.5s all;
		border-radius: 20px;
		opacity: 0;
	}

	.destination-card:hover:before{
		opacity: 1;
	}

	.destination-card img{
		width: 100%;
		height: 100%;
		object-fit: cover;
		position: absolute;
		top: 0;
		left: 0;
	}

	.destination-card .info{
		position: relative;
		z-index: 3;
		color: #fff;
		opacity: 0;
		transform: translateY(30px);
		transition: 0.5s all;
	}

	.destination-card:hover .info{
		opacity: 1;
		transform: translateY(30px);
	}

	.info h1, .info p {
		padding: 0px 10px 30px 10px;
	}
	
	.info p {
		font-size: 10pt;
	}
	
	.input-box input {
		border-radius: 10px;
		width: 180px;
		height: 30px;
		border: none;
	}

	.input-box input::placeholder {
		padding: 0 20px;
	}

	@media(max-width:330px){
		.logo{
			position:absolute; 
			width:100px; 
			max-height:150px; 
			align:left; 
			left:20px; 
		}

		.tabContent1{
			max-width:100px;
			padding-left:1px;
			margin:auto;
			padding-bottom:300px;
		}


		.side-bar {
			position: fixed;
			max-width: 50px;
			height: 300px;
			margin:auto;
			padding-left:10px;
			
		}

		.side-bar-content {
			position: fixed;
			max-width: 200px;
			max-height: 500px;
			left:5px;
			padding-left:20px;
			
		}

		.acc-container {
			width: 300px;
			height: 100px;
			padding-top:70px;
			text-align: center;

		}

		.menu{
			position: fixed;
			max-width: 200px;
			height: 100vh;
			left:280px;
		}

		.home-title-content{
			max-width: 320px;
			text-align:right;
			right:100px;
		}

		.to-top{
			position: fixed;
			max-width: 200px;
			height: 100vh;
			left:280px;
		}

		td{
			max-width:5px;
		}

		tr{
			max-width:5px;
		}


		.destination-card{
			max-width:100px;
		}

		.info h1, .info p {
			padding: 0px 10px 30px 10px;
			margin:auto;
			font-size: 8px;
		}

	}


	</style>
</head>

<body>
	<?php include "sidebar.php"; ?>
		<div style="position:absolute; width:100px; height:200px; align:left; top:-40px; left:20px;">
			<a href="index.php"><img src="images/tombuslogo2.png" class="logo" style="filter: grayscale(100%);"></a>
		</div>
		<!----- Tab Header ----->
		<div style="background:#d3e4f0">
		<br/><br/><br/><br/><br/>
		<h1 align="center">Plan your travel with</h1>
		<br/><br/>
		<h1 align="center"><big>Largest Bus Booking Platform</big></h1>
		<br/><br/><br/>

		<!-- Tab Content -->
			

					<!-- Tab Content 1-->
					<form action="busbooking.php" method="post">
					<div class="tabContent1" id="tabContent1">
						<!----- From ----->
						<div class="input-box">
							<input list="departure" placeholder="From" name="departure">
								<datalist id="departure">
									<?php 
										//connect database
										$dbc = mysqli_connect('localhost', 'root', '');

										if (!$dbc) {
											die("Error: " . mysqli_connect_error($dbc));
										}

										mysqli_select_db($dbc, 'busplan');

										//select the record without duplicating
										$query = "SELECT DISTINCT departure FROM busroute";

										if ($r = mysqli_query($dbc, $query)) {
											while ($row = mysqli_fetch_array($r)) {
												echo "<option value=\"{$row['departure']}\">";
											}
										}
										else {
										echo "Error: " . mysqli_error($dbc); 
										}
									?>
								</datalist>	
						</div>
						
						<!----- To ----->
						<div class="input-box">
							<input list="destination" placeholder="To" name="destination">
								<datalist id="destination">
									<?php 
										//connect database
										$dbc = mysqli_connect('localhost', 'root', '');

										if (!$dbc) {
											die("Error: " . mysqli_connect_error($dbc));
										}

										mysqli_select_db($dbc, 'busplan');

										//select the record without duplicating
										$query = "SELECT DISTINCT destination FROM busroute";

										if ($r = mysqli_query($dbc, $query)) {
											while ($row = mysqli_fetch_array($r)) {
												echo "<option value=\"{$row['destination']}\">";
											}
										}
										else {
										echo "Error: " . mysqli_error($dbc); 
										}
									?>
								</datalist>	
						</div>
						
						<!----- Date ----->
						<div class="input-box">
							<input type="date" class="form-control select-date" name="onwardDate">
						</div>
						
						<!----- Search ----->
						<br/><br/>
						<input type="submit" class="searchBus" value="Search Bus">	
						<input type="hidden" name="submitted" value="true">
					</div>
					</form>
					<!--End of Tab Content 1 -->

				</div>
				<br/><br/>

		<!-- Bus Route Table -->
		<h1 align="center">Top Bus Route</h1>
		<br/><br/>
		<table class="bus_route">

			<!-- Place -->
			<div class="col-sm-12 col-lg-6">
			<table class="table">
			<tbody>
				<tr>
					<td scope="row">Penang to Kuala Lumpur</td>
					<td>Kuala Lumpur to Penang</td>
					<td>Melacca to Penang</td>
					<td>Johor to Penang</td>
					<td>Perlis to Penang</td>
				</tr>
				<tr>
					<td scope="row">Penang to Melacca</th>
					<td>Kuala Lumpur to Melacca</td>
					<td>Melacca to Kuala Lumpur</td>
					<td>Johor to Kuala Lumpur</td>
					<td>Perlis to Kuala Lumpur</td>
				</tr>
				<tr>
					<td scope="row">Penang to Johor</th>
					<td>Kuala Lumpur to Johor</td>
					<td>Melacca to Johor</td>
					<td>Johor to Melacca</td>
					<td>Perlis to Johor</td>
				</tr>
				<tr>
					<td scope="row">Penang to Perlis</th>
					<td>Kuala Lumpur to Perlis</td>
					<td>Melacca to Perlis</td>
					<td>Johor to Perlis</td>
					<td>Perlis to Melacca</td>
				</tr>
			</tbody>
			</table>
		</div>

		<br/><br/>

		<br/><br/>

		<!-- Card Hover -->
	<body>
		<div class="location_title">
            <h1>Top Destination</h1>
        </div>

		<br/>

		<div class="location">
			<div class="destination-wrapper">
				<div class="destination-card"><div class="col-12 col-lg-6">
					<img src="images/Penang.jpg">
					<div class="info">
						<h1>Penang</h1>
						<p>Penang is a Malaysian state located on the northwest coast of Peninsular Malaysia, by the Malacca Strait.</p>
					</div>
				</div></div>
			
		
			
				<div class="destination-card"><div class="col-12 col-lg-6">
					<img src="images/KL.jpg">
					<div class="info">
						<h1>Kuala Lumpur</h1>
						<p>Kuala Lumpur officially the Federal Territory of Kuala Lumpur (Malay: Wilayah Persekutuan Kuala Lumpur) and colloquially referred to as KL, is a federal territory and the capital city of Malaysia.</p>
					</div>
				</div></div>

				<div class="destination-card"><div class="col-12 col-lg-6">
					<img src="images/Melacca.jpg">
					<div class="info">
						<h1>Melacca</h1>
						<p>Malacca is a state in Malaysia located in the southern region of the Malay Peninsula, next to the Strait of Malacca.</p>						
					</div>
				</div></div>
			</div>
		</div>

		
		<div class="location2"><div class="row col-12 col-lg-6">
			<div class="destination-wrapper2">
				<div class="destination-card">
					<img src="images/Johor.jpg">
					<div class="info">
						<h1>Johor</h1>
						<p>Johor also spelled as Johore, is a state of Malaysia in the south of the Malay Peninsula.</p>
					</div>
				</div>

				<div class="destination-card">
					<img src="images/Perlis.jpg">
					<div class="info">
						<h1>Perlis</h1>
						<p>Perlis or also known by its popular honorific title Perlis Indera Kayangan is the smallest state in Malaysia located at the northern part of the west coast of Peninsular Malaysia and has the Satun and Songkhla Provinces of Thailand on its northern border.</p>
					</div>
				</div>
			</div>
		</div>
		</div>
	</body>

	<br/><br/>
		<script>

			var tabContent1 = document.getElementById("tabContent1");
			var tabContent2 = document.getElementById("tabContent2");
			var tabContent3 = document.getElementById("tabContent3");
			
			function showTab1() {
				tabContent1.style.display = "block";
				tabContent1.style.opacity = "1";
				tabContent1.style.transitionDuration = "1s";

				tabContent2.style.display = "none";
				tabContent2.style.opacity = "0";
				tabContent2.style.transitionDuration = ".2s";

				tabContent3.style.display = "none";
				tabContent3.style.opacity = "0";
				tabContent3.style.transitionDuration = ".2s";
				
			}
			function showTab2() {
				tabContent1.style.display = "none";
				tabContent1.style.opacity = "0";
				tabContent1.style.transitionDuration = ".2s";

				tabContent2.style.display = "block";
				tabContent2.style.opacity = "1";
				tabContent2.style.transitionDuration = "3s";

				tabContent3.style.display = "none";
				tabContent3.style.opacity = "0";
				tabContent3.style.transitionDuration = ".2s";

			}
			function showTab3() {
				tabContent1.style.display = "none";
				tabContent1.style.opacity = "0";
				tabContent1.style.transitionDuration = ".2s";

				tabContent2.style.display = "none";
				tabContent2.style.opacity = "0";
				tabContent2.style.transitionDuration = ".2s";

				tabContent3.style.display = "block";
				tabContent3.style.opacity = "1";
				tabContent3.style.transitionDuration = "1s";

			}
		</script>
		<?php include 'Footer.php'; ?>
	</body>
</html>
