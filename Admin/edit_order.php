<?php
session_start();
include 'config.php';

$id = $_GET['id'];
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id=$id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];

    // Validate selected status before updating
    $valid_statuses = ['processed', 'shipped', 'enroute', 'arrived', 'cancelled'];
    if (in_array($status, $valid_statuses)) {
        $query = "UPDATE orders SET status='$status' WHERE id=$id";
        mysqli_query($conn, $query);
    }

    header("Location: orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Order Status</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Order Status</label>
                <select name="status" class="form-control" required>
                    <option value="processed" <?php echo ($order['status'] == 'processed') ? 'selected' : ''; ?>>Processed</option>
                    <option value="shipped" <?php echo ($order['status'] == 'shipped') ? 'selected' : ''; ?>>Shipped</option>
                    <option value="enroute" <?php echo ($order['status'] == 'enroute') ? 'selected' : ''; ?>>Enroute</option>
                    <option value="arrived" <?php echo ($order['status'] == 'arrived') ? 'selected' : ''; ?>>Arrived</option>
                    <option value="cancelled" <?php echo ($order['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Update Order</button>
            <a href="orders.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
