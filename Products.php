<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" href="style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="app.js" defer></script>
    <script type="module" src="product.js" defer></script>
    <title>TechZone Products</title>
</head>
<body>
    <header id="main-header">
        <div id="logo-container">
            <img src="images/TechZoneLogo.png" alt="Tech Zone logo">
            <a href="index.php" id="logo">Tech<span style="color: #54bafa;">Z</span>one</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="">All Products</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="#">Hi, <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?></a></li>
                    <li><a href="logout.php">Log Out</a></li>
                    <li>
                        <a href="Cart.php" class="cart-link">
                            <img src="images/CartLogo.png" alt="Cart Logo">
                            <span id="cart-badge" class="cart-badge">0</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li><a href="customer_registration.php">Sign Up</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3>Categories:</h3>
            <ul>
                <li><a href="#" data-category="all">All Products</a></li>
                <li><a href="#" data-category="Computers">Computers</a></li>
                <li><a href="#" data-category="Chargers and Cables">Chargers & Cables</a></li>
                <li><a href="#" data-category="Components">Components</a></li>
                <li><a href="#" data-category="Storage Devices">Storage Devices</a></li>
                <li><a href="#" data-category="Accessories">Accessories</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="sorting-options">
                <label for="sort">Sort by:</label>
                <select id="sort">
                    <option value="latest">Latest Products</option>
                    <option value="price_low_high">Price: Low to High</option>
                    <option value="price_high_low">Price: High to Low</option>
                </select>
            </div>
            <div class="product-grid" id="product-grid"></div>
            <div class="pagination" id="pagination"></div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <a href="#">Terms of Use</a>
                <a href="#">Privacy Policy</a>
            </div>
            <div class="footer-logo">
                <a href="#">TechZone</a> <span>Your Online Shop</span>
            </div>
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </footer>


    <script>
        const isLoggedIn = <?= json_encode($isLoggedIn); ?>;
    </script>

</body>
</html>
