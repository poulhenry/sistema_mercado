<?php

namespace App\Repositories\InMemory;

use App\Entites\Product;

class InMemoryProductRepository
{
    public function __construct(private array $products = [])
    {
    }

    public function findByAll(): array
    {
        return array_values($this->products);
    }

    public function getTotalProducts(): int
    {
        $totalProducts = count($this->products);

        if ($totalProducts === 0) {
            return 0;
        }

        return $totalProducts;
    }

    public function create(Product $product): bool
    {
        if (!$product instanceof Product) {
            return false;
        }

        $this->products[count($this->products) + 1] = $product;

        return true;
    }
}
