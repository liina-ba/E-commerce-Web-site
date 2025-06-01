<?php
session_start();

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
    <script type="module" src="manageProducts.js" defer></script>
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
                <li><a href="#">Hi, Admin</a></li>
                <li><a href="admin.php">Add a Product</a></li>
                <li><a href="logout.php">Log Out</a></li>
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
    <div id="customConfirmModal" class="modal">
    <div class="modal-content">
        <h3>Are you sure you want to delete this product?</h3>
        <button id="confirmDelete" class="btn">Yes, Delete</button>
        <button id="cancelDelete" class="btn btn-alt">Cancel</button>
    </div>
</div>


</body>
</html>
