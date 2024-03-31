<?php

namespace App\Controllers;

use App\Repositories\ProductRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProductController
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(Request $request, Response $response)
    {
        $products = $this->productRepository->findByAll();

        $products = array_map(fn ($product) => [
            'id' => $product['id'],
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => $product['price'],
            'productTypeName' => $product['product_type_name'],
            'taxName' => $product['tax_name'],
            'tax' => $product['tax'],
        ], $products);

        $response->getBody()->write(json_encode($products));

        return $response->withStatus(200);
    }

    public function create(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        $result = $this->productRepository->create($body);

        if (!$result) {
            $response->getBody()->write(json_encode([
                'message' => 'Product not created',
                'status' => 'error'
            ]));

            return $response->withStatus(500);
        }

        $response->getBody()->write(json_encode([
            'message' => 'Product created successfully',
            'status' => 'success'
        ]));

        return $response->withStatus(201);
    }
}
