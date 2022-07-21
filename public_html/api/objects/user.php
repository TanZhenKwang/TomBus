<?php

class User{
    // database connection and table name
    private $conn;
    private $table_name = "user";

    
    // object properties
    public $first_name;
    public $last_name;
    public $phone_no;
    public $email;
    public $password;
  
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
                first_name=:first_name, last_name=:last_name, phone_no=:phone_no, email=:email, password=:password";

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->first_name=htmlspecialchars(strip_tags($this->first_name));
        $this->last_name=htmlspecialchars(strip_tags($this->last_name));
        $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        
        // bind values
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":phone_no", $this->phone_no);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        
        // execute query
        if($stmt->execute()){
            return $stmt;
        }
        
    }
       

    // delete the product
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE user_id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->user_id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
    return false;
}

// read bus
function read(){
    
    // select all query
    $query = "SELECT * FROM $this->table_name ORDER BY user_id asc";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}

// used when filling up the update product form
function readOne(){
    
    // query to read single record
    $query = "SELECT * FROM $this->table_name WHERE user_id =?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->user_id);

    // execute query
    $stmt->execute();

    // get retrieved row
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // set values to object properties
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->phone_no  = $row['phone_no'];
        $this->email = $row['email'];
        $this->password = $row['password'];
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
                first_name = :first_name,
                last_name = :last_name,
                phone_no = :phone_no,
                email = :email,
                password = :password
            WHERE
            user_id = :user_id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));

    $isIdExist = $this->isIdExist($this->user_id);

    if ($isIdExist) {
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':phone_no', $this->phone_no);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':user_id', $this->user_id); 

        if ($stmt->execute())
            return true;
        else 
            return false;
    }
    return false;
}

function isIdExist($user_id) {
    $query = "SELECT user_id FROM " . $this->table_name . " WHERE user_id = " . $user_id;

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