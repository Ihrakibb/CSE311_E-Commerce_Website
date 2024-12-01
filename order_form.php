
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .order-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            box-sizing: border-box;
        }

        .order-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .order-form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .order-form input,
        .order-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .order-form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .order-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <form method="POST" action="order.php" class="order-form">
        <h2>Order Form</h2>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        
        <label for="delivery_area">Delivery Area:</label>
        <select id="delivery_area" name="delivery_area" required>
            <option value="Dhaka">Dhaka</option>
            <option value="Outside Dhaka">Outside Dhaka</option>
        </select>
        
        <button type="submit">Place Order</button>
    </form>

</body>
</html>
