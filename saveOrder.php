<?php
session_start();
require_once "dbconnect.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null; // Get user ID from session
    $cart = json_decode(file_get_contents('php://input'), true)['cart'] ?? [];
    file_put_contents('debug_cart.log', print_r($cart, true)); // Log cart data for debugging


    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }

    if (empty($cart)) {
        echo json_encode(['success' => false, 'message' => 'Cart is empty']);
        exit;
    }

    $total_amount = 0;
    foreach ($cart as $item) {
        if (!isset($item['product_id'], $item['product_price'], $item['quantity'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid cart item data']);
            exit;
        }
        $total_amount += $item['product_price'] * $item['quantity'];
    }
    
    $conn->begin_transaction();
    try {
        // Insert into customer_order
        $stmt = $conn->prepare("INSERT INTO customer_order (user_id, order_date, total_amount) VALUES (?, NOW(), ?)");
        $stmt->bind_param("id", $user_id, $total_amount);
        $stmt->execute();
        $order_id = $conn->insert_id;

        // Insert into order_items
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($cart as $item) {
            $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['product_price']);
            $stmt->execute();
        }
        // Clear cart for the user
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()]);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
