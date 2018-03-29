<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$UserID="7";
$Email="'6@gmail.com'";
$Password="'sss'";
$strip = substr($Password, 1,-1);
echo $strip."<br>";
$PasswordHashSalt="'".hash('sha256',$strip."Herecomesthesalt")."'";
$FirstName="'asd6'";
$LastName="'qwer6'";
$Role="'Visitor6'";
$Address="'426 Flush Street'";
$City="'Oakville6'";
$Province="'ON6'";
$PostalCode="'J9D8S6'";
$PhoneNumber="'4567896623'";
$TargerPropertyID="1";
echo $PasswordHashSalt."<br><br><br><br>";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




$insertSQL = "INSERT INTO User (
UserID,
Email,
Password,
FirstName,
LastName,
Role,
Address,
City,
Province,
PostalCode,
PhoneNumber,
TargerPropertyID)
VALUES (".$UserID.", ".$Email.",".$Password.",".$FirstName.",".$LastName.",".$Role.",".$Address.",".$City.",".$Province.",".$PostalCode.",".$PhoneNumber.",".$TargerPropertyID.")";

// if ($conn->query($insertSQL) === TRUE) {
//     echo "New record created successfully. <br>";
// } else {
//     echo "Error: " . $insertSQL . "<br>" . $conn->error;
// }

$selectSQL = "SELECT * FROM User";
$result = $conn->query($selectSQL);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo 
        "UserID: " . $row["UserID"]. "      ".
		"Email: " . $row["Email"]. "      ".
		"Password: " . $row["Password"]. "      ".
		"HashedPassword: " . hash('sha256',$row["Password"]."Herecomesthesalt"). "      ".
		"FirstName: " . $row["FirstName"]. "      ".
		"LastName: " . $row["LastName"]. "      ".
		"Role: " . $row["Role"]. "      ".
		"Address: " . $row["Address"]. "      ".
		"City: " . $row["City"]. "      ".
		"Province: " . $row["Province"]. "      ".
		"PostalCode: " . $row["PostalCode"]. "      ".
		"PhoneNumber: " . $row["PhoneNumber"]. "      ".
		"TargerPropertyID: " . $row["TargerPropertyID"]. "<br><br><br>";
    }
}
else {
    echo "0 results";
}



$conn->close();
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
UserID
Email
Password
FirstName
LastName
Role
Address
City
Province
PostalCode
PhoneNumber
TargerPropertyID
