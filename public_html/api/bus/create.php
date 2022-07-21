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
include_once '../objects/bus.php';
  
$database = new Database();
$db = $database->getConnection();
  
$bus = new Bus($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hii", true));
                    fwrite($myfile, print_r($data, true));

  
// make sure data is not empty
if(
    !empty($data->bus_name) &&
    !empty($data->bus_logo) 
){
    
    
                    
    // set bus property values
    $bus->bus_name = $data->bus_name;
    $bus->bus_logo = $data->bus_logo;
    
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi", true));
                    fwrite($myfile, print_r($bus, true));
  
    // create the bus
    if($bus->create()){
        
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi1", true));
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "bus was created."));
    }
  
    // if unable to create the bus, tell the user
    else{
  $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, print_r("hi2", true));
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create bus."));
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
    echo json_encode(array("message" => "Unable to create bus. Data is incomplete."));
}
?>