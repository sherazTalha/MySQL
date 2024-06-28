<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Details</title>
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
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 400px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin: 15px 0 8px;
            color: #333;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
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
    <form action='' method='post'>
        <h1>Update Patient Details</h1>
        <label for='patientID'>patientID:</label>
        <input type='text' id='patientID' name='patientID' placeholder='Enter Patient ID' required>
        <input type='submit' value='Fetch Patient Details' name='fetchDetailsPressed'>

        <?php
        require_once("ConnectToDB.php");

        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "hospital"; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['fetchDetailsPressed'])) {
            $patientID = $_POST['patientID'];

            $sql = "SELECT * FROM patients WHERE patientID = '$patientID'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $surname = $row['Surname'];
                $forename = $row['Forename'];
                $gender = $row['Gender'];

                echo "
                <label for='patientID'>Patient ID:</label>
                <input type='text' id='patientID' name='patientID' value='$patientID' readonly>
                <label for='surname'>Surname:</label>
                <input type='text' id='surname' name='surname' value='$surname' required>
                <label for='forename'>Forename:</label>
                <input type='text' id='forename' name='forename' value='$forename' required>
                <label for='gender'>Gender:</label>
                <select id='gender' name='gender' required>
                    <option value='male' " . ($gender == 'male' ? 'selected' : '') . ">Male</option>
                    <option value='female' " . ($gender == 'female' ? 'selected' : '') . ">Female</option>
                    <option value='other' " . ($gender == 'other' ? 'selected' : '') . ">Other</option>
                </select>
                <input type='submit' value='Update' name='updatePressed'>

                <!-- Back button -->
                <a href='http://localhost/hello/switchboard.php' class='back-button'>Back to Switchboard</a>
                ";
            } else {
                echo "<p>Patient not found.</p>";
            }
        }

        if (isset($_POST['updatePressed'])) {
            $surname = $_POST["surname"];
            $forename = $_POST["forename"];
            $gender = $_POST["gender"];
            $patientID = $_POST["patientID"];

            $sqlUpdate = "UPDATE patients SET Surname = '$surname', Forename = '$forename', Gender = '$gender' WHERE patientID = '$patientID';";

            if ($conn->query($sqlUpdate)) {
                echo "<script>alert('Record updated');</script>";
            } else {
                echo "<script>console.log('Error updating record: " . $conn->error . "');</script>";
            }
        }

        $conn->close();
        ?>
    </form>
</body>

</html>
