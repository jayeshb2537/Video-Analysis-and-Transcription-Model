<?php
session_start();
include_once __DIR__ . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['token'])) {
    $token = $_GET['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if token is valid
    $stmt = $conn->prepare("SELECT * FROM admins WHERE reset_token = ? AND reset_expires > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        // Update password in database
        $stmt = $conn->prepare("UPDATE admins SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $new_password, $token);
        $stmt->execute();

        echo "✅ Password has been reset! <a href='admin_login.php'>Login</a>";
    } else {
        echo "❌ Invalid or expired token!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>

    <h2>Reset Password</h2>
    <form method="POST">
        <label>New Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Reset Password</button>
    </form>

</body>
</html>

