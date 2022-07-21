<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/busroute.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$busroute = new Busroute($db);
  
// query busroute
$stmt = $busroute->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // busroute array
    $busroute_arr=array();
    $busroute_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $busroute_item=array(
            "departure" =>  $departure,
            "destination" => $destination,
            "date" => $date,
            "departure_time" => $departure_time,
            "arrival_time" => $arrival_time,
            "fare" => $fare,
            "bus_id" => $bus_id
        );
  
        array_push($busroute_arr["records"], $busroute_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show busroute data in json format
    echo json_encode($busroute_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no busroute found
    echo json_encode(
        array("message" => "No busroute found.")
    );
}