<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/bus.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare bus object
$bus = new Bus($db);
  
// get id of bus to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of bus to be edited
$bus->bus_id = $data->bus_id;
  
// set bus property values
$bus->bus_name = $data->bus_name;
$bus->bus_logo = $data->bus_logo;
  
// update the bus
if($bus->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "bus was updated."));
}
  
// if unable to update the bus, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update bus."));
}
?>