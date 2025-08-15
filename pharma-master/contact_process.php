<?php
include "config/db_connect.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $first_name = trim($_POST['c_fname']);
    $last_name = trim($_POST['c_lname']);
    $email = trim($_POST['c_email']);
    $subject = trim($_POST['c_subject']);
    $message = trim($_POST['c_message']);

    // Check for empty fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($subject) || empty($message)) {
        header("Location: contact.php?error=Please fill all required fields");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?error=Invalid email format");
        exit();
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO contact_us (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $subject, $message);

    if ($stmt->execute()) {
        header("Location: contact.php?success=Message Sent Successfully");
    } else {
        header("Location: contact.php?error=Database Error: " . $conn->error);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
    exit();
}
?>
