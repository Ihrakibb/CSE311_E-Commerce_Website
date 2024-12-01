<?php
session_start();

// Clear session variables related to user login
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['email']);

// Redirect to the homepage
header('Location: index.php');
exit();
?>