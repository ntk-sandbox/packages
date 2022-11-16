<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use ZnUser\Password\Symfony4\Web\Controllers\RestorePasswordController;
use ZnUser\Password\Symfony4\Web\Controllers\UpdatePasswordController;

return function (RoutingConfigurator $routes) {
    $routes
        ->add('restore-password/request-activation-code', '/restore-password')
        ->controller([RestorePasswordController::class, 'requestActivationCode'])
        ->methods(['GET', 'POST']);
    $routes
        ->add('restore-password/create-password', '/restore-password/create-password')
        ->controller([RestorePasswordController::class, 'createPassword'])
        ->methods(['GET', 'POST']);
    $routes
        ->add('update-password', '/update-password')
        ->controller([UpdatePasswordController::class, 'updatePassword'])
        ->methods(['GET', 'POST']);
};
