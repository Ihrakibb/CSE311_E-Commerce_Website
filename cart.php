<?php
session_start();
include 'database.php';

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT c.product_id, p.name as product_name, p.price as product_price, c.quantity, c.total_price, p.image as product_image FROM cart c join products p on 
            p.id=c.product_id WHERE c.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);

// Remove product from cart
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];

    // Remove product from database cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();

    // Remove product from session cart
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
            break;
        }
    }

    header("Location: cart.php"); // Redirect to the cart page
    exit();
}

// Clear cart
if (isset($_POST['clear_cart'])) {
    // Clear session cart
    $_SESSION['cart'] = [];

    // Clear database cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    header("Location: cart.php"); // Redirect to the cart page
    exit();
}

// Calculate total
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['total_price'];
}

// Redirect to order page if user clicks Place Order and is logged in
if (isset($_POST['place_order'])) {
    if (!isset($_SESSION['user_id'])) {
        // If user is not logged in, redirect to signin.php
        header("Location: signin.php");
        exit();
    } else {
        // If user is logged in, redirect to order.php
        header("Location: order.php");
        exit();
    }
}


if (isset($_POST['place_order'])) {
        // If user is logged in, redirect to order.php
        header("Location: order.php");
        exit();
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Link to the CSS file for styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Your Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Image</th> <!-- Added for product image -->
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($item['product_image']) ?>" alt="Product Image" style="width: 50px; height: 50px;"></td> <!-- Display product image -->
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= number_format($item['product_price'], 2) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td><?= number_format($item['total_price'], 2) ?></td>
                        <td><a href="cart.php?remove=<?= $item['product_id']?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Total: <?= number_format($total, 2) ?></h2>

    <form method="POST">
        <button type="submit" name="clear_cart">Clear Cart</button></form>

        <form method="POST" action="order_form.php">
        <button type="submit" name="place_order">Place Order</button>
    </form>
     <!-- Add More Products Button -->
     <a href="index.php"><button type="button">Add More Products</button></a>
</body>
</html>
