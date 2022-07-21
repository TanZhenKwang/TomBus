<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/booking.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare booking object
$booking = new BusBooking($db);
  
// set ID property of record to read
$booking->booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : die();
  
// read the details of booking to be edited
$booking->readOne();
  
if($booking->route_id!=null){
    // create array
    $booking_arr = array(
        "route_id" =>  $booking->route_id,
        "seat_no" => $booking->seat_no,
        "bus_id" => $booking->bus_id,
        "user_id" => $booking->user_id,
        "booking_time" => $booking->booking_time,
        "pay_amount" => $booking->pay_amount
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($booking_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user booking does not exist
    echo json_encode(array("message" => "booking does not exist."));
}
?>