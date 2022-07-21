<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/booking.php';
  
$database = new Database();
$db = $database->getConnection();
  
$booking = new BusBooking($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hii", true));
                    fwrite($myfile, print_r($data, true));

  
// make sure data is not empty
if(
    !empty($data->route_id) &&
    !empty($data->seat_no) &&
    !empty($data->bus_id) &&
    !empty($data->user_id) &&
    !empty($data->booking_time) &&
    !empty($data->pay_amount)
){
    
    
                    
    // set product property values
    $booking->route_id = $data->route_id;
    $booking->seat_no = $data->seat_no;
    $booking->bus_id = $data->bus_id;
    $booking->user_id = $data->user_id;
    $booking->booking_time = $data->booking_time;
    $booking->pay_amount = $data->pay_amount;
    
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi", true));
                    fwrite($myfile, print_r($booking, true));
  
    // create the product
    if($booking->create()){
        
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi1", true));
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Booking was created."));
    }
  
    // if unable to create the booking, tell the user
    else{
  $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi2", true));
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create Booking."));
    }
    
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi3", true));
}
  
// tell the user data is incomplete
else{
//   $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//                     fwrite($myfile, print_r("hi1", true));
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create booking. Data is incomplete."));
}
?>