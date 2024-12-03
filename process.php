<?php
session_start();
include 'includes/config.php';

// Ensure that the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: views/login.php');
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == 'create_post') {
    // Create a new post
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        header('Location: views/dashboard.php');
    } else {
        echo "Error: " . $conn->error;
    }

} elseif ($action == 'edit_post') {
    // Update an existing post
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: views/dashboard.php');
    } else {
        echo "Error: " . $conn->error;
    }

} elseif ($action == 'delete_post') {
    // Delete a post
    $id = $_GET['id'];
    $sql = "DELETE FROM posts WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: views/dashboard.php');
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
