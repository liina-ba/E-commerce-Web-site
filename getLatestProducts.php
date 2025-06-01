<?php
require_once "dbconnect.php";

// Query to fetch the latest products (e.g., order by ID or timestamp)
$sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT 6"; 
$result = mysqli_query($conn, $sql);

// Prepare the JSON response
$latestProducts = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $latestProducts[] = $row;
    }
}

// Output JSON
header('Content-Type: application/json');
echo json_encode($latestProducts);
?>
