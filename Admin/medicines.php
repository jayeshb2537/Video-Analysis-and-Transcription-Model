<?php
session_start();
include 'config.php';

// Fetch all medicines
$medicines = mysqli_query($conn, "SELECT * FROM products");

// Add Medicine
if (isset($_POST['add_medicine'])) {
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    $query = "INSERT INTO medicines (name, stock, price) VALUES ('$name', '$stock', '$price')";
    mysqli_query($conn, $query);
    header("Location: medicines.php"); // Refresh page
    exit();
}

// Delete Medicine
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header("Location: medicines.php");
    exit();
}

    // Edit Medicine (Fetch Data)
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit_result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
        $edit_data = mysqli_fetch_assoc($edit_result);
    }

    // Update Medicine
    if (isset($_POST['update_medicine'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];

        mysqli_query($conn, "UPDATE products SET name='$name', stock='$stock', price='$price' WHERE id=$id");
        header("Location: medicines.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Medicines</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Medicines</h2>

        <!-- Add Medicine Form -->
        <form method="POST" class="mb-3">
            <input type="hidden" name="id" value="<?= isset($edit_data) ? $edit_data['id'] : '' ?>">
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" required value="<?= isset($edit_data) ? $edit_data['name'] : '' ?>">
            </div>
            <div class="mb-3">
                <label>Stock:</label>
                <input type="number" name="stock" class="form-control" required value="<?= isset($edit_data) ? $edit_data['stock'] : '' ?>">
            </div>
            <div class="mb-3">
                <label>Price:</label>
                <input type="number" step="0.01" name="price" class="form-control" required value="<?= isset($edit_data) ? $edit_data['price'] : '' ?>">
            </div>
            <?php if (isset($edit_data)): ?>
                <button type="submit" name="update_medicine" class="btn btn-warning">Update Medicine</button>
            <?php else: ?>
                <button type="submit" name="add_medicine" class="btn btn-success">Add Medicine</button>
            <?php endif; ?>
        </form>

        <!-- Medicine Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($medicines)): ?>
                    <tr>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['stock'] ?></td>
                        <td>$<?= number_format($row['price'], 2) ?></td>
                        <td>
                            <a href="medicines.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="medicines.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
