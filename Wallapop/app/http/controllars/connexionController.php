<?php 
class ConnexionController
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "wallapop";
    private $conn;
    
    /**
     * Constructor to initialize the connection
     */
    public function __construct() {
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
     * Get the connection
     * @return mysqli
     */
    public function getConnection() {
        return $this->conn;
    }
}




?>