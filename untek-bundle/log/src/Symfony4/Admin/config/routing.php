<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Untek\Bundle\Log\Symfony4\Admin\Controllers\ApiKeyController;
use Untek\Bundle\Log\Symfony4\Admin\Controllers\ApplicationController;
use Untek\Bundle\Log\Symfony4\Admin\Controllers\EdsController;
use Untek\Component\Web\Controller\Helpers\RouteHelper;
use Untek\Bundle\Log\Symfony4\Admin\Controllers\HistoryController;

return function (RoutingConfigurator $routes) {
    RouteHelper::generateCrud($routes, HistoryController::class, '/log/history');
};
