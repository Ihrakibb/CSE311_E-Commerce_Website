<?php
require 'database.php'; // Include the database connection file
session_start(); // Start session for user management

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture and sanitize form inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Don't hash it yet; we'll verify it first.

    // Validate if all fields are filled
    if (empty($email) || empty($password)) {
        die("All fields are required.");
    }

    // Check for the user in the database
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables and redirect to welcome page
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username']; 
           // echo "Session variables set: ";
           // print_r($_SESSION);// You can use email or name based on your need
            header('Location: index.php');
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Email does not exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .signin-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .signin-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .signin-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .signin-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .signin-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="signin-container">
        <h2>Signin</h2>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Signin</button>
        </form>
    </div>
</body>
</html>
