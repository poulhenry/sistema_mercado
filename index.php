<?php

use App\Controllers\ProductController;
use App\Controllers\ProductTaxController;
use App\Controllers\ProductTypeController;
use App\Controllers\SalesController;
use App\Middlewares\EnableCorsMiddleware;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$definitions = __DIR__ . "/utils/definitions.php";

$builder = new ContainerBuilder();
$builder->addDefinitions($definitions);
$container = $builder->build();

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(new EnableCorsMiddleware);

$app->addRoutingMiddleware();

$app->group('/products', function ($app) {
    // Product Routes
    $app->get('', ProductController::class);
    $app->post('/store', [ProductController::class, 'create']);

    // Type Routes
    $app->get('/types', ProductTypeController::class);
    $app->post('/types/store', [ProductTypeController::class, 'create']);

    // Tax Routes
    $app->get('/tax', ProductTaxController::class);
    $app->post('/tax/store', [ProductTaxController::class, 'create']);

    // Sales Routes
    $app->get('/sales', SalesController::class);
    $app->get('/sales/recent', [SalesController::class, 'getAllRecentSales']);
    $app->get('/sales/metrics', [SalesController::class, 'getMetricsSales']);
    $app->get('/sales/sales-by-day', [SalesController::class, 'getSalesByDay']);
    $app->post('/sales/store', [SalesController::class, 'create']);
});

$app->run();
