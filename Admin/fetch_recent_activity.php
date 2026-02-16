<?php
include __DIR__ . '/db_connect.php'; // Ensure correct path

header('Content-Type: application/json');

$query = "
    (SELECT id, 'New Order' AS activity_type, created_at FROM orders ORDER BY created_at DESC LIMIT 5)
    UNION
    (SELECT id, 'Payment Received' AS activity_type, created_at FROM payments ORDER BY created_at DESC LIMIT 5)
    UNION
    (SELECT id, 'New User' AS activity_type, created_at FROM users ORDER BY created_at DESC LIMIT 5)
    ORDER BY created_at DESC
    LIMIT 10";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(["error" => mysqli_error($conn)]);
    exit;
}

$activities = [];
while ($row = mysqli_fetch_assoc($result)) {
    $activities[] = $row;
}

echo json_encode($activities);
?>
