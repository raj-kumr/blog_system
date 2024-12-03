<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include '../includes/config.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch the post data
$sql = "SELECT * FROM posts WHERE id = $id AND user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    die("Post not found or you do not have permission to edit it.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Post</title>
</head>
<body>
    <h2>Edit Post</h2>
    <form method="POST" action="../process.php">
        <input type="hidden" name="action" value="edit_post">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>
        
        <label>Content:</label><br>
        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>
        
        <button type="submit">Update Post</button>
    </form>
    <a href="dashboard.php">Cancel</a>
</body>
</html>
