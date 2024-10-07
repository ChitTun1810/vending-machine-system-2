<?php
// Simple router to redirect to views
$route = $_GET['route'] ?? 'home';

if ($route == 'create_product') {
    require_once 'views/create_product.php';
} elseif ($route == 'product_list') {
    require_once 'views/product_list.php';
} elseif ($route == 'purchase_product') {
    require_once 'views/purchase_product.php';
} else {
    echo "<h1>Welcome to the Vending Machine System</h1>";
    echo "<a href='?route=create_product'>Create Product</a> | ";
    echo "<a href='?route=product_list'>View Products</a> | ";
    echo "<a href='?route=purchase_product'>Purchase Product</a>";
}
