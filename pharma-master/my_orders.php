<?php
session_start();
include "config/db_connect.php";

// Check login
if (!isset($_SESSION['user_id'])) {
    echo "Please login first.";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch orders using user ID (not email)
$order_sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$order_stmt = $conn->prepare($order_sql);
$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #fff;
            margin: 0;
            padding: 40px;
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background-color: #13efef;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            color: #fff;
            font-weight: bold;
            font-size: 16px;
        }

        td {
            font-size: 15px;
            color: #333;
            border-bottom: 1px solid #eee;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .track-btn {
            background-color: #13efef;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>

<h2>My Orders</h2>

<?php if ($order_result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Payment Mode</th>
                <th>Email Used</th>
                <th>Track</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($order = $order_result->fetch_assoc()): ?>
            <tr>
                <td>#<?php echo $order['id']; ?></td>
                <td>₹<?php echo $order['total_price']; ?></td>
                <td><?php echo $order['status']; ?></td>
                <td><?php echo $order['created_at']; ?></td>
                <td><?php echo $order['payment_mode']; ?></td>
                <td><?php echo $order['email']; ?></td>
                <td>
                    <form method="GET" action="track_order1.php">
                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                        <button type="submit" class="track-btn">Track Order</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>You have no orders yet.</p>
<?php endif; ?>

</body>
</html>