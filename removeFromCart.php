<?php
session_start();
header('Content-Type: application/json');

// Database connection
require_once "dbconnect.php";

// Fetch user ID
$user_id = $_SESSION['user_id'] ?? session_id();

// Fetch data from the request
$data = json_decode(file_get_contents("php://input"), true);
$product_id = $data['product_id'];

// Fetch the cart ID
$sql = "SELECT cart_id FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_id = $result->fetch_assoc()['cart_id'] ?? null;

if (!$cart_id) {
    echo json_encode(["success" => false, "message" => "Cart not found."]);
    exit;
}

// Remove the product from the cart
$sql = "DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $cart_id, $product_id);
$stmt->execute();

echo json_encode(["success" => true, "message" => "Product removed from cart."]);
?>
