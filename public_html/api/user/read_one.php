<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare booking object
$user = new User($db);
  
// set ID property of record to read
$user->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
  
// read the details of booking to be edited
$user->readOne();
  
if($user->first_name!=null){
    // create array
    $user_arr = array(
        "first_name" =>  $user->first_name,
        "last_name" => $user->last_name,
        "phone_no" => $user->phone_no,
        "email" => $user->email,
        "password" => $user->password
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($user_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user $user does not exist
    echo json_encode(array("error"=>"1","message" => "$user does not exist."));
}
?>