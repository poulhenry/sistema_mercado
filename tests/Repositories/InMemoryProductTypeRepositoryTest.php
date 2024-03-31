<?php

namespace Tests\Repositories;

use App\Entites\ProductTax;
use App\Entites\ProductType;
use App\Repositories\InMemory\InMemoryProductTaxRepository;
use App\Repositories\InMemory\InMemoryProductTypeRepository;
use PHPUnit\Framework\TestCase;

class InMemoryProductTypeRepositoryTest extends TestCase
{
    private InMemoryProductTypeRepository $inMemoryProductTypeRepository;
    private InMemoryProductTaxRepository $inMemoryProductTaxRepository;

    public function setUp(): void
    {
        $this->inMemoryProductTypeRepository = new InMemoryProductTypeRepository();
        $this->inMemoryProductTaxRepository = new InMemoryProductTaxRepository();
    }

    public function testFindAll(): void
    {
        $productTax = new ProductTax(1, 'IVA', 0.21);
        $this->inMemoryProductTaxRepository->create($productTax);

        $productType = new ProductType(1, 'Alimento', $productTax->getId());
        $productTypeRepository = new InMemoryProductTypeRepository([1 => $productType]);
        $productTypeRepository->create($productType);

        $productTypes = $productTypeRepository->findAll();
        $this->assertObjectHasProperty('id', $productTypes[0]);
        $this->assertEquals('Alimento', $productTypes[0]->getName());
    }

    public function testCreateProductType()
    {
        $productTax = new ProductTax(1, 'IVA', 0.21);
        $this->inMemoryProductTaxRepository->create($productTax);

        $productType = new ProductType(1, 'Alimento', $productTax->getId());
        $result = $this->inMemoryProductTypeRepository->create($productType);

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
    }
}
