<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-08
 * File name: editProfilePage.php
 */

require 'db.php';
session_start();

// Check if user is logged in using the session variable
if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}
$email = $_SESSION['email'];
$result = $mysqli->query("SELECT * FROM UserT WHERE Email='$email'");

?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= $SESSION['firstname'].' '.$SESSION['lastname'] ?></title>
    <?php include 'css/css.html'; ?>
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require 'editProfile.php';
}
?>
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
    <div id="editProfile">
        <h1>Edit Profile</h1>
        <p>
            <?php
            if( isset($_SESSION['editProfileMessage']) AND !empty($_SESSION['editProfileMessage']) ):
                echo $_SESSION['editProfileMessage'];
            endif;
            ?>
        </p>
        <form name="editProfileForm" action="editProfilePage.php" method="post">
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<input type="hidden" name=\'email\' value='.$row["Email"].'></input>';
                    echo '<div class="field-wrap">';
                    echo '<label>First Name<span class="req">*</span></label>';
                    echo '<input type="text" required autocomplete="off" name=\'firstname\' value='.$row["FirstName"].'></input>';
                    echo '</div>';
                    echo '<div class="field-wrap">';
                    echo '<label>Last Name<span class="req">*</span></label>';
                    echo '<input type="text" required name=\'lastname\' value='.$row["LastName"].'"></input>';
                    echo '</div>';
                    echo '<div class="field-wrap">';
                    echo '<label>Address</label>';
                    echo '<input type="text" name=\'address\' value='.$row["Address"].'></input>';
                    echo '</div>';
                    echo '<div class="field-wrap">';
                    echo '<label>City</label>';
                    echo '<input type="text" name=\'city\' value='.$row["City"].'></input>';
                    echo '</div>';
                    echo '<div class="field-wrap">';
                    echo '<label>Province</label>';
                    echo '<input type="text" name=\'province\' value='.$row["Province"].'></input>';
                    echo '</div>';
                    echo '<div class="field-wrap">';
                    echo '<label>PostalCode</label>';
                    echo '<input type="text" name=\'postalcode\' value='.$row["PostalCode"].'></input>';
                    echo '</div>';
                    echo '<div class="field-wrap">';
                    echo '<label>PhoneNumber</label>';
                    echo '<input type="text" name=\'phone\' value='.$row["PhoneNumber"].'></input>';
                    echo '</div>';
                }
            }
            ?>
            <button type="submit" id="saveBtn" name="saveBtn">Save</button>
            <a href="profile.php">
                <input type="submit" id="cancelEditProfileBtn" name="cancelEditProfileBtn" value="Cancel" />
            </a>
        </form>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
</body>
</html>