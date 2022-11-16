<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use ZnUser\Rbac\Symfony4\Admin\Controllers\ApiKeyController;
use ZnUser\Rbac\Symfony4\Admin\Controllers\ApplicationController;
use ZnUser\Rbac\Symfony4\Admin\Controllers\EdsController;
use ZnLib\Web\Controller\Helpers\RouteHelper;
use ZnUser\Rbac\Symfony4\Admin\Controllers\HistoryController;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('rbac/info', '/rbac/info')
        ->controller([\ZnUser\Rbac\Symfony4\Admin\Controllers\InfoController::class, 'index'])
        ->methods(['GET', 'POST']);

    //RouteHelper::generateCrud($routes, HistoryController::class, '/log/history');

};
