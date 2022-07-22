
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Bus Plan - About Us</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Allura|Josefin+Sans');
    <script src="https://kit.fontawesome.com/0d581c024a.js" crossorigin="anonymous"></script>
 
 * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background: #d8d8d8;

}
.desc {
  margin: 0px 10px;
  line-height: 20pt;
}

.logo{
  position:absolute; 
  width:100px; 
  height:200px; 
  align:left; 
  top:-40px; 
  left:20px; 
  filter:invert(100%);
}

@media(max-width:350px){
    .logo{
      max-width: 30px;
      max-height: 200px
    }
}


  </style>

</head>

<body>
    <?php include "sidebar.php"; ?>

    <div class="col-sm-12 col-lg-12">
        <a href="index.php"><img src="images/tombuslogo2.png" class="logo" style="filter: grayscale(100%);"></a>
    </div>

    <div class="about-section">
      <div class="col-sm-12 col-lg-12">
      <h1><i class="fas fa-info">&nbsp;&nbsp;&nbsp;About Us</i></h1>
      <p>Get to know the history of out Bus agency.</p>
      </div>
    </div>

    <br><br>

    <div class="col-sm-12 col-lg-12">
    <h1 align="center">History Of Tom Bus</h1>
    <br><br>
    <p class="desc">Tom Bus was founded in 2022 by Tom engineers from the INTI University, 
        who also worked together at various organisations before founding the company. With an initial investment of $500,000 
        (equivalent to US$18,000 in 2021), the founders began operations in 2020, 
        by tying up with various travel agents for seat reservations through the Tom Bus portal. 
        In the same year the company was selected for the TiE Entrepreneurship Acceleration Program and was mentored on several aspects of the business.
        The company owns BOGDS, a cloud computing service for bus operators, and SeatSeller, a GDS for bus inventory distribution.</p>
    
    <br><br>
    <hr/>
    </div>
    <br><br>

    <h1 align="center">Our Bus agency</h1>
    <br><br>

	<p class="desc">Travel agency is a trusted one-stop online ticket booking portal for you to easily book your 
	bus tickets with the best prices in Malaysia. Whether you want to go back to 
	your hometown or planning for a vacation, we are here to make your journey hassle-free.</p>
    <br>
    <hr/>

<div class="wrapper">
  <h1>Our Team</h1>
  <div class="team">
    <div class="team_member">
      <div class="team_img">
        <img src="images/team1.png" alt="Team_image">
      </div>
      
      
      <h3>Tom</h3>
      <p class="role">CEO</p>
      <p>Lead the member when coding facing prblem.</p>
    </div>
  </div>
</div>

</body>
<?php include 'Footer.php'; ?>
</html>
