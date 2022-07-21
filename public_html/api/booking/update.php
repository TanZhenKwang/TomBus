<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/booking.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare booking object
$booking = new BusBooking($db);
  
// get id of booking to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of booking to be edited
$booking->booking_id = $data->booking_id;
  
// set booking property values
$booking->route_id = $data->route_id;
$booking->seat_no = $data->seat_no;
$booking->bus_id = $data->bus_id;
$booking->user_id = $data->user_id;
$booking->booking_time = $data->booking_time;
$booking->pay_amount = $data->pay_amount;
  
// update the booking
if($booking->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "booking was updated."));
}
  
// if unable to update the booking, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update booking."));
}
?>