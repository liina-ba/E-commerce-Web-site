<?php
require_once "dbconnect.php";
header('Content-Type: application/json');

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['product_id']) || empty($input['product_id'])) {
    echo json_encode([
        "success" => false,
        "message" => "Product ID not provided."
    ]);
    exit();
}

$productId = intval($input['product_id']);

$sql = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    echo json_encode([
        "success" => true,
        "product" => $product
    ]);
} else {
    echo json_encode(array(
        "success" => false,
        "message" => "Product not found."
    ));
}
?>