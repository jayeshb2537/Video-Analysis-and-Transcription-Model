<?php
session_start();
include_once __DIR__ . '/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Fetch orders from the database
$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 5px; }
        .btn-update { background: green; }
        .btn-delete { background: red; }
    </style>
</head>
<body>

    <h2>Admin Orders</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>₹<?php echo $row['total_price']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="update_order.php?id=<?php echo $row['id']; ?>" class="btn btn-update">Update</a>
                <a href="delete_order.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="admin_logout.php">Logout</a>
    <br>
    <a href="admin_add_product.php">Add Products</a>


</body>
</html>
