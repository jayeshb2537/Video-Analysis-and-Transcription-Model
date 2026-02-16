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

/* Styles for the Hero Section (About Us Page) */
.site-blocks-cover.inner-page {
    background-size: cover;
    background-position: center;
    padding: 120px 0; /* Adjust vertical padding for inner pages */
    text-align: center;
    color: #fff; /* White text for better contrast on image backgrounds */
    position: relative; /* For potential overlay or other absolute elements */
}

.site-blocks-cover.inner-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); /* Optional dark overlay for better text readability */
    z-index: 1; /* Ensure overlay is above the background image */
}

.site-blocks-cover.inner-page .container {
    position: relative; /* Ensure container content is above the overlay */
    z-index: 2;
}

.site-blocks-cover.inner-page .row {
    justify-content: center; /* Center the content horizontally */
}

.site-blocks-cover.inner-page .col-lg-7 {
    margin-left: auto;
    margin-right: auto; /* Center the column */
}

.site-blocks-cover.inner-page .align-self-center {
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 300px; /* Ensure some minimum height for alignment */
}

.site-blocks-cover.inner-page .text-center {
    text-align: center;
}

.site-blocks-cover.inner-page h1 {
    font-size: 3.5rem; /* Larger heading for emphasis */
    font-weight: bold;
    margin-bottom: 20px;
    line-height: 1.2; /* Improve line height for better readability of large text */
    text-shadow: 2px 2px 4px rgba(112, 93, 93, 0.6); /* Optional text shadow for better contrast */
}

.site-blocks-cover.inner-page p {
    font-size: 1.2rem;
    line-height: 1.8;
    max-width: 700px;
    margin: 0 auto;
    text-shadow: 1px 1px 2px rgba(60, 51, 51, 0.5); /* Optional text shadow for better contrast */
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .site-blocks-cover.inner-page {
        padding: 100px 0;
    }

    .site-blocks-cover.inner-page h1 {
        font-size: 3rem;
    }
}

@media (max-width: 768px) {
    .site-blocks-cover.inner-page {
        padding: 80px 0;
    }

    .site-blocks-cover.inner-page h1 {
        font-size: 2.5rem;
    }

    .site-blocks-cover.inner-page p {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .site-blocks-cover.inner-page h1 {
        font-size: 2rem;
    }
}



/*video */

 .site-section.bg-light.custom-border-bottom {
    padding: 60px 0;
    border-bottom: 1px rgb(229, 111, 111); /* Slightly lighter border */
    margin-bottom: 50px; /* Increased bottom margin for more separation */
}

.container {
    max-width: 1140px; /* Standard Bootstrap container width */
    margin: 0 auto;
    padding: 0 20px;
}
.order-md-2 {
    order: 2; /* Swap order for the second section on medium and larger screens */
}

.mr-auto {
    margin-right: auto; /* Push the element to the left */
}
.block-16 {
    position: relative;
    overflow: hidden;
    border-radius: 8px; /* Slightly rounded corners for the image */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.82); /* Subtle shadow for visual lift */
}

.block-16 img {
    display: block;
    width: 100%;
    height: auto;
    border-radius: inherit; /* Ensure image inherits rounded corners */
    transition: transform 0.3s ease-in-out; /* Smooth hover effect */
}
.block-16:hover img {
    transform: scale(1.05); /* Slight zoom on hover */
}



.site-section-heading {
    padding-top: 1rem; /* Adjust top padding */
    margin-bottom: 2rem; /* Increase bottom margin */
}

.site-section-heading h2 {
    font-size: 2.2rem; /* Slightly larger heading */
    color:rgb(213, 198, 213); /* Darker heading text */
    margin-bottom: 1rem;
    font-weight: 600; /* Semi-bold font weight */
}

.text-black {
    color: #333; /* Ensure paragraph text is dark */
    line-height: 1.7; /* Improved line height for readability */
}


/* Styles for the "Medicare Operation Team" section */
.operation-team-section {
    padding: 60px 0;
    background-color:rgba(46, 196, 213, 0.94); /* Light gray background */
    border-bottom: 1px rgba(224, 147, 147, 0.9); /* Light bottom border */
}

.operation-team-container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 20px;
}

.operation-team-heading-row {
    margin-bottom: 40px;
}

.operation-team-heading {
    text-align: center;
    padding-top: 1rem;
}

