<?php
$servername = "localhost";  // XAMPP default
$username = "root";  // Default MySQL user
$password = "";  // Default XAMPP MySQL has no password
$dbname = "pharmacy_db";  // Change to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// Database Connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "pharmacy_db"; 

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// UPI ID Configuration
$upi_id = "jayeshborase200537@okicici"; // Yahan apni UPI ID dalen
?>
