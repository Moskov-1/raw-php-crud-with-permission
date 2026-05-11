<?php

namespace App;

class Product
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM products');
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name, $description, $price)
    {
        $sql = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $description, $price]);
    }

    public function update($id, $name, $description, $price)
    {
        $sql = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $description, $price, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = ?');
        return $stmt->execute([$id]);
    }

    // Code Smell: Unused method
    /*
    public function getProductByName($name)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE name = ?');
        $stmt->execute([$name]);
        return $stmt->fetch();
    }
    */
}
