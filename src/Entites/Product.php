<?php

namespace App\Entites;

class Product
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $description,
        private float $price,
        private int $productTypeId,
        private int $productTaxId
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getProductTypeId(): int
    {
        return $this->productTypeId;
    }

    public function setProductTypeId($productTypeId): self
    {
        $this->productTypeId = $productTypeId;

        return $this;
    }
}
