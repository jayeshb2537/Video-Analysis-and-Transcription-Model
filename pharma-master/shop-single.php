<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'pharmacy_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Fetch product details
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $product['name']; ?> - Pharma</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* ... (existing CSS) ... */

/* ... (existing CSS) ... */

.product-detail-image-zoom {
    position: absolute;
    /* Adjust these values to control the zoom area's size and position */
    width: 200px;
    height: 200px;
    border: 1px solid #ccc;
    overflow: hidden;
    display: none;
    pointer-events: none; /* Prevent zoom area from blocking mouse events */
    z-index: 10; /* Ensure it's on top */
}

.product-detail-image-zoom img {
    position: absolute;
    width: auto;
    height: auto;
    max-width: none; /* Allow image to be larger than zoom area */
    max-height: none;
    transform-origin: 0 0;
}

        /* --- Product Single Page Details Styles --- */
        .product-detail-info h1.product-title {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #222;
            font-weight: 500;
        }

        .product-detail-info .product-price {
            margin-bottom: 15px;
        }

        .product-detail-info .product-price .price-original {
            color: #777;
            text-decoration: line-through;
            font-size: 1.2rem;
            margin-right: 10px;
        }

        .product-detail-info .product-price .price-discounted {
            color: #B12704; /* Amazon's price color */
            font-size: 1.8rem;
            font-weight: bold;
        }

        .product-detail-info .product-description {
            color: #333;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .product-detail-info .product-variants {
            margin-bottom: 20px;
        }

        .product-detail-info .product-variants label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .product-detail-info .product-variants button {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            margin-right: 5px;
            transition: background-color 0.2s ease;
        }

        .product-detail-info .product-variants button.active {
            background-color: #e0e0e0;
            border-color: #bbb;
        }

        .product-detail-info .product-variants button:hover {
            background-color: #e0e0e0;
        }

        .product-detail-info .product-options {}

        .product-detail-info .quantity-wrapper {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .product-detail-info .quantity-wrapper label {
            margin-right: 15px;
            font-weight: bold;
            color: #333;
        }

        .product-detail-info .quantity-wrapper .quantity-input {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
        }

        .product-detail-info .quantity-wrapper .quantity-button {
            background-color: #f0f0f0;
            color: #333;
            border: none;
            padding: 8px 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.2s ease;
        }

        .product-detail-info .quantity-wrapper .quantity-button:hover {
            background-color: #e0e0e0;
        }

        .product-detail-info .quantity-wrapper .quantity-input .qty {
            width: 50px;
            padding: 8px;
            border: none;
            text-align: center;
            font-size: 1rem;
        }

        .product-detail-info .add-to-cart-buy-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .product-detail-info .add-to-cart-button {
            background-color: #FFD814; /* Amazon's add to cart color */
            color: #0F1111;
            border: 1px solid #A88734;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        .product-detail-info .add-to-cart-button:hover {
            background-color: #F7CA00;
        }

        .product-detail-info .buy-now-button {
            background-color: #FFA41C; /* Amazon's buy now color */
            color: #0F1111;
            border: 1px solid #A88734;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        .product-detail-info .buy-now-button:hover {
            background-color: #F08804;
        }

        .product-detail-info .product-meta {
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .product-detail-info .product-meta .meta-value {
            font-weight: bold;
            color: #333;
        }

        .product-full-details {
            margin-top: 30px;
            padding: 20px;
            border-top: 1px solid #eee;
        }

        .product-full-details h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #222;
        }
    </style>

</head>

<body>

    <div class="site-wrap">


        <div class="site-navbar py-2">

            <div class="search-wrap">
                <div class="container">
                    <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                    <form action="#" method="post">
                        <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <div class="site-logo">
                            <a href="index.html" class="js-logo-clone">Pharma</a>
                        </div>
                    </div>
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li class="active"><a href="index.html">Home</a></li>
                                <li><a href="shop.html">Store</a></li>
                                <li class="has-children">
                                    <a href="#">Dropdown</a>
                                    <ul class="dropdown">
                                        <li><a href="#">Supplements</a></li>
                                        <li class="has-children">
                                            <a href="#">Vitamins</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Supplements</a></li>
                                                <li><a href="#">Vitamins</a></li>
                                                <li><a href="#">Diet &amp; Nutrition</a></li>
                                                <li><a href="#">Tea &amp; Coffee</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Diet &amp; Nutrition</a></li>
                                        <li><a href="#">Tea &amp; Coffee</a></li>

                                    </ul>
                                </li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="icons">
                        <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                        <a href="cart.html" class="icons-btn d-inline-block bag">
                            <span class="icon-shopping-bag"></span>
                            <span class="number">2</span>
                        </a>
                        <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                                class="icon-menu"></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a
                            href="shop.html">Store</a> <span class="mx-2 mb-0">/</span> <strong
                            class="text-black"><?php echo $product['name']; ?></strong></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
            <div class="col-md-6">
    <div class="product-detail-image-container">
        <div class="product-detail-image-wrapper">
            <img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-detail-image img-fluid">
        </div>
    </div>
</div>
                <div class="col-md-6 product-detail-info">
                    <h1 class="product-title"><?php echo $product['name']; ?></h1>

                    <div class="product-price">
                        <span class="price-original">₹<?php echo number_format($product['price'], 2); ?></span>
                        <span class="price-discounted">₹<?php echo number_format($product['discounted_price'], 2); ?></span>
                    </div>

                    <div class="product-description">
                        <p><?php echo $product['description']; ?></p>
                    </div>

                    <?php if (isset($product['quantity_options']) && $product['quantity_options']): // More robust check ?>
                    <div class="product-variants">
                        <label>Quantity:</label>
                        <div>
                            <?php
                            $options = explode(',', $product['quantity_options']);
                            foreach ($options as $option):
                                $trimmed_option = trim($option);
                                if (!empty($trimmed_option)):
                            ?>
                                <button type="button" class="quantity-select" data-quantity="<?php echo htmlspecialchars($trimmed_option); ?>"><?php echo htmlspecialchars($trimmed_option); ?> Tablet</button>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="product-options">
                        <div class="quantity-wrapper">
                            <label for="quantity">Quantity:</label>
                            <div class="quantity-input">
                                <button type="button" class="quantity-button minus">-</button>
                                <input type="number" id="quantity" value="1" min="1" class="qty">
                                <button type="button" class="quantity-button plus">+</button>
                            </div>
                        </div>

                        <div class="add-to-cart-buy-buttons">
                            <button class="add-to-cart-button">Add to Cart</button>
                            <button class="buy-now-button">Buy Now</button>
                        </div>
                    </div>

                    <div class="product-meta">
                        SKU: <span class="meta-value"><?php echo isset($product['sku']) ? $product['sku'] : 'BTM0002'; ?></span><br>
                        Category: <span class="meta-value"><?php echo isset($product['category']) ? $product['category'] : 'Biotin Product'; ?></span>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 product-full-details">
                    <h2>Product Details</h2>
                    <p><?php echo isset($product['full_description']) ? $product['full_description'] : $product['description']; ?></p>
                </div>
            </div>

        </div>
    </div>

    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                        <div class="banner-1-inner align-self-center">
                            <h2>Pharma Products</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio
                                voluptatem.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
                        <div class="banner-1-inner ml-auto  align-self-center">
                            <h2>Rated by Experts</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio
                                voluptatem.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

                    <div class="block-7">
                        <h3 class="footer-heading mb-4">About Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis distinctio
                            volupt -->
                        </body>

                        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageContainer = document.querySelector('.product-detail-image-container');
        const imageWrapper = document.querySelector('.product-detail-image-wrapper');
        const originalImage = document.querySelector('.product-detail-image');

        if (imageContainer && originalImage) {
            const zoomDiv = document.createElement('div');
            zoomDiv.classList.add('product-detail-image-zoom');
            imageWrapper.appendChild(zoomDiv);

            const zoomImage = document.createElement('img');
            zoomImage.src = originalImage.src;
            zoomDiv.appendChild(zoomImage);

            imageContainer.addEventListener('mousemove', function(e) {
                const rect = imageContainer.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                // Calculate zoomed image position
                const zoomX = -x * 1.5; // Adjust zoom factor (1.5 = 300% zoom)
                const zoomY = -y * 1.5;

                zoomImage.style.transform = `translate(${zoomX}px, ${zoomY}px)`;

                // Position the zoom area
                zoomDiv.style.left = (x - zoomDiv.offsetWidth / 2) + 'px';
                zoomDiv.style.top = (y - zoomDiv.offsetHeight / 2) + 'px';

                zoomDiv.style.display = 'block'; // Show zoom
            });

            imageContainer.addEventListener('mouseleave', function() {
                zoomDiv.style.display = 'none'; // Hide zoom
            });
        }
    });
</script>
</html>