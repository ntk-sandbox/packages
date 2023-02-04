<?php

use Untek\Sandbox\Sandbox\Asset\Symfony4\Web\Controllers\AssetsController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Untek\Lib\Web\Controller\Helpers\RouteHelper;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('assets', '/assets/{file}')
        ->controller([AssetsController::class, 'open'])
        ->requirements(['file' => '.+'])
        ->methods(['GET']);


//    RouteHelper::generateCrud($routes, FileController::class, '/storage/assets');
};
