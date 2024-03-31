<?php

namespace App\Controllers;

use App\Repositories\ProductTypeRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProductTypeController
{
    public function __construct(private ProductTypeRepository $productTypeRepository)
    {
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $productsType = $this->productTypeRepository->findAll();

        $response->getBody()->write(json_encode($productsType));

        return $response->withStatus(200);
    }

    public function create(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();

        if (!$body) {
            $response->getBody()->write(json_encode([
                'message' => 'Product type not created',
                'status' => 'error'
            ]));

            return $response->withStatus(500);
        }

        $result = $this->productTypeRepository->create($body);

        if (!$result) {
            $response->getBody()->write(json_encode([
                'message' => 'Product type not created',
                'status' => 'error'
            ]));

            return $response->withStatus(500);
        }

        $response->getBody()->write(json_encode([
            'message' => 'Product type created successfully',
            'status' => 'success'
        ]));

        return $response->withStatus(201);
    }
}
