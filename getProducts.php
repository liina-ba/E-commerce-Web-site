<?php
require_once "dbconnect.php";
// Get optional query parameters
$category = isset($_GET['category']) ? $_GET['category'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : null;

// Base SQL query
$sql = "
    SELECT 
        products.product_id,
        products.product_title,
        products.product_price,
        products.product_image,
        categories.cat_title AS category_name
    FROM 
        products
    JOIN 
        categories 
    ON 
        products.product_cat = categories.cat_id
";

// Add filtering by category
if (!empty($category) && $category !== 'all') {
    $sql .= " WHERE categories.cat_title = '" . $conn->real_escape_string($category) . "'";
}

// Add sorting by price or date
if ($sort === 'price_low_high') {
    $sql .= " ORDER BY products.product_price ASC";
} elseif ($sort === 'price_high_low') {
    $sql .= " ORDER BY products.product_price DESC";
} else {
    $sql .= " ORDER BY products.product_id DESC"; // Assuming `product_id` reflects the latest products
}

$result = $conn->query($sql);

// Convert result to JSON
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($products);

$conn->close();
?>