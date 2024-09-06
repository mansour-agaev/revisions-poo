<?php

namespace App\Abstract;

abstract class AbstractProduct
{
    protected $name;
    protected $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function getDescription();

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

namespace App\Interface;


interface StockableInterface
{
    public function addStocks(int $stock): self;
    public function removeStocks(int $stock): self;
}
