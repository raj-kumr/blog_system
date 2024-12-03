<?php
session_start();
include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $post_id = $_POST['id'];
        $user_id = $_SESSION['user_id'];

        // Delete the post from the database if it belongs to the logged-in user
        $sql = "DELETE FROM posts WHERE id = '$post_id' AND user_id = '$user_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Post deleted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
