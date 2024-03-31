<?php

namespace App\Repositories\InMemory;

use App\Entites\ProductTax;

class InMemoryProductTaxRepository
{
    /** @var ProductTax[] */
    private array $productTaxData = [];

    public function __construct(array $productTaxData = null)
    {
        $this->productTaxData = $productTaxData ?? [
            1 => new ProductTax(1, 'IVA', 0.19),
            2 => new ProductTax(2, 'PISA', 0.21)
        ];
    }

    public function findAll(): array
    {
        return array_values($this->productTaxData);
    }

    public function findByName(string $name): ?array
    {
        if (!$name) {
            return null;
        }

        return $this->productTaxData[array_search($name, array_column($this->productTaxData, 'name'))] ?? null;
    }

    public function create(ProductTax $productTax): bool
    {
        if (!$productTax instanceof ProductTax) {
            return false;
        }

        $this->productTaxData[count($this->productTaxData) + 1] = $productTax;

        return true;
    }
}
