<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: profile.php
 */

/* Displays user information and some useful messages */
require 'db.php';
session_start();

// Check if user is logged in using the session variable
if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}
else {
    // Makes it easier to read
    $email = $_SESSION['email'];
    $first_name = $_SESSION['firstname'];
    $last_name = $_SESSION['lastname'];
    $role = $_SESSION['role'];
}

$result = $mysqli->query("SELECT * FROM UserT WHERE Email='$email'");
?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= $first_name.' '.$last_name ?></title>
    <?php include 'css/css.html'; ?>
</head>

<body>
<!--Navbar-->
<div id="nav-bar">
    <ul class="navbar">
        <li class="navTitle"><a href="index.php">Real Est8</a></li>
        <?php
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']){
            echo "<li id=\"account-dropdown\" class=\"dropdown\">";
            echo "<a href=\"account.php\" class=\"dropbtn\">Sign in</a>";
            echo "</li>";
        }
        else{
            echo "<li id=\"account-dropdown\" class=\"dropdown\">";
            echo "<a href=\"profile.php\" class=\"dropbtn\">Profile</a>";
            echo "<div id=\"account-dropdown-content\" class=\"dropdown-content\">";
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'){
                echo "<a href=\"accountManagement.php\">Manage Accounts</a>";
            }
            echo "<a href=\"logout.php\">Sign out</a>";
            echo "</div>";
            echo "</li>";
        }
        ?>
    </ul>
</div>
<div id="profile-page">
    <h2>Welcome <?php echo $first_name.' '.$last_name; ?></h2>
    <table>
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<th align="left">First name:</th>';
                echo '<td align="right">'.$row["FirstName"].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th align="left">Last name:</th>';
                echo '<td align="right">'.$row["LastName"].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th align="left">Address:</th>';
                echo '<td align="right">'.$row["Address"].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th align="left">City:</th>';
                echo '<td align="right">'.$row["City"].'</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th align="left">Province:</th>';
                echo '<td align="right">'.$row["Province"].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th align="left">PostalCode:</th>';
                echo '<td align="right">'.$row["PostalCode"].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th align="left">PhoneNumber:</th>';
                echo '<td align="right">'.$row["PhoneNumber"].'</td>';
                echo '</tr>';
            }
        } else {
            echo
            '<div class="info">
                0 results
            </div>';
        }
        ?>
    </table>
    <button type="submit" name="editProfileButton" id="editProfileButton"/>Edit Profile</button>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>
</html>
