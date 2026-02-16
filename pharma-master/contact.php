<?php
include 'config.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data retrieve karein
    $first_name = $_POST['c_fname'];
    $last_name = $_POST['c_lname'];
    $email = $_POST['c_email'];
    $subject = $_POST['c_subject'];
    $message = $_POST['c_message'];

    // Database connection check
    if ($conn) {
        // Data insert query
        $sql = "INSERT INTO contact_us (first_name, last_name, email, subject, message) 
                VALUES ('$first_name', '$last_name', '$email', '$subject', '$message')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Message Sent Successfully'); window.location.href='contact.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Database Connection Failed');</script>";
    }

    // Database connection close
    mysqli_close($conn);
}
?>


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
  /* Styles for the Offices Section (Primary Background) */
.site-section.bg-primary {
    background-color:rgba(99 113 120 / 76%) !important; /* Primary blue background */
    padding: 60px 0;
}

.site-section.bg-primary .container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 20px;
}

.site-section.bg-primary .container .row {
    display: flex;
    flex-wrap: wrap;
    margin-left: -15px; /* Adjust for container padding */
    margin-right: -15px; /* Adjust for container padding */
}

.site-section.bg-primary .container .row > .col-12,
.site-section.bg-primary .container .row > .col-lg-4 {
    padding-left: 15px;
    padding-right: 15px;
}

.site-section.bg-primary .container .row .col-12 {
    flex: 0 0 100%;
    max-width: 100%;
    text-align: center; /* Center the heading */
    margin-bottom: 30px; /* Space below the heading */
}

.site-section.bg-primary .container .row .col-12 h2.text-white.mb-4 {
    font-size: 2.5rem;
    color: #fff !important;
    margin-bottom: 1.5rem !important;
    font-weight: 600;
}

.site-section.bg-primary .container .row .col-lg-4 {
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
    margin-bottom: 20px; /* Space below each office block */
}

.site-section.bg-primary .container .row .col-lg-4 .p-4.bg-white.mb-3.rounded {
    padding: 1.5rem !important;
    background-color: #fff !important;
    margin-bottom: 0 !important; /* Remove default bottom margin of the block */
    border-radius: 8px !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    transition: transform 0.2s ease-in-out; /* Hover effect */
}

.site-section.bg-primary .container .row .col-lg-4 .p-4.bg-white.mb-3.rounded:hover {
    transform: translateY(-5px); /* Slight lift on hover */
}

.site-section.bg-primary .container .row .col-lg-4 .p-4.bg-white.mb-3.rounded span.d-block.text-black.h6.text-uppercase {
    display: block !important;
    color: #343a40 !important;
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase !important;
    margin-bottom: 0.5rem;
}

.site-section.bg-primary .container .row .col-lg-4 .p-4.bg-white.mb-3.rounded p.mb-0 {
    color: #495057 !important;
    margin-bottom: 0 !important;
    font-size: 1rem;
    line-height: 1.6;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .site-section.bg-primary .container .row .col-lg-4 {
        flex: 0 0 50%;
        max-width: 50%;
        margin-bottom: 30px;
    }
}

@media (max-width: 768px) {
    .site-section.bg-primary .container .row .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 30px;
    }
    .site-section.bg-primary .container .row .col-12 {
        text-align: center;
    }
}

/form/
/* Style for the main form container */
form {
  margin-top: 30px; /* Add some top margin to separate from other content */
}

/* Style for the bordered section containing the form elements */
.border {
  border: 1px solid #ddd !important; /* Light grey border */
  border-radius: 8px; /* Slightly rounded corners */
  background-color: #fff; /* White background */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Subtle shadow for depth */
}

/* Padding inside the bordered section */
.p-3, .p-lg-5 {
  padding: 20px; /* Default padding */
}

@media (min-width: 992px) { /* Larger screens */
  .p-lg-5 {
    padding: 40px; /* Increased padding on larger screens */
  }
}

/* Style for form group rows to control layout */
.form-group.row {
  margin-bottom: 20px; /* Space between form groups */
}

/* Style for labels */
label.text-black {
  display: block; /* Make labels take full width */
  color: #333; /* Dark grey label text */
  font-weight: bold;
  margin-bottom: 5px;
}

/* Style for required field indicator */
.text-danger {
  color: #dc3545 !important; /* Red color for the asterisk */
}

/* Style for input fields */
.form-control {
  display: block;
  width: 100%;
  padding: 0.75rem 1rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color:rgb(152, 192, 234); /* Highlight color on focus */
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Focus ring */
}

/* Style for the textarea */
textarea.form-control {
  min-height: 120px; /* Minimum height for the message box */
}

/* Style for the submit button */
.btn.btn-primary {
  color: #fff;
  background-color:rgb(32, 130, 234); /* Primary blue color */
  border-color:rgb(57, 144, 237);
  padding: 1rem 2rem;
  font-size: 1.25rem;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  cursor: pointer;
  font-weight: bold;
}

.btn.btn-primary:hover {
  background-color:rgb(34, 134, 242); /* Darker blue on hover */
  border-color: #0056b3;
}

.btn.btn-lg {
  padding: 1.25rem 2.5rem;
  font-size: 1.5rem;
  border-radius: 0.3rem;
}

.btn.btn-block {
  display: block;
  width: 100%;
}

/* Responsive adjustments for column widths (already handled by Bootstrap classes like col-md-6, col-md-12, col-lg-12) */
/* You might add more specific responsive styles if needed */
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
                <li><a href="about.php">About</a></li>
                <li class="nav-item active"><a href="contact.php">Contact</a></li>
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
          <div class="col-md-12 mb-0">
            <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Contact</strong>
          </div>
        </div>
      </div>
    </div>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119066.52982230402!2d72.8222859!3d21.15920015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e59411d1563%3A0xfe4558290938b042!2sSurat%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1741244374109!5m2!1sen!2sin" 
      width="100%" 
      height="450" 
      style="border:0;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade"></iframe>   
    

   
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black">Get In Touch</h2>
          </div>
          <div class="col-md-12">
    
          <form action="contact_process.php" method="post">
    
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label >
                    <input type="text" class="form-control" id="c_fname" name="c_fname"required>
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_lname" name="c_lname"required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="c_email" name="c_email" placeholder="Enter your e-mail address"required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_subject" class="text-black">Subject </label>
                    <input type="text" class="form-control" id="c_subject" name="c_subject" required>
                  </div>
                </div>
    
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_message" class="text-black">Message </label>
                    <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Send Message">
                  </div>
                </div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>



    <div class="site-section bg-primary">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="text-white mb-4">Offices</h2>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-white mb-3 rounded">
              <span class="d-block text-black h6 text-uppercase">Surat/Guj</span>
              <p class="mb-0">60-B Madhuram Hub,Udhana,Surat.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-white mb-3 rounded">
              <span class="d-block text-black h6 text-uppercase">Pune/Mah</span>
              <p class="mb-0">12-B Sarthak Society,Lonavala,Pune.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-white mb-3 rounded">
              <span class="d-block text-black h6 text-uppercase">Delhi</span>
              <p class="mb-0">16-A Shrungal Nagar,SK-Road,Delhi.</p>
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