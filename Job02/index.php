<?php

class Category  
{
    // Propriétés privées
    private int $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    // Constructeur pour initialiser les propriétés lors de la création de l'objet
    public function __construct(int $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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

    public function getDescription(): string
    {
        return $this->description;
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

    public function setDescription(string $description): void
    {
        $this->description = $description;
        $this->updatedAt = new DateTime();
    }
}
