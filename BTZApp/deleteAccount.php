<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: deleteAccount.php
 */

if(isset($_POST['id']) && !empty($_POST['id'])) {
    $id = (int)$_POST['id'];
    $isClient = true;
    $deletedSuccess = true;

    $result = $mysqli->query("
                SELECT * FROM UserT JOIN Role 
                WHERE UserT.Role = Role.RoleID 
                AND Role.Description = 'Client'
                AND UserID='$id'");

    if ($result->num_rows > 0) {
        $isClient = true;
    }
    else{
        $isClient = false;
    }

    if (!$isClient){
        $resultDeleteAdmin = $mysqli->query("DELETE FROM AdminAndAgent WHERE UserID=$id") or die($mysqli->error);
        if ($result)
        {
            $deletedSuccess = true;
        }
        else {
            $deletedSuccess = false;
        }
    }

    if ($deletedSuccess){
        $resultDeleteUser = $mysqli->query("DELETE FROM UserT WHERE UserID=$id") or die($mysqli->error);
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
    else
    {
        $_SESSION['accountMessage'] = "Something was wrong, failed to delete account!";
        header("location: accountManagement.php");
    }


}
else {
    $_SESSION['accountMessage'] = "Please access this page from account management tab!";
    header("location: accountManagement.php");
}
?>