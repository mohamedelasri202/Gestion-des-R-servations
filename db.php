<?php

class Database {
    private $host = '192.168.9.81';  // Use the IP address of your MySQL server
    private $db_name = 'voyage_agency';  // Your database name
    private $username = 'ICHRAK';  // The MySQL username created for your friend
    private $password = 'ICHRAK123';  // The corresponding password for your friend
    public $conn;  // This will store the connection

    public function connect() {

        // Try to establish a connection using the provided details
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Check if the connection failed
        if ($this->conn->connect_error) {
            echo "Connection failed: " . $this->conn->connect_error;
            return null;
        }

        // If connection is successful, this message will be displayed
        echo "Connected successfully";
        return $this->conn;
    }
}

?>