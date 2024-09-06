<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $category_id;

    public function __construct($id, $name, $price, $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category_id = $category_id;
    }

    // Autres méthodes comme des getters...

    /**
     * Récupère la catégorie associée à ce produit
     * 
     * @param PDO $conn La connexion PDO à la base de données
     * @return Category|null Instance de la classe Category ou null si non trouvée
     */
    public function getCategory(PDO $conn)
    {
        // Préparation de la requête SQL pour récupérer la catégorie
        $sql = 'SELECT * FROM categories WHERE id = :category_id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats
        $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si une catégorie est trouvée, on retourne une instance de Category
        if ($categoryData) {
            return new Category($categoryData['id'], $categoryData['name']);
        }

        // Sinon, on retourne null
        return null;
    }
}
