<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');  
    exit();
}

// Welcome message
$username = $_SESSION['username']; 
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
   <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Your email: <?php echo htmlspecialchars($email); ?></p>
    <div class="button">
    <form method="POST" action="clear_session.php" style="display: inline;">
    <a href="index.php"><button>Go to Homepage</button></a>

            </form>
            <a href="signin.php"><button>Sign In</button></a>
        </div>
</body>
</html>
