<?php
// include 'db_connect.php'; Ensure this file exists

$query = "SELECT p.id, p.name, SUM(oi.quantity) AS total_sold
          FROM order_items oi
          JOIN products p ON oi.product_id = p.id
          GROUP BY p.id, p.name
          ORDER BY total_sold DESC
          LIMIT 5";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("SQL Query Failed: " . mysqli_error($conn));
}

// Check if data exists
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['total_sold']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No Data Found</td></tr>";
}
?>
