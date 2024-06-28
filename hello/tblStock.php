<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Inventory</title>
    <style>
        body {
            font-family: 'Verdana', sans-serif;
            background: url('med.webp');
            background-size: cover;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: white;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6); /* Adjust background color */
            border-radius: 8px;
            text-align: center;
        }
        h1 {
            color: white; /* Set text color to white */
            margin-top: 0; /* Remove default margin */
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #3399cc;
            color: white;
        }
        input[type="number"] {
            width: 70px;
            padding: 5px;
        }
        input[type="submit"] {
            background-color: #3399cc;
            color: white;
            border: none;
            padding: 10px 20px; /* Adjust button padding */
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px; /* Adjust button margin */
        }
        .back-button {
            background-color: #3399cc;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #267799;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Medicine Inventory</h1>
        <form action="" method="post">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>New Quantity</th>
                </tr>

                <?php
                // Connect to the database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "hospital";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch medicine data from database
                $sql = "SELECT * FROM medicine";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td><input type='number' name='new_quantity[" . $row["id"] . "]' value='0' min='0'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No medicines found</td></tr>";
                }
                $conn->close();
                ?>
            </table>
            <input type="submit" value="Update Quantities" name="updateQuantities">
        </form>
        
        <a href="http://localhost/hello/switchboard.php" class="back-button">Back to Switchboard</a>
        
        <?php
        if(isset($_POST['updateQuantities'])) {
            // Connect to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Update quantities in the database
            foreach ($_POST['new_quantity'] as $id => $quantity) {
                $sql = "UPDATE medicine SET quantity=$quantity WHERE id=$id";
                if ($conn->query($sql) !== TRUE) {
                    echo "Error updating record: " . $conn->error;
                }
            }
            echo "<script>alert('Quantities updated successfully');</script>";
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
