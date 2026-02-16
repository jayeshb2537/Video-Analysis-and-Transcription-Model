<?php
session_start();
include 'config.php'; // Database connection file
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<script>alert('Your cart is empty!'); window.location='cart.php';</script>";
        exit();
    }

    // Fetch form data
    $name = trim($_POST['c_fname']) . ' ' . trim($_POST['c_lname']);
    $email = trim($_POST['c_email_address']);
    $mobile = isset($_POST['c_mobile']) ? trim($_POST['c_mobile']) : ''; 
    $address = trim($_POST['c_address']);
    $payment_mode = trim($_POST['payment']);

    // Calculate total price
    $total_price = 0;
    $cart_items = [];

    if (!empty($_SESSION["cart"])) {
        $ids = implode(",", array_keys($_SESSION["cart"]));
        $sql = "SELECT * FROM products WHERE id IN ($ids)";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $product_id = $row["id"];
            $row["quantity"] = $_SESSION["cart"][$product_id]; // Fetch quantity from session
            $cart_items[] = $row;
            $total_price += $row["price"] * $row["quantity"];
        }
    }

    // Insert order into `orders` table
    $stmt = $conn->prepare("INSERT INTO orders (name, email, mobile, address, payment_mode, total_price) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sssssd", $name, $email, $mobile, $address, $payment_mode, $total_price);
    
    if (!$stmt->execute()) {
        die("MySQL Error: " . $stmt->error);
    }
    
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert order items into `order_items` table
    foreach ($cart_items as $item) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
        
        if (!$stmt->execute()) {
            die("MySQL Error: " . $stmt->error);
        }
        $stmt->close();
    }

    // Clear cart after order placement
    unset($_SESSION['cart']);
    echo "<script>alert('Order placed successfully!'); window.location='order-success.php';</script>";
    exit();
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pharma &mdash; Colorlib Template</title>
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

</head>
<style>
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
              <a href="index.php" class="js-logo-clone"><img src="uploads/Medicare.png" alt="logo" style="width: 100px; height: 100px;"></a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
              <li><a href="index.php">Home</a></li>
              <li><a href="shop.php">Store</a></li>
                <li class="nav-item active"><a href="cart.php">Cart</a></li>
                <!-- <li><a href="#">Diet &amp; Nutrition</a></li>
                <li><a href="#">Tea &amp; Coffee</a></li> -->
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>

                <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="logout.php">Logout (<?php echo $_SESSION["user_name"]; ?>)</a></li>
                <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
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
             
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="bg-light rounded p-3">
              <p class="mb-0">Returning customer? <a href="login.php" class="d-inline-block">Click here</a> to login</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Billing Details</h2>
            <div class="p-3 p-lg-5 border">
            <form method="POST" action="">
              <div class="form-group">
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" name="c_fname" required placeholder="First Name" required class="form-control" id="c_fname">
                  <!-- <label>First Name:</label> -->
        <!-- <input type="text" name="c_fname" required> -->
                </div>
                <div class="col-md-6">
                  <label class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" name="c_lname" required placeholder="Last Name" required class="form-control" id="c_lname">
                  <!-- <label>Last Name:</label> -->
        <!-- <input type="text" name="c_lname" required> -->
                </div>
              </div>
    
            
    
              <div class="form-group row">
                <div class="col-md-12">
                  <label class="text-black">Address <span class="text-danger">*</span></label>
                  <textarea name="c_address" required placeholder="Address" class="form-control" id="c_address" name="c_address" required placeholder="Street address"></textarea>
                  <!-- <label>Address:</label> -->
        <!-- <textarea name="c_address" required></textarea> -->
                </div>
              </div>
    
              <!-- <div class="form-group">
                <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
              </div> -->
    
              <!-- <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_state_country" name="c_state_country">
                </div>
                <div class="col-md-6">
                  <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                </div>
              </div> -->
    
              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label class="text-black">Email Address <span class="text-danger">*</span></label>
                  <input type="email" name="c_email_address" required placeholder="Email" required class="form-control" id="c_email_address">
                  <!-- <label>Email:</label> -->
        <!-- <input type="email" name="c_email_address" required> -->
                </div>
                <div class="col-md-6">
                  <label class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="text" name="c_mobile" required placeholder="Enter Mobile Number" required class="form-control" id="c_phone">
                  <!-- <label>Phone:</label> -->
        <!-- <input type="text" name="c_mobile" placeholder="Enter Mobile Number" required> -->
                </div>
              </div>
    
              
    
              <!-- <div class="form-group">
                <label class="text-black">Order Notes</label>
                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                  placeholder="Write your notes here..."></textarea>
              </div> -->
                </form>
            </div>
          </div>
          <div class="col-md-6">
    
            <!-- <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                <div class="p-3 p-lg-5 border">
                
    
                  <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                  <div class="input-group w-75">
                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code"
                      aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-sm px-4" type="button" id="button-addon2">Apply</button>
                    </div>
                  </div>
    
                </div>
              </div>
            </div> -->
    
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                    <?php
    if (!empty($_SESSION['cart'])) {
        include 'config.php'; // Make sure database connection is available

        $total_price = 0;
        $ids = implode(",", array_keys($_SESSION["cart"]));
        $sql = "SELECT * FROM products WHERE id IN ($ids)";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $product_id = $row['id'];
            $quantity = $_SESSION["cart"][$product_id];
            $total = $row['price'] * $quantity;
            $total_price += $total;
    ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo $quantity; ?></td>
                <td>₹<?php echo number_format($row['price'], 2); ?></td>
                <td>₹<?php echo number_format($total, 2); ?></td>
            </tr>
    <?php
        }
    ?>
        <tr>
            <td colspan="3" style="text-align: right;"><strong>Total Price:</strong></td>
            <td><strong>₹<?php echo number_format($total_price, 2); ?></strong></td>
        </tr>
    <?php
    } else {
        echo "<tr><td colspan='4'>Your cart is empty.</td></tr>";
    }
    ?>

  </tbody>
  </table>
      <label>Payment Mode:</label>
      <select name="payment" required>
        <option value="COD">Cash on Delivery</option>
        <option value="Online">Online Payment</option>
    </select>
    
                  <!-- <div class="border mb-3">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button"
                        aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>
    
                    <div class="collapse" id="collapsebank">
                      <div class="py-2 px-4">
                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the
                          payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>
    
                  <div class="border mb-3">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button"
                        aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>
    
                    <div class="collapse" id="collapsecheque">
                      <div class="py-2 px-4">
                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the
                          payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>
    
                  <div class="border mb-5">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button"
                        aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>
    
                    <div class="collapse" id="collapsepaypal">
                      <div class="py-2 px-4">
                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the
                          payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="form-group"> -->
                  <button type="submit" name="place_order" class="btn btn-primary btn-lg btn-block">Place Order</button>
                  <!-- <button type="submit" name="place_order">Place Order</button> -->
                  <!-- </div> -->
    
                </div>
              </div>
            </div>
    
          </div>
        </div>
        <!-- </form> -->
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
                <li><a href="about.php">About</a></li>
            </ul>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">60-B Madhuram Hub,Udhana Road,Surat</li>
                <li class="phone"><a href="tel://23923929210">6355537353</a></li>
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
</body>

</html>