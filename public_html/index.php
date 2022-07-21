<html>

<head>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Bus Plan - Home Page</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<style>
	.image_destination{
		font-size:10.5pt;
		margin-top:100px;
		margin-left:5%;
		margin-right:5%;
		text-align:center;
	}

	@media(max-width:320px){
		.video{
			max-width:120vw;
		}

		.side-bar {
			position: fixed;
			max-width: 200px;
			height: 400px;
			left:5px;
			padding-left:200px;
			
		}

		.side-bar-content {
			position: fixed;
			max-width: 200px;
			max-height: 500px;
			left:5px;
			padding-left:18px;
			
		}

		.acc-container {
			width: 300px;
			height: 100px;
			padding-top:70px;
			text-align: center;

		}

  		.video-container video {
			max-width:100%;
			width: 100%;
			height:100%;
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
		
		.menu{
			position: fixed;
			max-width: 200px;
			height: 100vh;
			left:280px;
		}

		.img{
			max-width:175px;
		}

		.card-desc{
			max-width:100px;
			padding-right:30px;
		}

		p.card-desc{
			font-size: 7px;
			margin:auto;
		}

		h3.word{
			font-size:10px;
			left:10px;
		}

		.card-content{
			max-width: 100px;
			margin:auto;
			
		}

		.container{
			left:100px;
			margin-right:100px;
			max-width:250px;
		}

		.top_destination{
			max-width:200px;
			text-align:left;
			right:10px;
			padding-right:200px;
		}

		p.top{
			font-size:10px;
			text-align:left;
			max-width:300px;
		}

		.image_destination{
			padding-right:10px;
			max-width:270px;
		}

	}
</style>

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
	
	<div class="bus">
	
	<div class="video-container">
		<video autoplay muted loop>
			<source src="busvideo.mov" type="video/mp4">
		</video>
	</div>

		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 230">
			<path fill="#fff" fill-opacity="1" d="M0,224L60,192C120,160,240,96,360,90.7C480,85,600,139,720,149.3C840,160,960,128,1080,122.7C1200,117,1320,139,1380,149.3L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
		</svg>

		<a href="index.php"><img src="images/tombuslogo2.png" class="logo" style="filter: grayscale(100%);opacity: 80%; transform:translateX(40px)translateY(-35px);"></a>

		<div class="home-title-content">
			<p style="font-size:16pt">Welcome to</p>
			<h1 style="font-size:40pt">Tom Bus</h1>
			<a href="busbooking.php"><button type="button" class="btn-glass">Book Now &nbsp;&nbsp;&#8594</button></a>
		</div>

		<a name="top"></a>

		<div class="side-bar">
			<button class="menu-btn">
				<img src="images/menu.png" class="menu">
			</button>

			<div class="side-bar-content">
				
				<div class="acc-container">

					<?php 

						if (!$login) {
							echo '<a href="account.php"><img src="images/person.png" class="account"></a>';
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
	</div>

	<h1 align="center">Why Book With Us?</h1>

	<br/>

	<div class="col-12 col-lg-6">
		<div class="card-container">

			<div class="cards">
				<div class="card">
					<div class="card-img" id="card-img1">
						<img src="images/trust.png" width="90px" height="90px">
				</div>
					
					<div class="col-12 col-lg-6">
						<div class="card-content">
							<h3 class="word">Trustworthy</h3>
							<p class="card-desc">Established a strong background history through our success. Aiming to deliver only quality services.</p>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-img" id="card-img2">
						<img src="images/multiplebus.png" width="90px" height="90px" style="padding:25px;">
					</div>
					
					<div class="col-12 col-lg-6">
						<div class="card-content">
							<h3 class="word">Multiple Bus Services</h3>
							<p class="card-desc">Choose from various bus services, coach companies and your preferred seat.</p>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-img" id="card-img3">
						<img src="images/securepayment.png" width="90px" height="90px" style="padding:23px;">
					</div>
					
					<div class="col-12 col-lg-6">
						<div class="card-content">
							<h3 class="word">Secure Payment</h3>
							<p class="card-desc">Has the highest security standards and keeps your information and purchases completely safe and secure.</p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="cards">
				<div class="card">
					<div class="card-img" id="card-img4">
						<img src="images/promotion.png" width="80px" height="80px" style="padding:15px;">
					</div>
					
					<div class="col-12 col-lg-6">
						<div class="card-content">
							<h3 class="word">Discounts & Promotions</h3>
							<p class="card-desc">Frequent promotions are up for grab! Check out great discounts and sales from time to time to enjoy lower prices.</p>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-img" id="card-img5">
						<img src="images/comfort.png" width="90px" height="90px">
					</div>
					
					<div class="card-content">
						<h3 class="word">Comfort on board</h3>
						<p class="card-desc">Our buses are equipped with large and comfortable seats, a toilet, Wi-Fi and power outlets.</p>
					</div>
				</div>

				<div class="card">
					<div class="card-img" id="card-img6">
						<img src="images/support.png" width="80px" height="80px" style="padding:5px;">
					</div>

					<div class="col-12 col-lg-6">
						<div class="card-content">
							<h3 class="word">Superior Customer Support</h3>
							<p class="card-desc">Our customer support will ensure to service all your queries.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<h1 align="center">Promotion</h1>
	<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
			<img src="images/promotion1.jpg" class="d-block w-100" alt="...">
			</div>
			<div class="carousel-item">
			<img src="images/promotion1.jpg" class="d-block w-100" alt="...">
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>

	<br/><br/>
			<h1 align="center">Top Destination</h1>
			<hr width="15%" size="1" color="#000000">

	<div class="top_destination">
		<div class="container">
			<div class="row text-center">
					<div class="col-sm-12 col-lg-6">
							<img class="image_destination" width="350" height="350" src="images/Penang.jpg">
					</div>

					<div class="col-sm-12 col-lg-6">
						<h3 class="text-center"><i>Penang</i></h3>
						<p>&emsp;&emsp;&emsp;&emsp;</p>
						<p class="top" align="left" style="line-height:2">Kek Lok Si, Batu Ferringhi Beach, Escape Theme Park, Penang Butterfly Park,  Penang House of Music, Glass Museum, Penang 3D Trick Art Museum, The Top Komtar and many more places.
						<br/><br/>You will find a plethora of places to visit in Penang, an island that is proud of its culture and is in love with the idea of exhibiting it in every way possible. It doesn’t catch a break from impressing the tourists with the most unusual yet spectacular places like the Clan Jetties and the Floating Mosque.
						<br/><br/>This island has managed to wonderfully capture the heritage, architecture, and religious traditions that existed centuries ago till this modern day. The Penang tourist places are not bound to just that; it is an arena of markets, temples, churches, mosques, national parks, nature, museums, and adventure with something for every member of the family.
						<br/><br/>You will never run out of options to spend your holiday on this seaside land with an alternative for every mood. Here are some places that you should not miss.</p>
					</div>
			</div>
		</div>

		<br/><br/>

		<div class="container">
			<div class="row text-center">
				<div class="col-sm-12 col-lg-6">
				<h3 class="text-center"><i>Kuala Lumpur</i></h3>
						<p>&emsp;&emsp;&emsp;&emsp;</p>
						<p class="top" align="right" style="line-height:2">Petronas Tower, Menara KL Tower, Kuala Lumpur Bird Park, Batu Caves, Sultan Abdul Samad Building, Sunway Lagoon Theme Park, Aquaria KLCC, Jalan Alor, Pavilion KL, Bukit Gambang Water Park and many more amazing attractions.
			<br/><br/>The sultry capital of Malaysia, punctuated by towering skyscrapers, Islamic style domes & minarets, vibrant streets are some of the many tourist places in Kuala Lumpur that are a treat to your eyes. This city is divided into several districts and its main hub is called the Golden Triangle that includes Bukit Bintang, Chinatown and KLCC. 
			<br/><br/>With Malay, Chinese and Indian communities living together harmoniously, Kuala Lumpur is sprawling with ancient culture in the form of mosques and temples. This is balanced by the modern world comprising of places to visit in Kuala Lumpur like Petronas Twin Towers, Suria KLCC, various shopping malls, and buildings with cutting-edge infrastructure. 
			<br/><br/>On the other hand, the city is also blessed with several natural places to see in Kuala Lumpur like the world’s largest covered KL Bird Park or the leafy canopies of banyan trees in different areas. With some of the best food stalls around Kuala Lumpur, you can have a feast of multi-cultural cuisines in areas like the traditional Kopitiam (coffee shops) which serve freshly cooked food for you.</p>
				</div>

				<div class="col-sm-12 col-lg-6">
					<div class="image" align=" center" style="font-size:10.5pt;margin-top:100px;margin-left:5%;margin-right:5%">
							<img class="image_destination" width="350" height="350" src="images/KL.jpg">
					</div>
				</div>
			</div>
		</div>

		<br/><br/>


		<div class="container">
			<div class="row text-center">
					<div class="col-sm-12 col-lg-6">
						<div class="image" align=" center" style="font-size:10.5pt;margin-top:100px;margin-left:5%;margin-right:5%">
								<img class="image_destination" width="350" height="350" src="images/Johor.jpg">
						</div>
					</div>

					<div class="col-sm-12 col-lg-6">

					<h3 class="text-center"><i>Johor</i></h3>
						<p>&emsp;&emsp;&emsp;&emsp;</p>
						<p class="top" align="left" style="line-height:2">There’s no shame in being a tourist in our own country, especially when Malaysia has plenty of land worth exploring. In the town of Johor Bahru itself, there are already an abundance of places and an almost inexhaustible amount of things to do. 
			<br/><br/>If you’ve always thought that all there is to JB is Legoland and bowls of Johor laksa, this list will definitely come in handy for your next weekend getaway. Locals and tourists alike will be able to find something new to add into their itinerary, from a glow-in-the-dark mini-golf course to a hidden bar that also acts as a full-fledged tailor. </p>

					</div>
			</div>
		</div>
	</div>

	<br/><br/><br/>

		<?php include 'Footer.php'; ?>
</body>
</head>
