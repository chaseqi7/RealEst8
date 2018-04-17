<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: deleteAccount.php
 */

include("AccountClass.php");
include('db.php');
$db = new DB();
$mysqli = $db->getConnection();
$account = new AccountClass($mysqli);

if(isset($_POST['id']) && !empty($_POST['id'])) {
    $id = (int)$_POST['id'];
    $result = $account->deleteAccount($id);
    if ($result)
    {
        $_SESSION['accountMessage'] = "User was successfully deleted!";
        header("location: accountManagement.php");
    }
    else {
        $_SESSION['accountMessage'] = "Something was wrong, failed to delete account!";
        header("location: accountManagement.php");
    }
}
else {
    $_SESSION['accountMessage'] = "Please access this page from account management tab!";
    header("location: accountManagement.php");
}
?>
