<?php
session_start();
include 'config.php';

// Fetch medicines for dropdown
$medicines = mysqli_query($conn, "SELECT * FROM PRODUCTS");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $medicine_id = $_POST['medicine_id'];
    $quantity = $_POST['quantity'];

    // Get medicine price
    $medicine = mysqli_fetch_assoc(mysqli_query($conn, "SELECT price FROM medicines WHERE id = $medicine_id"));
    $total_price = $medicine['price'] * $quantity;

    $query = "INSERT INTO orders (customer_name, medicine_id, quantity, total_price) VALUES ('$customer_name', '$medicine_id', '$quantity', '$total_price')";
    mysqli_query($conn, $query);

    header("Location: orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Order</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Medicine</label>
                <select name="medicine_id" class="form-control" required>
                    <option value="">Select Medicine</option>
                    <?php while ($row = mysqli_fetch_assoc($medicines)) { ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Order</button>
            <a href="orders.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
