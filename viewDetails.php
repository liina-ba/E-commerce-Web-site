<?php
session_start();

require_once "dbconnect.php";
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user']);
$userName = $isLoggedIn ? htmlspecialchars($_SESSION['user']['first_name']) : null;

// Check if the product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Product ID not provided.'); window.location.href = 'index.php';</script>";
    exit();
}

$productId = intval($_GET['id']); // Sanitize the product ID
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="viewDetails.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="app.js" defer></script>
    <title>View Details</title>
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
                <li><a href="Products.php">All Products</a></li>
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
    <main>
    <section id="product-details">
            <div id="details-container"></div>
        </section>
    </main>
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
         const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
        const productId = <?php echo $productId; ?>;

        fetch('getProductDetails.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderProductDetails(data.product);
            } else {
                alert(data.message || "Failed to fetch product details.");
            }
        })
        .catch(error => console.error('Error fetching product details:', error));

        // Function to render product details on the page
        function renderProductDetails(product) {
    const container = document.getElementById('details-container');
    container.innerHTML = `
        <div class="product-image">
            <img src="${product.product_image}" alt="${product.product_title}">
        </div>
        <div class="product-info">
            <h1>${product.product_title}</h1>
            <p><strong>Brand:</strong> ${product.product_brand}</p>
            <p><strong>Price:</strong> <span class="price">${parseFloat(product.product_price).toFixed(2)} DA</span></p>
            <p><strong>Descreption: </strong><br><br> ${product.product_desc}</p>
            <button class="btn btn-primary add-to-cart" 
                data-id="${product.product_id}" 
                data-title="${product.product_title}" 
                data-price="${product.product_price}" 
                data-image="${product.product_image}">
                Add to Cart
            </button>
        </div>
    `;

    document.querySelectorAll(".add-to-cart").forEach((button) => {
        button.addEventListener("click", (e) => {
            if (!isLoggedIn) { 
                Swal.fire({
                    title: "Fail!",
                    text: "Please log in to add items to the cart.",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#54bafa",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "products.php"; 
                    }
                });
            } else{
                const product = {
                    id: e.target.getAttribute("data-id"),
                    title: e.target.getAttribute("data-title"),
                    price: parseFloat(e.target.getAttribute("data-price")),
                    image: e.target.getAttribute("data-image"),
                };
                addToCart(product); 
            }  
        });
    });

}
    </script>

</body>
</html>
