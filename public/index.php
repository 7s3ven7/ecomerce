<?php

require_once __DIR__ . '/../vendor/autoload.php';

use wesley\Page;
use wesley\PageAdmin;
use wesley\DB\Sql;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response, array $args)
{
    $interface = new Page();
    $interface->setTpl('index');
});

$app->get('/admin', function (Request $request, Response $response, array $args)
{
    $interface = new PageAdmin();
    $interface->setTpl('index');
});

$app->run();