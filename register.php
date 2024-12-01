<?php
require 'database.php'; // Include the database connection file
session_start(); // Start session for user management

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture and sanitize form inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Validate if all fields are filled
    if (empty($username) || empty($name) || empty($email) || empty($password)) {
        die("All fields are required.");
    }
    
    // Hash the password for security
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    
    // Check for duplicate username or email
    $check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or email already exists. Please try another.";
    } else {
        // Insert the new user into the database
        $query = "INSERT INTO users (username, name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $username, $name, $email, $password_hashed);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            header('Location: welcome.php');
            exit();
        } else {
            echo "Error in registration. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .register-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .register-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .register-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

