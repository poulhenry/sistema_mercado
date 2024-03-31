<?php

namespace App\Entites;

class Sale
{
    public function __construct(
        private ?int $id,
        private string $createdAt,
        private float $priceTotal,
        private int $quantity,
        private int $productId
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

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }


    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPriceTotal(): float
    {
        return $this->priceTotal;
    }


    public function setPriceTotal($priceTotal): self
    {
        $this->priceTotal = $priceTotal;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId($productId): self
    {
        $this->productId = $productId;

        return $this;
    }
}
