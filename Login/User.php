<?php
include_once('DbConnection.php');
 
class User extends DbConnection{

    public function __construct(){

        parent::__construct();
    }
    
    public function check_login($username, $password){

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $query = $this->connection->query($sql);

        if($query->num_rows > 0){
            $row = $query->fetch_array();
            return $row['id'];
        }
        else{
            return false;
        }
    }
        
    public function details($sql){

        $query = $this->connection->query($sql);
        
        $row = $query->fetch_array();
            
        return $row;       
    }
    
    public function escape_string($value){
        
        return $this->connection->real_escape_string($value);
    }

    private $conn;
    private $users = "users";

     // object properties
    public $id;
    public $username;
    public $password;
    

      // constructor
    public function __construct($db){
        $this->conn = $db;
        // create new user record
function create(){
 $query = "INSERT INTO
                " . $this->users . "
            SET
                username = :username,
                password = :password,
                email = :email";

                   // prepare the query
    $stmt = $this->conn->prepare($query);

     // sanitize
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->password=htmlspecialchars(strip_tags($this->password));
    

    // bind the values
    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':password', $this->password);
    

    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }else{
        $this->showError($stmt);
        return false;
    }
}
}
}
    ?>