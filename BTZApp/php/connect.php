
<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: connect.php
 */

class DBConnection{
    public $host="localhost"; // Host name.
    public $db_user="root"; // MySQL username.
    public $db_password=""; // MySQL password.
    public $database="BTZDatabase"; // Database name.
    public $conn =null;

    public function _construct(){

    }

    public function connect(){
        // Create connection
        $this->conn = new mysqli($this->host, $this->db_user, $this->db_password, $this->database);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function closeConnection(){
        $this->conn->close();
    }

    public function login(){

    }


    public function displayListing(){
        $sql = "SELECT id, firstname, lastname FROM MyGuests";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    public function displayProfile(){

    }
}

?>