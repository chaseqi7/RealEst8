<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-10
 * File name: createAccount.php
 */

$passwordCheckBase = $_POST['password'];
$passwordConfirm = $_POST['confirmPassword'];

// Escape all $_POST variables to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$role = $mysqli->escape_string($_POST['role']);
$password = $mysqli->escape_string('');

$result = $mysqli->query("SELECT * FROM UserT WHERE Email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $sqlAddUser = "INSERT INTO UserT (Email,Password,FirstName,LastName,Role,) 
            VALUES ('$email','$password','$first_name','$last_name',$role)";

    // Add user to the database
    if ($mysqli->query($sqlAddUser)) {
        $resultRole = $mysqli->query("
                SELECT * FROM UserT JOIN Role 
                WHERE UserT.Role = Role.RoleID AND Email='$email'");
        if ($resultRole['Description'] != 'Client')
        {
            $userID = $resultRole['UserID'];
            $sqlAddAgent = "INSERT INTO AdminAndAgent (UserID) VALUES ($userID)";
            if ($mysqli->query($sqlAddUser)) {
                $_SESSION['addAccountMessage'] = 'User '. $email. ' was successfully added!';
                header("location: createAccountPage.php");
            }
            else{
                $_SESSION['addAccountMessage'] = 'Something was wrong! Please remove user '.
                    $email. ' and re-add again!';
                header("location: createAccountPage.php");
            }
        }

    } else {
        $_SESSION['addAccountMessage'] = 'Failed to add user '. $email. '!';
        header("location: createAccountPage.php");
    }
}
else { // User exists
    $_SESSION['addAccountMessage'] = "User '. $email .' already exist!";
    header("location: createAccountPage.php");
}