.operation-team-heading h2 {
    font-size: 2.8rem;
    color:rgb(111, 162, 212); /* Dark heading text */
    margin-bottom: 15px;
    font-weight: 700; /* Stronger font weight */
    letter-spacing: -0.8px;
}

.team-members-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center team member cards */
}

.team-member-column {
    flex: 0 0 50%; /* Two columns on medium and larger screens */
    max-width: 50%;
    padding: 0 15px;
    margin-bottom: 40px; /* Spacing between team members */
}

.team-member-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(29, 28, 28, 0.64);
    padding: 30px;
    text-align: center;
    transition: transform 0.2s ease-in-out;
}

.team-member-card:hover {
    transform: translateY(-5px); /* Slight lift on hover */
}

.team-member-image-container {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 20px auto;
    box-shadow: 0 2px 4px rgba(28, 26, 26, 0.82);
}

.team-member-image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.team-member-header h3 {
    font-size: 1.5rem;
    color:rgb(27, 29, 30); /* Darker name text */
    margin-bottom: 8px;
    font-weight: 600;
}

.team-member-header p {
    font-size: 1rem;
    color: #6c757d; /* Gray subheading text */
    margin-bottom: 0;
    line-height: 1.5;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .team-member-column {
        flex: 0 0 50%;
        max-width: 50%;
        margin-bottom: 30px;
    }
}

@media (max-width: 768px) {
    .team-member-column {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 30px;
    }
    .operation-team-heading h2 {
        font-size: 2.4rem;
    }
}


/* General styles for the section */
.site-section {
  padding: 50px 0; /* Adjust vertical padding as needed */
}

.custom-border-bottom {
  border-bottom: 1px solid #eee; /* Light grey bottom border */
  padding-bottom: 30px; /* Add some space below the border */
  margin-bottom: 30px; /* Add margin below the section */
}

.site-section-heading {
  margin-bottom: 30px;
}

.site-section-heading h2 {
  font-size: 2.5rem; /* Adjust heading size */
  color: #333; /* Dark grey heading text */
  font-weight: bold;
  margin-bottom: 15px;
}

/* Styles for the individual team member blocks (cards) */
.block-38 {
  background-color: #fff; /* White background for the card */
  border-radius: 8px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); /* Subtle shadow for depth */
  padding: 20px;
  transition: transform 0.3s ease-in-out; /* Smooth hover effect */
}

.block-38:hover {
  transform: translateY(-5px); /* সামান্য উপরে উঠে আসার ইফেক্ট */
  box-shadow: 0 8px 16px rgba(56, 47, 47, 0.1); /* Slightly stronger shadow on hover */
}

.block-38-img {
  margin-bottom: 20px;
}

.block-38-img img {
  width: 120px; /* Adjust image size */
  height: 120px;
  border-radius: 50%; /* Circular image */
  object-fit: cover; /* Ensure the image covers the circle */
  margin-bottom: 15px;
}

.block-38-header h3 {
  font-size: 1.5rem; /* Adjust name size */
  color: #555; /* Slightly lighter text for names */
  font-weight: bold;
  margin-bottom: 5px;
}

.block-38-header p {
  font-size: 0.9rem; /* Adjust subheading size */
  color: #777; /* Grey text for subheadings */
  line-height: 1.6;
}

