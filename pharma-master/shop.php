<?php
session_start();
include "config/db_connect.php"; // Include database connection

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<?php
include_once "config.php"; // Database connection

$result = $conn->query("SELECT * FROM products");
?>
<?php
include 'config.php';

$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : 10000; // Default max price

$stmt = $conn->prepare("SELECT * FROM products WHERE price BETWEEN ? AND ?");
$stmt->bind_param("ii", $min_price, $max_price);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shop - Pharmacy</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  
  <!-- Favicons -->
  <link href="uploads/Medicare.png" rel="icon">
  <link href="uploads/medicare.png" rel="apple-touch-icon">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>
<style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            transition: 0.3s;
        }
        .product-card:hover {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .product-card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }
        .product-card h5 {
            margin-top: 10px;
            font-size: 18px;
        }
        .product-card p {
            font-size: 14px;
            color: #666;
        }
        .product-card .price {
            font-size: 18px;
            font-weight: bold;
            color: #27ae60;
        }
        .search-container {
        position: relative;
        display: inline-block;
    }
    
    .search-icon {
        font-size: 24px;
        cursor: pointer;
    }

    .search-box {
        display: none;
        position: absolute;
        top: 30px;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        padding: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .search-box input {
        border: none;
        outline: none;
        padding: 5px;
        width: 200px;
    }
    </style>
<body>

  <div class="site-wrap">


    <div class="site-navbar py-2">

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="index.php" class="js-logo-clone"><img src="uploads/Medicare.png" alt="logo"  style="element.style width: 100px;height: 100px;}"></a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
              <li class="nav-item active"><a href="shop.php">Store</a></li>
                <!-- <li><a href="track_order.php">Track Order</a></li> -->
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <!-- <li><a href="#">Diet &amp; Nutrition</a></li>
                <li><a href="#">Tea &amp; Coffee</a></li> -->
                <?php if (isset($_SESSION["user_id"])): ?>
                  <li class="has-children">
                    <a href="#"> (<?php echo $_SESSION["user_name"]; ?>)</a>
                    <ul class="dropdown">
                      <li><a href="my_orders.php">My Order</a></li>
                      <li><a href="profile.php">My Profile</a></li>
                      <li><a href="logout.php">Logout (<?php echo $_SESSION["user_name"]; ?>)</a></li>
                      <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                      <!-- <li class="has-children">
                      <a href="#">Vitamins</a>
                      <ul class="dropdown">
                        <li><a href="#">Supplements</a></li>
                        <li><a href="#">Vitamins</a></li>
                        <li><a href="#">Diet &amp; Nutrition</a></li>
                        <li><a href="#">Tea &amp; Coffee</a></li> -->
                      
                    </li>
                    </ul>

                

                
            <?php endif; ?>
              </ul>
            </nav>
          </div>
          <div class="search-container">
    <span class="search-icon" onclick="toggleSearch()"><a>
    <img src="uploads/text.png" alt="Search" style="height: 20px;">
</a>
</span>
    <div class="search-box" id="searchBox">
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Search for products..." required>
            <button type="submit">Submit</button>
        </form>
    </div>
            <a href="cart.php" class="icons-btn d-inline-block bag"> 
            <svg class="icon-shopping-bag" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg>
              <!-- <span class="icon-shopping-bag"></span> -->
              <!-- <span class="number">2</span> -->
            </a>
            <!-- <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                class="icon-menu"></span></a> -->
          </div>
        </div>
      </div>
    </div>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Store</strong></div>
        </div>
      </div>
    </div>

    <!-- Filter by Price Form with Range Slider -->
    <form method="GET" action="" class="filter-form">
            <label>Min Price: ₹<span id="minPriceValue"><?php echo htmlspecialchars($min_price); ?></span></label>
            <input type="range" id="minPrice" name="min_price" min="0" max="1000" value="<?php echo htmlspecialchars($min_price); ?>" oninput="updateRangeValues()">
            <label>Max Price: ₹<span id="maxPriceValue"><?php echo htmlspecialchars($max_price); ?></span></label>
            <input type="range" id="maxPrice" name="max_price" min="0" max="1000" value="<?php echo htmlspecialchars($min_price); ?>" oninput="updateRangeValues()">

           
            <button type="submit">Filter</button>
        </form>
    <!-- <form method="GET" action="">
        <label>Min Price: </label>
        <input type="number" name="min_price" value="<?php echo $min_price; ?>" required>
        
        <label>Max Price: </label>
        <input type="number" name="max_price" value="<?php echo $max_price; ?>" required>
        
        <button type="submit">Filter</button>
    </form> -->
</div>
<div class="container mt-4">
        <h2 class="text-center">Our Products</h2>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-3 mb-4">
                    <div class="product-card">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Product Image">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text">₹<?php echo number_format($row['price'], 2); ?></p>
                            <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>      

    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

            <div class="block-7">
              <h3 class="footer-heading mb-4">About Us</h3>
              <p>Welcome to Medicare , your trusted health partner. We provide high-quality medications, expert advice, and exceptional service to meet all your healthcare needs.</p>
            </div>

          </div>
          <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4">Quick Links</h3>
            <ul class="list-unstyled">
            <li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
                <li><a href="shop.php">Store</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="track_order.php">Track Order</a></li>
            </ul>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">60-B Madhuram Hub,Udhana Road,Surat</li>
                <li class="phone"><a href="tel://23923929210">+91 6355537353</a></li>
                <li class="email">jayeshborase200537@gmail.com</li>
              </ul>
            </div>


          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;
              <script>document.write(new Date().getFullYear());</script> All rights reserved 
               <i class="icon-heart" aria-hidden="true"></i> by <a href="#" target="_blank"
                class="text-primary">Medicare</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>

        </div>
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

</body>
<script>
    $(document).ready(function(){
      $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,  // Disable next/prev arrows
    dots: true,  // Keep dots
    autoplay: true,
    autoplayTimeout: 5000,
    responsive: {
        0: { items: 1 },
        600: { items: 2 },
        1000: { items: 3 }
    }
});


    });
</script>
<script>
    function toggleSearch() {
        var searchBox = document.getElementById("searchBox");
        if (searchBox.style.display === "block") {
            searchBox.style.display = "none";
        } else {
            searchBox.style.display = "block";
        }
    }
</script>




  <script src="js/main.js"></script>
<script>
        function updateRangeValues() {
            document.getElementById('minPriceValue').innerText = document.getElementById('minPrice').value;
            document.getElementById('maxPriceValue').innerText = document.getElementById('maxPrice').value;
        }
</script>
</html>