<?php
include 'config.php'; // Database Connection

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id']; // Order ID received from form
    $payment_status = 'confirmed'; // Payment confirmed status

    // Update order status (Replace `order_id` with `id`)
    $sql = "UPDATE orders SET status='$payment_status' WHERE id='$order_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Payment Verified Successfully!'); window.location='orders.php';</script>";
    } else {
        echo "<script>alert('Error verifying payment!'); window.location='orders.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location='orders.php';</script>";
}
?>
