<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-08
 * File name: accountManagement.php
 */

require 'db.php';
session_start();
// Check if user is logged in using the session variable
if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}
else if($_SESSION['role'] != 'Admin'){
    $_SESSION['message'] = "You don't have permission to view this page!";
    header("location: error.php");
}
else {
    // Makes it easier to read
    $email = $_SESSION['email'];
    $first_name = $_SESSION['firstname'];
    $last_name = $_SESSION['lastname'];
    $role = $_SESSION['role'];
}

$result = $mysqli->query("
    SELECT * FROM UserT JOIN Role 
    WHERE UserT.Role = Role.RoleID ORDER BY Description");
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Real Est8 - Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <link rel="icon" href="img/house-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->
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
                }
                echo "<a href=\"logout.php\">Sign out</a>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
    <div id="account-management-container">
    <!-- List of user -->
    <h2>List of Users</h2>
    <p>
        <?php
        if( isset($_SESSION['addAccountMessage']) && !empty($_SESSION['addAccountMessage']) ){
            echo $_SESSION['addAccountMessage'];
        }
        ?>
    </p>
    <a href="createAccountPage.php"><input name="addAccount" id="addAccount" type="button" value="Add Account"></a>
    <table id="accounts-table">
        <tr class="account-stripe">
            <th class="accounts-th">First name</th>
            <th class="accounts-th">Last name</th>
            <th class="accounts-th">Role</th>
            <th class="accounts-th">Email</th>
            <th class="accounts-th"></th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<tr class="account-stripe">';
                echo '<td class="accounts-td">'.$row["FirstName"].'</td>';
                echo '<td class="accounts-td">'.$row["LastName"].'</td>';
                echo '<td class="accounts-td">'.$row["Description"].'</td>';
                echo '<td class="accounts-td">'.$row["Email"].'</td>';
                echo '<td class="accounts-td-button" align="center">
                      <input class="accounts-button" name="btnDeleteAccount" type="button" value="Delete Account" 
                      onclick="return doConfirm('.$row["UserID"].')"/>
                      </td>';
                echo '</tr>';
            }
        }else {
            echo
            '<div class="info">
                0 results
            </div>';
        }
        ?>
    </table>
    <?php
    $clickedDelete= $_POST['btnDeleteAccount'];
    if ($clickedDelete)
    {
        if (isset($_POST['login'])) { //user logging in
            require 'login.php';
        }
        elseif (isset($_POST['register'])) {
            //user registering
            require 'register.php';
        }
    }
    ?>

    <script language="JavaScript" type="text/javascript">
        function doConfirm(id) {
            var ok = confirm("Are you sure to Delete?");
            if (ok) {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        window.location = "deleteAccount.php";
                    }
                }

                xmlhttp.open("POST", "deleteAccount.php?id=" + id);
                // file name where delete code is written
                xmlhttp.send();
            }
        }
    </script>
    </div>
</body>
</html>
