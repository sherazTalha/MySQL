<?php
$servername = "localhost";
$username1 = "admin";
$password1 = "admin";
$username2 = "hello";
$password2 = "hello";
$dbname = "cardealership";
$table = "tblcustomer";


$conn1 = new mysqli($servername, $username1, $password1, $dbname);


if ($conn1->connect_error) {
    die("Connection failed for User 1: " . $conn1->connect_error);
}


$sqlUser1 = "GRANT SELECT, INSERT, UPDATE ON $dbname.$table TO '$username1'@'localhost'";
if ($conn1->query($sqlUser1) === TRUE) {
    echo "Permissions granted successfully for User 1.\n";
} else {
    echo "Error granting permissions for User 1: " . $conn1->error;
}


$conn1->close();


$conn2 = new mysqli($servername, $username2, $password2, $dbname);


if ($conn2->connect_error) {
    die("Connection failed for User 2: " . $conn2->connect_error);
}


$sqlUser2 = "GRANT SELECT ON $dbname.$table TO '$username2'@'localhost'";
if ($conn2->query($sqlUser2) === TRUE) {
    echo "Permissions granted successfully for User 2.\n";
} else {
    echo "Error granting permissions for User 2: " . $conn2->error;
}


$conn2->close();
?>
