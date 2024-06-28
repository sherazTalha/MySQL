<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Log In</title>
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

    form {
        background-color: #f2f2f2;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        padding: 40px;
        text-align: center;
        width: 400px;
    }

    h1 {
        color: #333;
        margin-bottom: 30px;
        font-size: 24px;
    }

    label {
        display: block;
        margin: 15px 0 8px;
        color: #666;
    }

    input,
    select {
        width: 100%;
        padding: 12px;
        margin: 8px 0 20px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #ff6600;
        color: #fff;
        border: none;
        padding: 15px 25px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #cc5500;
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
    }

    .back-button:hover {
        background-color: #267799;
    }
</style>
    </head>
    
    <body>
<?php
session_start();

$adminUsername = "admin";
$adminPassword = "admin";

$helloUsername = "hello";
$helloPassword = "hello";

if (isset($_POST['submitPressed'])) {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    
    if ($enteredUsername === $adminUsername && $enteredPassword === $adminPassword) {
        $_SESSION['role'] = 'admin';
        header('Location: http://localhost/hello/switchboard.php');
        exit();
    } 
    
    elseif ($enteredUsername === $helloUsername && $enteredPassword === $helloPassword) {
        $_SESSION['role'] = 'hello';
        header('Location: http://localhost/hello/switchboard.php');
        exit();
    } else {
        
        $errorMessage = 'Invalid username or password. Try again.';
    }
}
?>


        <form action="" method="post">
            <h1>Log In</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Submit" name="submitPressed">
        </form>
    </body>

</html>