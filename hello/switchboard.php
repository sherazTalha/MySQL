<?php
session_start();


if (!isset($_SESSION['role'])) {
    header('Location: http://localhost/hello/loginscreen.php');
    exit();
}


$role = $_SESSION['role'];


if ($role === 'hello' && basename($_SERVER['PHP_SELF']) === 'tblStaff.php') {
    header('Location: http://localhost/hello/switchboard.php?error=access_denied');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
</head>
    <style>
        body {
            font-family: 'Verdana', sans-serif;
        background: url('hospital.jpg');
        background-size: cover;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        }

        #switchboard-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            width: 600px; /* Increased width to accommodate button text */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase; /* Convert to uppercase */
            font-size: 24px; /* Increased font size */
            margin-top: 0; /* Remove top margin */
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 15px 40px; /* Adjusted padding */
            font-size: 16px; /* Adjusted font size */
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 10px; /* Added margin */
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            color: red;
            margin-top: 10px;
        }
    </style>
<body>
    <?php
    
    if (isset($_GET['error']) && $_GET['error'] === 'access_denied') {
        echo '<p style="color: red;">Access denied. You do not have permission to access this page.</p>';
    }
    ?>

    <div id="switchboard">
        <h2>Main Menu</h2>
        <button onclick="performAction(1)">Add Patient</button>
        <?php if ($role !== 'hello') : ?>
            <button onclick="performAction(2)">Staff Table</button>
            <button onclick="performAction(6)">Update Staff Details</button>
        <?php endif; ?>
        <button onclick="performAction(3)">Table Medicine</button>
        <button onclick="performAction(4)">Extract Patient Data</button>
        <button onclick="performAction(5)">Update Patient Details</button>
        <button onclick="performAction(7)">Logout</button>
    </div>

    <script>
        function performAction(option) {
            switch (option) {
                case 1:
                    alert("Opening Patients Table");
                    window.location.href = "http://localhost/hello/addNewPatient.php";
                    break;

                case 2:
                    alert("Opening Staff Table");
                    window.location.href = "http://localhost/hello/tblStaff.php";
                    break;

                case 3:
                    alert("Opening Medicine Table");
                    window.location.href = "http://localhost/hello/tblStock.php";
                    break;

                case 4:
                    alert("Opening Extraction Tab");
                    window.location.href = "http://localhost/hello/exdata.php";
                    break;
                    
                case 5:
                    alert("Opening Update Tab");
                    window.location.href = "http://localhost/hello/custup.php";
                    break;
                    
                case 6:
                    alert("Opening Staff Update Tab")
                    window.location.href = "http://localhost/hello/staffup.php";
                    break;
                    
                case 7:
                    alert("Logout");
                    window.location.href = "http://localhost/hello/loginscreen.php";
                    break;
                    
                default:
                    console.error("Invalid option");
            }
        }
    </script>
</body>

</html>