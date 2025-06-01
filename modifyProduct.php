<?php
session_start();
require_once "dbconnect.php";
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit("Access Denied");
}

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    // Proceed with the rest of the code
} else {
    echo "Error: Product ID not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    
    $productId = intval($_GET['id']);
   

    $query = "SELECT * FROM products WHERE product_id = $productId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        exit("Product not found.");
    }
}

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['update_product'])) {
        $productId = intval($_GET['id']);
        $title = $conn->real_escape_string($_GET['title']);
        $brand = $conn->real_escape_string($_GET['brand']);
        $category = intval($_GET['category']);
        $desc = $conn->real_escape_string($_GET['desc']);
        $price = intval($_GET['price']);
        $imagePath = null;
    
        // Handle file upload if a new image is provided
        if (!empty($_FILES['image']['name'])) {
            $targetDir = "images/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
            if (in_array($imageFileType, ['png', 'jpg', 'jpeg'])) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    $imagePath = $targetFile;
                } else {
                    exit("Error uploading the image.");
                }
            } else {
                exit("Only PNG, JPG, and JPEG files are allowed.");
            }
        }
    
        // Update the product in the database
        $updateQuery = "UPDATE products SET 
                        product_title = '$title', 
                        product_brand = '$brand', 
                        product_cat = $category, 
                        product_desc = '$desc', 
                        product_price = $price";
    
        if ($imagePath) {
            $updateQuery .= ", product_image = '$imagePath'";
        }
    
        $updateQuery .= " WHERE product_id = $productId";
    
        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Product updated successfully.',
                        }).then(() => {
                            window.location.href = 'manageProducts.php';
                        });
                    });
                 </script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="manageProducts.css">
    <title>Modify Product page</title>
</head>
<body>
    <header id="main-header">
        <div id="logo-container">
            <img src="images/TechZoneLogo.png" alt="Tech Zone logo">
            <a href="#" id="logo">Tech<span style="color: #54bafa;">Z</span>one</a>
        </div>
        <nav>
            <ul>
                <li><a href="">Hi,Admin</a></li>
                <li><a href="manageProducts.php">Manage Products</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <div class="form-container">
        <h1>Modify Product</h1>
        <form action="modifyProduct.php" method="GET" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
        <input type="hidden" name="id" value="<?= $product['product_id'] ?>"> 
            <p>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?= htmlspecialchars($product['product_title']) ?>" required>
            </p>
            <p>
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" value="<?= htmlspecialchars($product['product_brand']) ?>" required>
            </p>
            <p>
                <label for="category">Product Category</label>
                <select name="category" id="category" required>
                    <option value="1" <?= $product['product_cat'] == 1 ? 'selected' : '' ?>>Computers</option>
                    <option value="2" <?= $product['product_cat'] == 2 ? 'selected' : '' ?>>Chargers & Cables</option>
                    <option value="3" <?= $product['product_cat'] == 3 ? 'selected' : '' ?>>Components</option>
                    <option value="4" <?= $product['product_cat'] == 4 ? 'selected' : '' ?>>Storage Devices</option>
                    <option value="5" <?= $product['product_cat'] == 5 ? 'selected' : '' ?>>Accessories</option>
                </select>
            </p>
            <p>
                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept=".png,.jpg,.jpeg">
                <small>Current Image: <img src="<?= $product['product_image'] ?>" alt="Product Image" width="100"></small>
            </p>
            <p>
                <label for="desc">Product Description</label>
                <textarea name="desc" id="desc" required rows="10"><?= htmlspecialchars($product['product_desc']) ?></textarea>
            </p>
            <p>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" min="1" step="1" value="<?= $product['product_price'] ?>" required>
            </p>
            <button type="reset" class="btn btn-alt">Reset</button>
            <button type="submit" name="update_product" class="btn">Save</button>
        </form>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>