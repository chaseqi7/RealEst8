<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-08
 * File name: changePassword.php
 */
include("AccountClass.php");

$email = $mysqli->escape_string($_POST['email']);
$currentPassword = $mysqli->escape_string($_POST['currentPassword']);
$newPassword = $mysqli->escape_string($_POST['newPassword']);
$confirmPassword = $mysqli->escape_string($_POST['confirmPassword']);

$account = new AccountClass($mysqli);
$user = $account->getUser($email);

if ($user !=null){
    if (password_verify($currentPassword, $user["Password"])) {
        if ($newPassword == $confirmPassword) {
            $result = $account->changePassword($newPassword,$email);
            if ($result) {
                $_SESSION['profileMessage'] = 'Password has been updated!';
                header("location: profile.php");
            } else { // Email doesn't already exist in a database, proceed...
                $_SESSION['changePasswordMessage'] = 'There is something wrong,please try again!';
                header("location: changePasswordPage.php");
            }
        } else {
            $_SESSION['changePasswordMessage'] = 'New Password doesn\'t match!';
            header("location: changePasswordPage.php");
        }
    }
    else{
        $_SESSION['changePasswordMessage'] = 'Current password not correct!';
        header("location: changePasswordPage.php");
    }
}
else{
    $_SESSION['changePasswordMessage'] = 'There is something wrong,please try again!';
    header("location: changePasswordPage.php");
}


