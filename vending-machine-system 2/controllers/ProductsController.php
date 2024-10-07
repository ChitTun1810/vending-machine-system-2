<?php
class ProductsController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Fetch all products
        return $this->db->query("SELECT * FROM products")->fetchAll();
    }

    public function create($name, $price, $quantity) {
        // Insert new product into the database
        $this->db->query("INSERT INTO products (name, price, quantity_available) VALUES (?, ?, ?)", [$name, $price, $quantity]);
    }

    public function update($id, $name, $price, $quantity) {
        // Update existing product in the database
        $this->db->query("UPDATE products SET name = ?, price = ?, quantity_available = ? WHERE id = ?", [$name, $price, $quantity, $id]);
    }

    public function delete($id) {
        // Delete a product by its ID
        $this->db->query("DELETE FROM products WHERE id = ?", [$id]);
    }

    public function purchase($user_id, $product_id, $quantity) {
        // Fetch product
        $product = $this->db->query("SELECT * FROM products WHERE id = ?", [$product_id])->fetch();

        if (!$product || $product['quantity_available'] < $quantity) {
            return false; // Not enough stock or product doesn't exist
        }

        // Calculate total price
        $total_price = $product['price'] * $quantity;

        // Update product quantity
        $new_quantity = $product['quantity_available'] - $quantity;
        $this->db->query("UPDATE products SET quantity_available = ? WHERE id = ?", [$new_quantity, $product_id]);

        // Log the transaction
        $this->db->query("INSERT INTO transactions (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)", [$user_id, $product_id, $quantity, $total_price]);

        return true;
    }
}
