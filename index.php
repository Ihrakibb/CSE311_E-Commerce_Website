<?php
require 'database.php';
session_start();

 if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
    header("Location: index.php"); // Redirect to the front page
    exit();
}  
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Amar_Bazaar</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <div class="navbar">
                <div class="nav-logo border">
                    <div class="logo"></div>
                </div>
                
                <div class="nav-address border">
                     <p class="add-first">Deliver to</p>
                  <div class="add-icon">
                   <img src="bd_flag.png" alt="Bangladesh Flag" class="flag-icon">
                       <form method="POST" class="dropdown-form">
                          <select name="division" class="division-select" onchange="this.form.submit()">
                             <option value="" disabled selected>Bangladesh</option>
                             <option value= "Bandarban">B - Bandarban</option>
                             <option value="Barguna">B - Barguna</option>
                              <option value="Barishal">B - Barishal</option>
                             <option value="Bhola">B - Bhola</option>
                             <option value="Bogura">B - Bogura</option>
                             <option value="Brahmanbaria">B - Brahmanbaria</option>
                             <option value="Chadpur">C - Chadpur</option>
                             <option value="Chattogram">C - Chattogram</option>
                             <option value="Chuadanga">C - Chuadanga</option>
                             <option value="Cox's Bazar">C - Cox's Bazar</option>
                             <option value="Dinajpur">D - Dinajpur</option>
                             <option value="Dhaka">D - Dhaka</option>
                             <option value= "Khulna">K - Khulna</option>
                             <option value="Lakshmipur">L -  Lakshmipur</option>
                             <option value="Maymensingh">M -  Maymensingh</option>
                             <option value= "Noakhali">N - Noakhali</option>
                             <option value= "Pabna">P - Pabna</option>
                             <option value= "Rangpur">R - Rangpur</option>
                             <option value="Sherpur">S -  Sherpur</option>
                             <option value="Sylhet">S -  Sylhet</option>
                             <option value="Thakurgaon">T -  Thakurgaon</option>
                        </select>
                      </form>
                   </div>
           </div>
 
                

                <div class="nav-search border">
                <form method="GET" action="search.php">
                    <select class="search-select">
                        <option>All</option>
                    </select>
                    <input type="text" name="search" placeholder="Search Amar Bazaar" class="search-input">
                    <button type="submit" class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
                </div>


              <div class="nav-signin border">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <p><span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></span></p>
                    <form action="logout.php" method="POST" style="display: inline;">
                        <button type="submit">Logout</button>
                    </form>
                  <form action="delete_account.php" method="POST" style="display: inline;">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete your account?');">Delete Account</button>
                    </form>
                <?php else: ?>
                    <p><span>Hello, sign in</span></p>
                <?php endif; ?>
            </div>
                <div class="nav-return border">
                <a href="order.php">
                    <p><span>Returns</span></p>
                    <p class="nav-second">& Orders</p>
                </div>

                <div class="nav-cart border">
                    <a href="cart.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Cart (<span id="cart-count"><?php echo $cart_count; ?></span>)
                    </a>
                </div> 

                <div class="nav-payment border ">
                    <i class="fa-solid fa-money-bill"></i>
                    Payment Method
                </div>
            </div>

            <div class="panel ">
                <div class="panel-all border">
                    <i class="fa-solid fa-bars"></i>
                    All
                </div>
                <div class="panel-ops">
                    <p>Today's Deals</p>
                    <p>Customer Service</p>
                    <p>Registry</p>
                    <p>Gift Cards</p>
                    <p>Sell</p>
                </div>
                <div class="panel-deals border">
                    Shop deals in Electronics
                </div>
        
                <div class="auth-buttons">
                    <a href="register.php"><button>Register</button></a>
                    <a href="signin.php"><button>Signin</button></a>
                </div>
            </div>
        </header>
        <div class="hero-section">
            <div class="hero-msg">
                <p>You are on amarbazaar.com. You can also shop on Amar Bazaar Bangladesh for millions of products with fast local delivery. <a>Click here to go to amarbazaar.bd</a></p>
            </div>
        </div>

        <div class="shop-section">
            <?php
        if (isset($_GET['search'])) {
            $search = mysqli_real_escape_string($conn, $_GET['search']);
            $query = "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="box">';
                    echo '<div class="box-content">';
                    echo '<h2>' . htmlspecialchars($row['name']) . '</h2>';
                    echo '<div class="box-img" style="background-image: url(\'' . htmlspecialchars($row['image_url']) . '\');"></div>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                    echo '<p>Price: ' . htmlspecialchars($row['price']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found.</p>';
            }
        }
        ?>
            <div class="box">
                <div class="box-content">
                    <h2>Garments</h2>
                    <div class="box-img" style="background-image: url('box1_image.jpg');"></div>
                    <a href="Garments.php?category_id=1"><p>Discover more</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Sanitation Supplies</h2>
                    <div class="box-img" style="background-image: url('box2_image.jpeg');"></div>
                    <a href="Garments.php?category_id=2"><p>For Sanitizing Your Home, Shop now</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Home Accessories</h2>
                    <div class="box-img" style="background-image: url('box3_image.jpg');"></div>
                     <a href="Garments.php?category_id=3"> 
                    <p>Shop Home Products</p> </a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Electronics</h2>
                    <div class="box-img" style="background-image: url('box4_image.jpg');"></div>
                   <a href="Garments.php?category_id=4"> 
                    <p>Shop Best Electronics</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Skincare & Makeup</h2>
                    <div class="box-img" style="background-image: url('box5_image.jpg');"></div>
                    <a href="Garments.php?category_id=5"> 
                    <p>Glam Gear</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Pet Foods</h2>
                    <div class="box-img" style="background-image: url('box6_image.jpeg');"></div>
                    <a href="Garments.php?category_id=6"> 
                     <p>Best Food For Your Pet</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Stationery and Toys</h2>
                    <div class="box-img" style="background-image: url('box7_image.jpg');"></div>
                    <a href="Garments.php?category_id=7"> 
                    <p>Best Stationeries In Town</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Ladies' Accessories</h2>
                    <div class="box-img" style="background-image: url('box8_image.jpg');"></div>
                    <a href="Garments.php?category_id=8"> 
                    <p>Fashion Finds</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Travel Essentials</h2>
                    <div class="box-img" style="background-image: url('box9_image.jpg');"></div>
                    <a href="Garments.php?category_id=9"> 
                    <p>Travel Checklist</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Get Your Game On</h2>
                    <div class="box-img" style="background-image: url('box10_image.jpg');"></div>
                    <a href="Garments.php?category_id=10"> 
                    <p>Your Gaming Destination</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Kitchen Deals</h2>
                    <div class="box-img" style="background-image: url('box11_image.jpg');"></div>
                    <a href="Garments.php?category_id=11"> 
                        <p>Affordable Kitchen Gadgets</p></a>
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <h2>Medicines</h2>
                    <div class="box-img" style="background-image: url('box12_image.jpg');"></div>
                    <a href="Garments.php?category_id=12"> 
                    <p>Wellness Solutions</p></a>
                </div>
            </div>
        </div>

           
     

        <footer>
            <div class="foot-panel1">
                Back To Top
            </div>

            <div class="foot-panel2">
                <div class="logo"></div>
            </div> 

            <div class="foot-panel3">
                <p class="accept-msg">We Accept</p>
                <div class="payment-methods">
                    <img src="visa.png" alt="VISA" class="payment-logo">
                    <img src="master.png" alt="MasterCard" class="payment-logo">
                    <img src="nexuspay.png" alt="Nexus Pay" class="payment-logo">
                    <img src="bkash.png" alt="bKash" class="payment-logo">
                    <img src="rocket.png" alt="Rocket" class="payment-logo">
                    <img src="nagad.png" alt="Nagad" class="payment-logo">
                </div>
            </div>
            <div class="foot-panel4">
        <div class="footer-links">
            <div class="footer-column">
                <h3>Get to Know Us</h3>
                <ul>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">About Amar Bazaar</a></li>
                    <li><a href="#">Investor Relations</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Make Money with Us</h3>
                <ul>
                    <li><a href="#">Sell on Amar Bazaar</a></li>
                    <li><a href="#">Become an Affiliate</a></li>
                    <li><a href="#">Advertise Your Products</a></li>
                    <li><a href="#">Self-Publish with Us</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Payment Products</h3>
                <ul>
                    <li><a href="#">Amar Bazaar Business Card</a></li>
                    <li><a href="#">Shop with Points</a></li>
                    <li><a href="#">Reload Your Balance</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Let Us Help You</h3>
                <ul>
                    <li><a href="#">Your Account</a></li>
                    <li><a href="#">Returns & Replacements</a></li>
                    <li><a href="#">Manage Your Content and Devices</a></li>
                    <li><a href="#">Help</a></li>
                 </ul>
               </div>
            </div>
          </div>
        </footer>
         
        <script>
            function toggleForm(formType) {
                // Hide both forms initially
                document.getElementById('register-form').style.display = 'none';
                document.getElementById('signin-form').style.display = 'none';

                // Show the selected form
                if (formType === 'register') {
                    document.getElementById('register-form').style.display = 'block';
                } else if (formType === 'signin') {
                    document.getElementById('signin-form').style.display = 'block';
                }
            }
        </script>
    </body>
</html>
