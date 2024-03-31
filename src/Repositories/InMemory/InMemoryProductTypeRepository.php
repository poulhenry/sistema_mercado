<?php

namespace App\Repositories\InMemory;

use App\Entites\ProductTax;
use App\Entites\ProductType;

class InMemoryProductTypeRepository
{
    /** @var ProductType[] */
    private array $productTypeRepository;

    public function __construct(array $data = null)
    {
        $this->productTypeRepository = $data ?? [
            1 => new ProductType(1, 'T-Shirt', 1),
            2 => new ProductType(2, 'Jacket', 2),
        ];
    }

    public function findAll(): array
    {
        return array_values($this->productTypeRepository);
    }

    public function findByName(string $name): ?array
    {
        if (!$name) {
            return null;
        }

        return $this->productTypeRepository[array_search($name, array_column($this->productTypeRepository, 'name'))];
    }

    public function create(ProductType $productType): bool
    {
        if (!$productType instanceof ProductType) {
            return false;
        }

        $this->productTypeRepository[count($this->productTypeRepository) + 1] = $productType;

        return true;
    }
}
