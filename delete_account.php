<?php
session_start();
require 'database.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Delete the user from the database
$query = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    session_destroy(); // Destroy the session
    if (session_status() == PHP_SESSION_NONE) {
        echo "Session destroyed successfully.";
    } else {
        echo "Failed to destroy session.";
    }
    header('Location: index.php'); // Redirect to the homepage
    exit();
} else {
    echo "Error deleting account.";
}
?>