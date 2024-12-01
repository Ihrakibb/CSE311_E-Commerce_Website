
<?php
require 'database.php'; // Include the database connection file
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="product-list">
    <?php
        if (isset($_GET['search'])) {
            $search = mysqli_real_escape_string($conn, $_GET['search']);
            $query = "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
            $result = $conn->query($query);
          

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                echo '  <div class="product-img" style="background-image: url(\'' . htmlspecialchars($row['image']) . '\');"></div>';
                echo '  <h2>' . htmlspecialchars($row['name']) . '</h2>';
                echo '  <p>' . htmlspecialchars($row['description']) . '</p>';
                echo '  <p>Price: $' . htmlspecialchars($row['price']) . '</p>';
                echo '  <p>In stock :' . htmlspecialchars($row['stock_quantity']) . '</p>';
                echo '  <form method="POST" action="">';
                echo '      <input type="hidden" name="product_id" value="' . htmlspecialchars($row['id']) . '">';
                echo '      <input type="hidden" name="product_name" value="' . htmlspecialchars($row['name']) . '">';
                echo '      <input type="hidden" name="product_price" value="' . htmlspecialchars($row['price']) . '">';
                echo '      <input type="hidden" name="product_image" value="' . htmlspecialchars($row['image']) . '">';
                echo '      <input type="number" name="quantity" value="1" min="1" max="' . htmlspecialchars($row['stock_quantity']) . '">';
                echo '      <button type="submit" name="add_to_cart">Add to Cart</button>';
                echo '  </form>';
                echo '<a href="cart.php" class="btn-cart">Go to Cart</a>';
                echo '</div>';
                }
            } else {
                echo '<p>Sorry!We do not have the item you are looking for.</p>';
            }
        }
        ?>
    </div>

  

</body>
</html>



