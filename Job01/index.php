<?php

class Product
{
    // Propriétés privées
    private int $id;
    private string $name;
    private array $photos;
    private int $price;
    private string $description;
    private int $quantity;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    // Constructeur pour initialiser les propriétés lors de la création de l'objet
    public function __construct(
        int $id,
        string $name,
        array $photos,
        int $price,
        string $description,
        int $quantity
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    // Setters
    public function setName(string $name): void
    {
        $this->name = $name;
        $this->updatedAt = new DateTime();
    }

    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
        $this->updatedAt = new DateTime();
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
        $this->updatedAt = new DateTime();
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
        $this->updatedAt = new DateTime();
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
        $this->updatedAt = new DateTime();
    }
}
