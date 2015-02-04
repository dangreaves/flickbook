<?php

use Klein\Klein;
use DanGreaves\Flickbook\ContainerFactory;
use DanGreaves\Flickbook\Controllers;

//Include the composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

//Set some constants
define('CONFIG_DIR', __DIR__ . '/../config');
define('VIEWS_DIR', __DIR__ . '/../views');

//Instantiate the router
$router = new Klein;

//Lazy load a DI container when required
$router->respond(function ($request, $response, $service, $app) {
    $app->register('container', function () {
        $config = require_once CONFIG_DIR . '/config.php';
        return ContainerFactory::make($config);
    });
});

//Initial search homepage
$router->respond('GET', '/', function ($request, $response, $service, $app) {
    return Controllers\SearchController::make($request, $response, $service, $app)->getIndex();
});

//Search results
$router->respond('GET', '/search/[a:query]?', function ($request, $response, $service, $app) {
    return Controllers\SearchController::make($request, $response, $service, $app)->getResults();
});

//Detail page
$router->respond('GET', '/photo/[i:id]', function ($request, $response, $service, $app) {
    return Controllers\SearchController::make($request, $response, $service, $app)->getDetail();
});

//Dispatch the request
$router->dispatch();
