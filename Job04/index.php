<?php
$servername = "localhost";
$username = "root";
$password = "";  // Utilisez le mot de passe correct
$dbname = "draft_shop";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Préparer et exécuter la requête SQL pour récupérer le produit avec l'id 7
$product_id = 7;
$sql = "SELECT * FROM product WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si un produit a été trouvé
if ($result->num_rows > 0) {
    // Récupérer les données sous forme de tableau associatif
    $productData = $result->fetch_assoc();

    // Afficher les données du produit (facultatif pour tester)
    echo "<pre>";
    print_r($productData);
    echo "</pre>";

    // Inclure la classe Product (Assurez-vous que la classe Product est correctement définie)
    require_once 'Product.php';

    // Hydrater une nouvelle instance de Product avec les données récupérées
    $product = new Product(
        $productData['id'],
        $productData['name'],
        json_decode($productData['photos'], true),  // Conversion JSON vers tableau
        $productData['price'],
        $productData['description'],
        $productData['quantity'],
        $productData['category_id']
    );

    // Utiliser les getters pour vérifier les données de l'objet hydraté
    echo "Produit hydraté :<br>";
    echo "Nom : " . $product->getName() . "<br>";
    echo "Prix : " . $product->getPrice() . "<br>";
    echo "Quantité : " . $product->getQuantity() . "<br>";
    echo "Catégorie ID : " . $product->getCategoryId() . "<br>";
} else {
    echo "Aucun produit trouvé avec l'ID 7.";
}

// Fermer la connexion
$conn->close();
?>
