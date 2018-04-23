<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-10
 * File name: createAccountPage.php
 */
include('db.php');
session_start();
$db = new DB();
$mysqli = $db->getConnection();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add Account</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <link rel="icon" href="img/house-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require 'createAccount.php';
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
        else {
            echo "<li id=\"account-dropdown\" class=\"dropdown\">";
            echo "<a href=\"profile.php\" class=\"dropbtn\">Profile</a>";
            echo "<div id=\"account-dropdown-content\" class=\"dropdown-content\">";
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'){
                echo "<a href=\"accountManagement.php\">Manage Accounts</a>";
                echo "<a href=\"reportPage.php\">Reports</a>";
            }
            echo "<a href=\"logout.php\">Sign out</a>";
            echo "</div>";
            echo "</li>";
        }
        ?>
    </ul>
</div>
<!-- Add Account Form -->
<div class="create-account-container">
    <h1>Add Account</h1>
    <form name="addAccountForm" action="createAccountPage.php" method="post" autocomplete="off">
        <div class="field-wrap">
            <label>
                Email Address<span class="req"></span>
            </label>
            <input type="email" autocomplete="off" name="email"/>
        </div>
        <div class="field-wrap">
            <label>
                First Name<span class="req"></span>
            </label>
            <input type="text" autocomplete="off" name="firstname"/>
        </div>
        <div class="field-wrap">
            <label>
                Last Name<span class="req"></span>
            </label>
            <input type="text" autocomplete="off" name="lastname"/>
        </div>
        <div class="field-wrap">
            <label>
                Role<span class="req"></span>
            </label>
            <?php
            $result = $mysqli->query("
                      SELECT * FROM Role ORDER BY Description");
            echo "<select name='roleSelect'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['RoleID'] . "'>".$row['Description']."</option>";
            }
            echo "</select>";
            ?>
        </div>
        <button type="submit" id="addAccountBtn" />Add Account</button>
    </form>
</div> <!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="libraries/jquery.validate.js"></script>
<script src="js/index.js"></script>
<script src="js/validation.js"></script>
</body>
</html>