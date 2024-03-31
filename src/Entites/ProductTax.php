<?php

namespace App\Entites;

class ProductTax
{
    public function __construct(
        private int $id,
        private string $name,
        private float $tax
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

    public function getTax(): int
    {
        return $this->tax;
    }

    public function setTax($tax): self
    {
        $this->tax = $tax;

        return $this;
    }
}
