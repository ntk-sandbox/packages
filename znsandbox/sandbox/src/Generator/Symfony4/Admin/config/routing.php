<?php

use ZnSandbox\Sandbox\Generator\Symfony4\Admin\Controllers\ApplicationController;
use ZnSandbox\Sandbox\Generator\Symfony4\Admin\Controllers\EdsController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use ZnSandbox\Sandbox\Generator\Symfony4\Admin\Controllers\ApiKeyController;
use ZnLib\Web\Controller\Helpers\RouteHelper;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('generator/bundle', '/generator/bundle')
        ->controller([\ZnSandbox\Sandbox\Generator\Symfony4\Admin\Controllers\BundleController::class, 'index'])
        ->methods(['GET', 'POST']);
    $routes
        ->add('generator/bundle/view', '/generator/bundle/view')
        ->controller([\ZnSandbox\Sandbox\Generator\Symfony4\Admin\Controllers\BundleController::class, 'view'])
        ->methods(['GET', 'POST']);
    
    //    RouteHelper::generateCrud($routes, ApplicationController::class, '/application/application');
};
