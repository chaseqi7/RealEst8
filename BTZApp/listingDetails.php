<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Real Est8 - Details</title>
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

<?php
/**
 * Created by PhpStorm.
 * User: chase
 * Date: 2018-04-13
 * Time: 5:25 PM
 */


if($_GET['id']){
    $property_id=$_GET['id'];
    $servername = "localhost:3306";
    $username = "root";
    $password = "1234";
    $dbname = "BTZDatabase";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $selectSQL = "SELECT Price,ListedDate,NumberOfBedrooms,
NumberOfWashrooms,Address, City,Province,PostalCode,pt.Description AS ptDes,bt.Description AS btDes,sor.Description AS sorDES,
os.description AS osDes, AgentName,AgentEmail,PictureID 
  FROM Property p INNER JOIN PropertyType pt ON pt.PropertyTypeID=p.PropertyType
                    INNER JOIN BuildingType bt ON bt.BuildingTypeID=p.BuildingType
                    INNER JOIN SaleOrRent sor ON sor.SaleOrRentID=p.SaleOrRent
                    INNER JOIN Ownership os ON os.OwnershipID=p.Ownership
                    WHERE p.PropertyID = ".$property_id;
    $result = $conn->query($selectSQL);
    while($row = $result->fetch_array())
    {
        $emailButton="location.href='mailto:".$row["AgentEmail"]."'";
        echo' 
                                <div class="listing-info-pane">                                  
                                    <div class="slideshow-container">
                                        <div class="mySlides fade">
                                            <img class="listing-detail-image" src="img/'.$row["PictureID"].'.jpg" style="width:100%">
                                        </div>
                                            
                                        <div class="mySlides fade">
                                            <img class="listing-detail-image" src="img/2.jpg" style="width:100%">
                                        </div>
                                            
                                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                        
                                    </div>
                                    <div class="listing-table">
                                        <table id="listing-detail-table">
                                            <tr>
                                                <th class="listing-details-th">Address: </th>
                                                <td class="listing-details-td">'.$row["Address"]." ".$row["City"]." ".$row["Province"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="listing-details-th">Price: </th>
                                                <td class="listing-details-td">$'.$row["Price"].'<td>
                                            </tr>
                                            <tr>
                                                <th class="listing-details-th">Bedrooms: </th>
                                                <td class="listing-details-td">'.$row["NumberOfBedrooms"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="listing-details-th">Washrooms: </th>
                                                <td class="listing-details-td">'.$row["NumberOfWashrooms"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="listing-details-th">Listed Date: </th>
                                                <td class="listing-details-td">'.$row["ListedDate"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="listing-details-th">Postal Code: </th>
                                                <td class="listing-details-td">'.$row["PostalCode"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="listing-details-th">Property Type: </th>
                                                <td class="listing-details-td">'.$row["ptDes"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="listing-details-th">Building Type: </th>
                                                <td class="listing-details-td">'.$row["btDes"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="listing-details-th">Sale Or Rent: </th>
                                                <td class="listing-details-td">'.$row["sorDES"].'</td>
                                            </tr>
                                            <tr>
                                                <th class="listing-details-th">Ownership: </th>
                                                <td class="listing-details-td">'.$row["sorDES"].'</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="contact-agent">
                                        <table>
                                            <tr>
                                                <th class="listing-details-th">Agent Name: </th>
                                                <td class="listing-details-td">'.$row["AgentName"].'</td>
                                            </tr>
                                            <tr>                                             
                                                <td class="listing-details-td" colspan="2">
                                                <button id="contact-button" onclick="'.$emailButton.'" type="button">Contact the Agent</button></td>                                              
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                           
                        ';
    }
} else {
    echo "failed";
}
?>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
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

