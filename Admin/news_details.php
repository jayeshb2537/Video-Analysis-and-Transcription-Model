<?php
include 'config.php';

// Check if 'id' exists and is a valid number
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: News ID not provided or invalid.");
}

$id = (int) $_GET['id']; // Convert to integer for security

$query = "SELECT * FROM news_updates WHERE id = $id";
$result = mysqli_query($conn, $query);
$news = mysqli_fetch_assoc($result);

if (!$news) {
    die("Error: News not found.");
}
?>

<h2><?php echo htmlspecialchars($news['title']); ?></h2>
<p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>

<?php if (!empty($news['image'])) { ?>
    <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="News Image" width="400">
<?php } ?>

<a href="index.php">Back to News</a>
