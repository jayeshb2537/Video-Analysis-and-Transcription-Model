<?php
session_start();
include 'config.php'; // Database connection file
require 'fpdf/fpdf.php'; // Include FPDF Library
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) { 
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<script>alert('Your cart is empty!'); window.location='cart.php';</script>";
        exit();
    }
    
    // Fetch form data
    $user_id = $_SESSION['user_id']; // user logged in
    $name = trim($_POST['c_fname']) . ' ' . trim($_POST['c_lname']);
    $email = trim($_POST['c_email_address']);
    $mobile = isset($_POST['c_mobile']) ? trim($_POST['c_mobile']) : ''; 
    $address = trim($_POST['c_address']);
    $payment_mode = trim($_POST['payment']);

    // Calculate total price and fetch product details
    $total_price = 0;
    $cart_items = [];

    if (!empty($_SESSION["cart"])) {
        $ids = implode(",", array_map('intval', array_keys($_SESSION["cart"]))); // Secure SQL IDs
        $sql = "SELECT * FROM products WHERE id IN ($ids)";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $product_id = $row["id"];
            $row["quantity"] = $_SESSION["cart"][$product_id]; // Fetch quantity from session
            $cart_items[] = $row;
            $total_price += $row["discounted_price"] * $row["quantity"];
        }
    }

    // Insert order into `orders` table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, name, email, mobile, address, payment_mode, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssd", $user_id, $name, $email, $mobile, $address, $payment_mode, $total_price); // Adjusted to match parameters
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert order items into `order_items` table
    foreach ($cart_items as $item) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['discounted_price']);
        $stmt->execute();
        $stmt->close();
    }


    
// Generate PDF Invoice
$pdf = new FPDF();
$pdf->AddFont('DejaVu','','DejaVuSans.php'); 
$pdf->AddFont('DejaVu','','DejaVuSans-Bold.php'); 
$pdf->SetFont('DejaVu','',14);
$pdf->AddPage();
    
// Company Name
// $pdf->SetFont('DejaVu','',16);
// $pdf->Cell(190, 10, "Medicare", 0, 1, 'C'); Change the name as per your compan

// Set background color
$pdf->SetFillColor(230, 230, 250); // Light Lavender background
$pdf->Rect(0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight(), 'F');
// Order details
$pdf->SetY(35);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(190, 10, "Medicare - Order #$order_id", 1, 1, 'C');   
$pdf->Ln(5);

// Customer Details
$pdf->SetFont('DejaVu','',12);
$pdf->Cell(190, 10, "Customer: $name", 0, 1);
$pdf->Cell(190, 10, "Email: $email", 0, 1);
$pdf->Cell(190, 10, "Mobile: $mobile", 0, 1);
$pdf->Cell(190, 10, "Address: $address", 0, 1);
$pdf->Cell(190, 10, "Payment Mode: $payment_mode", 0, 1);
$pdf->Ln(10);


// Table Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(200, 200, 200); // Light gray background
$pdf->Cell(90, 10, "Product", 1, 0, 'C', true);
$pdf->Cell(30, 10, "Quantity", 1, 0, 'C', true);
$pdf->Cell(30, 10, "Price", 1, 0, 'C', true);
$pdf->Cell(40, 10, "Total", 1, 1, 'C', true);








// Order Items
$pdf->SetFont('DejaVu', '', 12);
foreach ($cart_items as $item) {
    $pdf->Cell(90, 10, $item['name'], 1);
    $pdf->Cell(30, 10, $item['quantity'], 1);
    $pdf->Cell(30, 10, number_format($item['discounted_price'], 2), 1);
    $pdf->Cell(40, 10, number_format($item['quantity'] * $item['discounted_price'], 2), 1);
    $pdf->Ln();
}

// Total Amount
$pdf->SetFont('DejaVu','',12);
$pdf->Cell(150, 10, "Total Amount", 1);
$pdf->Cell(40, 10, number_format($total_price, 2), 1, 1, 'R');

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 128, 0); // Green color
$pdf->Cell(190, 10, "Thank you!", 0, 1, 'C');
// Save PDF
$pdf_file = "invoices/order_$order_id.pdf";
$pdf->Output('F', $pdf_file);

    // Send Email with PDF
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jayeshborase200537@gmail.com';
        $mail->Password = 'egnk fdux zepy pvmd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and Recipient
        $mail->setFrom('jayeshborase200537@gmail.com', 'Your Pharmacy');
        $mail->addAddress($email); // Customer email
        $mail->addAddress('jayeshborase200537@gmail.com'); // Admin email

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "Order Confirmation - Order #$order_id";
        $mail->Body    = "<h3>Dear $name,</h3>
                          <p>Your order has been successfully placed.</p>
                          <p>Order ID: <strong>$order_id</strong></p>
                          <p>Total Amount: <strong>₹" . number_format($total_price, 2) . "</strong></p>
                          <p>Thank you for shopping with us!</p>";

        // Attach PDF
        $mail->addAttachment($pdf_file);

        // Send Email
        $mail->send();
        echo "<script>alert('Order placed successfully! Check your email for invoice.'); window.location='order-success.php';</script>";
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Clear cart
    unset($_SESSION['cart']);
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





    body {
    background-color: #f8f9fa; /* Light background for better contrast */
}

