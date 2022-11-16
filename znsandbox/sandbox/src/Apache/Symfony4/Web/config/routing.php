<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use ZnSandbox\Sandbox\Apache\Symfony4\Web\Controllers\ServerController;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('apache/server/index', '/apache')
        ->controller([ServerController::class, 'index']);
    $routes
        ->add('apache/server/view', '/apache/view')
        ->controller([ServerController::class, 'view']);
};
