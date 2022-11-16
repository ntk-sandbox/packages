<?php

use ZnSandbox\Sandbox\Application\Symfony4\Admin\Controllers\ApplicationController;
use ZnSandbox\Sandbox\Application\Symfony4\Admin\Controllers\EdsController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use ZnSandbox\Sandbox\Application\Symfony4\Admin\Controllers\ApiKeyController;
use ZnLib\Web\Controller\Helpers\RouteHelper;

return function (RoutingConfigurator $routes) {
    RouteHelper::generateCrud($routes, ApplicationController::class, '/application/application');
    RouteHelper::generateCrud($routes, ApiKeyController::class, '/application/api-key');
    RouteHelper::generateCrud($routes, EdsController::class, '/application/eds');
};
