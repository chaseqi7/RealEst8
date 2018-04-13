<?php
/**
 * Created by PhpStorm.
 * User: chase
 * Date: 2018-04-13
 * Time: 5:25 PM
 */


if($_GET['id']){
    $property_id=$_GET['id'];
    echo $property_id;
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
os.description AS osDes
  FROM Property p INNER JOIN PropertyType pt ON pt.PropertyTypeID=p.PropertyType
                    INNER JOIN BuildingType bt ON bt.BuildingTypeID=p.BuildingType
                    INNER JOIN SaleOrRent sor ON sor.SaleOrRentID=p.SaleOrRent
                    INNER JOIN Ownership os ON os.OwnershipID=p.Ownership
                    WHERE p.PropertyID = ".$property_id;
    $result = $conn->query($selectSQL);
    while($row = $result->fetch_array())
    {
        echo' 
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
                                    
                                    Listed Date: <p>'.$row["ListedDate"].'</p>
                                    Postal Code: <p>'.$row["PostalCode"].'</p>
                                    Property Type: <p>'.$row["ptDes"].'</p>
                                    Building Type: <p>'.$row["btDes"].'</p>
                                    Sale Or Rent: <p>'.$row["sorDES"].'</p>
                                    Ownership: <p>'.$row["osDes"].'</p>
                                </div>
                                
                           
                        ';
    }
} else {
    echo "failed";
}

