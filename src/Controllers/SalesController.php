<?php

namespace App\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\SalesRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SalesController
{
    public function __construct(
        private SalesRepository $salesRepository,
        private ProductRepository $productRepository
    ) {
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $sales = $this->salesRepository->getAllSales();

        $response->getBody()->write(json_encode($sales));

        return $response->withStatus(200);
    }

    public function create(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();

        if (!$body) {
            $response->getBody()->write(json_encode([
                'message' => 'Sales not created',
                'status' => 'error'
            ]));

            return $response->withStatus(400);
        }

        $result = $this->salesRepository->create($body);

        if (!$result) {
            $response->getBody()->write(json_encode([
                'message' => 'Sales not created',
                'status' => 'error'
            ]));

            return $response->withStatus(500);
        }

        $response->getBody()->write(json_encode([
            'message' => 'Sales created',
            'status' => 'success'
        ]));

        return $response->withStatus(201);
    }

    public function getAllRecentSales(Request $request, Response $response): Response
    {
        $recentSales = $this->salesRepository->getAllRecentSales();

        $recentSales = array_map(fn ($sale) => [
            'id' => $sale['id'],
            'name' => $sale['name'],
            'productType' => $sale['product_type'],
            'quantity' => $sale['quantity'],
            'price' => $sale['price_total'],
        ], $recentSales);

        $response->getBody()->write(json_encode($recentSales));

        return $response->withStatus(200);
    }

    public function getMetricsSales(Request $request, Response $response): Response
    {
        $totalRevenue = $this->salesRepository->getTotalRevenue();
        $totalSales = $this->salesRepository->getTotalSales();
        $totalProducts = $this->productRepository->getTotalProducts();
        $averageTicket = $this->salesRepository->getAverageTicket();

        $result = [
            'totalRevenue' => $totalRevenue,
            'totalSales' => $totalSales,
            'totalProducts' => $totalProducts,
            'averageTicket' => $averageTicket
        ];

        $response->getBody()->write(json_encode($result));

        return $response->withStatus(200);
    }

    public function getSalesByDay(Request $request, Response $response): Response
    {
        $sales = $this->salesRepository->getSalesVolumePerDay();

        $response->getBody()->write(json_encode($sales));

        return $response->withStatus(200);
    }
}
