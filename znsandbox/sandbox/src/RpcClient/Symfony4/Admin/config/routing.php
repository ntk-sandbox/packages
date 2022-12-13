<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use ZnSandbox\Sandbox\RpcClient\Symfony4\Admin\Controllers\ClientController;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('rpc-client/request', '/rpc-client/request')
        ->controller([ClientController::class, 'request'])
        ->methods(['GET', 'POST']);
    $routes
        ->add('rpc-client/request/clear-history', '/rpc-client/request/clear-history')
        ->controller([ClientController::class, 'clearHistory'])
        ->methods(['GET', 'POST']);
    $routes
        ->add('rpc-client/request/import-from-routes', '/rpc-client/request/import-from-routes')
        ->controller([ClientController::class, 'importFromRoutes'])
        ->methods(['GET', 'POST']);
    $routes
        ->add('rpc-client/request/all-routes', '/rpc-client/request/all-routes')
        ->controller([ClientController::class, 'allRoutes'])
        ->methods(['GET', 'POST']);
    
    //    RouteHelper::generateCrud($routes, ApplicationController::class, '/application/application');
};
