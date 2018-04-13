<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-08
 * File name: index.php
 */

require 'db.php';
session_start();
// Check if user is logged in using the session variable
if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ) {
    $email = $_SESSION['email'];
    $first_name = $_SESSION['firstname'];
    $last_name = $_SESSION['lastname'];
    $role = $_SESSION['role'];
}
$servername = "localhost:3306";
$username = "root";
$password = "1234";
$dbname = "BTZDatabase";
$conn = new mysqli($servername, $username, $password, $dbname);


function refreshList(){


    // Check connection
    global $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        $filterStrings= "WHERE ";
        $selectSQL = "SELECT * FROM Property ";
        if (isset($_POST['PropertyTypeSelect'])) {
            $filterStrings=$filterStrings."PropertyType=".$_POST['PropertyTypeSelect']." AND ";
        }
        if (isset($_POST['BuildingTypeSelect'])) {
            $filterStrings=$filterStrings."BuildingType=".$_POST['BuildingTypeSelect']." AND ";
        }
        if (isset($_POST['OwnershipSelect'])) {
            $filterStrings=$filterStrings."Ownership=".$_POST['OwnershipSelect']." AND ";
        }
        if (isset($_POST['SaleOrRentSelect'])) {
            $filterStrings=$filterStrings."SaleOrRent=".$_POST['SaleOrRentSelect']." AND ";
        }
        if (isset($_POST['UpperLimitSelect'])) {
            $filterStrings=$filterStrings."Price<=".$_POST['UpperLimitSelect']." AND ";
        }
        if (isset($_POST['LowerLimitSelect'])) {
            $filterStrings=$filterStrings."Price>=".$_POST['LowerLimitSelect']." AND ";
        }
        if (isset($_POST['NumberOfBedroomsSelect'])) {
            $NumberOfBedrooms=$_POST['NumberOfBedroomsSelect'];
            if($NumberOfBedrooms=='5'){
                $filterStrings=$filterStrings."NumberOfBedrooms>=".$NumberOfBedrooms." AND ";
            }
            else{
                $filterStrings=$filterStrings."NumberOfBedrooms=".$NumberOfBedrooms." AND ";
            }
        }
        if (isset($_POST['NumberOfWashroomsSelect'])) {
            $NumberOfWashrooms=$_POST['NumberOfWashroomsSelect'];
            if($NumberOfWashrooms=='5'){
                $filterStrings=$filterStrings."NumberOfWashrooms>=".$NumberOfWashrooms." AND ";
            }
            else{
                $filterStrings=$filterStrings."NumberOfWashrooms=".$NumberOfWashrooms." AND ";
            }
        }
        if (isset($_POST['OpenHouseSelect'])) {
            $filterStrings=$filterStrings."OpenHouse=".$_POST['OpenHouseSelect']." AND ";
        }

        if (isset($_POST['search']) AND $_POST['search']!='') {
            $filterStrings=$filterStrings."(Address LIKE '%".$_POST['search']."%' OR City LIKE '%".$_POST['search']."%' OR Province LIKE '%".$_POST['search']."%' OR PostalCode LIKE '%".$_POST['search']."%') AND ";
        }

        $SQLString=substr($selectSQL.$filterStrings, 0, -4);
        $result = $conn->query($SQLString);
        while($row = $result->fetch_array())
        {
            echo' <a href="listing-detail.html" class="listing-link">
                                <div class="listing">
                                    <img class="listing-image" src="img/example-house.jpg" />
                                    <h3 class="listing-address">'.$row["Address"].'</h3><br>
                                    <h3 class="listing-city">'.$row["City"]." ".$row["Province"].'</h3><br>
                                    <h4 class="listing-price">$'.$row["Price"].'</h4><br>
                                    <div class="listing-extra-div1">
                                        <p class="listing-detail">Number Of Bedrooms: </p>
                                        <p class="listing-detail">'.$row["NumberOfBedrooms"].'</p>
                                    </div>
                                    <div class="listing-extra-div2">
                                        <p class="listing-detail">Number Of Washrooms: </p>
                                        <p class="listing-detail">'.$row["NumberOfWashrooms"].'</p><br>
                                    </div>
                                </div>
                            </a>
                        ';
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
                }
                echo "<a href=\"logout.php\">Sign out</a>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
    <!--Search Bar-->
    <div id="search-container" align="center">

            <form id="select-panels" method="post">

                <input type="button" onclick="filterShowHide()" id="filter-button" value="▼"/>

                <input id="mainSearchBar" type="text" name="search" placeholder="Search..">
                <input type="submit" id="searchButton" name="searchButton" value="Search" />


                <div id="filter-pane" style="display: none">

                <?php
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                else{
                    $result = $conn->query("SELECT * FROM PropertyType ORDER BY PropertyTypeID");
                    echo "<select name='PropertyTypeSelect' class='filter-option'><option selected disabled>Property Type</option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['PropertyTypeID'] . "'>".$row['Description']."</option>";
                    }
                    echo "</select>";

                    $result = $conn->query("SELECT * FROM BuildingType ORDER BY BuildingTypeID");
                    echo "<select name='BuildingTypeSelect' class='filter-option'><option selected disabled>Building Type</option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['BuildingTypeID'] . "'>".$row['Description']."</option>";
                    }
                    echo "</select>";

                    $result = $conn->query("SELECT * FROM Ownership ORDER BY OwnershipID");
                    echo "<select name='OwnershipSelect' class='filter-option'><option selected disabled>Owner ship</option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['OwnershipID'] . "'>".$row['Description']."</option>";
                    }
                    echo "</select>";

                    $result = $conn->query("SELECT * FROM SaleOrRent ORDER BY SaleOrRentID");
                    echo "<select name='SaleOrRentSelect' class='filter-option'><option selected disabled>Sale Or Rent</option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['SaleOrRentID'] . "'>".$row['Description']."</option>";
                    }
                    echo "</select>";

                    echo "<select name='LowerLimitSelect' class='filter-option'><option selected disabled>Lower Price Limit</option>";
                    for ($k = 0 ; $k < 1000000; $k=$k+100000){
                        echo "<option value='" . $k . "'>" . $k . "</option>";
                    }
                    echo "</select>";

                    echo "<select name='UpperLimitSelect' class='filter-option'><option selected disabled>Upper Price Limit</option>";
                    for ($k = 0 ; $k < 1000000; $k=$k+100000){
                        echo "<option value='" . $k . "'>" . $k . "</option>";
                    }
                    echo "</select>";

                    echo "<select name='NumberOfBedroomsSelect' class='filter-option'><option selected disabled>Number Of Bedrooms</option>";
                    for ($k = 1 ; $k < 5; $k++){
                        echo "<option value='" . $k . "'>" . $k . "</option>";
                    }
                    echo "<option value=\"5\">5+</option></select>";

                    echo "<select name='NumberOfWashroomsSelect' class='filter-option'><option selected disabled>Number Of Washrooms</option>";
                    for ($k = 1 ; $k < 5; $k++){
                        echo "<option value='" . $k . "'>" . $k . "</option>";
                    }
                    echo "<option value=\"5\">5+</option></select>";
                }
                ?>
                <select name="OpenHouseSelect"  class='filter-option'>
                    <option selected disabled>Open House</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>


                </div>
            </form>
    </div>
        <!--Suggestiongs/Search Results-->
        <div id="main-listings">
            <div id="listings">
                <?php
                refreshList();
                ?>
            </div>
        </div>
    <script>
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function filterShowHide() {
            var x = document.getElementById("filter-pane");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/home.js"></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
        ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
</html>