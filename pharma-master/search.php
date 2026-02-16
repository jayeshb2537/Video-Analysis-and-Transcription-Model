<?php 
include 'config.php'; // Include database connection

if (isset($_GET['query'])) {
    $search = trim($_GET['query']);
    
    // SQL query to search products by name or description
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ?");
    $searchTerm = "%$search%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(121, 162, 205);
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 27%;
            height: 418px;
            object-fit: contain;
            border-radius: 8px;
            background: #fff;
            padding: 10px;
        }

        .product-card h3 {
            color: #333;
            font-size: 18px;
            margin: 10px 0;
        }

        .product-card p {
            font-size: 16px;
            color: #007bff;
            font-weight: bold;
        }

        .product-card a {
            display: inline-block;
            text-decoration: none;
            background: #28a745;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .product-card a:hover {
            background: #218838;
        }

        .no-results {
            font-size: 18px;
            color: #dc3545;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="product-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                        <h3><?php echo $row['name']; ?></h3>
                        <p>₹<?php echo $row['price']; ?></p>
                        <a href="product_details.php?id=<?php echo $row['id']; ?>">View Details</a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-results">No results found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
