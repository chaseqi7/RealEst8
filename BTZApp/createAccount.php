<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-10
 * File name: createAccount.php
 */

include("AccountClass.php");

// Escape all $_POST variables to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$firstname = $mysqli->escape_string($_POST['firstname']);
$lastname = $mysqli->escape_string($_POST['lastname']);
$role = $mysqli->escape_string($_POST['roleSelect']);
$password = $mysqli->escape_string(password_hash('1234',PASSWORD_DEFAULT));

$account = new AccountClass($mysqli);

if ($account->ifUserExist($_POST['email'])) {
    $_SESSION['messageLogin'] = 'User with this email already exists!';
    header("location: account.php");
} else {
    $result = $account->addAccount($email,$password,$firstname,$lastname,$role);
    // Add user to the database
    if ($result) {
        if ($account->ifUserExist($_POST['email'])){
            $user = $account->getUser($_POST['email']);
            $resultAdd = $account->addAccount($user['UserID']);
            if ($resultAdd) {
                $_SESSION['accountMessage'] = "User '$email' was successfully added!";
                header("location: accountManagement.php");
            } else {
                $_SESSION['accountMessage'] = "Something was wrong! Please remove user '
                    $email' and re-add again!";
                header("location: accountManagement.php");
            }
        }
        else{
            $_SESSION['accountMessage'] = "Failed to add user '$email'!". $mysqli->error;
            header("location: accountManagement.php");
        }
    } else {
        $_SESSION['accountMessage'] = "Failed to add user '$email'!". $mysqli->error;
        header("location: accountManagement.php");
    }
}