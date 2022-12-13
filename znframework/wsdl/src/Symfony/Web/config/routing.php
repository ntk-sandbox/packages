<?php

use ZnFramework\Wsdl\Symfony\Web\Controllers\DefinitionController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use ZnFramework\Wsdl\Symfony\Web\Controllers\TransportController;

return function (RoutingConfigurator $routes) {
    /*$routes
        ->add('wsdl/docs', '/wsdl')
        ->controller([WsdlController::class, 'showDocs'])
        ->methods(['GET']);*/

    $routes
        ->add('wsdl/callProcedure', '/wsdl/{app}/request')
        ->controller([TransportController::class, 'index'])
        ->requirements(['app' => '.+'])
        ->methods(['POST', 'GET']);

    $routes
        ->add('wsdl/definition', '/wsdl/{app}/definition/{file}')
        ->controller([DefinitionController::class, 'index'])
        ->requirements(['app' => '.+'])
        ->requirements(['file' => '.+'])
        ->methods(['POST', 'GET']);

    /*$routes
        ->add('wsdl/client', '/wsdl/client')
        ->controller([\ZnFramework\Wsdl\Symfony\Web\Controllers\WsdlClientController::class, 'index'])
        ->methods(['POST', 'GET']);*/
};