.site-section {
    padding: 2rem 0; /* Increased padding for a more spacious layout */
}

.bg-light {
    background-color: #ffffff !important; /* White background for forms */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adding shadow for depth */
    border-radius: 8px; /* Rounded corners */
}

h2.h3 {
    margin-bottom: 1.5rem; /* Spacing between headings */
}

input[type="text"],
input[type="email"],
textarea,
select {
    width: 100%;
    padding: 0.75rem; /* Padding for better usability */
    margin-bottom: 1rem; /* Space between fields */
    border: 1px solid #ced4da; /* Subtle border */
    border-radius: 4px; /* Rounded corners */
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Inset shadow */
}

button[type="submit"] {
    background-color: #007bff; /* Bootstrap primary color */
    color: white;
    padding: 0.75rem 1.25rem; /* Padding for buttons */
    border: none;
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Hand cursor on hover */
    transition: background-color 0.3s; /* Smooth transition */
}

button[type="submit"]:hover {
    background-color: #0056b3; /* Darker shade on hover */
}

table {
    width: 100%;
    margin-top: 1.5rem; /* Spacing from above */
    border-collapse: collapse; /* Cleaner appearance */
}

th, td {
    border: 1px solid #dee2e6; /* Border color for table */
    padding: 0.75rem; /* Padding */
    text-align: center; /* Center align for aesthetics */
}

th {
    background-color: #f1f1f1; /* Light background for header */
}

td:last-child {
    font-weight: bold; /* Highlight total */
}

.order-summary {
    background-color: #ffffff; /* White background for order summary */
    border-radius: 8px; /* Rounded corners */
    padding: 1.5rem; /* Padding */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow */
}

</style>

<style>
.checkout-steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 20px 0;
}
.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    text-align: center;
    position: relative;
}
.step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 4px;
    background-color: #ccc;
    z-index: -1;
}
.circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: white;
}
.step.active .circle {
    background-color: #8DA74E;
}
.label {
    margin-top: 5px;
    font-weight: bold;
    color: #666;
}
.step.active .label {
    color: black;
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
                <li class="nav-item"><a href="track_order.php">Track Order</a></li>
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
              <!-- <p class="mb-0">Returning customer? <a href="login.php" class="d-inline-block">Click here</a> to login</p> -->
               <!-- Checkout Steps Progress Bar -->
<div class="checkout-steps">
    <div class="step active">
        <span class="circle">1</span>
        <span class="label">Order Details</span>
    </div>
    <div class="step">
        <span class="circle">2</span>
        <span class="label">Payment Details</span>
    </div>
    <div class="step">
        <span class="circle">3</span>
        <span class="label">Order Complete</span>
    </div>
</div>
            </div>
          </div>
        </div>
        <div class="row">
    <!-- Billing Details on Left Side -->
    <div class="col-md-6 order-summary">
        <h2 class="h3 mb-3 text-black">Billing Details</h2>
        <div class="p-3 p-lg-5 border">
            <form method="POST" action="">
                <label>First Name:</label>
                <input type="text" name="c_fname" required>
                <label>Last Name:</label>
                <input type="text" name="c_lname" required>
                <label>Email:</label>
                <input type="email" name="c_email_address" required>
                <label>Phone:</label>
                <input type="text" name="c_mobile" placeholder="Enter Mobile Number" required>
                <label>Address:</label>
                <textarea name="c_address" required></textarea>
                <label>Payment Mode:</label>
                <select name="payment" required>
                    <option value="COD">Cash on Delivery</option>
                    <option value="Online">Online Payment</option>
                </select>
                <!-- <button type="submit" name="place_order">Place Order</button> -->
                <?php if (isset($_SESSION['user_id'])): ?>
              <button type="submit" name="place_order" class="btn btn-primary btn-block">Place Order</button>
            <?php else: ?>
              <p class="text-danger">You must <a href="login.php">login</a> to place an order.</p>
            <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Order Summary on Right Side -->
    <div class="col-md-6 order-summary">
        <h3>Order Summary</h3>
        <table>
            <tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>
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
                    $total = $row['discounted_price'] * $quantity;
                    $total_price += $total;
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td>₹<?php echo number_format($row['discounted_price'], 2); ?></td>
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
        </table>
    </div>
</div>

</body>
</html>
