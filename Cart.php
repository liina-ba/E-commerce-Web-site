<?php
session_start();

$isLoggedIn = isset($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    

    <link rel="stylesheet" href="Cart.css">
    <link rel="stylesheet" href="style.css">
    <script src="app.js" defer></script>
    <script type="module" src="Cart.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
/>

</head>
<body id="cart-page">
    <header id="main-header">
        <div id="logo-container">
            <img src="images/TechZoneLogo.png" alt="Tech Zone logo">
            <a href="index.php" id="logo">Tech<span style="color: #54bafa;">Z</span>one</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="Products.php">All Products</a></li>
                <li>
                    <a href="Cart.php" class="cart-link">
                        <img src="images/CartLogo.png" alt="Cart Logo">
                        <span id="cart-badge" class="cart-badge">0</span>
                    </a>
                </li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="latest-products">
            <h1>Your Cart</h1>
            <h3>TechZone</h3>
            <table id="cart-table">
                <tbody id="cart-items">
                </tbody>
            </table>
            <div class="Total">
                <p>Total: <span id="total-price">0 DA</span></p>
                <button type="submit" id="validate-order">Validate My Order</button>
            </div>
        </section>   
        <footer>
            <div class="footer-container">
                <div class="footer-links">
                    <a href="#">Terms of Use</a>
                    <a href="#">Privacy Policy</a>
                </div>
                <div class="footer-logo">
                    <a href="#">TechZone</a>  <span>Your Online Shop</span>
                </div>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </footer>

    </main>
</body>
</html>