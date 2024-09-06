<?php

class Product {
    private $id;
    private $name;
    private $price;
    private $category_id;

    // Constructeur avec des paramètres optionnels pour permettre l'hydratation
    public function __construct($id = null, $name = null, $price = null, $category_id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category_id = $category_id;
    }

    // Autres méthodes comme des getters et setters...

    /**
     * Récupère toutes les lignes de la table products et retourne un tableau d'instances de Product
     * 
     * @param PDO $conn La connexion PDO à la base de données
     * @return array Tableau d'instances de Product
     */
    public static function findAll(PDO $conn) {
        // Préparation de la requête SQL pour récupérer tous les produits
        $sql = 'SELECT * FROM products';
        $stmt = $conn->prepare($sql);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Récupération des résultats
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Tableau pour stocker les instances de Product
        $products = [];
        
        // Boucle sur chaque ligne pour créer une instance de Product
        foreach ($productsData as $productData) {
            $products[] = new Product(
                $productData['id'],
                $productData['name'],
                $productData['price'],
                $productData['category_id']
            );
        }
        
        // Retourner le tableau des produits
        return $products;
    }
}
   