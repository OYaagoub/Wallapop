<?php 
class ConnexionController
{
    private $servername = getenv("DB_HOST");
    private $username = getenv("DB_USERNAME");
    private $password = getenv("DB_PASSWORD");
    private $dbname = getenv("DB_NAME");
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
