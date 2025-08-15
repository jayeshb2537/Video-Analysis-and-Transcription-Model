<?php
session_start();
include_once __DIR__ . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : ''; 
    $password = $_POST['password'];

    // Hardcoded admin credentials (change these for security)
    $admin_user = "admin";
    $admin_pass = "admin123";

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_orders.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Login</title>
    <link rel="stylesheet" href="style3.css">   
</head>
<body>
    <div class="wrapper">
        <form method="POST">
            <h2>Admin Login</h2>
            <div class="input-box">
              <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-box">
              <input type="password" placeholder="Password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>    
</body>
</html>

