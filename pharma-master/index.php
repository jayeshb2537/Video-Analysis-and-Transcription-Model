<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Medicare &mdash;  Online Medical shop</title>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<!-- jQuery (Required for Owl Carousel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">
    
</head>
 <style>

 /* Hero Section (Same as before, ensuring consistency) */
 .site-blocks-cover {
    background-size: cover;
    background-position: center;
    padding: 10rem 0;
    text-align: center;
    color: #fff;
    position: relative;
}

.site-blocks-cover::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.site-block-cover-content {
    position: relative;
    z-index: 1;
}

.site-block-cover-content h2.sub-title {
    color: #fff;
    font-size: 1rem;
    margin-bottom: 0.75rem;
    font-style: italic;
    opacity: 0.8;
}

.site-block-cover-content h1 {
    color:rgb(238, 236, 133) !important;
    font-size: 4rem;
    margin-bottom: 1.5rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    letter-spacing: 0.05em;
}

.site-block-cover-content p a.btn {
    background-color:rgba(248, 75, 202, 0.77);
    color: white;
    border: none;
    border-radius: 5px;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease-in-out;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
}

.site-block-cover-content p a.btn:hover {
    background-color: rgba(248, 75, 202, 0.77);
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.site-blocks-cover .container {
    max-width: 1200px;
    margin: 0 auto;
    padding-left: 15px;
    padding-right: 15px;
}

.site-blocks-cover .row {
    display: flex;
    justify-content: center;
}

.site-blocks-cover .col-lg-7 {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.site-blocks-cover .align-self-center {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Banner Section */
.site-section {
    padding: 4rem 0;
}

.site-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding-left: 15px;
    padding-right: 15px;
}

.section-overlap {
    margin-top: -5rem; /* Adjust to control overlap */
    position: relative;
    z-index: 2;
}

.section-overlap .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center banners on smaller screens */
}

.col-md-6 {
    flex-basis: calc(50% - 1rem); /* Two columns on medium screens with some gap */
    margin-bottom: 1rem;
}

.col-lg-4 {
    flex-basis: calc(33.33% - 1rem); /* Three columns on large screens with some gap */
    margin-bottom: 2rem; /* More margin for spacing on larger screens */
}

/* Ensure last item in a row doesn't have extra right margin */
.row > .col-md-6:nth-child(odd) {
    margin-right: 1rem;
}

.row > .col-lg-4:not(:last-child) {
    margin-right: 1rem;
}

.banner-wrap {
    background-color:rgb(178, 244, 158);
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    padding: 2rem;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%; /* Make banners the same height */
}

.banner-wrap:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.banner-wrap a {
    display: block;
    color: inherit;
    text-decoration: none; /* Prevent default link underline */
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.banner-wrap h5 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: #333;
    line-height: 1.2;
}

.banner-wrap p {
    font-size: 0.9rem;
    color:rgb(167, 197, 222);
    margin-bottom: 0;
    line-height: 1.6;
}

.banner-wrap strong {
    font-weight: bold;
    color: #212529; /* Slightly darker emphasis */
}

.banner-wrap.bg-primary {
    background-color:rgba(169, 235, 244, 0.92);
    color: white;
}

.banner-wrap.bg-primary h5,
.banner-wrap.bg-primary p,
.banner-wrap.bg-primary a {
    color: white;
}

.banner-wrap.bg-warning {
    background-color:rgb(251, 134, 226);
    color: #333;
}

.banner-wrap.bg-warning h5,
.banner-wrap.bg-warning p,
.banner-wrap.bg-warning a {
    color: #333;
}
</style> 

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
                <li class="nav-item active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
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

    <div class="site-blocks-cover" style="background-image: url('images/home.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
            <div class="site-block-cover-content text-center">
              <h2 class="sub-title">Effective Medicine, New Medicine Everyday</h2>
              <h1 style="color:#ff8c00;" class>Welcome To Pharma</h1>
              <p>
                <a href="shop.php" class="btn btn-primary px-5 py-3">Shop Now</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row align-items-stretch section-overlap">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="banner-wrap bg-primary h-100">
              <a href="free_shipping.php" class="h-100">
              <h5>Free <br> Shipping</h5>
              <p>
                Simple and Direct
                <strong>Free Shipping on All Orders! Get your medicines delivered to your doorstep at no extra cost.</strong>
                </p>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="banner-wrap h-100">
              <a href="season_sale.php" class="h-100">
                <h5>Season <br> Sale 50% Off</h5>
                <p>
                  Limited offer in each season 
                  <strong>Flat 50% Off! Stock up on medicines & health essentials at half the price. Limited time only! 🎉💊</strong>
                </p>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="banner-wrap bg-warning h-100">
              <a href="gift_card.php" class="h-100">
                <h5>Buy <br> A Gift Card</h5>
                <p>
                  Medicare Gift Card
                  <strong>You can buy gift card for discount in purchase of any medicine or product.</strong> 
                </p>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- / -->
          <?php
include 'config.php';

// Fetch products from the database
$stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 8");
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Start of Popular Products Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Popular Products</h2>
    <div class="row">
        <?php
        include 'config.php';
        $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 8");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center shadow-sm">
                    <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text text-danger">₹<?php echo number_format($row['price'], 2); ?></p>
                        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- End of Popular Products Section -->
        </div>
        
        


        <div class="row mt-5">
          <div class="col-12 text-center">
            <a href="shop.php" class="btn btn-primary px-4 py-3">View All Products</a>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5">
    <h2 class="text-center mb-4">New Products</h2>
    <div class="owl-carousel owl-theme">
        <?php
        include 'config.php';
        $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 10");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="item">
                <div class="card shadow">
                    <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text text-danger">₹<?php echo number_format($row['price'], 2); ?></p>
                        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>


    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">Testimonials</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 block-3 products-wrap">
            <div class="nonloop-block-3 no-direction owl-carousel">
        
              <div class="testimony">
                <blockquote>
                  <img src="uploads/Amit.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                  <p>"Fast delivery and genuine medicines! I ordered my prescription online, and it arrived quickly. The packaging was secure, and the products were 100% authentic. Highly recommended!</p>
                </blockquote>

                <p>&mdash; Amit Sharma</p>
              </div>
        
              <div class="testimony">
                <blockquote>
                  <img src="uploads/Priya.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                  <p>"Great customer support!" I had some queries about my medication, and the support team was super helpful. They guided me through the entire process. Excellent service!</p>
                </blockquote>
              
                <p>&mdash; Priya Mehta</p>
              </div>
        
              <div class="testimony">
                <blockquote>
                  <img src="uploads/Rahul.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                  <p>"Affordable prices and easy ordering!" Compared to local stores, the prices here are very reasonable. Ordering was simple, and I received updates on my delivery. Will shop again!</p>
                </blockquote>
              
                <p>&mdash; Rahul Verma</p>
              </div>
        
              <div class="testimony">
                <blockquote>
                  <img src="uploads/Sneha.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                  <p>"Trustworthy and reliable!" This is my go-to online pharmacy. The medicines are always genuine, and the service is top-notch. I never worry about my health needs anymore!</p>
                </blockquote>
              
                <p>&mdash; Sneha Kapoor</p>
              </div>
        
            </div>
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
              <script>document.write(new Date().getFullYear());</script> All rights reserved <i class="icon-heart" aria-hidden="true"></i> by <a href="#" target="_blank"
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

  <!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

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

</body>

</html>