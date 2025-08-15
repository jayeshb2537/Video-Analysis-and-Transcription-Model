<?php
include "config/db_connect.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Secure password
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "Email already registered!";
    } else {
        // Insert user data
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $password, $phone, $address);

        if ($stmt->execute()) {
            echo "Registration successful! <a href='login.php'>Login Here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="widht=device-widht,initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
     <div class= wrapper>
       <form method="POST">
         <h2>User Registration</h2>
           <div class="input-box">
             <input type="text" placeholder="Name" name="name" required>
           </div>
           <div class="input-box">
             <input type="email" placeholder="Email" name="email" required>
           </div>
           <div class="input-box">
             <input type="password" placeholder="Password" name="password"  required>
           </div>
           <div class="input-box">
             <input type="text" placeholder="Contact No" name="phone" required>
           </div>
           <div class="input-box">
              <input type="textarea" placeholder="Address" name="address" required>
           </div>
           <button type="submit" class="btn">Register</button>
           <div class="login-link">
              <p>Already have an account! <a href="login.php">Login Now</a></p>
           </div>      
       </form>
     </div> 
</body>
</html>
