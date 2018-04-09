
<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: db.php
 */

/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '1234';
$db = 'BTZDatabase';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);