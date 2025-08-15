<?php
include 'config.php'; // Include your database connection file

if (isset($_POST['track_order'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']); // Prevent SQL injection

    // Fetch order details
    $query = "SELECT * FROM orders WHERE id = '$order_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
        $status = $order['status'];
    } else {
        $error = "Order not found. Please check your Order ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Medicare &mdash;  Track Your Order</title>
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
  
  <!-- Owl Carousel CSS -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<!-- jQuery (Required for Owl Carousel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">
    
</head>


<style>
.owl-nav {
    display: none !important;
}
.swiper-button-next, .swiper-button-prev {
    display: none !important;
  
}



  /* Fix Bootstrap affecting other sections */
.navbar, .footer, .hero-section {
    width: 100%;
    max-width: 100%;
}

/* Fix unwanted Bootstrap padding/margins */
.container {
    padding-left: 15px;
    padding-right: 15px;
}

/* Ensure only Popular Products uses Bootstrap grid */
.popular-products .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
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
    .js-logo-clone{
  
    background: transparent; /* Ensure transparency */
}

  
   
</style>
<style>
        /* General Styles */
body {
    font-family: 'Rubik', sans-serif;
    background-color: #f8f9fa;
    text-align: center;
    margin: 0;
    padding: 0;
}

/* Order Tracking Section */
.order-tracking {
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 500px;
    margin: 50px auto;
}

.order-tracking h2 {
    font-size: 22px;
    color: #333;
    margin-bottom: 20px;
}

.order-tracking input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
    font-size: 16px;
}

.order-tracking button {
    width: 100%;
    padding: 12px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.order-tracking button:hover {
    background-color: #218838;
}

.status {
    font-size: 18px;
    font-weight: bold;
    color: #007bff;
    margin-top: 15px;
}

.error {
    font-size: 16px;
    color: red;
    margin-top: 15px;
}

.status-list {
    margin-top: 20px;
    text-align: left;
    color: #555;
    font-size: 14px;
}

.status-list p {
    background: #f1f1f1;
    padding: 10px;
    border-radius: 5px;
    margin: 5px 0;
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
              <li><a href="shop.php">Store</a></li>
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
    
</head>
<body>
    <div class="order-tracking">
        <h2>Track Your Order</h2>
        <form method="post">
            <input type="text" name="order_id" placeholder="Enter Order ID" required>
            <br><br>
            <button type="submit" name="track_order">Track</button>
        </form>

        <?php if (isset($status)) { ?>
            <p class="status">Current Status: <?= htmlspecialchars($status) ?></p>
        <?php } ?>
        <br><br>
        <div class="status-list">
            <p><strong>Order Status Descriptions:</strong></p>
            <p>Processing (Order received)</p>
            <p>Shipped (Order dispatched)</p>
            <p>Enroute (On the way)</p>
            <p>Arrived (Successfully delivered)</p>
            <p>Cancelled (Order Cancelled)</p>
        </div>

        <?php if (isset($error)) { ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php } ?>
    </div>

    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
              <div class="banner-1-inner align-self-center">
                <h2>Pharma Products</h2>
                <p>Pharmaceutical products are substances designed to diagnose, treat, or prevent diseases and they are crucial for modern healthcare, undergoing strict regulation for safety.
                </p>
              </div>
            </a>
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
              <div class="banner-1-inner ml-auto  align-self-center">
                <h2>Rated by Experts</h2>
                <p>This signifies that product reviews or information have been evaluated by qualified professionals, such as pharmacists or medical experts.
                </p>
              </div>
            </a>
          </div>
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
</body>
</html>