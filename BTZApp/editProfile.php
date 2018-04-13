<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-08
 * File name: editProfile.php
 */

// Escape all $_POST variables to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$firstname = $mysqli->escape_string($_POST['firstname']);
$lastname = $mysqli->escape_string($_POST['lastname']);
$address = $mysqli->escape_string($_POST['address']);
$city = $mysqli->escape_string($_POST['city']);
$province = $mysqli->escape_string($_POST['province']);
$postalcode = $mysqli->escape_string($_POST['postalcode']);
$phone = $mysqli->escape_string($_POST['phone']);

// Check if user with that email already exists
$sql = "UPDATE userT SET FirstName='$firstname', LastName='$lastname', Address='$address',
        City='$city', Province='$province', PostalCode='$postalcode',
        PhoneNumber='$phone' WHERE email='$email'";

if ($mysqli->query($sql)) {
    $_SESSION['profileMessage'] = 'User was successfully edited!';
    header("location: profile.php");
} else { // Email doesn't already exist in a database, proceed...
    $_SESSION['editProfileMessage'] = 'There is something wrong,please try again!';
    header("location: editProfilePage.php");
}