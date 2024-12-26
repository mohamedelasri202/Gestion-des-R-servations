<?php

class Database {
    private $host = 'localhost'; 
    private $db_name = 'voyage_agency'; 
    private $username = 'root'; 
    private $password = ''; 
    public $conn; 

    
    public function connect() {
    
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

      
        if ($this->conn->connect_error) {
            echo "ohhoh la" . $this->conn->connect_error;
            return null;
        }

        echo "wakhlini sakta";
        return $this->conn;
    }
}

?>
