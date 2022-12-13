<?php

use ZnSandbox\Sandbox\Person\Symfony4\Web\Controllers\PersonController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('settings/person', '/person-settings')
        ->controller([PersonController::class, 'update'])
        ->methods(['GET', 'POST']);
};
