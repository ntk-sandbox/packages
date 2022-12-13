<?php

use ZnBundle\Language\Symfony4\Web\Controllers\CurrentController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('language/current/switch', '/language/current/switch')
        ->controller([CurrentController::class, 'switch'])
        ->methods(['GET', 'POST']);
};
