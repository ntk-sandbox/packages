<?php

use Untek\Sandbox\Sandbox\Generator\Symfony4\Admin\Controllers\ApplicationController;
use Untek\Sandbox\Sandbox\Generator\Symfony4\Admin\Controllers\EdsController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Untek\Sandbox\Sandbox\Generator\Symfony4\Admin\Controllers\ApiKeyController;
use Untek\Lib\Web\Controller\Helpers\RouteHelper;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('generator/bundle', '/generator/bundle')
        ->controller([\Untek\Sandbox\Sandbox\Generator\Symfony4\Admin\Controllers\BundleController::class, 'index'])
        ->methods(['GET', 'POST']);
    $routes
        ->add('generator/bundle/view', '/generator/bundle/view')
        ->controller([\Untek\Sandbox\Sandbox\Generator\Symfony4\Admin\Controllers\BundleController::class, 'view'])
        ->methods(['GET', 'POST']);
    
    //    RouteHelper::generateCrud($routes, ApplicationController::class, '/application/application');
};
