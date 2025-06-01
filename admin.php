<?php
session_start();
require_once "dbconnect.php";
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit("Access Denied");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $title = $conn->real_escape_string($_POST['title']);
    $brand = $conn->real_escape_string($_POST['brand']);
    $category = $conn->real_escape_string($_POST['category']);
    $desc = $conn->real_escape_string($_POST['desc']);
    $price = intval($_POST['price']);

    $checkQuery = "SELECT * FROM products WHERE product_title = '$title' AND product_brand = '$brand' AND product_cat = '$category'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'This product already exists in the database.',
                    }).then(() => {
                        window.location.href = 'admin.php';
                    });
                });
             </script>";

    } else {
        // Handle file upload
        $targetDir = "images/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Check if file is an image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Allow only PNG and JPG file types
        if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
            echo "Sorry, only PNG, JPG, and JPEG files are allowed.";
            $uploadOk = 0;
        }
        // Check if upload is OK
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // Insert data into the database
                $sql = "INSERT INTO products (product_title, product_brand, product_cat, product_desc, product_price, product_image)
                        VALUES ('$title', '$brand', '$category', '$desc', $price, '$targetFile')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'New product added successfully.',
                        }).then(() => {
                            window.location.href = 'admin.php';
                        });
                    });
                 </script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="app.js" defer></script> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="manageProducts.css">
    <title>Admin page</title>
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
        <h1>Add new Product</h1>
        <form action="admin.php" method="POST" enctype="multipart/form-data">
            <p>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
            </p>
            <p>
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" required>
            </p>
            <p>
                <label for="category">Product Category</label>
                <select name="category" id="category" required>
                    <option value="1">Computers</option>
                    <option value="2">Chargers & Cables</option>
                    <option value="3">Components</option>
                    <option value="4">Storage Devices</option>
                    <option value="5">Accessories</option>
                </select>
            </p>
            <p>
                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept=".png,.jpg">
            </p>
            <p>
                <label for="desc">Product Descreption</label>
                <textarea  name="desc" id="desc" required rows="10"></textarea>
            </p>
            <p>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" min="1" step="1" required>
            </p>
            <button type="reset" class="btn btn-alt">Reset</button>
            <button class="btn">Save</button>

        </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>