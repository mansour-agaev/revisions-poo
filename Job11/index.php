<?php

class Product {
    protected $id;
    protected $name;
    protected $price;
    protected $category_id;
    protected $image_url;
    protected $quantity;
    protected $created_at;
    protected $updated_at;

    // Constructeur
    public function __construct($name, $price, $category_id, $image_url = null, $quantity = null) {
        $this->name = $name;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->image_url = $image_url;
        $this->quantity = $quantity;
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
    }

    // Méthodes create, update, find, etc. pour gérer les produits génériques
    // ...
}

class Clothing extends Product {
    private $size;
    private $color;
    private $type;
    private $material_fee;

    public function __construct($name, $price, $category_id, $size, $color, $type, $material_fee, $image_url = null, $quantity = null) {
        parent::__construct($name, $price, $category_id, $image_url, $quantity);
        $this->size = $size;
        $this->color = $color;
        $this->type = $type;
        $this->material_fee = $material_fee;
    }

    // Méthode pour insérer un produit de type Clothing
    public function create(PDO $conn) {
        $conn->beginTransaction();
        try {
            // Insérer dans la table products
            parent::create($conn);

            // Insérer dans la table clothings
            $sql = 'INSERT INTO clothings (product_id, size, color, type, material_fee) 
                    VALUES (:product_id, :size, :color, :type, :material_fee)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':product_id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':size', $this->size);
            $stmt->bindParam(':color', $this->color);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':material_fee', $this->material_fee);
            $stmt->execute();

            $conn->commit();
            return $this;
        } catch (Exception $e) {
            $conn->rollBack();
            return false;
        }
    }

    // Méthode pour mettre à jour un produit de type Clothing
    public function update(PDO $conn) {
        $conn->beginTransaction();
        try {
            // Mettre à jour la table products
            parent::update($conn);

            // Mettre à jour la table clothings
            $sql = 'UPDATE clothings 
                    SET size = :size, color = :color, type = :type, material_fee = :material_fee 
                    WHERE product_id = :product_id';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':size', $this->size);
            $stmt->bindParam(':color', $this->color);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':material_fee', $this->material_fee);
            $stmt->bindParam(':product_id', $this->id, PDO::PARAM_INT);
            $stmt->execute();

            $conn->commit();
            return $this;
        } catch (Exception $e) {
            $conn->rollBack();
            return false;
        }
    }
}


