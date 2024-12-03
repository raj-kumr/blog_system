<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include '../includes/config.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM posts WHERE user_id = $user_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard</h2>
    <a href="../logout.php">Logout</a>
    <a href="create_post.php">Create New Post</a>
    <h3>Your Posts:</h3>
    <ul>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <li>
                <h4><?php echo $row['title']; ?></h4>
                <p><?php echo $row['content']; ?></p>
                <a href="edit_post.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="../process.php?action=delete_post&id=<?php echo $row['id']; ?>">Delete</a>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
