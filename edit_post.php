<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id='$post_id' AND user_id = '{$_SESSION['user_id']}'";
    if ($conn->query($sql) === TRUE) {
        echo "Post updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    $post_id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id = '$post_id' AND user_id = '{$_SESSION['user_id']}'";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();
}
?>

<form method="POST" action="">
    <input type="text" name="title" value="<?= $post['title']; ?>" required>
    <textarea name="content" required><?= $post['content']; ?></textarea>
    <button type="submit">Update Post</button>
</form>
