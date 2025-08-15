<?php
session_start();
include 'config.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$medicine = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $expiry_date = $_POST['expiry_date'];

    $query = "UPDATE products SET name='$name', price='$price', stock='$stock', expiry_date='$expiry_date' WHERE id=$id";
    mysqli_query($conn, $query);

    header("Location: medicines.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medicine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Medicine</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Medicine Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $medicine['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $medicine['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="<?php echo $medicine['stock']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Expiry Date</label>
                <input type="date" name="expiry_date" class="form-control" value="<?php echo $medicine['expiry_date']; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Update Medicine</button>
            <a href="medicines.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
