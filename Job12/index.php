<?php
class ProductRepository
{
    protected $data = [];

    public function findOneById($id)
    {
        // Cette méthode sera redéfinie dans les classes enfants
        return false;
    }

    public function findAll()
    {
        // Cette méthode sera redéfinie dans les classes enfants
        return [];
    }

    public function create($product)
    {
        $this->data[] = $product;
    }

    public function update($id, $updatedProduct)
    {
        foreach ($this->data as &$product) {
            if ($product->id === $id) {
                $product = $updatedProduct;
                return true;
            }
        }
        return false;
    }
}
class Clothing extends ProductRepository
{
    public function findOneById($id)
    {
        foreach ($this->data as $product) {
            if ($product->id === $id && $product instanceof Clothing) {
                return $product;
            }
        }
        return false;
    }

    public function findAll()
    {
        $clothingItems = [];
        foreach ($this->data as $product) {
            if ($product instanceof Clothing) {
                $clothingItems[] = $product;
            }
        }
        return $clothingItems;
    }

    public function create($clothingItem)
    {
        if ($clothingItem instanceof Clothing) {
            parent::create($clothingItem);
        }
    }

    public function update($id, $updatedClothingItem)
    {
        if ($updatedClothingItem instanceof Clothing) {
            return parent::update($id, $updatedClothingItem);
        }
        return false;
    }
}
class Electronic extends ProductRepository
{
    public function findOneById($id)
    {
        foreach ($this->data as $product) {
            if ($product->id === $id && $product instanceof Electronic) {
                return $product;
            }
        }
        return false;
    }

    public function findAll()
    {
        $electronicItems = [];
        foreach ($this->data as $product) {
            if ($product instanceof Electronic) {
                $electronicItems[] = $product;
            }
        }
        return $electronicItems;
    }

    public function create($electronicItem)
    {
        if ($electronicItem instanceof Electronic) {
            parent::create($electronicItem);
        }
    }

    public function update($id, $updatedElectronicItem)
    {
        if ($updatedElectronicItem instanceof Electronic) {
            return parent::update($id, $updatedElectronicItem);
        }
        return false;
    }
}
