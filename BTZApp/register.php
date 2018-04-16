<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: register.php
 */

include("AccountClass.php");

/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */
$passwordCheckBase = $_POST['password'];
$passwordConfirm = $_POST['confirmPassword'];

// Escape all $_POST variables to protect against SQL injections
$firstname = $mysqli->escape_string($_POST['firstname']);
$lastname = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string($_POST['password']);

if($passwordCheckBase === $passwordConfirm) {
    $account = new AccountClass($mysqli);

    if ($account->ifUserExist($_POST['email'])) {
        $_SESSION['messageLogin'] = 'User with this email already exists!';
        header("location: account.php");
    } else {
        $result = $account->addAccount(
            $email,$password,$firstname,$lastname,3);
        // Add user to the database
        if ($result) {
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