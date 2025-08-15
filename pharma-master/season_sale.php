<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Season Sale</title>
    <link rel="stylesheet" href="style5.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    /* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    text-align: center;
    color: #333;
}

/* Container */
.container {
    max-width: 800px;
    margin: 40px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Headings */
h1 {
    color: #e74c3c;
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 10px;
}

h2 {
    color: #27ae60;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 20px;
}

h3 {
    color: #545d64;
    font-size: 1.5rem;
    font-weight: 700;
    margin-top: 20px;
}

/* Paragraph Styling */
p {
    color: #555;
    font-size: 1.1rem;
    font-weight: 600;
    line-height: 1.6;
    margin: 10px auto;
    max-width: 600px;
}

/* Shop Now Button */
.shop-btn {
    display: inline-block;
    text-decoration: none;
    background-color: #f39c12;
    color: white;
    padding: 12px 20px;
    font-size: 1.2rem;
    font-weight: 700;
    border-radius: 5px;
    margin-top: 15px;
    transition: 0.3s;
}

.shop-btn:hover {
    background-color: #d68910;
}

a {
    text-decoration: none; /* Removes the underline */
}
.shop-btn {
    text-decoration: none; /* Removes underline */
    font-weight: bold; /* Keeps text bold */
    color: #fff; /* Change color to white or desired color */
    background-color: #6a1b9a; /* Set a background color */
    padding: 10px 20px;
    border-radius: 5px;
    display: inline-block;
}

.shop-btn:hover {
    background-color: #4a148c; /* Darker shade on hover */
}

/* Background Image */
body {
    background-image: url('uploads/medic_pic.jpg'); /* Corrected the backslash */
    background-size: cover; /* Ensure the image covers the entire screen */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Prevent the image from repeating */
    background-attachment: fixed; /* Make the background image fixed */  
}
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
</style>
<body>
<div class ="site-wrap">    
<div class="site-navbar py-2">

    <h1>Medicare - Season Sale! 50% Off on Health and Wellness Products.</h1>
    <h2>🛍️ Biggest Sale of the Season – Get 50% Off!<h2> 
        <p>Stock up on essential health products at unbeatable prices. Hurry, limited-time offer! <br>
         📅 Sale Duration: [15th March 2025] – [30th Desember 2025]. <br>
         🚚 Free Shipping on Orders Over $50!
        </p> 
        <h3>So Start Shop Medications for your Healthier Life</h3> 
        <p><a href ="shop.php">Shop Now</a></p>
</div>         
</body>
</html>


