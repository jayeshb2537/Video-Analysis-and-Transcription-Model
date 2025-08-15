<?php 
session_start();
include "config/db_connect.php"; // Include database connection

// Check login
if (!isset($_SESSION['user_id'])) {
    echo "Please login first.";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT id, name, email, phone, address, role, created_at, profile_pic FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit;
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Handle file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($_FILES['profile_picture']['type'], $allowed_types)) {
            $target_dir = "uploads/";
            $file_name = uniqid() . "_" . basename($_FILES["profile_picture"]["name"]);
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
            $profile_pic = $target_file;

            // Update with picture
            $sql = "UPDATE users SET name=?, email=?, phone=?, address=?, profile_pic=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $name, $email, $phone, $address, $profile_pic, $user_id);
        } else {
            echo "Only JPG and PNG images are allowed.";
            exit;
        }
    } else {
        // Update without picture
        $sql = "UPDATE users SET name=?, email=?, phone=?, address=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $phone, $address, $user_id);
    }

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit;
    } else {
        echo "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="Stylesheet" href="style5.css">  
</head>
<body>

<div class="profile-card">
    <form method="POST" enctype="multipart/form-data">
      <h2>My Profile</h2>
      <img src="<?php echo !empty($user['profile_pic']) ? htmlspecialchars($user['profile_pic']) : 'uploads/Profile2.jpg'; ?>" alt="Profile Picture" class="profile-picture">
        <div class="input-box">
         <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required placeholder="Name">
        </div>
        <div class="input-box">  
         <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required placeholder="Email">
        </div> 
        <div class="input-box">
         <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required placeholder="Phone">
        </div>
        <div class="input-box"> 
         <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required placeholder="Address">
        </div>
        <div class="upload-container">
         <input type="file" name="profile_picture" accept="image/*">
        </div>
        <button type="submit" class="btn">Update Profile</button>
    </form>
    <div class="span">
     <p><span class="label">Role:</span> <?php echo htmlspecialchars($user['role']); ?></p>
     <p><span class="label">Joined on:</span> <?php echo htmlspecialchars($user['created_at']); ?></p>
    </div>
</div>
</body>
</html>