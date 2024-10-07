<?php
require_once '../auth/Auth.php';
require_once '../models/Database.php';
require_once '../controllers/ProductsController.php';

$auth = new Auth(new Database());

if (!$auth->isAuthenticated()) {
    echo "Please log in to make a purchase.";
    exit();
}

$controller = new ProductsController(new Database());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    if ($controller->purchase($_SESSION['user_id'], $product_id, $quantity)) {
        echo "Purchase successful!";
    } else {
        echo "Unable to complete the purchase.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Purchase Product</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/validation.js" defer></script>  <!-- Include the JS file -->
</head>
<body>
    <h1>Purchase Product</h1>
    <form method="POST" id="purchase-form">
        <label for="product_id">Product ID:</label>
        <input type="number" name="product_id" id="product_id" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" required>

        <button type="submit">Purchase</button>
    </form>
</body>
</html>
