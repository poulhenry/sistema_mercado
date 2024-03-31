<?php

namespace App\Repositories\InMemory;

use App\Entites\Sale;

class InMemorySalesRepository
{
    /** @var Sale[] */
    private array $salesRepository;

    public function __construct(array $data = null)
    {
        $this->salesRepository = $data ?? [
            1 => new Sale(1, '2020-01-01', 100.0, 2, 2),
            2 => new Sale(2, '2020-01-02', 200.0, 3, 1),
        ];
    }

    public function getAllSales(): array
    {
        return array_values($this->salesRepository);
    }

    public function getAllRecentSales(): array
    {
        $recentSales = $this->salesRepository;
        krsort($recentSales);

        return array_values($recentSales);
    }

    public function getTotalRevenue(): float
    {
        $totalRevenue = 0;
        foreach ($this->salesRepository as $sale) {
            $totalRevenue += $sale->getPriceTotal();
        }

        return $totalRevenue;
    }

    public function getTotalSales(): int
    {
        return count($this->salesRepository);
    }

    public function getAverageTicket(): float
    {
        $totalRevenue = $this->getTotalRevenue();
        $totalSales = $this->getTotalSales();

        return round($totalRevenue / $totalSales, 2);
    }

    public function getSalesVolumePerDay(): array
    {
        $salesVolumePerDay = [];

        foreach ($this->salesRepository as $sale) {
            $date = $sale->getCreatedAt();
            $date = date('Y-m-d', strtotime($date));

            if (!isset($salesVolumePerDay[$date])) {
                $salesVolumePerDay[$date] = 0;
            }
            $salesVolumePerDay[$date] += $sale->getQuantity();
        }

        return $salesVolumePerDay;
    }

    /**
     * @param Sale[] $sale
     */
    public function create(array $sales): bool
    {
        if (!is_array($sales)) {
            return false;
        }

        foreach ($sales as $sale) {
            $this->salesRepository[count($this->salesRepository) + 1] = $sale;
        }

        return true;
    }
}
