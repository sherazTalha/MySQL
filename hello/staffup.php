<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff Details</title>
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
        <h2>Update Staff Details</h2>
        
        <!-- Form to update staff details -->
        <form action="" method="post">
            <label for="staffID">Staff ID:</label>
            <input type="text" id="staffID" name="staffID" placeholder="Enter Staff ID" required>
            <label for="staffSurname">New Surname:</label>
            <input type="text" id="staffSurname" name="staffSurname" placeholder="Enter New Surname" required>
            <label for="staffForename">New Forename:</label>
            <input type="text" id="staffForename" name="staffForename" placeholder="Enter New Forename" required>
            <input type="submit" value="Update Staff" name="updateStaff">
        </form>
        
        <!-- PHP code for updating staff details -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hospital";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Update staff details
            if(isset($_POST['updateStaff'])) {
                $staffID = $_POST['staffID'];
                $newSurname = $_POST['staffSurname'];
                $newForename = $_POST['staffForename'];
                $sql = "UPDATE tblstaff SET staffSurname='$newSurname', staffForename='$newForename' WHERE staffID=$staffID"; // Adjusted table name
                if ($conn->query($sql) === TRUE) {
                    echo "<p>Staff details updated successfully.</p>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            $conn->close();
        }
        ?>
        
        <!-- Back to main menu button -->
        <a href="http://localhost/hello/switchboard.php" class="back-button">Back to Main Menu</a>
    </div>
</body>
</html>
