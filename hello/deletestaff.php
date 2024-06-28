<?php


if (isset($_GET['staffID'])) {
    $staffID = $_GET['staffID'];

   
    $servername = "localhost";
    $username = "your_database_username";
    $password = "your_database_password";
    $dbname = "your_database_name";

    $conn = new mysqli($servername, $username, $password, $dbname);

  
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $sql = "DELETE FROM tblstaff WHERE staffID = $staffID";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
