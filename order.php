<?php
require 'database.php';
session_start();

// Flag to check if the order has been successfully placed
$order_success = false;

// Process order form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture user details
    $user_id = $_SESSION['user_id'];   
    $mail = $_SESSION['email'];          
    $phone = $_POST['phone'];          
    $address = $_POST['address'];      
    $delivery_area = $_POST['delivery_area'];  
    
    // Validation: check if the cart is empty or if any required fields are missing
    if (empty($_SESSION['cart'])) {
        $error_message = "Cart is empty. Cannot proceed with the order.";
    } elseif (empty($phone) || empty($address) || empty($delivery_area)) {
        $error_message = "Please fill all the fields, especially the delivery area.";
    } else {
        // Calculate the total amount including shipping charge
        $total_amount = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_amount += $item['total']; // Calculate total of items in the cart
        }

        // Add shipping charges based on the delivery area
        $shipping_charge = ($delivery_area == "Dhaka") ? 80 : 130;
        $total_amount += $shipping_charge;  

        // Prepare SQL query to insert the order
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, shipping_address, mail, phone) 
                                VALUES (?, ?, ?, ?, ?)");

        if ($stmt === false) {
            die("SQL Prepare Failed: " . $conn->error);
        }
        
        // Bind parameters and execute the query
        $stmt->bind_param("idsss", $user_id, $total_amount, $address, $mail, $phone);

        if ($stmt->execute()) {
            // Clear the cart after successful order placement
            unset($_SESSION['cart']);

            // Optionally delete cart items from the database
            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            
            $order_success = true; // Set success flag to show the success message
            // Get the last inserted order ID for the invoice
            $order_id = $stmt->insert_id;
        } else {
            $error_message = "Error placing order: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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
        .order-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .order-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-container p {
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .order-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .order-container button:hover {
            background-color: #45a049;
        }
        .order-container .cancel-btn {
            background-color: #f44336; /* Red for cancel */
        }
        .order-container .cancel-btn:hover {
            background-color: #d32f2f;
        }
        .order-container .back-btn {
            background-color: #007185; /* Blue for back */
        }
        .order-container .back-btn:hover {
            background-color: #005f6a;
        }

        /* Style for the invoice section */
        .invoice {
            margin-top: 20px;
            padding: 10px;
            border-top: 1px solid #ccc;
            text-align: left;
        }
        .invoice h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .invoice p {
            margin: 5px 0;
        }
        .invoice .total {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="order-container">
        <?php if ($order_success): ?>
            <!-- Success Message -->
            <h2>Order Placed Successfully!</h2>
            <p>Your order has been placed successfully. Thank you for shopping with us!</p>

            <!-- Invoice Display -->
            <div class="invoice">
                <h3>Invoice</h3>
                <p><strong>Phone:</strong> <?= htmlspecialchars($phone); ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($address); ?></p>
                <p><strong>Delivery Area:</strong> <?= htmlspecialchars($delivery_area); ?></p>
                <p class="total"><strong>Total Amount:</strong> <?= number_format($total_amount, 2); ?> BDT</p>
            </div>

            <!-- Button to Cancel Order (redirect to home) -->
            <form method="POST" action="index.php">
                <button class="cancel-btn" type="submit">Cancel Order</button>
            </form>

            <!-- Button to Go Back to Home -->
            <form method="POST" action="index.php">
                <button type="submit" class="back-btn">Back to Home</button>
            </form>

        <?php elseif (isset($error_message)): ?>
            <!-- Error Message -->
            <h2>Error</h2>
            <p><?php echo $error_message; ?></p>

            <!-- Button to Go Back to Cart -->
            <a href="cart.php"><button class="back-btn">Back to Cart</button></a>
        <?php endif; ?>
    </div>
</body>
</html>
