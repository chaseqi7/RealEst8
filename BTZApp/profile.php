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
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $role = $_SESSION['role'];
    $active = $_SESSION['active'];
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
    <p>
        <?php
        // Display message about account verification link only once
        if ( isset($_SESSION['message']) )
        {
            echo $_SESSION['message'];
            // Don't annoy the user with more messages upon page refresh
            unset( $_SESSION['message'] );
        }
        ?>
    </p>
    <?php
    // Keep reminding the user this account is not active, until they activate
    if ( !$active ){
        echo
        '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
        </div><br>';
    }
    ?>
    <table>
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<label>First name:</label>';
                echo '<p>'.$row["FirstName"].'</p>'.'<br>';
                echo '<label>Last name:</label>';
                echo '<p>'.$row["LastName"].'</p>'.'<br>';
                echo '<label>Address:</label>';
                echo '<p>'.$row["Address"].'</p>'.'<br>';
                echo '<label>City:</label>';
                echo '<p>'.$row["City"].'</p>'.'<br>';
                echo '<label>Province:</label>';
                echo '<p>'.$row["Province"].'</p>'.'<br>';
                echo '<label>PostalCode:</label>';
                echo '<p>'.$row["PostalCode"].'</p>'.'<br>';
                echo '<label>PhoneNumber:</label>';
                echo '<p>'.$row["PhoneNumber"].'</p>'.'<br>';
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
    <button type="submit" class="button button-block" name="editProfileButton" id="editProfileButton"/>Edit Profile</button>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>
</html>
