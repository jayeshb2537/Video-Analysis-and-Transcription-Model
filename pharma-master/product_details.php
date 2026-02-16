<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'pharmacy_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from URL safely
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Secure Query to Fetch Product Details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .main-wrap {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #a8dadc;
        }
        .main-wrap .product {
            width: 90%;
            max-width: 750px;
            display: flex;
        }   
        .image-gallery {
            flex-basis: 30%;
            background: #011627;    
            box-shadow: -10px 5px 10px rgba(0, 0, 0, 0.1);
            transform: scale(1.07);
            position: relative;
        }
        .image-gallery img {
            width: 100%;
            padding-top: 50px;
        }
        .image-gallery .controls {
            position: absolute;
            bottom: 20px;
            right: 10px;
        }
        .image-gallery .controls .btn {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            display: inline-block;
            margin: 5px;
            cursor: pointer;
        }
        .image-gallery .controls .btn.active {
            background: #00b4d8;
        }
        .product-details {
            flex-basis: 70%;
            background: #fff;
            box-shadow: -10px 5px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        .product-details h2 {
            font-size: 25px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .product-description p {
            font-size: 14px;
            color: #555;
        }
        .product-price {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }
        .product-price .price-original {
            text-decoration: line-through;
            color: red;
        }
        .quantity {
            margin-top: 10px;
        }
        .sub-btn {
            margin-top: 20px;
        }
        .sub-btn a {
            text-decoration: none;
            background: #00b4d8;
            padding: 10px 20px;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section class="main-wrap">
        <div class="product">
            <!-- Product Image -->
            <div class="image-gallery">
                <img id="productImg" src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="controls">
                    <span class="btn active" onclick="changeImage('uploads/<?php echo $product['image']; ?>')"></span>
                    <span class="btn" onclick="changeImage('uploads/insulin_injection.jpg')"></span>
                    <span class="btn" onclick="changeImage('uploads/<?php echo $product['image']; ?>')"></span>
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="product-details">
                <h2 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h2>
                <div class="product-description">
                    <p><?php echo htmlspecialchars($product['big_description']); ?></p>
                </div>
                <div class="product-price">
                    <span class="price-original">₹<?php echo number_format($product['price'], 2); ?></span>
                    <span class="price-discounted">₹<?php echo number_format($product['discounted_price'], 2); ?></span>
                </div>
                <div class="quantity">
    <!-- <h3>Quantity:</h3>
    <input type="number" name="quantity" value="1" min="1">
</div> -->
<!-- <div class="sub-btn">
    <a href="cart.php?add=<?php echo $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
</div> -->

                <div class="sub-btn">
                    <a href="cart.php?add=<?php echo $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Prevent Negative Quantity
        document.querySelector('input[name="quantity"]').addEventListener('input', function () {
            if (this.value < 1) {
                this.value = 1;
            }
        });

        // Image Gallery Switching
        function changeImage(src) {
            document.getElementById('productImg').src = src;
            let buttons = document.querySelectorAll('.btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
        }
    </script>
</body>
</html>
