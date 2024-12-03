<?php
// Database connection credentials
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "";     // Replace with your MySQL password
$dbname = "blog_db";

// Create a connection to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create the database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";

// Execute the database creation query
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database '$dbname' created or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// SQL to create the users table
$sql_create_users_table = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute the query to create the users table
if ($conn->query($sql_create_users_table) === TRUE) {
    echo "Table 'users' created or already exists.<br>";
} else {
    die("Error creating users table: " . $conn->error);
}

// SQL to create the posts table
$sql_create_posts_table = "
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

// Execute the query to create the posts table
if ($conn->query($sql_create_posts_table) === TRUE) {
    echo "Table 'posts' created or already exists.<br>";
} else {
    die("Error creating posts table: " . $conn->error);
}

// Close the connection
$conn->close();
echo "Database setup complete.";
?>
