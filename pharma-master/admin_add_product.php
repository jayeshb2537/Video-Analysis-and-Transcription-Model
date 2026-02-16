<?php
session_start();
include_once "config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $category = trim($_POST['category']);
    $image = $_FILES['image']['name'];

    // Upload image
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, category, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $name, $description, $price, $category, $image);
    if ($stmt->execute()) {
        echo "✅ Product added successfully!";
    } else {
        echo "❌ Error adding product!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" required><br>
        
            <label>Description:</label>
            <textarea name="description" required></textarea><br>
        
        <label>Price:</label>
        <input type="number" step="0.01" name="price" required><br>
        
        <label>Category:</label>
        <input type="text" name="category" required><br>
        
        <label>Product Image:</label>
        <input type="file" name="image" required><br>
        
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
