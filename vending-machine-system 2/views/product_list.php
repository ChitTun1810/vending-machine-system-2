<?php
require_once '../models/Database.php';
require_once '../controllers/ProductsController.php';

$controller = new ProductsController(new Database());
$products = $controller->index();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Product List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Available Quantity</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td>$<?= htmlspecialchars($product['price']) ?></td>
                <td><?= htmlspecialchars($product['quantity_available']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
