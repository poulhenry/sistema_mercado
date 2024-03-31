<?php

namespace Tests\Repositories;

use App\Entites\ProductTax;
use App\Repositories\InMemory\InMemoryProductTaxRepository;
use PHPUnit\Framework\TestCase;

class InMemoryProductTaxRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $productTax = new ProductTax(1, 'Tax 1', 10);
        $productTaxRepository = new InMemoryProductTaxRepository([1 => $productTax]);
        $productTaxData = $productTaxRepository->findAll();

        $this->assertIsArray($productTaxData);
        $this->assertNotEmpty($productTaxData);
        $this->assertEquals(1, $productTaxData[0]->getId());
    }

    public function testCreateProductTax(): void
    {
        $tax = new ProductTax(5, 'Tax 1', 10);
        $productTypeRepository = new InMemoryProductTaxRepository();

        $result = $productTypeRepository->create($tax);
        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
    }
}
