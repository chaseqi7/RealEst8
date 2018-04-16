
<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: db.php
 */

class DB{
    /* Database connection settings */
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '1234';
    private $db = 'BTZDatabase';
    private $mysqli;

    function __construct()
    {
        $this->mysqli=new mysqli($this->host,$this->user,$this->pass,$this->db) or die($this->mysqli->error);
    }

    function getConnection(){
        return $this->mysqli;
    }
}