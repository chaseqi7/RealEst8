<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-10
 * File name: createAccount.php
 */

// Escape all $_POST variables to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$role = $mysqli->escape_string($_POST['roleSelect']);
$password = $mysqli->escape_string(password_hash('1234',PASSWORD_DEFAULT));

$result = $mysqli->query("SELECT * FROM UserT WHERE Email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $sqlAddUser = "INSERT INTO UserT (Email,Password,FirstName,LastName,Role) 
            VALUES ('$email','$password','$first_name','$last_name',$role)";

    // Add user to the database
    if ($mysqli->query($sqlAddUser)) {
        $resultRole = $mysqli->query("
                SELECT * FROM UserT JOIN Role 
                WHERE UserT.Role = Role.RoleID AND Email='$email'");
        if ($resultRole->num_rows > 0) {
            // output data of each row
            while ($row = $resultRole->fetch_assoc()) {
                if ($row['Description'] != 'Client') {
                    $userID = $row['UserID'];
                    $sqlAddAgent = "INSERT INTO AdminAndAgent (UserID) VALUES ($userID)";
                    if ($mysqli->query($sqlAddUser)) {
                        $_SESSION['accountMessage'] = "User '$email' was successfully added!";
                        header("location: accountManagement.php");
                    } else {
                        $_SESSION['accountMessage'] = "Something was wrong! Please remove user '
                    $email' and re-add again!";
                        header("location: accountManagement.php");
                    }
                }
            }
        }

    } else {
        $_SESSION['accountMessage'] = "Failed to add user '$email'!". $mysqli->error;
        header("location: accountManagement.php");
    }
}
else { // User exists
    $_SESSION['accountMessage'] = "User '$email' already exist!";
    header("location: accountManagement.php");
}
