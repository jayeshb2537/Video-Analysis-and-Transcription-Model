<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

    <h2>Welcome, Admin!</h2>

    <ul>
        <li><a href="admin_orders.php">Manage Orders</a></li>
        <li><a href="admin_products.php">Manage Products</a></li>
        <li><a href="admin_customers.php">Manage Customers</a></li>
        <li><a href="admin_logout.php">Logout</a></li>
    </ul>

</body>
</html>
