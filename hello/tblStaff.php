<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management</title>
    <style>
        body {
            font-family: 'Verdana', sans-serif;
            background: url('update.jpg');
            background-size: cover;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 20px;
            max-width: 600px; /* Limiting maximum width for smaller container */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .back-button {
            display: block;
            width: 100px;
            margin: 20px auto;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Staff Management</h2>
        
        <!-- Form to add a new staff member -->
        <form action="" method="post">
            <h3>Add Staff</h3>
            <label for="staffSurname">Surname:</label>
            <input type="text" id="staffSurname" name="staffSurname" placeholder="Enter Surname" required>
            <label for="staffForename">Forename:</label>
            <input type="text" id="staffForename" name="staffForename" placeholder="Enter Forename" required>
            <input type="submit" value="Add Staff" name="addStaff">
        </form>
        
        <!-- Display list of staff members -->
        <h3>Staff List</h3>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hospital";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Add staff member
        if(isset($_POST['addStaff'])) {
            $surname = $_POST['staffSurname'];
            $forename = $_POST['staffForename'];
            $sql = "INSERT INTO tblstaff (staffSurname, staffForename) VALUES ('$surname', '$forename')"; // Adjusted table name
    if ($conn->query($sql) === TRUE) {
        // Redirect to the same page after successful insertion
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

        // Delete staff member
        if(isset($_POST['deleteStaff'])) {
        $id = $_POST['deleteStaff'];
        $sql = "DELETE FROM tblstaff WHERE staffID=$id"; // Adjusted table name
            if ($conn->query($sql) === TRUE) {
            echo "<p>Staff member deleted successfully.</p>";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
}

// Display staff list
$sql = "SELECT staffID, staffSurname, staffForename FROM tblstaff"; // Adjusted table name
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Surname</th><th>Forename</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["staffID"]."</td><td>".$row["staffSurname"]."</td><td>".$row["staffForename"]."</td><td><form action='' method='post'><input type='hidden' name='deleteStaff' value='".$row["staffID"]."'><input type='submit' value='Delete'></form></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

        
        <!-- Back to main menu button -->
        <a href="http://localhost/hello/switchboard.php" class="back-button">Back to Main Menu</a>
    </div>
</body>
</html>



