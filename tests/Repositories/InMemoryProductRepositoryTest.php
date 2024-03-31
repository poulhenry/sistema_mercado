<?php

namespace Tests\Repositories;

use App\Entites\Product;
use App\Entites\ProductTax;
use App\Entites\ProductType;
use App\Repositories\InMemory\InMemoryProductRepository;
use PHPUnit\Framework\TestCase;

class InMemoryProductRepositoryTest extends TestCase
{
    public function testFindByAll(): void
    {
        $productTax = new ProductTax(1, 'ISS', 0.1);
        $productType = new ProductType(1, 'Alimento', $productTax->getId());
        $product = new Product(1, 'Coca Cola', 'Cola Cola Lata', 10, $productType->getId(), $productTax->getId());

        $productRepository = new InMemoryProductRepository([1 => $product]);
        $products = $productRepository->findByAll();

        $this->assertIsArray($products);
        $this->assertEquals(1, count($products));
        $this->assertEquals('Coca Cola', $products[0]->getName());
    }

    public function testIfGetTotalProducts(): void
    {
        $productTax = new ProductTax(1, 'ISS', 0.1);
        $productType = new ProductType(1, 'Alimento', $productTax->getId());
        $product = new Product(1, 'Coca Cola', 'Cola Cola Lata', 10, $productType->getId(), $productTax->getId());

        $productRepository = new InMemoryProductRepository([1 => $product]);

        $totalProducts = $productRepository->getTotalProducts();

        $this->assertIsInt($totalProducts);
        $this->assertEquals(1, $totalProducts);
    }

    public function testCreateProduct(): void
    {
        $productTax = new ProductTax(1, 'ISS', 0.1);
        $productType = new ProductType(1, 'Alimento', $productTax->getId());
        $product = new Product(1, 'Coca Cola', 'Cola Cola Lata', 10, $productType->getId(), $productTax->getId());

        $productRepository = new InMemoryProductRepository();
        $result = $productRepository->create($product);

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
    }
}
