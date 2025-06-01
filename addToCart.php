<?php
session_start();
header('Content-Type: application/json');

// Database connection
require_once "dbconnect.php";

$user_id = $_SESSION['user_id']; // Use the logged-in user ID


// Fetch product data from the request
$data = json_decode(file_get_contents("php://input"), true);
$product_id = $data['product_id'];
$quantity = $data['quantity'];

// Ensure cart exists for this user
$sql = "SELECT cart_id FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $cart_id = $row['cart_id'];
} else {
    $sql = "INSERT INTO cart (user_id) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $cart_id = $conn->insert_id;
}

// Check if the product already exists in the cart
$sql = "SELECT item_id FROM cart_items WHERE cart_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $cart_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Update quantity
    $sql = "UPDATE cart_items SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $cart_id, $product_id);
    $stmt->execute();
} else {
    // Insert a new item
    $sql = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $cart_id, $product_id, $quantity);
    $stmt->execute();
}

// Fetch the updated cart item count for the badge
$sql = "SELECT SUM(quantity) AS total_items FROM cart_items WHERE cart_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cart_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$total_items = $result['total_items'] ?? 0;

echo json_encode(["success" => true, "message" => "Product added to cart.", "cart_count" => $total_items]);
?>
