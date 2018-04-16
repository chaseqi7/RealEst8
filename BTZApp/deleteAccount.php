<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: deleteAccount.php
 */

include("AccountClass.php");

$account = new AccountClass($mysqli);
$email = $mysqli->escape_string($_POST['email']);
$result = $account->deleteAccount($email);

if ($result)
{
    $_SESSION['accountMessage'] = "User was successfully deleted!";
    header("location: accountManagement.php");
}
else {
    $_SESSION['accountMessage'] = "Something was wrong, failed to delete account!";
    header("location: accountManagement.php");
}