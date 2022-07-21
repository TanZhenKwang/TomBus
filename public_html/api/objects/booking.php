<?php

class BusBooking{
    // database connection and table name
    private $conn;
    private $table_name = "booking";

    
    // object properties
    public $booking_id;
    public $route_id;
    public $seat_no;
    public $bus_id;
    public $user_id;
    public $booking_time;
    public $pay_amount;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    
    // create booking
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                route_id=:route_id, seat_no=:seat_no, bus_id=:bus_id, user_id=:user_id, booking_time=:booking_time, pay_amount=:pay_amount";

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->route_id=htmlspecialchars(strip_tags($this->route_id));
        $this->seat_no=htmlspecialchars(strip_tags($this->seat_no));
        $this->bus_id=htmlspecialchars(strip_tags($this->bus_id));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->booking_time=htmlspecialchars(strip_tags($this->booking_time));
        $this->pay_amount=htmlspecialchars(strip_tags($this->pay_amount));
        
        // bind values
        $stmt->bindParam(":route_id", $this->route_id);
        $stmt->bindParam(":seat_no", $this->seat_no);
        $stmt->bindParam(":bus_id", $this->bus_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":booking_time", $this->booking_time);
        $stmt->bindParam(":pay_amount", $this->pay_amount);
    
        // execute query
        if($stmt->execute()){
            return $stmt;
        }
        
    }
       

    // delete the booking
    function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE booking_id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->booking_id=htmlspecialchars(strip_tags($this->booking_id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->booking_id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
    return false;
}

//read
function read(){
    
    // select all query
    $query = "SELECT * FROM $this->table_name ORDER BY booking_id asc";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}

// used when filling up the update product form
function readOne(){
    
    // query to read single record
    $query = "SELECT * FROM $this->table_name WHERE booking_id = ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->booking_id);

    // execute query
    $stmt->execute();

    // get retrieved row
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // set values to object properties
        $this->route_id = $row['route_id'];
        $this->seat_no = $row['seat_no'];
        $this->bus_id = $row['bus_id'];
        $this->user_id = $row['user_id'];
        $this->booking_time = $row['booking_time'];
        $this->pay_amount = $row['pay_amount'];
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
                route_id = :route_id,
                seat_no = :seat_no,
                bus_id = :bus_id,
                user_id = :user_id,
                booking_time = :booking_time,
                pay_amount = :pay_amount
            WHERE
                booking_id = :booking_id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->route_id=htmlspecialchars(strip_tags($this->route_id));
    $this->seat_no=htmlspecialchars(strip_tags($this->seat_no));
    $this->bus_id=htmlspecialchars(strip_tags($this->bus_id));
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));
    $this->booking_time=htmlspecialchars(strip_tags($this->booking_time));
    $this->pay_amount=htmlspecialchars(strip_tags($this->pay_amount));
    $this->booking_id=htmlspecialchars(strip_tags($this->booking_id));

    $isIdExist = $this->isIdExist($this->booking_id);

    if ($isIdExist) {
        $stmt->bindParam(":route_id", $this->route_id);
        $stmt->bindParam(":seat_no", $this->seat_no);
        $stmt->bindParam(":bus_id", $this->bus_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":booking_time", $this->booking_time);
        $stmt->bindParam(":pay_amount", $this->pay_amount);
        $stmt->bindParam(':booking_id', $this->booking_id); 

        if ($stmt->execute())
            return true;
        else 
            return false;
    }
    return false;
}

function isIdExist($booking_id) {
    $query = "SELECT booking_id FROM " . $this->table_name . " WHERE booking_id = " . $booking_id;

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