
<?php
session_start();
require_once "dbconnect.php";
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    header("Location: admin.php"); 
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user']);
$userName = $isLoggedIn ? htmlspecialchars($_SESSION['user']['first_name']) : null;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
/>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="app.js" defer></script>

    <link rel="stylesheet" href="style.css">
    <title>Tech Zone</title>

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
                <li><a href="#aboutUs">About Us</a></li>
                <li><a href="Products.php">All Products</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="#">Hi, <?php echo $userName; ?></a></li>
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
    <main>
        <section id="hero">
            <div id="hero-content">
                <h1>Tech <span style="color: #54bafa;">Z</span>one</h1>
                <p>WELCOME TO, TechZone Your Online Tech Shop!</p>
                <p>Stay ahead with the best in technology!</p>
                <a href="Products.php" class="shop-now-btn">Shop Now</a>
            </div>
        </section>

        <!-- Latest Products Section -->
        <section id="latest-products" class="my-5">
            <h2 class="text-center">Latest Products</h2>
            <div id="latestProductsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" id="carousel-inner">
                    <!-- Dynamic content will be inserted here -->
                </div>
                <!-- Navigation arrows -->
                <button class="carousel-control-prev" type="button" data-bs-target="#latestProductsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#latestProductsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <!-- About Us Section -->
        <section class="about-us" id="aboutUs">
            <h2>ABOUT <span class="highlight">US</span></h2>
            <p>We believe that the more we share, the more we learn.</p>
            <div class="features-container">
                <div class="feature">
                    <i class="fa-solid fa-newspaper"></i>
                    <h3>POWER OF FLEXIBILITY</h3>
                    <p>Experience the best with us.</p>
                </div>
                <div class="feature">
                    <i class="fa fa-diamond"></i>
                    <h3>FULLY RESPONSIVE</h3>
                    <p>Your needs, our priority.</p>
                </div>
                <div class="feature">
                    <i class="fa fa-area-chart"></i>
                    <h3>GREAT DEALS</h3>
                    <p>Unmatched prices for tech enthusiasts.</p>
                </div>
            </div>
        </section>
    </main>

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
                <a href="https://web.facebook.com"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <?php if (isset($_SESSION['welcome_message'])): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div id="welcomeToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= $_SESSION['welcome_message']; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastElement = document.getElementById('welcomeToast');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        });
    </script>
     <?php unset($_SESSION['welcome_message']);?>
    <?php endif; ?>

</body>
</html>
