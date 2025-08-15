<?php
session_start();
include_once __DIR__ . '/config.php';
require_once __DIR__ . '/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/PHPMailer/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50)); // Secure token
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Store token in database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expires, $email);
        $stmt->execute();

        // Send email using PHPMailer
        $resetLink = "http://localhost/pharma-master/user_reset_password.php?token=" . $token;
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jayeshborase200537@gmail.com'; // Replace with your email
            $mail->Password = 'lfbu nlbb dfqc dhls'; // Use Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('your-email@gmail.com', 'Pharmacy Support');
            $mail->addAddress($email);
            $mail->Subject = "User Password Reset";
            $mail->Body = "Click the link below to reset your password:\n\n" . $resetLink;

            $mail->send();
            echo "✅ Password reset link has been sent to your email!";
        } catch (Exception $e) {
            echo "❌ Email sending failed: {$mail->ErrorInfo}";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Forgot Pasword</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    <div class="wrapper">
        <form method="POST">
            <h2>User Forgot Password</h2>
            <div class="input-box">
                <input type="email" placeholder="Enter Your Email" name="email" required>
            </div>
               <button type="submit" class="btn">Send Reset Link</button>      
        </form>
    </div>    
</body>
</html>
