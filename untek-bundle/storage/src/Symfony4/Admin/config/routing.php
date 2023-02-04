<?php

use Untek\Bundle\Storage\Symfony4\Admin\Controllers\FileController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Untek\Lib\Web\Controller\Helpers\RouteHelper;

return function (RoutingConfigurator $routes) {
    RouteHelper::generateCrud($routes, FileController::class, '/storage/file');
};
