<?php
session_start();
include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title']) && isset($_POST['content'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];

        // Insert the new post into the database
        $sql = "INSERT INTO posts (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
        if ($conn->query($sql) === TRUE) {
            // Fetch the newly created post to return as HTML
            $post_id = $conn->insert_id;
            $new_post = "
                <tr id='post-$post_id'>
                    <td>$title</td>
                    <td>
                        <a href='edit_post.php?id=$post_id' class='btn edit-btn'>Edit</a>
                        <button class='btn delete-btn' onclick='deletePost($post_id)'>Delete</button>
                    </td>
                </tr>";
            echo $new_post;
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
