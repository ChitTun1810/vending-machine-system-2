<?php
require_once '../auth/Auth.php';
require_once '../models/Database.php';
require_once '../controllers/ProductsController.php';

$auth = new Auth(new Database());

if (!$auth->isAdmin()) {
    echo "Access Denied. You must be an admin to access this page.";
    exit();
}

$controller = new ProductsController(new Database());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];

    if (!empty($name) && $price > 0 && $quantity >= 0) {
        $controller->create($name, $price, $quantity);
        echo "Product created successfully!";
    } else {
        echo "Invalid input.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/validation.js" defer></script>  <!-- Include the JS file -->
</head>
<body>
    <h1>Create New Product</h1>
    <form method="POST" id="create-product-form">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" min="0.01" step="0.01" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="0" required>

        <button type="submit">Create</button>
    </form>
</body>
</html>
