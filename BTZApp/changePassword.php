<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-08
 * File name: changePassword.php
 */

$email = $mysqli->escape_string($_POST['email']);
$currentPassword = $mysqli->escape_string($_POST['currentPassword']);
$newPassword = $mysqli->escape_string($_POST['newPassword']);
$confirmPassword = $mysqli->escape_string($_POST['confirmPassword']);
$hashedPassword = $mysqli->escape_string(password_hash($newPassword,PASSWORD_DEFAULT));

$result = $mysqli->query("SELECT * FROM UserT WHERE Email='$email'");

if ( $result->num_rows > 0 ){
    while ($row = $result->fetch_assoc()) {
        if (password_verify($currentPassword, $row["Password"])) {
            if ($newPassword == $confirmPassword) {
                $sql = "UPDATE userT SET Password='$hashedPassword' WHERE Email='$email'";

                if ($mysqli->query($sql)) {
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
}
else{
    $_SESSION['changePasswordMessage'] = 'There is something wrong,please try again!';
    header("location: changePasswordPage.php");
}

