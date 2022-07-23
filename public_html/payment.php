<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Bus Plan - View Seat</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    
    <style>
        body {
            margin: 50px;
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
if (isset($_GET['seat'])) {

    $seats = $_GET['seat'];

    $total_seat_selected = implode(', ', $seats);

    $count = count($seats);

    //connect database
	$dbc = mysqli_connect('localhost', 'root', '');

	if (!$dbc) {
		die("Error: " . mysqli_connect_error($dbc));
	}

	mysqli_select_db($dbc, 'busplan');

	if (isset($_SESSION['user_info'])) {

		//run the query
		if ($r = mysqli_query($dbc, $_SESSION['user_info'])) { 

			//retrieve the record
			$row = mysqli_fetch_array($r);

            $user_id = $row['user_id'];

            echo "
                <div class=\"payment-cont\">
                    <div class=\"payment-content\">
                        <h1>Payment Form</h1>

                        <hr>

                        <h2>Customer Information</h2>
                       
                        <p>Name: {$user->first_name} {$user->last_name}</p>
                        <p>Phone Number: {$user->phone_no}</p>
                        <p>E-mail: {$user->email}</p>

                        <hr>

                        <h2>Booking Information</h2>";

                        $route_id = $_SESSION['route_id'];
                        $query = "SELECT * FROM busroute r, bus b WHERE route_id = '$route_id' AND r.bus_id = b.bus_id";
                        
                        //run the query
                        if ($r = mysqli_query($dbc, $query)) { 

                            //retrieve and print every record
                            while ($row = mysqli_fetch_array($r)) {

                                if(isset($_POST['booking'])){

                                    $postfields = array(
                                        "route_id" => $_POST['route_id'],
                                        "seat_no" => $_POST['seat_no'],
                                        "bus_id" => $_POST['bus_id'],
                                        "user_id" => $_POST['user_id'],
                                        "booking_time" => $_POST['booking_time'],
                                        "pay_amount" => $_POST['pay_amount'],
                                    );
                                
                                    $postfields = json_encode($postfields);
                                    $curl = curl_init();
                                
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'http://localhost/Bus_Plan/api/booking/create.php',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => '',
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 0,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMEREQUEST => 'POST',
                                        CURLOPT_POSTFIELDS => $postfields,
                                        CURLOPT_HTTPPHEADER => array(
                                            'Content-Type: text/plain'
                                
                                    ),
                                ));
                                
                                $response = curl_exec($curl);
                                
                                curl_close($curl);
                                echo $response;
                                
                                }

                                $total_fare = ($row['fare']) * $count;

                                echo "<p>Departure: {$busroute->departure}</p>
                                <p>Destination: {$busroute->destination}</p>
                                <p>Date: {$busroute->date}</p>
                                <p>Departure Time: {$busroute->departure_time}</p>
                                <p>Arrival Time: {$busroute->arrival_time}</p>
                                <p>Total Fare: RM $total_fare</p>
                                <p>Seat No: "; print_r ($total_seat_selected); echo "</p>
                                <p>Bus Name: {$bus->bus_name}</p>

                                    <hr>

                                    <h2>Payment Information</h2>

                                    <form action=\"checkout.php\" action=\"post\">
                                    	Bank: <select name=\"bank\">
                                            <option value=\"maybank\">May Bank</option>
                                            <option value=\"publicbank\">Public Bank</option>
                                            <option value=\"hongleongbank\">Hong Leong Bank</option>
                                            <option value=\"cimbbank\">CIMB Bank</option>
                                        </select>
                                        
                                        <br/><br/>
                                        
                                        <button class=\"btn\" type=\"submit\">Confirm Payment</button>
                                        <input type=\"hidden\" name=\"confirmPayment\" value=\"true\">
                                    </form>
                                ";
                            $_SESSION['seat_no'] = $total_seat_selected;
                            $_SESSION['pay_amount'] = $total_fare;
                            $_SESSION['bus_id'] = $row['bus_id'];
                            $_SESSION['user_id'] = $user_id;
                            $_SESSION['bus_name'] = $row['bus_name'];
                            }
                        }
                        else {
                            echo "Could not add the entry because: <br/>" . mysqli_error($dbc) . "The query was: " . $query;
                        }

                        
                    echo "</div>
                </div>";
		}

        //query didn't run
        else { 
			echo '<p style="color:red;">Could not retrieve the data because: <br/>' . mysqli_error($dbc) . '</p><p>The query being run was: ' . $query . '</p>';
		}
    }

    else {
    
        echo "Please login before proceed to payment.<br/><br/>";
        echo "<a href=\"userlogin.php\" target=\"_blank\"><button class=\"btn\" type=\"submit\">Login</button></a>";
    }
    mysqli_close($dbc);
}

else {
    echo "Please choose your seat before proceed to payment.<br/><br/>";
    echo '<button class="btn" onclick="history.go(-1)">Back</button>';
}
?>

</body>

</html>

