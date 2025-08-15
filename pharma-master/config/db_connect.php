<?php
$host = "localhost"; // Server name (default for XAMPP)
$username = "root"; // Default username for phpMyAdmin
$password = ""; // Default password (empty for XAMPP)
$database = "pharmacy_db"; // Database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Uncomment the below line to confirm connection
// echo "Connected successfully";
?>
