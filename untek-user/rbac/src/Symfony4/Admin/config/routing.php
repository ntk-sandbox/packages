<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Untek\User\Rbac\Symfony4\Admin\Controllers\ApiKeyController;
use Untek\User\Rbac\Symfony4\Admin\Controllers\ApplicationController;
use Untek\User\Rbac\Symfony4\Admin\Controllers\EdsController;
use Untek\Component\Web\Controller\Helpers\RouteHelper;
use Untek\User\Rbac\Symfony4\Admin\Controllers\HistoryController;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('rbac/info', '/rbac/info')
        ->controller([\Untek\User\Rbac\Symfony4\Admin\Controllers\InfoController::class, 'index'])
        ->methods(['GET', 'POST']);

    //RouteHelper::generateCrud($routes, HistoryController::class, '/log/history');

};
