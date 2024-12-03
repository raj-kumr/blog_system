<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // If logged in, redirect to dashboard
    header('Location: views/dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Welcome to the Blog System</h1>
        <nav>
            <ul>
                <li><a href="views/login.php">Login</a></li>
                <li><a href="views/register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>What is this system?</h2>
        <p>This is a simple blog management system where you can create, edit, and delete blog posts. Please log in or register to start managing your blog posts.</p>
    </main>

    <footer>
        <p>&copy; 2024 Blog System</p>
    </footer>
</body>
</html>
