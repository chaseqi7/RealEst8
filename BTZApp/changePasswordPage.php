<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-08
 * File name: changePasswordPage.php
 */

require 'db.php';
session_start();

// Check if user is logged in using the session variable
if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}

?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= $first_name.' '.$last_name ?></title>
    <?php include 'css/css.html'; ?>
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require 'changePassword.php';
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
        <h1>Change Password</h1>
        <p>
            <?php
            if( isset($_SESSION['changePasswordMessage']) AND !empty($_SESSION['changePasswordMessage']) ):
                echo $_SESSION['changePasswordMessage'];
            endif;
            ?>
        </p>
        <form name="changePasswordForm" action="changePasswordPage.php" method="post">
            <input type="hidden" name='email' value='<?php echo $_SESSION["email"]?>'></input>
            <div class="field-wrap">
                <label>
                    Current Password<span class="req">*</span>
                </label>
                <input type="password" name="currentPassword"/>
            </div>
            <div class="field-wrap">
                <label>
                    New Password<span class="req">*</span>
                </label>
                <input type="password" name="newPassword"/>
            </div>
            <div class="field-wrap">
                <label>
                    Confirm New Password<span class="req">*</span>
                </label>
                <input type="password" name="confirmPassword"/>
            </div>
            <button type="submit" class="button button-block" name="changePasswordBtn" id="changePasswordBtn"/>Change</button>
        </form>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
</body>
</html>