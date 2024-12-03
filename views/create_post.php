<?php include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Post</title>
</head>
<body>
    <h2>Create New Post</h2>
    <form method="POST" action="../process.php">
        <input type="hidden" name="action" value="create_post">
        <label>Title:</label>
        <input type="text" name="title" required>
        <label>Content:</label>
        <textarea name="content" required></textarea>
        <button type="submit">Create</button>
    </form>
</body>
</html>
