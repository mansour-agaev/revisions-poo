<?php

class Category
{
    private $id; // Identifiant de la catégorie

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Récupère tous les produits liés à cette catégorie
     * 
     * @return array Tableau d'instances de Product, ou tableau vide s'il n'y a aucun produit
     */
    public function getProducts()
    {
        // Connexion à la base de données (à adapter selon votre configuration)
        $pdo = new PDO('mysql:host=localhost;dbname=nom_de_la_base', 'utilisateur', 'mot_de_passe');

        // Préparation de la requête SQL pour récupérer les produits
        $sql = 'SELECT * FROM products WHERE category_id = :category_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category_id', $this->id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats sous forme de tableau associatif
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Tableau pour stocker les instances de Product
        $products = [];

        // Si des produits sont trouvés, les instancier et les ajouter au tableau
        if ($productsData) {
            foreach ($productsData as $productData) {
                $products[] = new Product($productData['id'], $productData['name'], $productData['price'], $productData['category_id']);
            }
        }

        // Retourner le tableau des produits (vide s'il n'y en a pas)
        return $products;
    }
}
