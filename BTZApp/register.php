<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: register.php
 */

/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */
$passwordCheckBase = $_POST['password'];
$passwordConfirm = $_POST['confirmPassword'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$phone = $mysqli->escape_string($_POST['phone']);
$password = $mysqli->escape_string(password_hash($_POST['password'],PASSWORD_DEFAULT));

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM UserT WHERE Email='$email'") or die($mysqli->error());

if($passwordCheckBase === $passwordConfirm) {
    // We know user email exists if the rows returned are more than 0
    if ($result->num_rows > 0) {
        $_SESSION['messageLogin'] = 'User with this email already exists!';
        header("location: account.php");
    } else { // Email doesn't already exist in a database, proceed...
        // active is 0 by DEFAULT (no need to include it here)
        $sql = "INSERT INTO UserT (Email,Password,FirstName,LastName,Role,PhoneNumber) 
            VALUES ('$email','$password','$first_name','$last_name',3,'$phone')";

        // Add user to the database
        if ($mysqli->query($sql)) {
            $_SESSION['logged_in'] = true; // So we know the user has logged in
            $_SESSION['messageLogin'] =
                "You have successfully registered, please log in!";
            header("location: account.php");
        } else {
            $_SESSION['messageLogin'] = 'Registration failed!';
            header("location: account.php");
        }
    }
}
else {
    $_SESSION['messageLogin'] = 'Passwords did not match';
    header("location: account.php");
}