<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include '../includes/config.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Ensure the user owns the post before deleting it
$sql = "SELECT * FROM posts WHERE id = $id AND user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Post exists and belongs to the user
    $sql_delete = "DELETE FROM posts WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    die("Post not found or you do not have permission to delete it.");
}

$conn->close();
?>
