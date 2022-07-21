<?php

class Bus{
    // database connection and table name
    private $conn;
    private $table_name = "bus";

    
    // object properties
    public $bus_id;
    public $bus_name;
    public $bus_logo;
  
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
                bus_name=:bus_name, bus_logo=:bus_logo";

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->bus_name=htmlspecialchars(strip_tags($this->bus_name));
        $this->bus_logo=htmlspecialchars(strip_tags($this->bus_logo));
        
        // bind values
        $stmt->bindParam(":bus_name", $this->bus_name);
        $stmt->bindParam(":bus_logo", $this->bus_logo);
    
        // execute query
        if($stmt->execute()){
            return $stmt;
        }
        
    }
       

    // delete the product
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE bus_id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->bus_id=htmlspecialchars(strip_tags($this->bus_id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->bus_id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
    return false;
}

// read bus
function read(){
    
    // select all query
    $query = "SELECT * FROM $this->table_name ORDER BY bus_id asc";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}

// used when filling up the update product form
function readOne(){
    
    // query to read single record
    $query = "SELECT * FROM $this->table_name WHERE bus_id =?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->bus_id);

    // execute query
    $stmt->execute();

    // get retrieved row
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // set values to object properties
        $this->bus_name = $row['bus_name'];
        $this->bus_logo = $row['bus_logo'];
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
                bus_name = :bus_name,
                bus_logo = :bus_logo
            WHERE
                bus_id = :bus_id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->bus_name=htmlspecialchars(strip_tags($this->bus_name));
    $this->bus_logo=htmlspecialchars(strip_tags($this->bus_logo));
    $this->bus_id=htmlspecialchars(strip_tags($this->bus_id));

    $isIdExist = $this->isIdExist($this->bus_id);

    if ($isIdExist) {
        $stmt->bindParam(':bus_name', $this->bus_name);
        $stmt->bindParam(':bus_logo', $this->bus_logo);
        $stmt->bindParam(':bus_id', $this->bus_id); 

        if ($stmt->execute())
            return true;
        else 
            return false;
    }
    return false;
}

function isIdExist($bus_id) {
    $query = "SELECT bus_id FROM " . $this->table_name . " WHERE bus_id = " . $bus_id;

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