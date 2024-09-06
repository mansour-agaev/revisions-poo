<?php

// Définition de l'interface StockableInterface
interface StockableInterface
{
    // Méthode pour ajouter des stocks
    public function addStocks(int $stock): self;

    // Méthode pour retirer des stocks
    public function removeStocks(int $stock): self;
}

class Clothing extends AbstractProduct implements StockableInterface
{
    private $size;
    private $color;
    private $stock = 0; // Gestion des stocks

    public function __construct($name, $price, $size, $color)
    {
        parent::__construct($name, $price);
        $this->size = $size;
        $this->color = $color;
    }

    // Implémentation de la méthode addStocks
    public function addStocks(int $stock): self
    {
        $this->stock += $stock;
        return $this;
    }

    // Implémentation de la méthode removeStocks
    public function removeStocks(int $stock): self
    {
        if ($stock <= $this->stock) {
            $this->stock -= $stock;
        } else {
            throw new Exception("Stock insuffisant pour retirer $stock articles.");
        }
        return $this;
    }

    // Méthode pour obtenir la description de l'article
    public function getDescription()
    {
        return "Clothing: {$this->name}, Size: {$this->size}, Color: {$this->color}, Price: {$this->price}, Stock: {$this->stock}";
    }
}
