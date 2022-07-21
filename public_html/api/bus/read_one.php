<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/bus.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare bus object
$bus = new Bus($db);
  
// set ID property of record to read
$bus->bus_id = isset($_GET['bus_id']) ? $_GET['bus_id'] : die();
  
// read the details of bus to be edited
$bus->readOne();
  
if($bus->bus_logo!=null){
    // create array
    $bus_arr = array(
        "bus_name" =>  $bus->bus_name,
        "bus_logo" => $bus->bus_logo,
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($bus_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user bus does not exist
    echo json_encode(array("message" => "bus does not exist."));
}
?>