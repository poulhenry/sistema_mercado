<?php

namespace App\Entites;

class ProductType
{
    public function __construct(
        private int $id,
        private string $name,
        private int $productTaxId
    ) {
    }

    public function getId(): int
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

    public function getProductTaxId(): int
    {
        return $this->productTaxId;
    }

    public function setProductTaxId($productTaxId): self
    {
        $this->productTaxId = $productTaxId;

        return $this;
    }
}
