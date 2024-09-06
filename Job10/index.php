<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $category_id;
    private $image_url;
    private $quantity;
    private $created_at;
    private $updated_at;

    // Constructeur avec des paramètres optionnels pour permettre l'hydratation
    public function __construct($id = null, $name = null, $price = null, $category_id = null, $image_url = null, $quantity = null, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->image_url = $image_url;
        $this->quantity = $quantity;
        $this->created_at = $created_at ?? new DateTime();
        $this->updated_at = $updated_at ?? new DateTime();
    }

    // Getters et setters pour chaque propriété...

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Met à jour le produit dans la base de données
     * 
     * @param PDO $conn La connexion PDO à la base de données
     * @return Product|false Retourne l'instance mise à jour, sinon false
     */
    public function update(PDO $conn)
    {
        if ($this->id === null) {
            return false; // Impossible de mettre à jour sans ID
        }

        try {
            // Préparation de la requête SQL pour mettre à jour le produit
            $sql = 'UPDATE products 
                    SET name = :name, price = :price, category_id = :category_id, image_url = :image_url, quantity = :quantity, updated_at = :updated_at 
                    WHERE id = :id';
            $stmt = $conn->prepare($sql);

            // Liaison des paramètres avec les valeurs de l'instance actuelle
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
            $stmt->bindParam(':image_url', $this->image_url);
            $stmt->bindParam(':quantity', $this->quantity, PDO::PARAM_INT);
            $stmt->bindParam(':updated_at', $this->updated_at->format('Y-m-d H:i:s'));
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            // Exécution de la requête
            $stmt->execute();

            // Retourner l'instance courante mise à jour
            return $this;
        } catch (Exception $e) {
            // En cas d'échec de la mise à jour, retourner false
            return false;
        }
    }
}
