<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Z
 * iming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: verify.php
 */

/* Verifies registered user email, the link to this page
   is included in the register.php email message
*/
require 'db.php';
session_start();

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']))
{
    $email = $mysqli->escape_string($_GET['email']);
    $hash = $mysqli->escape_string($_GET['hash']);

    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $mysqli->query("SELECT * FROM UserT WHERE Email='$email' AND Active=0");

    if ( $result->num_rows == 0 )
    {
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";

        header("location: error.php");
    }
    else {
        $_SESSION['message'] = "Your account has been activated!";

        // Set the user status to active (active = 1)
        $mysqli->query("UPDATE UserT SET Active=1 WHERE Email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;

        header("location: success.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: error.php");
}
?>