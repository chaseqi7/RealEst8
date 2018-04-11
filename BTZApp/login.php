<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: login.php
 */

/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM UserT WHERE Email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['Password'])) {
        $roleId = $user['Role'];
        $getRole = $mysqli->query("SELECT * FROM Role WHERE RoleID='$roleId'");
        $role = $getRole->fetch_assoc();
        $_SESSION['email'] = $user['Email'];
        $_SESSION['first_name'] = $user['FirstName'];
        $_SESSION['last_name'] = $user['LastName'];
        $_SESSION['role'] = $role['Description'];
        $_SESSION['active'] = $user['Active'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: index.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}