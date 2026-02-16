<?php
session_start();
include_once __DIR__ . '/config.php';
require_once __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50)); // Generate a secure token
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token expires in 1 hour

        // Store reset token in the database
        $stmt = $conn->prepare("UPDATE admins SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expires, $email);
        $stmt->execute();

        // Send email with password reset link
        $resetLink = "http://localhost/pharma-master/admin_reset_password.php?token=" . $token;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jayeshborase200537@gmail.com'; // Replace with your Gmail
            $mail->Password = 'lfbu nlbb dfqc dhls'; // Replace with your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('jayeshborase200537@gmail.com', 'Admin');
            $mail->addAddress($email);
            $mail->Subject = "Admin Password Reset";
            $mail->Body = "Click the link below to reset your password:\n\n" . $resetLink;

            $mail->send();
            echo "✅ Password reset link has been sent to your email!";
        } catch (Exception $e) {
            echo "❌ Email could not be sent. Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "❌ Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="POST">
        <label>Enter your Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>