<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use ZnBundle\Log\Symfony4\Admin\Controllers\ApiKeyController;
use ZnBundle\Log\Symfony4\Admin\Controllers\ApplicationController;
use ZnBundle\Log\Symfony4\Admin\Controllers\EdsController;
use ZnLib\Web\Controller\Helpers\RouteHelper;
use ZnBundle\Log\Symfony4\Admin\Controllers\HistoryController;

return function (RoutingConfigurator $routes) {
    RouteHelper::generateCrud($routes, HistoryController::class, '/log/history');
};
