<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Bus - Account</title>

    <link rel="icon" href="images/titleicon.png">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">

    <style>
    body {
        margin: 0 50px;
    }
    @media print {
    body * {
        visibility: hidden;
    }
    .receipt, .receipt * {
        visibility: visible;
    }
    .receipt {
        position: absolute;
        left: 0;
        top: 0;
    }
    }
    </style>
</head>

<body>
<?php
function getUser ($user_id){
    $curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'localhost/Bus_Plan/api/user/read_one.php?user_id=' . $user_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = json_decode (curl_exec($curl));

curl_close($curl);
$response;

return $response;

}


function getBusroute ($route_id){
    $curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'localhost/Bus_Plan/api/busroute/read_one.php?route_id=' . $route_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$responseroute = json_decode (curl_exec($curl));

curl_close($curl);
$responseroute;

return $responseroute;
}


function getBus ($bus_id){
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'localhost/Bus_Plan/api/bus/read_one.php?bus_id=' .$bus_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));

$responsebus = json_decode (curl_exec($curl));

curl_close($curl);
$responsebus;

return $responsebus;
}

session_start();

if(isset($_SESSION['user_id'])){
    $user = getUser($_SESSION['user_id']);
    $busroute = getBusroute($_SESSION['route_id']);
    $bus = getBus($_SESSION['bus_id']);
    
}
?>
<?php

    $route_id = $_SESSION['route_id'];
    $user_id =  $_SESSION['user_id'];
    $seat_no = $_SESSION['seat_no'];
    $pay_amount = $_SESSION['pay_amount'];
    $bus_id = $_SESSION['bus_id'];
    date_default_timezone_set('Asia/Singapore');
    $date = date('y-m-d H:i:s');
    $bus_name = $_SESSION['bus_name'];

    //connect database
	$dbc = mysqli_connect('localhost', 'root', '');

	if (!$dbc) {
		die("Error: " . mysqli_connect_error($dbc));
	}

	mysqli_select_db($dbc, 'busplan');
                                    
    $query = "INSERT INTO booking (booking_id, route_id, seat_no, bus_id, user_id, booking_time, pay_amount) 
            VALUES (0, '$route_id', '$seat_no', '$bus_id', '$user_id', '$date', '$pay_amount')";
                                   
            
    //run the query     
                              				
   if (mysqli_query($dbc, $query)) {

        echo '<p>Your payment is successful.</p>
               <hr>
               <div class="receipt">
                <h1>Receipt</h1>';

       $query = "SELECT * FROM user WHERE user_id = '$user_id'";
       
       if ($r = mysqli_query($dbc, $query)) {
           while ($row = mysqli_fetch_array($r)) {
               echo "
                    <p>Name: {$user->first_name} {$user->last_name}</p>
                        <p>Phone Number: {$user->phone_no}</p>
                        <p>E-mail: {$user->email}</p>
                    <br/>
               ";
           }
       }
       else {
           echo "Could not show the receipt because: <br/>" . mysqli_error($dbc) . "The query was: " . $query;
       }

       $query = "SELECT * FROM booking INNER JOIN busroute ON booking.route_id = busroute.route_id
                where booking.user_id = $user_id ORDER BY booking_id DESC LIMIT 1";

        if ($r = mysqli_query($dbc, $query)) {
           while ($row = mysqli_fetch_array($r)) { 
               echo "
                    <p>Route ID: {$row['route_id']}</p>
                    <p>Departure: {$row['departure']}</p>
                    <p>Destination: {$row['destination']}</p>
                    <p>Date: {$row['date']}</p>
                    <p>Departure Time: {$row['departure_time']}</p>
                    <p>Arrival Time: {$row['arrival_time']}</p>
                    <p>Seat No: {$row['seat_no']}</p>
                    <br/>
                    <p>Bus ID: $bus_id</p>
                    <p>Bus Name: $bus_name</p>
                    <br/>
                    <p>Booking ID: {$row['booking_id']}</p>
                    <p>Booking Time: {$row['booking_time']}</p>
                    <p>Total Fare: RM {$row['pay_amount']}</p>
                </div>
                ";

           }
        }
        else {
           echo "Could not show the receipt because: <br/>" . mysqli_error($dbc) . "The query was: " . $query;
       }

        
        echo '
            <hr>
            <div style="width:500px;height:40px;display:flex;justify-content:space-around;align-items:center">
                <button class="btn" onclick="window.print()">Print Receipt</button>
                <a href="bookinghistory.php"><button class="btn">View Booking History</button></a>
                <a href="index.php"><button class="btn">Back to Home</button></a>
            </div>
            <br/>
        ';
    }
    else {
        echo "Could not add the entry because: <br/>" . mysqli_error($dbc) . "The query was: " . $query;
    }
                        
                                
?>
</body>

</html>
