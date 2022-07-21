<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/busroute.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare busroute object
$busroute = new Busroute($db);
  
// get id of busroute to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of busroute to be edited
$busroute->route_id = $data->route_id;
  
// set busroute property values
$busroute->departure = $data->departure;
$busroute->destination = $data->destination;
$busroute->date = $data->date;
$busroute->departure_time = $data->departure_time;
$busroute->arrival_time = $data->arrival_time;
$busroute->fare = $data->fare;
$busroute->bus_id = $data->bus_id;
  
// update the busroute
if($busroute->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "busroute was updated."));
}
  
// if unable to update the busroute, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update busroute."));
}
?>