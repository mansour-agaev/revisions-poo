<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $category_id;
    private $image_url;
    private $created_at;
    private $updated_at;

    // Constructeur
    public function __construct($name, $price, $category_id, $image_url = null, $created_at = null, $updated_at = null)
    {
        $this->name = $name;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->image_url = $image_url ?? 'default_image_url';  // URL par défaut si aucune image n'est fournie
        $this->created_at = $created_at ?? new DateTime();     // Date de création par défaut à l'instant actuel
        $this->updated_at = $updated_at ?? new DateTime();     // Date de mise à jour par défaut à l'instant actuel
    }

    // Autres méthodes comme des getters et setters...

    /**
     * Insère le produit en base de données
     * 
     * @param PDO $conn La connexion PDO à la base de données
     * @return Product|false Retourne l'instance du produit avec l'ID nouvellement créée, sinon false
     */
    public function create(PDO $conn)
    {
        try {
            // Préparation de la requête SQL pour insérer un nouveau produit
            $sql = 'INSERT INTO products (name, price, category_id, image_url, created_at, updated_at) 
                    VALUES (:name, :price, :category_id, :image_url, :created_at, :updated_at)';
            $stmt = $conn->prepare($sql);

            // Liaison des paramètres avec les valeurs de l'instance actuelle
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
            $stmt->bindParam(':image_url', $this->image_url);
            $stmt->bindParam(':created_at', $this->created_at->format('Y-m-d H:i:s'));
            $stmt->bindParam(':updated_at', $this->updated_at->format('Y-m-d H:i:s'));

            // Exécution de la requête
            $stmt->execute();

            // Si l'insertion réussit, récupérer l'ID du produit nouvellement créé
            $this->id = $conn->lastInsertId();

            // Retourner l'instance courante avec l'ID nouvellement créée
            return $this;
        } catch (Exception $e) {
            // En cas d'échec de l'insertion, retourner false
            return false;
        }
    }
}
