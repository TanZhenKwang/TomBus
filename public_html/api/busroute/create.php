<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate bus object
include_once '../objects/busroute.php';
  
$database = new Database();
$db = $database->getConnection();
  
$busroute = new Busroute($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hii", true));
                    fwrite($myfile, print_r($data, true));

  
// make sure data is not empty
if(
    !empty($data->departure) &&
    !empty($data->destination) &&
    !empty($data->date) &&
    !empty($data->departure_time) &&
    !empty($data->arrival_time) &&
    !empty($data->fare) &&
    !empty($data->bus_id) 
){
    
    
                    
    // set busroute property values
    $busroute->departure = $data->departure;
    $busroute->destination = $data->destination;
    $busroute->date = $data->date;
    $busroute->departure_time = $data->departure_time;
    $busroute->arrival_time = $data->arrival_time;
    $busroute->fare = $data->fare;
    $busroute->bus_id = $data->bus_id;
    
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi", true));
                    fwrite($myfile, print_r($busroute, true));
  
    // create the busroute
    if($busroute->create()){
        
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi1", true));
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "busroute was created."));
    }
  
    // if unable to create the busroute, tell the user
    else{
  $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi2", true));
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create busroute."));
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
    echo json_encode(array("message" => "Unable to create busroute. Data is incomplete."));
}
?>