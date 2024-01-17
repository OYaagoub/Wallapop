<?php 
class ConnexionController
{
    private $servername = "practica26consumyoussama-server.mysql.database.azure.com";
    private $username = "kvpvwogxfq";
    private $password = "60U66HGMFNQ07SR5$";
    private $dbname = "practica26consumyoussama-database";
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
