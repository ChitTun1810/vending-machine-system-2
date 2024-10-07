<?php
require_once '../models/Database.php';
require_once '../controllers/ProductsController.php';

header('Content-Type: application/json');

$controller = new ProductsController(new Database());
$products = $controller->index();
echo json_encode($products);
