<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/bus.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$bus = new Bus($db);
  
// query bus
$stmt = $bus->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // bus array
    $bus_arr=array();
    $bus_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $bus_item=array(
            "bus_name" => $bus_name,
            "bus_logo" => $bus_logo
        );
  
        array_push($bus_arr["records"], $bus_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show bus data in json format
    echo json_encode($bus_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no bus found
    echo json_encode(
        array("message" => "No bus found.")
    );
}
