<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $category_id;

    // Constructeur vide pour permettre l'instanciation sans hydratation initiale
    public function __construct() {}

    // Autres méthodes comme des getters et setters...

    /**
     * Trouve un produit par son ID et hydrate l'instance courante
     * 
     * @param PDO $conn La connexion PDO à la base de données
     * @param int $id L'ID du produit à rechercher
     * @return Product|false Retourne l'instance du produit si trouvé, sinon false
     */
    public function findOneById(PDO $conn, int $id)
    {
        // Préparation de la requête SQL pour récupérer le produit
        $sql = 'SELECT * FROM products WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si un produit est trouvé, hydrater l'instance courante
        if ($productData) {
            $this->id = $productData['id'];
            $this->name = $productData['name'];
            $this->price = $productData['price'];
            $this->category_id = $productData['category_id'];

            // Retourner l'instance courante
            return $this;
        }

        // Si aucun produit n'est trouvé, retourner false
        return false;
    }

    // Ajoutez des getters et setters si nécessaire pour accéder aux propriétés privées
}
