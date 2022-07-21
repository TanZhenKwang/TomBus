<?php

class Busroute{
    // database connection and table name
    private $conn;
    private $table_name = "busroute";

    
    // object properties
    public $route_id;
    public $departure;
    public $destination;
    public $date;
    public $departure_time;
    public $arrival_time;
    public $fare;
    public $bus_id;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    
    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                departure=:departure, destination=:destination, date=:date, departure_time=:departure_time, arrival_time=:arrival_time, fare=:fare, bus_id=:bus_id";

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->departure=htmlspecialchars(strip_tags($this->departure));
        $this->destination=htmlspecialchars(strip_tags($this->destination));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->departure_time=htmlspecialchars(strip_tags($this->departure_time));
        $this->arrival_time=htmlspecialchars(strip_tags($this->arrival_time));
        $this->fare=htmlspecialchars(strip_tags($this->fare));
        $this->bus_id=htmlspecialchars(strip_tags($this->bus_id));
        
        // bind values
        $stmt->bindParam(":departure", $this->departure);
        $stmt->bindParam(":destination", $this->destination);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":departure_time", $this->departure_time);
        $stmt->bindParam(":arrival_time", $this->arrival_time);
        $stmt->bindParam(":fare", $this->fare);
        $stmt->bindParam(":bus_id", $this->bus_id);
        
        // execute query
        if($stmt->execute()){
            return $stmt;
        }
        
    }
       

    // delete the product
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE route_id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->route_id=htmlspecialchars(strip_tags($this->route_id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->route_id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
    return false;
}

// read bus
function read(){
    
    // select all query
    $query = "SELECT * FROM $this->table_name ORDER BY route_id asc";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}

// used when filling up the update product form
function readOne(){
    
    // query to read single record
    $query = "SELECT * FROM $this->table_name WHERE route_id = ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->route_id);

    // execute query
    $stmt->execute();

    // get retrieved row
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // set values to object properties
        $this->departure = $row['departure'];
        $this->destination = $row['destination'];
        $this->date = $row['date'];
        $this->departure_time = $row['departure_time'];
        $this->arrival_time = $row['arrival_time'];
        $this->fare = $row['fare'];
        return true;
    }
    else {
        return false;
    }
    
}
// update the product
function update(){

    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                departure = :departure,
                destination = :destination,
                date = :date,
                departure_time = :departure_time,
                arrival_time = :arrival_time,
                fare = :fare
            WHERE
            route_id = :route_id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->departure=htmlspecialchars(strip_tags($this->departure));
    $this->destination=htmlspecialchars(strip_tags($this->destination));
    $this->date=htmlspecialchars(strip_tags($this->date));
    $this->departure_time=htmlspecialchars(strip_tags($this->departure_time));
    $this->arrival_time=htmlspecialchars(strip_tags($this->arrival_time));
    $this->fare=htmlspecialchars(strip_tags($this->fare));
    $this->route_id=htmlspecialchars(strip_tags($this->route_id));

    $isIdExist = $this->isIdExist($this->route_id);

    if ($isIdExist) {
        $stmt->bindParam(':departure', $this->departure);
        $stmt->bindParam(':destination', $this->destination);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':departure_time', $this->departure_time);
        $stmt->bindParam(':arrival_time', $this->arrival_time);
        $stmt->bindParam(':fare', $this->fare);
        $stmt->bindParam(':route_id', $this->route_id); 

        if ($stmt->execute())
            return true;
        else 
            return false;
    }
    return false;
}

function isIdExist($route_id) {
    $query = "SELECT route_id FROM " . $this->table_name . " WHERE route_id = " . $route_id;

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // execute query
    $stmt->execute();

    // get retrieved row
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        return true;
    }

    return false;
}

}

?>