<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: login.php
 */

include("AccountClass.php");

$email = $mysqli->escape_string($_POST['email']);
$account = new AccountClass($mysqli);
$user = $account->login($email,$_POST['password']);
if ($user != null){
    if ( password_verify($_POST['password'], $user['Password'])) {
        $_SESSION['email'] = $user['Email'];
        $_SESSION['firstname'] = $user['FirstName'];
        $_SESSION['lastname'] = $user['LastName'];
        $_SESSION['role'] = $user['Description'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: index.php");
    }
    else{
        $_SESSION['messageLogin'] = "You have entered wrong password, try again!";
        header("location: account.php");
    }
}
else{
    $_SESSION['messageLogin'] = "User with that email doesn't exist!";
    header("location: account.php");
}