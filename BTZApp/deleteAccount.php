<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: deleteAccount.php
 */

require 'db.php';
session_start();

// Make
if(isset($_POST['id']) && !empty($_POST['id']))
{
    $id = $mysqli->escape_string($_POST['id']);

    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $mysqli->query("DELETE FROM UserT WHERE UserID='$id'") or die($mysqli->error);

    if ($result)
    {
        $message = "Account has been deleted successfully!";
        echo "<script type='text/javascript'>alert('$message');</script>";

        header("location: accountManagement.php");
    }
    else {
        $_SESSION['message'] = "Something was wrong, failed to delete account!";
        header("location: error.php");
    }
}
else {
    $_SESSION['message'] = "Please access this page from account management tab!";
    header("location: error.php");
}
?>