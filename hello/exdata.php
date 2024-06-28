<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Data Extraction</title>
    <style>
         body {
            font-family: 'Verdana', sans-serif;
            background: url('data.png');
            background-size: cover;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: white;
        }

        form {
            background-color: #f2f2f2;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            max-width: 400px;
            margin: auto;
        }

        button {
            background-color: #3399cc;
            color: #fff;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #267799;
        }

        .data-container {
            margin-top: 20px;
            color: white;
        }

        .data-item {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #fff;
        color: #333;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .data-item * {
        color: white !important; 
        }
        
        .back-button {
        background-color: #3399cc;
        color: #fff;
        border: none;
        padding: 15px 25px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 8px;
        margin-top: 20px;
        transition: background-color 0.3s ease;
    </style>
</head>

<body>
    
    <?php
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $sql = "SELECT patientID, Surname, Forename, Gender FROM patients";
        $result = $conn->query($sql);

       
        if ($result === false) {
            die("Error executing the query: " . $conn->error);
        }

        while ($row = $result->fetch_assoc()) {
        echo "PatientID: " . $row['patientID'] . "<br>";
        echo "PatientSurname: " . $row['Surname'] . "<br>";
        echo "PatientForename: " . $row['Forename'] . "<br>";
        echo "PatientGender: " . $row['Gender'] . "<br>";
        echo "--------------------------<br>";
        }
    }

  
    $conn->close();
    ?>

    <form action="" method="post">
        <button type="submit">Extract Data</button>
        <a href="http://localhost/hello/switchboard.php" class="back-button">Back to Switchboard</a>
    </form>

</body>

</html>
