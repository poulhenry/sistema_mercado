<?php

namespace Tests\Repositories;

use App\Entites\Sale;
use App\Repositories\InMemory\InMemorySalesRepository;
use PHPUnit\Framework\TestCase;

class InMemorySalesRepositoryTest extends TestCase
{
    public function testIfReturnAllSales(): void
    {
        $sale1 = new Sale(1, '2024-03-29', 100.2, 2, 1);
        $sale2 = new Sale(2, '2024-03-30', 100.2, 2, 1);
        $sale3 = new Sale(3, '2024-03-31', 100.2, 2, 1);

        $sales = [
            1 => $sale1,
            2 => $sale2,
            3 => $sale3
        ];

        $salesRepository = new InMemorySalesRepository($sales);
        $allSales = $salesRepository->getAllSales();

        $this->assertIsArray($allSales);
        $this->assertContains($sale1, $allSales);
        $this->assertCount(3, $allSales);
    }

    public function testIfReturnAllRecentSales(): void
    {
        $sale1 = new Sale(1, '2024-03-29', 100.2, 2, 1);
        $sale2 = new Sale(2, '2024-03-30', 100.2, 2, 1);
        $sale3 = new Sale(3, '2024-03-31', 100.2, 2, 1);

        $sales = [
            1 => $sale1,
            2 => $sale2,
            3 => $sale3
        ];

        $salesRepository = new InMemorySalesRepository($sales);
        $recentSales = $salesRepository->getAllRecentSales();

        $this->assertEquals($sale3, $recentSales[0]);
    }

    public function testIfGetTotalRevenueReturnsSumOfSales()
    {
        $sale1 = new Sale(1, '2024-03-29', 100.25, 2, 1);
        $sale2 = new Sale(2, '2024-03-30', 200, 2, 1);
        $sale3 = new Sale(3, '2024-03-31', 300.25, 2, 1);

        $sales = [
            1 => $sale1,
            2 => $sale2,
            3 => $sale3
        ];

        $salesRepository = new InMemorySalesRepository($sales);
        $totalRevenue = $salesRepository->getTotalRevenue();

        $this->assertIsNumeric($totalRevenue);
        $this->assertEquals(600.5, $totalRevenue);
    }

    public function testIfGetTotalSalesReturnsNumberOfSales()
    {
        $sale1 = new Sale(1, '2024-03-29', 100.25, 2, 1);
        $sale2 = new Sale(2, '2024-03-30', 200, 2, 1);
        $sale3 = new Sale(3, '2024-03-31', 300.25, 2, 1);

        $sales = [
            1 => $sale1,
            2 => $sale2,
            3 => $sale3
        ];

        $salesRepository = new InMemorySalesRepository($sales);
        $totalSales = $salesRepository->getTotalSales();

        $this->assertIsNumeric($totalSales);
        $this->assertEquals(3, $totalSales);
    }

    public function testIfGetAverageTicketReturnsAverageTicket()
    {
        $sale1 = new Sale(1, '2024-03-29', 100.25, 2, 1);
        $sale2 = new Sale(2, '2024-03-30', 200, 2, 1);
        $sale3 = new Sale(3, '2024-03-31', 300.25, 2, 1);

        $sales = [
            1 => $sale1,
            2 => $sale2,
            3 => $sale3
        ];

        $salesRepository = new InMemorySalesRepository($sales);
        $averageTicket = $salesRepository->getAverageTicket();

        $this->assertIsNumeric($averageTicket);
        $this->assertEquals(200.17, $averageTicket);
    }

    public function testGetSalesVolumePerDayReturnsSalesPerDay()
    {
        $sale1 = new Sale(1, '2024-03-29', 100.25, 2, 1);
        $sale2 = new Sale(2, '2024-03-30', 200, 2, 1);
        $sale3 = new Sale(3, '2024-03-31', 300.25, 1, 1);

        $sales = [
            1 => $sale1,
            2 => $sale2,
            3 => $sale3
        ];

        $salesRepository = new InMemorySalesRepository($sales);
        $salesPerDay = $salesRepository->getSalesVolumePerDay();

        $this->assertIsArray($salesPerDay);
        $this->assertArrayHasKey('2024-03-29', $salesPerDay);
        $this->assertArrayHasKey('2024-03-30', $salesPerDay);
        $this->assertArrayHasKey('2024-03-31', $salesPerDay);

        $this->assertEquals(2, $salesPerDay['2024-03-29']);
        $this->assertEquals(2, $salesPerDay['2024-03-30']);
        $this->assertEquals(1, $salesPerDay['2024-03-31']);
    }

    public function testCreateSale()
    {
        $sale1 = new Sale(1, '2024-03-29', 100.25, 2, 1);
        $sale2 = new Sale(2, '2024-03-30', 200, 2, 1);
        $sale3 = new Sale(3, '2024-03-31', 300.25, 1, 1);

        $sales = [
            1 => $sale1,
            2 => $sale2,
            3 => $sale3
        ];

        $salesRepository = new InMemorySalesRepository([]);
        $result = $salesRepository->create($sales);
        $allSales = $salesRepository->getAllSales();

        $this->assertCount(3, $allSales);
        $this->assertEquals(true, $result);
    }
}
