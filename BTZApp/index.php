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
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $role = $_SESSION['role'];
    $active = $_SESSION['active'];
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
<<<<<<< HEAD
<<<<<<< HEAD
            echo "<li id=\"account-dropdown\" class=\"dropdown\">";
            echo "<a href=\"profile.php\" class=\"dropbtn\">Profile</a>";
            echo "<div id=\"account-dropdown-content\" class=\"dropdown-content\">";
            echo "<a href=\"logout.php\">Sign out</a>";
            echo "</div>";
            echo "</li>";
        }
        ?>
    </ul>
</div>
<!--Search Bar-->
<div id="search-container" align="center">
    <input id="mainSearchBar" type="text" name="search" placeholder="Search..">
    <button id="searchButton" name="searchButton">Search</button>
    <!--<button onclick="filterShowHide()" id="filter-button">Filters</button>-->
    <div id="filter-pane" style="display: none">
        <form>
            <h3>Waiting for filters...</h3>
        </form>
=======
=======
>>>>>>> a565058aee00f7e7d2a86696580c89171e3224a3
            else{
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'){
                    echo "<li class=\"dropdown\"><a href=\"accountManagement.php\">Manage Accounts</a></li>";
                }
                echo "<li id=\"account-dropdown\" class=\"dropdown\">";
                echo "<a href=\"profile.php\" class=\"dropbtn\">Profile</a>";
                echo "<div id=\"account-dropdown-content\" class=\"dropdown-content\">";
                echo "<a href=\"logout.php\">Sign out</a>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
<<<<<<< HEAD
>>>>>>> a565058aee00f7e7d2a86696580c89171e3224a3
=======
>>>>>>> a565058aee00f7e7d2a86696580c89171e3224a3
    </div>
    <!--Search Bar-->
    <div id="search-container" align="center">
        <input id="mainSearchBar" type="text" name="search" placeholder="Search..">
        <button onclick="filterShowHide()" id="filter-button">Filters</button>
        <div id="filter-pane" style="display: none">
            <form>
                <h3>Waiting for filters...</h3>
            </form>
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
<<<<<<< HEAD
=======
            }
        }
    </script>
    <!--Search Bar-->
    <!--Suggestiongs/Search Results-->
    <div id="main-listings">
    <?php
    $query = $_GET['query'];
    // gets value sent over search form
    $min_length = 3;
    // you can set minimum length of the query if you want
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;
        $query = $mysqli->escape_string($query);
        // makes sure nobody uses SQL injection
        $raw_results = $mysqli->query("SELECT * FROM property
            WHERE (`Price` LIKE '%".$query."%') OR (`ListedDate` LIKE '%".$query."%') OR (`NumberOfBedrooms` LIKE '%".$query."%') OR (`NumberOfWashrooms` LIKE '%".$query."%') OR (`Address` LIKE '%".$query."%') OR (`City` LIKE '%".$query."%') OR (`Province` LIKE '%".$query."%') OR (`PostalCode` LIKE '%".$query."%')") or die(mysql_error());
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
            while($results = mysql_fetch_array($raw_results)){
                // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                echo "<p><h3>".$results['title']."</h3>".$results['text']."</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
>>>>>>> a565058aee00f7e7d2a86696580c89171e3224a3
            }
        }
    </script>
    <!--Search Bar-->
    <!--Suggestiongs/Search Results-->
    <div id="main-listings">
    <?php

    ?>
    <!--            <h2>Suggestions</h2><!--Should change 'Results' when someone searches for something-->
    <!--        <div id="listings">-->
    <!--            <a href="listing-detail.html" class="listing-link">-->
    <!--                <div class="listing">-->
    <!--                    <img class="listing-image" src="img/example-house.jpg" />-->
    <!--                    <h3 class="listing-address">123 The Best Street</h3><br>-->
    <!--                    <h3 class="listing-city">Kitchener ON</h3><br>-->
    <!--                    <h4 class="listing-price">$150 000</h4><br>-->
    <!--                    <div class="listing-extra-div1">-->
    <!--                        <p class="listing-detail">Detail Label: </p>-->
    <!--                        <p class="listing-detail">77 Rooms</p>-->
    <!--                    </div>-->
    <!--                    <div class="listing-extra-div2">-->
    <!--                        <p class="listing-detail">Detail Label: </p>-->
    <!--                        <p class="listing-detail">8 Bathrooms</p><br>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </a>-->
    <!--            <a href="listing-detail.html" class="listing-link">-->
    <!--                <div class="listing">-->
    <!--                    <img class="listing-image" src="img/example-house2.jpg" />-->
    <!--                    <h3 class="listing-address">123 The Best Street</h3><br>-->
    <!--                    <h3 class="listing-city">Kitchener ON</h3><br>-->
    <!--                    <h4 class="listing-price">$150 000</h4><br>-->
    <!--                    <div class="listing-extra-div1">-->
    <!--                        <p class="listing-detail">Detail Label: </p>-->
    <!--                        <p class="listing-detail">77 Rooms</p>-->
    <!--                    </div>-->
    <!--                    <div class="listing-extra-div2">-->
    <!--                        <p class="listing-detail">Detail Label: </p>-->
    <!--                        <p class="listing-detail">8 Bathrooms</p><br>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </a>-->
    <!--        </div>-->
    <!--    </div>-->

    <!--Suggestiongs/Search Results-->


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