<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('includes/config.php');

// Fetch posts of the logged-in user
$sql = "SELECT * FROM posts WHERE user_id = '" . $_SESSION['user_id'] . "'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Blog Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">
        <h1>Welcome, <?= $_SESSION['username']; ?>!</h1>

        <h2>Your Posts</h2>
        <table class="posts-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="post-list">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr id="post-<?= $row['id']; ?>">
                        <td><?= $row['title']; ?></td>
                        <td>
                            <a href="edit_post.php?id=<?= $row['id']; ?>" class="btn edit-btn">Edit</a>
                            <button class="btn delete-btn" onclick="deletePost(<?= $row['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Create New Post</h3>
        <form id="create-post-form">
            <input type="text" id="post-title" placeholder="Post Title" required>
            <textarea id="post-content" placeholder="Content" required></textarea>
            <button type="submit" id="create-post-btn">Create Post</button>
        </form>

        <a href="logout.php" class="btn logout-btn">Logout</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Handle post creation via AJAX
        $('#create-post-form').on('submit', function(event) {
            event.preventDefault();
            const title = $('#post-title').val();
            const content = $('#post-content').val();

            $.ajax({
                type: 'POST',
                url: 'create_post.php',
                data: { title: title, content: content },
                success: function(response) {
                    // Clear the form and append the new post
                    $('#post-title').val('');
                    $('#post-content').val('');
                    $('#post-list').prepend(response);
                }
            });
        });

        // Handle post deletion via AJAX
        function deletePost(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                $.ajax({
                    type: 'POST',
                    url: 'delete_post.php',
                    data: { id: postId },
                    success: function(response) {
                        // Remove the post from the UI
                        $('#post-' + postId).remove();
                    }
                });
            }
        }
    </script>
</body>
</html>
