<?php

// Définition de la classe abstraite AbstractProduct
abstract class AbstractProduct
{
    // Propriétés communes à tous les produits
    protected $name;
    protected $price;

    // Constructeur commun à tous les produits
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    // Méthode abstraite qui doit être implémentée par toutes les classes enfants
    abstract public function getDescription();

    // Autres méthodes communes non abstraites
    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

// Classe Clothing qui étend AbstractProduct
class Clothing extends AbstractProduct
{
    private $size;
    private $color;

    public function __construct($name, $price, $size, $color)
    {
        parent::__construct($name, $price);
        $this->size = $size;
        $this->color = $color;
    }

    // Implémentation de la méthode abstraite getDescription
    public function getDescription()
    {
        return "Clothing: {$this->name}, Size: {$this->size}, Color: {$this->color}, Price: {$this->price}";
    }
}

// Classe Electronic qui étend AbstractProduct
class Electronic extends AbstractProduct
{
    private $brand;
    private $warranty;

    public function __construct($name, $price, $brand, $warranty)
    {
        parent::__construct($name, $price);
        $this->brand = $brand;
        $this->warranty = $warranty;
    }

    // Implémentation de la méthode abstraite getDescription
    public function getDescription()
    {
        return "Electronic: {$this->name}, Brand: {$this->brand}, Warranty: {$this->warranty}, Price: {$this->price}";
    }
}

// Exemple d'utilisation
$shirt = new Clothing("T-Shirt", 20, "M", "Blue");
echo $shirt->getDescription();

$laptop = new Electronic("Laptop", 1000, "Dell", "2 years");
echo $laptop->getDescription();
