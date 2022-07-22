
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Bus Plan - FAQ</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<style>
@import url('https://fonts.googleapis.com/css2?family=Baloo+2&display=swap');

body {
    font-family: 'Baloo 2', cursive;
    background-color: #eee;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.accordion-item{
  width:80%;
}

.accordion-button{
    display:block;
}

.logo{
  position:absolute; 
  width:100px; 
  height:200px; 
  align:left; 
  left:20px; 
}

@media(max-width:350px){
    .logo{
      max-width: 30px;
      max-height: 150px;
      left:0px;
      bottom:10px;
    }

    .accordion-item{
    width:100%;
}
}

</style>
</head>

<body>

    <?php include "sidebar.php"; ?>

    <div style="position:absolute; width:100px; height:200px; align:left; top:-40px; left:20px; filter:invert(100%)">
        <a href="index.php"><img src="images/tombuslogo2.png" class="logo" style="filter: grayscale(100%);"></a>
    </div>
    

    <div class="about-section">
        <h1 align="center">Frequently Asked Questions (FAQ)</h1>
    </div>
    <br/><br/><br/>

    <div class="accordion accordion-flush d-flex justify-content-center align-items-center flex-column" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
      Can I just take my Order Summary straight to the bus and borad?
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">It depends on the bus company and pick-up location.
        <br/><br/>Your order summary will clearly state where you need to go for pick-up. Once you arrive at the stated location, if there is a counter there with a unit number corresponding to that on your order summary, you will need to go to that counter to exchange your order summary for a boarding pass or a bus plate & platform number. Show this boarding pass to the bus driver as you board the bus.
        <br/><br/>If your pick-up location does not have a counter, and is, for example, a taxi stand, then you may show your order summary (electronic OR printed paper version) to the bus driver as you board the bus.</div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Do I need to print out my order summart?
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">You may either print out your order summary or have it ready to view on your phone/tablet. Either a paper version or an electronic version of your entire order summary is acceptable, as long as the bus counter staff/bus driver can view it clearly.
        <br/><br/>*If you are planning to show you order summary electronically, make sure that the entire order summary (3 -4 pages) are able to be viewed on your device.</div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      Can I change my coach ticket date and time?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Tickets once sold are confirmed NOT changeable in any circumstance. You may still email to us at tombus@book.com to request to change the departure date and time of your coach e-tickets / order summary. You can only change your e-tickets to those tickets that belonged to the same coach company of your original tickets. However, by no means, the change request will be successful each time, this is always subjected to the coach side's decision</div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFour">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
      Can I get a refund for cancellations
      </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">No cancellation or refund is allowed.</div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFive">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
      Can I check availability and fares without actually purchasing a ticket?
      </button>
    </h2>
    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Yes. You do not need to pay or provide your credit card details to check availability and fares. We only require your payment details if you choose to complete a booking.</div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingSix">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
      Can I give the ticket to my friend?
      </button>
    </h2>
    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Yes, you can do so. But you need to change the passenger's details to the one who is boarding the coach. You may log in to membership => View Booking History =>choose the departure date => click Edit to change the passenger's details.</div>
    </div>
  </div>
</div>
    
<br/><br/><br/>
<?php include 'Footer.php'; ?>
</body>
</html>



