<?php
// Include your database connection file
include "http://localhost/phpmyadmin/index.php?route=/database/structure&db=cardealership";

// Your test query
$sql = "SELECT * FROM your_table";
$result = $conn->query($sql);

// Display the results
if ($result->num_rows > 0) {
    echo "<h2>Test Results:</h2>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>ID: " . $row["id"]. " - Name: " . $row["name"]. "</li>";
    }
    echo "</ul>";
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>
