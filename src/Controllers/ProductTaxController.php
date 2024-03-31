<?php

namespace App\Controllers;

use App\Repositories\ProductTaxRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProductTaxController
{
    public function __construct(private ProductTaxRepository $productTaxRepository)
    {
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $result = $this->productTaxRepository->findAll();

        $response->getBody()->write(json_encode($result));

        return $response->withStatus(200);
    }

    public function create(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();

        if (!$body) {
            $response->getBody()->write(json_encode([
                'message' => 'Product tax not created',
                'status' => 'error'
            ]));

            return $response->withStatus(500);
        }

        $result = $this->productTaxRepository->create($body);

        if (!$result) {
            $response->getBody()->write(json_encode([
                'message' => 'Product tax not created',
                'status' => 'error'
            ]));

            return $response->withStatus(500);
        }

        $response->getBody()->write(json_encode([
            'message' => 'Product tax created successfully',
            'status' => 'success'
        ]));

        return $response->withStatus(201);
    }
}
