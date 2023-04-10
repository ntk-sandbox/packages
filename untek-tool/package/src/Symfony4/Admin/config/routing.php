<?php

use Untek\Tool\Package\Symfony4\Admin\Controllers\ApplicationController;
use Untek\Tool\Package\Symfony4\Admin\Controllers\EdsController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Untek\Tool\Package\Symfony4\Admin\Controllers\ApiKeyController;
use Untek\Component\Web\Controller\Helpers\RouteHelper;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('package/changed', '/package/changed')
        ->controller([\Untek\Tool\Package\Symfony4\Admin\Controllers\ChangedController::class, 'index'])
        ->methods(['GET', 'POST']);
    $routes
        ->add('package/changed/view', '/package/changed/view')
        ->controller([\Untek\Tool\Package\Symfony4\Admin\Controllers\ChangedController::class, 'view'])
        ->methods(['GET', 'POST']);
    
    //    RouteHelper::generateCrud($routes, ApplicationController::class, '/application/application');
};
