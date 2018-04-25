<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-08
 * File name: reportPage.php
 */

require 'db.php';
session_start();
$db = new DB();
$mysqli = $db->getConnection();

function displayReport()
{
    // Check connection
    global $mysqli;
    $selectSQL = "";
    if (isset($_POST['reportTypeSelect'])) {
        if($_POST['reportTypeSelect'] == 'propertyReport'){
            $selectSQL = "SELECT Property.ListedDate, Property.Price, Property.NumberOfBedrooms, 
              Property.NumberOfWashrooms, PropertyType.Description AS PropertyTypeDes, 
              SaleOrRent.Description AS SaleOrRentDes, Property.City FROM Property 
              JOIN PropertyType ON Property.PropertyType = PropertyType.PropertyTypeID
              JOIN SaleOrRent ON Property.SaleOrRent = SaleOrRent.SaleOrRentID 
              ORDER BY Property.ListedDate ASC";
            $result = $mysqli->query($selectSQL)or die($mysqli->error);
            echo'<table class="reports-table">
                    <tr class="account-stripe">
                        <th class="accounts-th">Listed Date</th>
                        <th class="accounts-th">Price</th>
                        <th class="accounts-th">Number Of Bedrooms</th>
                        <th class="accounts-th">Number Of Washrooms</th>
                        <th class="accounts-th">Property Type</th>
                        <th class="accounts-th">Sale Or Rent</th>
                        <th class="accounts-th">City</th>
                    </tr>';
            while($row = $result->fetch_assoc())
            {
                echo'<tr class="account-stripe">
                        <td class="accounts-td">'.$row["ListedDate"].'</td>
                        <td class="accounts-td">'.$row["Price"].'</td>
                        <td class="accounts-td">'.$row["NumberOfBedrooms"].'</td>
                        <td class="accounts-td">'.$row["NumberOfWashrooms"].'</td>
                        <td class="accounts-td">'.$row["PropertyTypeDes"].'</td>
                        <td class="accounts-td">'.$row["SaleOrRentDes"].'</td>
                        <td class="accounts-td">'.$row["City"].'</td>
                    </tr>';
            }
            echo'</table>';
        }
        else if($_POST['reportTypeSelect'] == 'userReport'){
            $selectSQL = "SELECT UserT.Email, Role.Description AS Role FROM UserT 
              JOIN Role ON UserT.Role = Role.RoleID
              ORDER BY Role.Description ASC";
            $result = $mysqli->query($selectSQL)or die($mysqli->error);
            echo'<table class="reports-table">
                    <tr class="account-stripe">
                        <th class="accounts-th">Email</th>
                        <th class="accounts-th">Role</th>
                    </tr>';
            while($row = $result->fetch_assoc())
            {
                echo'<tr class="account-stripe">
                        <td class="accounts-td">'.$row["Email"].'</td>
                        <td class="accounts-td">'.$row["Role"].'</td>
                    </tr>';
            }
            echo'</table>';
        }

    }
}
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
                    echo "<a href=\"reportPage.php\">Reports</a>";
                }
                echo "<a href=\"logout.php\">Sign out</a>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
    <div id="report-container">
        <form method="post">
            <select id='reportTypeSelect' name='reportTypeSelect' class='filter-option'>
                <option selected disabled>Choose Report</option>
                <option value='propertyReport'>Property Reprot</option>
                <option value='userReport'>User Reprot</option>
            </select>
            <input type="submit" id="searchButton" name="searchButton" value="Submit" />
        </form>
        <!--Suggestiongs/Search Results-->
        <div id="report">
            <?php
            displayReport();
            ?>
        </div>
    </div>
</body>
</html>