<?php
class Database {
    private $host = "localhost:3307";
    private $user = "root";
    private $pass = "";
    private $conn;
    
    public function connect($dbname) {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $dbname);

        if ($this->conn->connect_error) {
            die("Connection to $dbname failed: " . $this->conn->connect_error);
        }
        return $this->conn; 
    }
    
}
?>
