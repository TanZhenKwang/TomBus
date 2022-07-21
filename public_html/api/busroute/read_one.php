<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/busroute.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare booking object
$busroute = new Busroute($db);
  
// set ID property of record to read
$busroute->route_id = isset($_GET['route_id']) ? $_GET['route_id'] : die();
  
// read the details of booking to be edited
$busroute->readOne();
  
if($busroute->departure!=null){
    // create array
    $busroute_arr = array(
        "departure" =>  $busroute->departure,
        "destination" => $busroute->destination,
        "date" => $busroute->date,
        "departure_time" => $busroute->departure_time,
        "arrival_time" => $busroute->arrival_time,
        "fare" => $busroute->fare,
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($busroute_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user $busroute does not exist
    echo json_encode(array("message" => "$busroute does not exist."));
}
?>