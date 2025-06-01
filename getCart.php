<?php
session_start();
header('Content-Type: application/json');



// Database connection
require_once "dbconnect.php";

$user_id = $_SESSION['user_id'];

// Ensure cart exists for this user
$sql = "SELECT cart_id FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_id = $result->fetch_assoc()['cart_id'] ?? null;

if (!$cart_id) {
    echo json_encode([]); // Empty cart
    exit;
}

// Fetch cart items
$sql = "
    SELECT 
        ci.product_id, 
        p.product_title, 
        p.product_price, 
        ci.quantity, 
        (p.product_price * ci.quantity) AS total, 
        p.product_image 
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.product_id
    WHERE ci.cart_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cart_id);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

echo json_encode($cartItems);
?>