/* Responsive adjustments for smaller screens */
@media (max-width: 767.98px) {
  .col-md-6 {
    margin-bottom: 30px; /* Add more space between cards on smaller screens */
  }
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
                <li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
              <li><a href="shop.php">Store</a></li>
                <!-- <li><a href="track_order.php">Track Order</a></li> -->
                <li class="nav-item active"><a href="about.php">About</a></li>
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


    <div class="site-blocks-cover inner-page" style="background-image: url('images/home.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto align-self-center">
            <div class=" text-center">
              <h1>About Us</h1>
              <p>Welcome to Medicare , your trusted health partner. We provide high-quality medications, expert advice, and exceptional service to meet all your healthcare needs.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light custom-border-bottom" data-aos="fade">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6">
            <div class="block-16">
              <figure>
                <img src="uploads/Pharmacy_video1.jpg" alt="Image placeholder" class="img-fluid rounded">
                <a href="uploads/Pharmacy_video.mp4" class="play-button popup-vimeo"><span
                    class="icon-play"></span></a>
    
              </figure>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-5">
    
    
            <div class="site-section-heading pt-3 mb-4">
              <h2 class="text-black">Health & Wealth Advisors</h2>
            </div>
            <p>At Health & Wealth Advisors, we understand that health and wealth are intertwined. The health decisions you make today 
              can have a profound impact on your future financial security, just as your financial situation can directly affect your 
              access to healthcare. Our mission is to empower you with the tools, knowledge, and expert guidance to make informed 
              decisions about both your health and your wealth. </p>
            <p>Whether you are preparing for retirement, managing a chronic condition, or planning for unexpected medical expenses, 
              we provide tailored solutions that ensure you achieve optimal health while securing your financial future.</p>
    
          </div>
        </div>
      </div>
    </div>

    

    <div class="site-section bg-light custom-border-bottom" data-aos="fade">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6 order-md-2">
            <div class="block-16">
              <figure>
                <img src="uploads/Pharmacy_video2.jpg" alt="Image placeholder" class="img-fluid rounded">
                <a href="uploads/Pharmacy_video2.mp4" class="play-button popup-vimeo"><span
                    class="icon-play"></span></a>
    
              </figure>
            </div>
          </div>
          <div class="col-md-5 mr-auto">
    
    
            <div class="site-section-heading pt-3 mb-4">
              <h2 class="text-black">We Are Trusted Company</h2>
            </div>
            <p class="text-black">At Medicare , trust is at the heart of everything we do. With years of
              experience serving our community, we are proud to be your go-to pharmacy for not only prescription 
              medications but also expert healthcare advice and personalized service. We understand that when it 
              comes to your health, you need a pharmacy you can rely on — and that's exactly what we provide.</p>
    
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section site-section-sm site-blocks-1 border-0" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="icon-truck text-primary"></span>
            </div>
            <div class="text">
              <h2>Free Shipping</h2>
              <p>At Medicare , we offer FREE SHIPPING on all orders, delivering your medications safely to your doorstep for your convenience. 🚚💊</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
            <div class="icon mr-4 align-self-start">
              <span class="icon-refresh2 text-primary"></span>
            </div>
            <div class="text">
              <h2>Free Returns</h2>
              <p>At Medicare , we offer FREE RETURNS on eligible products for a hassle-free shopping experience. 🔄💊</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
            <div class="icon mr-4 align-self-start">
              <span class="icon-help text-primary"></span>
            </div>
            <div class="text">
              <h2>Customer Support</h2>
              <p>At Medicare , our 24/7 customer support is here to assist with orders, prescriptions, and inquiries. 📞💊</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    

    <div class="site-section bg-light custom-border-bottom" data-aos="fade">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Medicare Operation Team</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-6 mb-5">
    
            <div class="block-38 text-center">
              <div class="block-38-img">
                <div class="block-38-header">
                  <img src="uploads/Jayesh.jpg" alt="Image placeholder" class="mb-4">
                  <h3 class="block-38-heading h4">Jayesh Borase</h3>
                  <p class="block-38-subheading">CEO/Co-Founder <br> Backend Developer <br> Project Manager</p>
                </div>
               
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 mb-5">
            <div class="block-38 text-center">
              <div class="block-38-img">
                <div class="block-38-header">
                  <img src="uploads/Raghu.jpg" alt="Image placeholder" class="mb-4">
                  <h3 class="block-38-heading h4">Chetan Borse</h3>
                  <p class="block-38-subheading">Co-Founder <br>Documentation Expert <br> Logo Designer</p>
                </div>
               
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 mb-5">
            <div class="block-38 text-center">
              <div class="block-38-img">
                <div class="block-38-header">
                  <img src="uploads/Prakash.jpg" alt="Image placeholder" class="mb-4">
                  <h3 class="block-38-heading h4">Prakash Nikam</h3>
                  <p class="block-38-subheading">Marketing <br> UI/UX Designer <br> Product Manager</p>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 mb-5">
            <div class="block-38 text-center">
              <div class="block-38-img">
                <div class="block-38-header">
                  <img src="uploads/vedika.jpg" alt="Image placeholder" class="mb-4">
                  <h3 class="block-38-heading h4">Vedika Shirbhate</h3>
                  <p class="block-38-subheading">Sales Manager <br> Content Expert <br> UI/UX Designer</p>
                </div>
                
              </div>
            </div>
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
                <li class="address">60-B Madhuram HUb,Udhana Road,Surat</li>
                <li class="phone"><a href="tel://23923929210">+91 6355537353</a></li>
                <li class="email">jayeshborase200537@gmail.com</li>
              </ul>
            </div>
          </div>

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

  <script src="js/main.js"></script>

</body>
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
</html>

