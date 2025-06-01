<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON input
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['id'])) {
        $productId = intval($data['id']);
        require_once "dbconnect.php";

        // Delete query
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            echo "Product deleted successfully.";
        } else {
            echo "Failed to delete the product.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Product ID not provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
