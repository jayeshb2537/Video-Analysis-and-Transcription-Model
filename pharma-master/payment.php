<!-- <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['card_number'] = $_POST['card_number'];
    $_SESSION['expiry'] = $_POST['expiry'];
    $_SESSION['cvv'] = $_POST['cvv'];
    
    // Here you would typically process payment details securely
    // Redirect to OTP entry page
    header("Location: enter_otp.php");
    exit();
}
?> -->

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="checkout-steps mb-4">
            <span class="step completed">1. Order Details</span>
            <span class="step active">2. Payment Details</span>
            <span class="step">3. Order Complete</span>
        </div>
        
        <h2 class="mb-3">Payment Details</h2>
        <div class="payment-form bg-light p-4 rounded">
            <form action="process-payment.php" method="POST">
                <label for="payment-method">Select Payment Method:</label>
                <select name="payment_method" id="payment-method" class="form-control mb-3" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="debit_card">Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="cod">Cash on Delivery</option>
                </select>
                
                <div id="card-details" class="d-none">
                    <label for="card-number">Card Number:</label>
                    <input type="text" id="card-number" name="card_number" class="form-control mb-3">
                    <label for="expiry">Expiry Date:</label>
                    <input type="text" id="expiry" name="expiry_date" class="form-control mb-3" placeholder="MM/YY">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" class="form-control mb-3" maxlength="3">
                </div>
                
                <button type="submit" class="btn btn-primary">Proceed to Payment</button>
            </form>
        </div>
    </div>
    
    <script>
        document.getElementById('payment-method').addEventListener('change', function () {
            let cardDetails = document.getElementById('card-details');
            if (this.value === 'credit_card' || this.value === 'debit_card') {
                cardDetails.classList.remove('d-none');
            } else {
                cardDetails.classList.add('d-none');
            }
        });
    </script>
</body>
</html> -->
<?php
// session_start();
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Please login to proceed with payment!'); window.location='login.php';</script>";
    exit();
}

include 'config.php'; // Database connection

// Define UPI ID and Payment Details
$upi_id = "yourupi@okhdfcbank"; // Replace with your UPI ID
$amount = isset($_SESSION["total_price"]) ? $_SESSION["total_price"] : 0; // Fetch total amount from session
$order_id = "ORD" . time(); // Generate unique order ID

// Generate UPI Payment Link
$upi_link = "upi://pay?pa=$upi_id&pn=Your Store&mc=1234&tid=$order_id&tr=$order_id&tn=Order Payment&am=$amount&cu=INR";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UPI Payment - Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .payment-container { max-width: 500px; margin: 50px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center; }
        .qr-code { margin: 20px 0; }
        .btn-pay { background-color: #007bff; color: white; padding: 10px; text-decoration: none; display: inline-block; border-radius: 5px; }
        .btn-pay:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<div class="payment-container">
    <h2>Complete Your Payment</h2>
    <p>Pay using UPI (Google Pay, PhonePe, Paytm, etc.)</p>
    
    <!-- UPI Payment Button -->
    <a href="<?php echo $upi_link; ?>" class="btn-pay">Pay ₹<?php echo number_format($amount, 2); ?> via UPI</a>

    <h4>OR Scan the QR Code</h4>
    
    <!-- UPI QR Code -->
    <img class="qr-code" src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=<?php echo urlencode($upi_link); ?>&choe=UTF-8" alt="UPI QR Code">
    
    <hr>
    <h4>Upload Payment Screenshot</h4>
    <form action="verify_payment.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <input type="file" name="payment_screenshot" required>
        <button type="submit" class="btn btn-success mt-2">Submit for Verification</button>
    </form>
</div>

</body>
</html>
