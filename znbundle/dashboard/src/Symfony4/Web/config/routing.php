<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use ZnBundle\Dashboard\Symfony4\Web\Controllers\DashboardController;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('main_page', '/')
        ->controller([DashboardController::class, 'index']);
};
